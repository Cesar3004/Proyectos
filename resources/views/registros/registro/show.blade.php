@extends ('layouts.admin')
@section ('contenido')

    

<div class="row">
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="empleado">Empleado</label>
            <p>{{$registro->nombre}}</p>
        </div>
    </div>
   
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label>Numero Comprobante</label>
            <p>{{$registro->numero_comprobante}}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-body">
            
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <table id="detalles"class="table table-striped table-bordered table-condensend table-hover">
                        <thead style="background-color:#A9D0F5">
                            
                            <th>Codigo</th>
                            <th>Nombre del articulo</th>
                            <th>Descripcion</th>
                            <th>Fecha de Adquisicion</th>
                            <th>Area Asignada</th>

                        </thead>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tfoot>
                        <tbody>
                        @foreach($detalles as $det)
                        <tr>
                            <td>{{$det->codigo}}</td>
                            <td>{{$det->articulo}}</td>
                            <td>{{$det->descrip_articulo}}</td>
                            <td>{{$det->fecha_registro}}</td>
                            <td>{{$det->area}}</td>
                        </tr>
                        @endforeach

                        </tbody>
                </table>
        
            </div>
    </div>
</div>
    
    

</div>
        

        
        
@endsection