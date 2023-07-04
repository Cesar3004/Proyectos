<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\SalidaFormRequest;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;


class SalidaController extends Controller
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
          $salidas=DB::table('salida as s')
          ->join('empleado as e','s.idempleado','=','e.idempleado')
          ->join('detalle_salida as ds','s.idsalida','=','ds.idsalida')
          ->select('ds.idsalida','s.fecha_salida','e.nombre','e.apellido','s.estado','ds.cantidad')
          ->where('s.fecha_salida','LIKE','%'.$query.'%')
          ->orderBy('s.idsalida','desc')
          ->paginate(7);
          return view('registros.salida.index',["salidas"=>$salidas,"searchText"=>$query]);

        }

        
    }
    public function create()
    {
        $empleados=DB::table('empleado')
        ->where('estado','=','Activo')->get();
        $articulos= DB::table('articulo as art')
        
        ->select(DB::raw('CONCAT(art.codigo," ",art.nom_articulo) AS articulo'),'art.idarticulo','art.stock')
        ->where('art.estado','=','Activo')
        ->where('art.stock','>','0')
        ->get();
        
        return view("registros.salida.create",["empleados"=>$empleados,"articulos"=>$articulos]);


    }

    public function store(SalidaFormRequest $request)
    {
        try{
            DB::beginTransaction();
            $salida=new \App\Models\Salida;
            $salida->idempleado=$request->get('idempleado');

            $mytime = Carbon::now('America/Lima');
            $salida->fecha_salida=$mytime->toDateTimeString();
            $salida->estado='A';
            $salida->save();

            $idarticulo=$request->get('idarticulo');
            $cantidad=$request->get('cantidad');

            $cont=0;

            while($cont < count($idarticulo)){
                    $detalle = new \App\Models\DetalleSalida();
                    $detalle->idsalida=$salida->idsalida;
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
        return Redirect::to('registros/salida');




    }

    public function show($id)
    {
        $salida=DB::table('salida as s')
        ->join('empleado as e','s.idempleado','=','e.idempleado')
        ->join('detalle_salida as ds','s.idsalida','=','ds.idsalida')
        ->select('s.idsalida','s.fecha_salida','e.nombre','e.apellido','s.estado','ds.cantidad')
        ->where('s.idsalida','=',$id)
        ->first();
        
        $detalles=DB::table('detalle_salida as ds')
        
        ->join('articulo as a','ds.idarticulo','=','a.idarticulo')
        ->join('salida as s','s.idsalida','=','ds.idsalida')
        
        ->select('a.codigo','a.nom_articulo as articulo','a.descrip_articulo','s.fecha_salida','a.idarea as area')
        ->get();

        return view("registros/salida.show",["salida"=>$salida,"detalles"=>$detalles]);

    }

    public function destroy($id)
    {
        $salida=\App\Models\Salida::findOrFail($id);
        $salida->estado='R';
        $salida->update();
        return Redirect::to('registros/salida');

    }
}
