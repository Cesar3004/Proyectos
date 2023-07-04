@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Nuevo Articulo</h3>
        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>

        </div>
    </div> 
</div> 

        @endif

        {!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
        {{Form::token()}}
<div class="row">
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nom_articulo" required value ="{{old('nom_articulo')}}" class="form-control" placeholder="Nombre">
        </div>
    </div>
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label>Categoria</label>
            <select name="idcategoria" class="form-control">
                    @foreach ($categorias as $cat)
                        <option value="{{$cat->idcategoria}}">{{$cat->nomcategoria}}</option>
                    @endforeach

            </select>
        </div>
    </div>
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label>Area a Asignar</label>
            <select name="idarea" class="form-control">
                    @foreach ($areas as $ar)
                        <option value="{{$ar->idarea}}">{{$ar->nomarea}}</option>
                    @endforeach

            </select>
        </div>
    </div>
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
            <label for="codigo">Codigo</label>
            <input type="text" name="codigo" required value ="{{old('codigo')}}" class="form-control" placeholder="Codigo del Articulo.....">
        </div>
    </div>
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
            <label for="stock">Stock</label>
            <input type="text" name="stock" required value ="{{old('stock')}}" class="form-control" placeholder="Stock del Articulo.....">
        </div>
    </div>
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
            <label for="descrip_articulo">Descripcion</label>
            <input type="text" name="descrip_articulo" required value ="{{old('descrip_articulo')}}" class="form-control" placeholder="Descripcion del Articulo.....">
        </div>
    </div>
    

    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" required  class="form-control" >
        </div>
    </div>
    
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <button class ="btn btn-primary" type="submit">Guardar</button>
            <button class ="btn btn-danger" type="reset">Cancelar</button>
        </div>

    </div>

</div>
        

        
        {!!Form::close()!!}
   
@endsection