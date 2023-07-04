<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use DB;
class CategoriaController extends Controller
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
          $categorias=DB::table('categoria')
          ->where('nomcategoria','LIKE','%'.$query.'%')
          ->where('condicion','=','1')
          ->orderBy('idcategoria','desc')
          ->paginate(7);
          return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
        }

        
    }
    public function create()
    {
        return view("almacen.categoria.create");

    }
    public function store(CategoriaFormRequest $request)
    {
        $categoria=new \App\Models\Categoria;
        $categoria->nomcategoria=$request->get('nomcategoria');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->condicion='1';
        $categoria->save();
        return Redirect::to('almacen/categoria');
    }
    public function show($id)
    {
        return view("almacen.categoria.show",["categoria"=>\App\Models\Categoria::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("almacen.categoria.edit",["categoria"=>\App\Models\Categoria::findOrFail($id)]);
    }
    public function update(CategoriaFormRequest $request,$id)
    {
        $categoria=\App\Models\Categoria::findOrFail($id);
        $categoria->nomcategoria=$request->get('nomcategoria');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
    public function destroy($id)
    {
        $categoria=\App\Models\Categoria::findOrFail($id);
        $categoria->condicion='0';
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
}
