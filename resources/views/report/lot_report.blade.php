@extends('layouts.app')
@section('title', __('lang_v1.lot_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('lang_v1.lot_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row no-print">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
              {!! Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockReport']), 'method' => 'get', 'id' => 'stock_report_filter_form' ]) !!}
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                        {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('category_id', __('category.category') . ':') !!}
                        {!! Form::select('category', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                        {!! Form::select('sub_category', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('brand', __('product.brand') . ':') !!}
                        {!! Form::select('brand', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('unit',__('product.unit') . ':') !!}
                        {!! Form::select('unit', $units, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                    </div>
                </div>
                @if(Module::has('Manufacturing'))
                    <div class="col-md-3">
                        <div class="form-group">
                            <br>
                            <div class="checkbox">
                                <label>
                                  {!! Form::checkbox('only_mfg', 1, false, 
                                  [ 'class' => 'input-icheck', 'id' => 'only_mfg_products']); !!} {{ __('manufacturing::lang.only_mfg_products') }}
                                </label>
                            </div>
                        </div>
                    </div>
                @endif
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
   <!-- LAESTRADA Se agregan formato de pestaña para mostrar reporte de los productos agrupados por lote. --> 
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom"> 
                <ul class="nav nav-tabs">

                    <li class="active no-print">
                        <a href="#rp_stock_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i> Detalle lotes</a>
                    </li>
                    <li class="no-print">
                        <a href="#rp_groupstock_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i> Agrupados por lote</a>
                    </li>
                </ul>
                <!-- Tabla Original  -->
                
                <div class="tab-content">
                    <div class="tab-pane active" id="rp_stock_tab">
                        @component('components.widget', ['class' => 'box-primary'])
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="lot_report">
                                <thead>
                                    <tr>
                                        <th>SKU</th>
                                        <th>@lang('business.product')</th>
                                        <th>@lang('lang_v1.lot_number')</th>
                                        <th>@lang('product.exp_date')</th>
                                        <th>@lang('report.current_stock')</th>
                                        <th>@lang('report.total_unit_sold')</th>
                                        <th>@lang('lang_v1.total_unit_adjusted')</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 text-center footer-total">
                                        <td colspan="4"><strong>@lang('sale.total'):</strong></td>
                                        <td id="footer_total_stock"></td>
                                        <td id="footer_total_sold"></td>
                                        <td id="footer_total_adjusted"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        @endcomponent
                    </div>
                    <!-- Nueva tabla -->
                    <div class="tab-pane" id="rp_groupstock_tab">
                        <div class="table-responsive">
                        <button type="button" class="btn btn-primary pull-right no-print" aria-label="Print" onclick="window.print();"><i class="fa fa-print"></i> Impresión</button>
                            <table class="table table-bordered table-striped" id="grouped_lot_report">
                                <thead>
                                    <tr>
                                        <th>Reporte agrupado por lotes</th>
    
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($groupedProducts as $lotNumber => $products)
                                        <tr>
                                            <td colspan="3"><strong>@lang('lang_v1.lot_number'): {{ $lotNumber }}</strong></td>
                                        </tr>
                                        @foreach($products as $product)
                                            <tr>

                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ number_format($product->quantity, 2).$product->unit }}</td>
                                                <td>
                                                    @if($product->type == 'production_purchase')                                                
                                                 <button data-href="{{ route('production.getlot', ['id' => $product->lot_number]) }}" class="btn btn-info btn-xs btn-modal" data-container=".view_modal"><i class="fa fa-eye"></i></button>
                                                   @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</section>
<!-- /.content -->

@endsection
<div class="modal fade" id="recipe_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>


@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection