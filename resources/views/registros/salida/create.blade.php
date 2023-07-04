@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Nueva Salida de Articulos</h3>
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

        {!!Form::open(array('url'=>'registros/salida','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}
<div class="row">
    <div class="col-lg-6-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="empleado">Empleado</label>
            <select name="idempleado" id="idempleado" class="form-control selectpicker" data-live-search="true">
                @foreach($empleados as $empleado)
                    <option value="{{$empleado->idempleado}}">{{$empleado->nombre.' '.$empleado->apellido}}</option>
                @endforeach

            </select>
        </div>
    </div>
   
    
</div>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                <label>Articulo</label>
                <select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
                @foreach($articulos as $articulo)
                <option value="{{$articulo->idarticulo}}_{{$articulo->stock}}">{{$articulo->articulo}}</option>
                @endforeach

                </select>
            </div>
        </div>
        <div class="col-lg-4  col-sm-4 col-md-4 col-xs-12 ">
            <div class="form-group">
                <label for="pcantidad">Cantidad</label>
                <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad"></input>
            </div>
        </div>
        <div class="col-lg-4  col-sm-4 col-md-4 col-xs-12 ">
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" disabled name="pstock" id="pstock" class="form-control" placeholder="Stock"></input>
            </div>
        </div>
        <div class="col-lg-3  col-sm-3 col-md-3 col-xs-12 ">
            <div class="form-group">
                <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                
            </div>
        </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <table id="detalles"class="table table-striped table-bordered table-condensend table-hover">
                        <thead style="background-color:#A9D0F5">
                            <th>Opciones</th>
                            <th>Articulo</th>
                            <th>Cantidad</th>
                        </thead>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tfoot>
                        <tbody>


                        </tbody>
                </table>
        
            </div>
    </div>
</div>
    
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
        <div class="form-group">
            
            <button class ="btn btn-primary" type="submit">Guardar</button>
            <button class ="btn btn-danger" type="reset">Cancelar</button>
        </div>

    </div>

</div>
        

        
        {!!Form::close()!!}
@push('scripts')
<script>
    
    $(document).ready(function(){
        $('#bt_add').click(function(){
            agregar();
        });
    });

    var cont=0;
    total=0;
    $("#guardar").hide();
    $("#pidarticulo").change(mostrarValores);
    
    function mostrarValores(){
        datosArticulo=document.getElementById('pidarticulo').value.split('_');
        $("#pstock").val(datosArticulo[1]);



    }

    function agregar(){
        datosArticulo=document.getElementById('pidarticulo').value.split('_');
        

        idarticulo=datosArticulo[0];
        articulo=$("#pidarticulo option:selected").text();
        cantidad=$("#pcantidad").val();
        stock=$("#pstock").val();

        if(idarticulo!="" && cantidad!="" && cantidad>0 )
        {
            if(stock>=cantidad)
            {
                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td></tr>';
            cont++;
            limpiar();
            evaluar();
            $('#detalles').append(fila);
            }else
            {
                alert ('La cantidad de articulos para la salida supera el stock disponible');
            }
            
        }
        else{
            alert("Error al ingresar  el detalle de salida, revise los datos del articulo");

        }
    }



    function limpiar(){
     $("#pcantidad").val("");
        
    }

    function evaluar(){
        if(cont>0)
        {
            $("#guardar").show();
        }
        else{
            $("#guardar").hide();
        }

    }

    function eliminar(index){
        $("#fila"+index).remove();
        evaluar();

    }
</script>
@endpush  
@endsection