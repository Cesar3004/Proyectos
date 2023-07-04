<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use DB;


class UsuarioController extends Controller
{
   public function __construct(){

    $this->middleware('auth');
   }

   public function index(Request $request){
    if($request)
    {
        $query=trim($request->get('searchText'));
        $usuarios=DB::table('users')
        ->where('name','LIKE','%'.$query.'%')
        ->orderBy('id','desc')
        ->paginate(7);
        return view('seguridad.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
    }



   }
   public function create(){
    return view("seguridad.usuario.create");
   }
   public function store(UsuarioFormRequest $request){
            $usuario=new \App\Models\User;
            $usuario->name=$request->get('name');
            $usuario->email=$request->get('email');
            $usuario->password= bcrypt($request->get('password'));
            $usuario->save();
            return Redirect::to('seguridad/usuario');


   }
   public function edit($id){

    return view("seguridad.usuario.edit",["usuario"=>\App\Models\User::findOrFail($id)]);
   }

   public function update(UsuarioFormRequest $request,$id)
   {
        $usuario=\App\Models\User::findOrFail($id);
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->update();
        return Redirect::to('seguridad/usario');
   }

   public function destroy($id){

        $usario = DB::table('users')->where('id','=',$id)->delete();
        return Redirect::to('seguridad/usuario');
   }
}

