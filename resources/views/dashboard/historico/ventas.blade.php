@extends('dashboard.base')

@section('content')
<div class="row input-daterange">
  <div class="col-md-4">
      <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Desde" readonly />
  </div>
  <div class="col-md-4">
      <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Hasta" readonly />
  </div>
  <div class="col-md-4">
      <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
      <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
  </div>
  <br>
  <br>
  <br>
</div>
<div class="table-responsive" style="padding-left: 20px; padding-right:20px " >
        <table id="ventas" class="display compact" cellspacing="1" width="100%" align="center">
            <thead>
                <tr class="table-success">
                    <th>No. int Factura</th>
                    <th>Entrega</th>
                    <th>Docto Venta</th>
                    <th>Folio Factura</th>
                    <th>estado</th>
                    <th>fechaFactura de Compra</th>
                    <th>mes</th>
                    <th>anio</th>
                    <th>cantidad Venta</th>
                    <th>costoMXN</th>
                    <th>costoUSD</th>
                    <th>Subtotal Costo MXN,</th>
                    <th>Subtotal Costo USD</th>
                    <th>PrecioUSD</th>
                    <th>PrecioMXN</th>
                    <th>Subtotal Venta USD</th>
                    <th>Subtotal VentaMXN</th>
                    <th>ImpuestoUSD</th>
                    <th>ImpuestoMXN</th>
                    <th>TotalUSD</th>
                    <th>TotalMXN</th>
                    <th>UtilidadUSD</th>
                    <th>UtilidadMXN</th>
                    <th>Porcentaje Utilidad,</th>
                    <th>Moneda Docto</th>
                    <th>Paridad</th>
                    <th>Tipo Cambio Dia Pago</th>
                    <th>TipoCambio</th>
                    <th>CuentaMayor</th>
                    <th>SKU</th>
                    <th>Descripcion</th>
                    <th>GrupoArticulos</th>
                    <th>Fabricante</th>
                    <th>Potencia</th>
                    <th>PotenciaTotal</th>
                    <th>CodigoCliente</th>
                    <th>Cliente/Lead</th>
                    <th>Origen</th>
                    <th>Propietario</th>
                    <th>FechaAltaCliente</th>
                    <th>Nombre Cliente</th>
                    <th>Grupo Clientes</th>
                    <th>EncargadoVentas</th>
                    <th>RFC</th>
                    <th>ClaseExpedicion</th>
                    <th>ListaPrecios</th>
                    <th>MetodoPago</th>
                    <th>ColoniaEnvio</th>
                    <th>CodigoPostalEnvio</th>
                    <th>DelegacionEnvio</th>
                    <th>CiudadEnvio</th>
                    <th>EstadoEnvio</th>
                    <th>EstadoFiscal</th>
                    <th>PaisEnvio</th>
                    <th>Almacen</th>
                    <th>Sucursal</th>
                </tr>
            </thead>
        </table>
    
</div>
@endsection
@section('style')

@endsection
@section('javascript')
<script>
    $(document).ready(function(){
      $('.input-daterange').datepicker({
        todayBtn:'linked',
        format:'dd/mm/yyyy',
        autoclose:true
      });
      
      load_data();
      function load_data(from_date = '', to_date = ''){
        $('#ventas').DataTable({
            processing: true,
            dom: 'Bfrtip',
            lengthMenu: [
              [ 10, 25, 50, -1 ],
              [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
            ],
          
            "serverSide": true,
            ajax: {
              url:'{{ route("ventas.index") }}',
              data:{from_date:from_date, to_date:to_date}
            },
            "columns": [
                {data: 'internoFactura'},
                {data: 'entrega'},
                {data: 'doctoVenta' },
                {data: 'folioFactura'},
                {data: 'estado'},
                {data: 'fechaFactura'},
                {data: 'mes'},
                {data: 'anio'},
                {data: 'cantidad'},
                {data: 'costoMXN' },
                {data: 'costoUSD'}, 
                {data: 'subtotalCostoMXN'},
                {data: 'subtotalCostoUSD'},
                {data: 'precioUSD' },
                {data: 'precioMXN'},
                {data: 'subtotalVentaUSD'},
                {data: 'subtotalVentaMXN'},
                {data: 'impuestoUSD'},
                {data: 'impuestoMXN'},
                {data: 'totalUSD'},
                {data: 'totalMXN' },
                {data: 'utilidadUSD'}, 
                {data: 'utilidadMXN'},
                {data: 'porcentajeUtilidad,'},
                {data: 'monedaDocto' },
                {data: 'paridad'},
                {data: 'tipoCambioDiaPago'},
                {data: 'tipoCambio'},
                {data: 'cuentaMayor'},
                {data: 'SKU'},
                {data: 'descripcion'},
                {data: 'grupoArticulos' },
                {data: 'fabricante'}, 
                {data: 'potencia'},
                {data: 'potenciaTotal'},
                {data: 'codigoCliente' },
                {data: 'clienteLead'},
                {data: 'origen'},
                {data: 'propietario'},
                {data: 'fechaAltaCliente'},
                {data: 'nombreCliente'},
                {data: 'grupoClientes'},
                {data: 'encargadoVentas' },
                {data: 'RFC'}, 
                {data: 'claseExpedicion'},
                {data: 'listaPrecios'},
                {data: 'metodoPago' },
                {data: 'coloniaEnvio'},
                {data: 'codigoPostalEnvio'},
                {data: 'delegacionEnvio'},
                {data: 'ciudadEnvio'},
                {data: 'estadoEnvio'},
                {data: 'estadoFiscal'},
                {data: 'paisEnvio' },
                {data: 'almacen'}, 
                {data: 'sucursal'}, 
            ],        
        });
      }
        $('#filter').click(function(){
          var from_date = $('#from_date').val();
          var to_date = $('#to_date').val();
          if(from_date != '' &&  to_date != '')
          {
          $('#ventas').DataTable().destroy();
          load_data(from_date, to_date);
          }
          else
          {
          alert('Both Date is required');
          }
        });
        
        $('#refresh').click(function(){
          $('#from_date').val('');
          $('#to_date').val('');
          $('#ventas').DataTable().destroy();
          load_data();
        });
    });
</script>
@endsection