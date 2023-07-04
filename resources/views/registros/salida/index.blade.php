@extends ('layouts.admin')
@section ('contenido')
<div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Salida de Articulos <a href="salida/create"><button class="btn btn-success">Nuevo</button></a>
        <h3>
        @include('registros.salida.search')
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
                    
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>    
                @foreach ($salidas as $sal)
                <tr>
                    <td>{{$sal->idsalida}}</td>
                    <td>{{$sal->fecha_salida}}</td>
                    <td>{{$sal->nombre.' '.$sal->apellido}}</td>
                    
                    <td>{{$sal->cantidad}}</td>
                    <td>{{$sal->estado}}</td>
                    
                   
                    <td>
                        <a href="{{URL::action('SalidaController@show',$sal->idsalida)}}"><button class="btn btn-primary">Detalles</button></a>
                        <a href="" data-target="#modal-delete-{{$sal->idsalida}}" data-toggle="modal" ><button class="btn btn-danger">Anular</button></a>
                    </td>
                </tr>
                @include('registros.salida.modal')
                @endforeach
            </table>
        </div> 
        {{$salidas->render()}}   
    </div>
</div>
@endsection