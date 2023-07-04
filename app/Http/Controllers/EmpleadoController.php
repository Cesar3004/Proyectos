<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\EmpleadoFormRequest;
use DB;

class EmpleadoController extends Controller
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
          $empleados=DB::table('empleado as e')
          ->join('area as a','e.idarea','=','a.idarea')
          ->select('e.idempleado','e.nombre','e.apellido','e.tipo_documento','e.num_documento','e.telefono','e.email','a.nomarea as area')
          ->where('nombre','LIKE','%'.$query.'%')
          ->where('estado','=','Activo')
          ->orwhere('num_documento','LIKE','%'.$query.'%')
          ->where('estado','=','Activo')
          ->orderBy('idempleado','desc')
          ->paginate(7);
          return view('registros.empleado.index',["empleados"=>$empleados,"searchText"=>$query]);
        }

        
    }
    public function create()
    {
        $areas=DB::table('area')->get();
        return view("registros.empleado.create",["areas"=>$areas]);

    }
    public function store(EmpleadoFormRequest $request)
    {
        $empleado=new \App\Models\Empleado;
        
        $empleado->estado='Activo';
        $empleado->nombre=$request->get('nombre');
        $empleado->apellido=$request->get('apellido');
        $empleado->tipo_documento=$request->get('tipo_documento');
        $empleado->idarea=$request->get('idarea');
        $empleado->num_documento=$request->get('num_documento');
        $empleado->direccion=$request->get('direccion');
        $empleado->telefono=$request->get('telefono');
        $empleado->email=$request->get('email');
        


        $empleado->save();
        return Redirect::to('registros/empleado');
    }
    public function show($id)
    {
        return view("registros.empleado.show",["empleado"=>\App\Models\Empleado::findOrFail($id)]);
    }
    public function edit($id)
    
    {
        $empleado=\App\Models\Empleado::findOrFail($id);
        $areas=DB::table('area')->get();
        return view("registros.empleado.edit",["empleado"=>$empleado,"areas"=>$areas]);
    }
    public function update(EmpleadoFormRequest $request,$id)
    {
        $empleado=\App\Models\Empleado::findOrFail($id);

        $empleado->nombre=$request->get('nombre');
        $empleado->apellido=$request->get('apellido');
        $empleado->tipo_documento=$request->get('tipo_documento');
        $empleado->idarea=$request->get('idarea');
        $empleado->num_documento=$request->get('num_documento');
        $empleado->direccion=$request->get('direccion');
        $empleado->telefono=$request->get('telefono');
        $empleado->email=$request->get('email');

        $empleado->update();
        return Redirect::to('registros/empleado');
    }
    public function destroy($id)
    {
        $empleado=\App\Models\Empleado::findOrFail($id);
        $empleado->estado='Inactivo';
        $empleado->update();
        return Redirect::to('registros/empleado');
    }
}
