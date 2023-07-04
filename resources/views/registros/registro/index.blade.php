@extends ('layouts.admin')
@section ('contenido')
<div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Registro de Articulos <a href="registro/create"><button class="btn btn-success">Nuevo</button></a>
        <h3>
        @include('registros.registro.search')
    </div>

</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Empleado</th>
                    <th>Numero Comprobante</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>    
                @foreach ($registros as $reg)
                <tr>
                    <td>{{$reg->idregistro}}</td>
                    <td>{{$reg->fecha_registro}}</td>
                    <td>{{$reg->nombre.' '.$reg->apellido}}</td>
                    <td>{{$reg->numero_comprobante}}</td>
                    <td>{{$reg->cantidad}}</td>
                    <td>{{$reg->estado}}</td>
                    
                   
                    <td>
                        <a href="{{URL::action('RegistroController@show',$reg->idregistro)}}"><button class="btn btn-primary">Detalles</button></a>
                        <a href="" data-target="#modal-delete-{{$reg->idregistro}}" data-toggle="modal" ><button class="btn btn-danger">Anular</button></a>
                    </td>
                </tr>
                @include('registros.registro.modal')
                @endforeach
            </table>
        </div> 
        {{$registros->render()}}   
    </div>
</div>
@endsection