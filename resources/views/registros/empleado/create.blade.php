@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Nuevo Empleado</h3>
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

        {!!Form::open(array('url'=>'registros/empleado','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}
<div class="row">
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required value ="{{old('nombre')}}" class="form-control" placeholder="Nombre">
        </div>
    </div>
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
            <label for="nombre">Apellido</label>
            <input type="text" name="apellido" required value ="{{old('apellido')}}" class="form-control" placeholder="Apellido">
        </div>
    </div>
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label>Documento</label>
            <select name="tipo_documento" class="form-control">
                   
                        <option value="DNI">DNI</option>
                        <option value="PAS">PASAPORTE</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
            <label for="num_documento">Numero Documento</label>
            <input type="text" name="num_documento" required value ="{{old('num_documento')}}" class="form-control" placeholder="Numero de Documento">
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
            <label for="telefono">Telefono</label>
            <input type="text" name="telefono" required value ="{{old('telefono')}}" class="form-control" placeholder="Numero de telefono">
        </div>
    </div>
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" required value ="{{old('direccion')}}" class="form-control" placeholder="Direccion">
        </div>
    </div>
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" required value ="{{old('email')}}" class="form-control" placeholder="Ingrese su email">
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