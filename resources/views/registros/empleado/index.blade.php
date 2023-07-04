@extends ('layouts.admin')
@section ('contenido')
<div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Empleados <a href="empleado/create"><button class="btn btn-success">Nuevo</button></a>
        <h3>
        @include('registros.empleado.search')
    </div>

</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo Doc.</th>
                    <th>Numero Doc.</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Area</th>
                    <th>Opciones</th>
                </thead>    
                @foreach ($empleados as $emp)
                <tr>
                    <td>{{$emp->idempleado}}</td>
                    <td>{{$emp->nombre}}</td>
                    <td>{{$emp->apellido}}</td>
                    <td>{{$emp->tipo_documento}}</td>
                    <td>{{$emp->num_documento}}</td>
                    <td>{{$emp->telefono}}</td>
                    <td>{{$emp->email}}</td>
                    <td>{{$emp->area}}</td>
                   
                    <td>
                        <a href="{{URL::action('EmpleadoController@edit',$emp->idempleado)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$emp->idempleado}}" data-toggle="modal" ><button class="btn btn-danger">Eliminar</button></a>
                    </td>
                </tr>
                @include('registros/empleado.modal')
                @endforeach
            </table>
        </div> 
        {{$empleados->render()}}   
    </div>
</div>
@endsection