@extends('layouts.app')
@section('title', __('Historial Stock unificado'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('Historial Stock unificado')</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
    @component('components.widget')
    <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('stock_history_date_range', __('report.date_range') . ':') !!}
                {!! Form::text('stock_history_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'stock_history_date_range', 'readonly']); !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                {!! Form::select('location_id', $business_locations, request()->input('location_id', null), ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
            </div>
        </div>
        
        @if($product->type == 'variable')
            <div class="col-md-3">
                <div class="form-group">
                    <label for="variation_id">@lang('product.variations'):</label>
                    <select class="select2 form-control" name="variation_id" id="variation_id">
                        @foreach($product->variations as $variation)
                            <option value="{{$variation->id}}"
                            @if(request()->input('variation_id', null) == $variation->id)
                                selected
                            @endif
                            >{{$variation->product_variation->name}} - {{$variation->name}} ({{$variation->sub_sku}})</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @else
            <input type="hidden" id="variation_id" name="variation_id" value="{{$product->variations->first()->id}}">
        @endif
    @endcomponent
    @component('components.widget')
        <div id="product_stock_history_all" style="display: none;"></div>
    @endcomponent
    </div>
</div>

</section>
<!-- /.content -->
@endsection

@section('javascript')
   <script type="text/javascript">
        $(document).ready( function(){
                        // Definir el formato de fecha
                        var moment_date_format = 'YYYY-MM-DD'; // Asegúrate de que esto coincida con el formato que estás utilizando

                // Configuración de dateRangePicker con rango de fechas predeterminado
                var dateRangeSettings = {
                    startDate: moment().subtract(7, 'days'), // Fecha de inicio: Hace 7 días
                    endDate: moment(), // Fecha de fin: Hoy
                    locale: {
                        format: moment_date_format,
                        applyLabel: 'Aplicar',
                        cancelLabel: 'Cancelar',
                        customRangeLabel: 'Rango personalizado'
                    },
                    ranges: {
                        'Hoy': [moment(), moment()],
                        'Ayer': [moment().subtract(1, 'day'), moment().subtract(1, 'day')],
                        'Hace 7 días': [moment().subtract(7, 'days'), moment()],
                        'Este mes': [moment().startOf('month'), moment().endOf('month')],
                        'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        'Este año': [moment().startOf('year'), moment().endOf('year')],
                        'El año pasado': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                    }
                };

            $('#stock_history_date_range').daterangepicker(
            dateRangeSettings, 
            function(start, end) {
                $('#stock_history_date_range').val(
                    start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
                );
                load_stock_history( $('#location_id').val());
            });

            load_stock_history( $('#location_id').val());
            $('#product_id').select2({
                ajax: {
                    url: '/products/list-no-variation',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term, // search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data,
                        };
                    },
                },
                minimumInputLength: 1,
                escapeMarkup: function(m) {
                    return m;
                },
            }).on('select2:select', function (e) {
                var data = e.params.data;
                window.location.href = "{{url('/')}}/products/stock-history-all" + data.id
            });
        });

       function load_stock_history( location_id) {
            $('#product_stock_history_all').fadeOut();

            var start = $('input#stock_history_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
            var end = $('input#stock_history_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');

            $.ajax({
                url: '/products/stock-history-all',
                data:{
                    location_id: location_id,
                    start_date: start,
                    end_date: end
                },
                dataType: 'html',
                success: function(result) {
                    $('#product_stock_history_all')
                        .html(result)
                        .fadeIn();

                    __currency_convert_recursively($('#product_stock_history_all'));

                    $('#stock_history_table').DataTable({
                        searching: false,
                        ordering: false
                    });
                },
            });
       }

       $(document).on('change', ' #location_id', function(){
            load_stock_history( $('#location_id').val());
       });
   </script>
@endsection