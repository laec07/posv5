<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang( 'manufacturing::lang.production_details' ) (<b>@lang('purchase.ref_no'):</b> #{{ $production_purchase->ref_no }})</h4>
        </div>

        <div class="modal-body">
        <div class="row">
                <div class="col-md-12">
                    <h4>@lang('manufacturing::lang.ingredients')</h4>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('manufacturing::lang.ingredient')</th>
                                <th>@lang('manufacturing::lang.input_quantity')</th>
                                <th>@lang('manufacturing::lang.waste_percent')</th>
                                <th>@lang('manufacturing::lang.final_quantity')</th>
                                <th>@lang('manufacturing::lang.total_price')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_ingredient_price = 0;
                            @endphp
                            @foreach($ingredients as $ingredient)
                                <tr>
                                    <td>
                                        {{$ingredient['full_name']}}
                                        @if(!empty($ingredient['lot_numbers']))
                                            <br>
                                            <small> @lang('lang_v1.lot_n_expiry'):  {{$ingredient['lot_numbers']}}</small>
                                        @endif
                                    </td>
                                    <td>{{@format_quantity($ingredient['quantity'])}} {{$ingredient['unit']}}</td>
                                    <td>{{@format_quantity($ingredient['waste_percent'])}} %</td>
                                    <td>{{@format_quantity($ingredient['final_quantity'])}} {{$ingredient['unit']}}</td>
                                    @php
                                        $price = $ingredient['total_price'];

                                        $total_ingredient_price += $price;
                                    @endphp
                                    <td>
                                         <span class="display_currency" data-currency_symbol="true">{{$price}}</span>
                                    </td>
                                </tr>
                            @endforeach
                            @if(!empty($ingredient_groups))
                                @foreach($ingredient_groups as $ingredient_group)
                                    <tr>
                                        <td colspan="5" class="bg-gray">
                                            <strong>
                                                {{$ingredient_group['ig_name'] ?? ''}}
                                            </strong>
                                            @if(!empty($ingredient_group['ig_description']))
                                                - {{$ingredient_group['ig_description']}}
                                            @endif
                                        </td>
                                    </tr>
                                    @foreach($ingredient_group['ig_ingredients'] as $ingredient)
                                        <tr>
                                            <td>
                                                {{$ingredient['full_name']}}
                                                @if(!empty($ingredient['lot_numbers']))
                                                    <br>
                                                    <small> @lang('lang_v1.lot_n_expiry'):  {{$ingredient['lot_numbers']}}</small>
                                                @endif
                                            </td>
                                            <td>{{@format_quantity($ingredient['quantity'])}} {{$ingredient['unit']}}</td>
                                            <td>{{@format_quantity($ingredient['waste_percent'])}} %</td>
                                            <td>{{@format_quantity($ingredient['final_quantity'])}} {{$ingredient['unit']}}</td>
                                            @php
                                                $price = $ingredient['total_price'];
                                                $total_ingredient_price += $price;
                                            @endphp
                                            <td>
                                                 <span class="display_currency" data-currency_symbol="true">{{$price}}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><strong>@lang('manufacturing::lang.ingredients_cost')</strong></td>
                                <td><span class="display_currency" data-currency_symbol="true">{{$total_ingredient_price}}</span></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"><strong>{{__('manufacturing::lang.production_cost')}}:</strong></td>
                                <td><span class="display_currency" data-currency_symbol="true">{{$total_production_cost}}</span> </td>
                            </tr>
                            <tr><td colspan="4" class="text-right"><strong>{{__('manufacturing::lang.total_cost')}}:</strong></td>
                                <td><span class="display_currency" data-currency_symbol="true">{{$production_purchase->final_total}}</span></td></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-primary no-print" aria-label="Print" 
      onclick="$(this).closest('div.modal-content').printThis();"><i class="fa fa-print"></i> @lang( 'messages.print' )
      </button>
            <button type="button" class="btn btn-default no-print" data-dismiss="modal">@lang( 'messages.close' )</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->