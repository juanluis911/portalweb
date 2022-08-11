@extends('dashboard.base')

@section('content')
<div class="table-responsive" style="padding-left: 20px; padding-right:20px " >
        <table id="garantias" class="display compact" cellspacing="1" width="100%" align="center">
            <thead>
                <tr class="table-success">
                    <th>Numero Interno</th>
                    <th>Numero Documento</th>
                    <th>Factura</th>
                    <th>Fecha Contabilizacion</th>
                    <th>Codigo Cliente</th>
                    <th>Nombre Cliente</th>
                    <th>Numero Articulo</th>
                    <th>Descripcion</th>
                    <th>Numero Serie</th>
                    <th>Nombre Grupo</th>
                    <th>Estatus Documento</th>
                    <th>Nombre Fabricante</th>
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

        $('#garantias thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#garantias thead');

        $('#garantias').DataTable({
            
            "serverSide": true,
            "ajax": "{{ url('api/garantias') }}",
            "columns": [
                {data: 'numeroInterno'},
                {data: 'numeroDocumento'},
                {data: 'factura'},
                {data: 'fechaContabilizacion' },
                {data: 'codigoCliente'},
                {data: 'nombreCliente'},
                {data: 'numeroArticulo'},
                {data: 'descripcion'},
                {data: 'numeroSerie'},
                {data: 'nombreGrupo'},
                {data: 'statusDocumento' },
                {data: 'nombreFabricante'}, 
            ],
            orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();

            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" style="width : 100%; heigth : 4px" placeholder="' + title + '" />');

                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();

                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();

                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
            },
        });
    });
</script>
@endsection