<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\RegistroFormRequest;
use App\Registro;
use App\DetalleRegistro;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class RegistroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }
    public function index(Request $request)
    {
        if($request)
        {
          $query=trim($request->get('searchText'));
          $registros=DB::table('registro as r')
          ->join('empleado as e','r.idempleado','=','e.idempleado')
          ->join('detalle_registro as dr','r.idregistro','=','dr.idregistro')
          ->select('r.idregistro','r.fecha_registro','e.nombre','e.apellido','r.numero_comprobante','r.estado','dr.cantidad')
          ->where('r.numero_comprobante','LIKE','%'.$query.'%')
          ->orderBy('r.idregistro','desc')
          ->paginate(7);
          return view('registros.registro.index',["registros"=>$registros,"searchText"=>$query]);

        }

        
    }
    public function create()
    {
        $empleados=DB::table('empleado')
        ->where('estado','=','Activo')->get();
        $articulos= DB::table('articulo as art')
        ->select(DB::raw('CONCAT(art.codigo," ",art.nom_articulo) AS articulo'),'art.idarticulo')
        ->where('art.estado','=','Activo')
        ->get();
        
        return view("registros.registro.create",["empleados"=>$empleados,"articulos"=>$articulos]);


    }

    public function store(RegistroFormRequest $request)
    {
        try{
            DB::beginTransaction();
            $registro=new \App\Models\Registro;
            $registro->idempleado=$request->get('idempleado');
            $registro->numero_comprobante=$request->get('numero_comprobante');

            $mytime = Carbon::now('America/Lima');
            $registro->fecha_registro=$mytime->toDateTimeString();
            $registro->estado='A';
            $registro->save();

            $idarticulo=$request->get('idarticulo');
            $cantidad=$request->get('cantidad');

            $cont=0;

            while($cont < count($idarticulo)){
                    $detalle = new \App\Models\DetalleRegistro();
                    $detalle->idregistro=$registro->idregistro;
                    $detalle->idarticulo=$idarticulo[$cont];
                    $detalle->cantidad=$cantidad[$cont];
                    $detalle->save();
                    $cont=$cont+1;
                    
            }


            DB::commit();

        }catch(\Exception $e)
        
        {

            DB::rollback();


        }
        return Redirect::to('registros/registro');




    }

    public function show($id)
    {
        $registro=DB::table('registro as r')
        ->join('empleado as e','r.idempleado','=','e.idempleado')
        ->join('detalle_registro as dr','r.idregistro','=','dr.idregistro')
        ->select('r.idregistro','r.fecha_registro','e.nombre','e.apellido','r.numero_comprobante','r.estado','dr.cantidad')
        ->where('r.idregistro','=',$id)
        ->first();
        
        $detalles=DB::table('detalle_registro as dr')
        
        ->join('articulo as a','dr.idarticulo','=','a.idarticulo')
        ->join('registro as r','r.idregistro','=','dr.idregistro')
        ->select('a.codigo','a.nom_articulo as articulo','a.descrip_articulo','r.fecha_registro','a.idarea as area')
        ->get();

        return view("registros/registro.show",["registro"=>$registro,"detalles"=>$detalles]);

    }

    public function destroy($id)
    {
        $registro=\App\Models\Registro::findOrFail($id);
        $registro->estado='C';
        $registro->update();
        return Redirect::to('registros/registro');

    }
}
