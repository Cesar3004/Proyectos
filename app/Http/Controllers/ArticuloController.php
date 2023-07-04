<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Iluminate\Support\Facades\Redirect;
use Iluminate\Support\Facades\Input;
use App\Http\Requests\ArticuloFormRequest;
use App\Http\Requests\AreaFormRequest;
use App\Articulo;
use DB;

class ArticuloController extends Controller
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
          $articulos=DB::table('articulo as a')
          ->join('categoria as c','a.idcategoria','=','c.idcategoria')
          ->join('area as ar','a.idarea','=','ar.idarea')
          ->select('a.idarticulo','a.nom_articulo','a.codigo','a.stock','c.nomcategoria as categoria','ar.nomarea as area','a.descrip_articulo','a.imagen','a.estado')
          ->where('a.nom_articulo','LIKE','%'.$query.'%')
          ->where('estado','=','Activo')
          ->orwhere('a.codigo','LIKE','%'.$query.'%')
          ->where('estado','=','Activo')
          ->orderBy('a.idarticulo','desc')
          ->paginate(7);
          return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        }

        
    }
    public function create()
    {
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        $areas=DB::table('area')->get();
        return view("almacen.articulo.create",["categorias"=>$categorias,"areas"=>$areas]);
        

    }
    public function store(ArticuloFormRequest $request,)
    {
        $articulo=new \App\Models\Articulo;
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nom_articulo=$request->get('nom_articulo');
        $articulo->stock=$request->get('stock');
        $articulo->descrip_articulo=$request->get('descrip_articulo');
        $articulo->idarea=$request->get('idarea');

        $articulo->estado='Activo';

        if ($request->hasFile('imagen')){
            $file=$request->file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }
        $articulo->save();
        return \Illuminate\Support\Facades\Redirect::to('almacen/articulo');
    }
    public function show($id)
    {
        return view("almacen.articulo.show",["Articulo"=>\App\Models\Articulo::findOrFail($id)]);
    }
    public function edit($id)
    {
        $articulo=\App\Models\Articulo::findOrFail($id);
        $categorias=DB::table('categoria')
        ->where('condicion','=','1')->get();
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    }
    public function update(ArticuloFormRequest $request,$id)
    {
        $articulo=\App\Models\Articulo::findOrFail($id);
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nom_articulo=$request->get('nom_articulo');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descrip_articulo');
        $articulo->idarea=$request->get('id_area');
        

        if ($request->hasFile('imagen')){
            $file=$request->file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }
        $articulo->update();
        return \Illuminate\Support\Facades\Redirect::to('almacen/articulo');
    }
    public function destroy($id)
    {
        $articulo=\App\Models\Articulo::findOrFail($id);
        $articulo->estado='Inactivo';
        $articulo->update();
        return \Illuminate\Support\Facades\Redirect::to('almacen/articulo');
    }
}
