<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" href="style.css"> -->
        <title>Receipt-{{$receipt_details->invoice_no}}</title>
    </head>
    <body>
        <div class="ticket">
        	@if(empty($receipt_details->letter_head))
				@if(!empty($receipt_details->logo))
					<div class="text-box centered">
						<img style="max-height: 100px; width: auto;" src="{{$receipt_details->logo}}" alt="Logo">
					</div>
				@endif
				<div class="text-box">
				<!-- Logo -->
				<p class="centered">
					<!-- Header text -->
					@if(!empty($receipt_details->header_text))
						<span class="headings">{!! $receipt_details->header_text !!}</span>
						<br/>
					@endif

					<!-- business information here -->
					@if(!empty($receipt_details->display_name))
						<span class="headings">
							{{$receipt_details->display_name}}
						</span>
						<br/>
					@endif
					
					@if(!empty($receipt_details->address))
						{!! $receipt_details->address !!}
						<br/>
					@endif

					@if(!empty($receipt_details->contact))
						{!! $receipt_details->contact !!}
					@endif
					@if(!empty($receipt_details->contact) && !empty($receipt_details->website))
						, 
					@endif
					@if(!empty($receipt_details->website))
						{{ $receipt_details->website }}
					@endif
					@if(!empty($receipt_details->location_custom_fields))
						<br>{{ $receipt_details->location_custom_fields }}
					@endif

					@if(!empty($receipt_details->sub_heading_line1))
						{{ $receipt_details->sub_heading_line1 }}<br/>
					@endif
					@if(!empty($receipt_details->sub_heading_line2))
						{{ $receipt_details->sub_heading_line2 }}<br/>
					@endif
					@if(!empty($receipt_details->sub_heading_line3))
						{{ $receipt_details->sub_heading_line3 }}<br/>
					@endif
					@if(!empty($receipt_details->sub_heading_line4))
						{{ $receipt_details->sub_heading_line4 }}<br/>
					@endif		
					@if(!empty($receipt_details->sub_heading_line5))
						{{ $receipt_details->sub_heading_line5 }}<br/>
					@endif

					@if(!empty($receipt_details->tax_info1))
						<br><b>{{ $receipt_details->tax_label1 }}</b> {{ $receipt_details->tax_info1 }}
					@endif

					@if(!empty($receipt_details->tax_info2))
						<b>{{ $receipt_details->tax_label2 }}</b> {{ $receipt_details->tax_info2 }}
					@endif
				@endif
					<!-- Title of receipt -->
					@if(!empty($receipt_details->invoice_heading))
						<br/><span class="sub-headings">{!! $receipt_details->invoice_heading !!}</span>
					@endif
				</p>
				</div>
				@if(!empty($receipt_details->letter_head))
					<div class="text-box">
						<img style="width: 100%;margin-bottom: 10px;" src="{{$receipt_details->letter_head}}">
					</div>
				@endif
				
			<div class="border-top textbox-info">
				<table style="width: 100%;">
					<tr>
						<td class="f-left"><strong>{!! $receipt_details->invoice_no_prefix !!}: </strong>{{$receipt_details->invoice_no}}</td>
						<td class="f-right" colspan="8">
							<!--{{$receipt_details->invoice_no}}-->
						</td>
					</tr>
				</table>
			</div>
<div class="textbox-info">
    <table style="width: 100%;">
        <tr>
            <td class="f-left"><strong>{!! $receipt_details->date_label !!}: </strong>{{$receipt_details->invoice_date}}</td>
            <td class="f-right" >
                <!--{{$receipt_details->invoice_date}}-->
            </td>
			<td></td>
        </tr>
    </table>
</div>

@if(!empty($receipt_details->due_date_label))
    <div class="textbox-info">
        <table style="width: 100%;">
            <tr>
                <td class="f-left"><strong>{{$receipt_details->due_date_label}}</strong></td>
                <td class="f-right" colspan="8">{{$receipt_details->due_date ?? ''}}</td>
				<td></td>
            </tr>
        </table>
    </div>
@endif



<!-- customer info -->
<div class="textbox-info">
    <table style="width: 100%;">
        <tr>
            <td style="vertical-align: top;"><strong>{{$receipt_details->customer_label ?? ''}}: </strong>
                @if(!empty($receipt_details->customer_info))
                    {!! $receipt_details->customer_info !!}
                @endif
            </td>
			<td></td>
        </tr>
    </table>
</div>

@if(!empty($receipt_details->client_id_label))
    <div class="textbox-info">
        <table style="width: 100%;">
            <tr>
                <td class="f-left"><strong>{{$receipt_details->client_id_label}}</strong></td>
                <td class="f-right" colspan="8">{{$receipt_details->client_id}}</td>
				<td></td>
            </tr>
        </table>
    </div>
@endif


@if(!empty($receipt_details->sale_orders_invoice_no))
    <div class="textbox-info">
        <table style="width: 100%;">
            <tr>
                <td class="f-left"><strong>@lang('restaurant.order_no'): </strong> {!!$receipt_details->sale_orders_invoice_no ?? ''!!}</td>
                <td class="f-right" colspan="8"></td>
				<td></td>
            </tr>
        </table>
    </div>
@endif

@if(!empty($receipt_details->sale_orders_invoice_date))
    <div class="textbox-info">
        <table style="width: 100%;">
            <tr>
                <td class="f-left"><strong>@lang('lang_v1.order_dates'): </strong>{!!$receipt_details->sale_orders_invoice_date ?? ''!!}</td>
                <td class="f-right" colspan="8"></td>
				<td></td>
            </tr>
        </table>
    </div>
@endif
@if(!empty($receipt_details->letter_head))
					<div class="text-box">
						<img style="width: 100%;margin-bottom: 10px;" src="{{$receipt_details->letter_head}}">
					</div>
				@endif
				&nbsp;
            <table style="margin-top: 25px !important" class="border-bottom width-100 table-f-12 mb-10">
                <thead class="border-bottom-dotted">
                    <tr>
                       <!-- <th class="serial_number">#</th>-->
                        <th class="quantity text-left">
                        	{{$receipt_details->table_qty_label}}
                        </th>
                        <th class="description" width="30%">
                        	{{$receipt_details->table_product_label}}
                        </th>

                        @if(empty($receipt_details->hide_price))
                        <th class="unit_price text-right">
                        	{{$receipt_details->table_unit_price_label}}
                        </th>
                        @if(!empty($receipt_details->discounted_unit_price_label))
							<th class="text-right">
								{{$receipt_details->discounted_unit_price_label}}
							</th>
						@endif
                        @if(!empty($receipt_details->item_discount_label))
							<th class="text-right">{{$receipt_details->item_discount_label}}</th>
						@endif
                        <th class="price text-right">{{$receipt_details->table_subtotal_label}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
					<tr>
				<td colspan="10" style="border-bottom: 1px dashed #000;">&nbsp;</td>
				</tr>
					<!-- VARIABLE PARA MOSTRAR TOTAL SIN DESCUENTOS -->
					@php 
						$total_laec=0;
					@endphp
                	@forelse($receipt_details->lines as $line)
	                    <tr><!-- Se elimina Numero de item
	                        <td class="serial_number" style="vertical-align: top;">
	                        	{{$loop->iteration}}
	                        </td>-->
							<!-- LAESTRADA Se elimina Unidad para no mostrar en envio-->
							
							<td class="quantity text-left">{{$line['quantity']}} <!-- {{$line['units']}}--> @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                            <br><small>
                            	{{$line['quantity']}} x {{$line['base_unit_multiplier']}} = {{$line['orig_quantity']}} {{$line['base_unit_name']}}
                            </small>
                            @endif</td>
	                        <td class="description">
	                        	{{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
	                        	@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
	                        	@if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
	                        	@if(!empty($line['product_description']))
	                            	<div class="f-8">
	                            		{!!$line['product_description']!!}
	                            	</div>
	                            @endif
	                        	@if(!empty($line['sell_line_note']))
	                        	<br>
	                        	<span class="f-8">
	                        	{!!$line['sell_line_note']!!} holassssdfasdfasfasdfas
	                        	</span>
	                        	@endif 
	                        	@if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
	                        	@if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif
	                        	@if(!empty($line['warranty_name']))
	                            	<br>
	                            	<small>
	                            		{{$line['warranty_name']}}
	                            	</small>
	                            @endif
	                            @if(!empty($line['warranty_exp_date']))
	                            	<small>
	                            		- {{@format_date($line['warranty_exp_date'])}}
	                            </small>
	                            @endif
	                            @if(!empty($line['warranty_description']))
	                            	<small> {{$line['warranty_description'] ?? ''}}</small>
	                            @endif

	                            @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
		                            <br><small>
		                            	1 {{$line['units']}} = {{$line['base_unit_multiplier']}} {{$line['base_unit_name']}} <br>
                            			{{$line['base_unit_price']}} x {{$line['orig_quantity']}} = {{$line['line_total']}}
		                            </small>
		                            @endif
	                        </td>
	                        
	                        @if(empty($receipt_details->hide_price))
	                        <td class="unit_price text-right">{{$line['unit_price_before_discount']}} </td>

	                        @if(!empty($receipt_details->discounted_unit_price_label))
								<td class="text-right">
									{{$line['unit_price_inc_tax']}} 
								</td>
							@endif

	                        @if(!empty($receipt_details->item_discount_label))
								<td class="text-right">
									{{$line['total_line_discount'] ?? '0.00'}}
									@if(!empty($line['line_discount_percent']))
								 		({{$line['line_discount_percent']}}%) 
									@endif
								</td>
							@endif
							<!-- se realiza la siguiente corrección ya que se mostraba el total con descuento de una vez  LAESTRADA (Cod originar *)-->
							@php 
							str_replace(",", "", $line['quantity']);
							
							str_replace(",", "", $line['unit_price_before_discount']);
							

							$quantity = floatval($line['quantity']);
							$unit_price_before_discount = floatval($line['unit_price_before_discount']);


							$totales = $quantity * $unit_price_before_discount;
							$formatted_totales = number_format($totales, 2); 
							$total_laec = $total_laec + $totales;
							$total_laec = number_format($total_laec,2);
							@endphp
							<td class="price text-right">{{$line['line_total']}}</td> * 
	                        <!--  <td class="price text-right">Q {{$formatted_totales}}</td>  * -->
	                        @endif
							{{$line['quantity']}};
							{{$quantity }}
	                    </tr>
	                    @if(!empty($line['modifiers']))
							@foreach($line['modifiers'] as $modifier)
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
			                            {{$modifier['name']}} {{$modifier['variation']}} 
			                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
			                            @if(!empty($modifier['sell_line_note']))({!!$modifier['sell_line_note']!!}) @endif 
			                        </td>
									<td class="f-8">{{$modifier['quantity']}} {{$modifier['units']}} </td>
									@if(empty($receipt_details->hide_price))
									<td class="f-8">{{$modifier['unit_price_inc_tax']}}</td>
									@if(!empty($receipt_details->discounted_unit_price_label))
										<td class="f-8">{{$modifier['unit_price_exc_tax']}}</td>
									@endif
									@if(!empty($receipt_details->item_discount_label))
										<td class="f-8">0.00</td>
									@endif
									<td class="f-8">{{$modifier['line_total']}}</td>
									@endif
								</tr>
							@endforeach
						@endif
                    @endforeach
					<tr>
				<td colspan="10" style="border-bottom: 1px solid #000;">&nbsp;</td>
				</tr>
                </tbody>
            </table>
			@if(!empty($receipt_details->total_quantity_label))
    <table style="width: 100%;">
        <tr>
		<td></td>
		<td></td>
            <td class="left text-right" style="width: 50%;">
                <strong>{!! $receipt_details->total_quantity_label !!}</strong>
            </td>
            <td class="width-50 text-right">{{$receipt_details->total_quantity}}</td>
        </tr>
    </table>
@endif

@if(!empty($receipt_details->total_items_label))
    <table style="width: 100%;">
        <tr>
		<td></td>
		<td></td>
            <td class="left text-right" style="width: 50%;">
                <strong>{!! $receipt_details->total_items_label !!}</strong>
            </td>
            <td class="width-50 text-right">{{$receipt_details->total_items}}</td>
        </tr>
    </table>
@endif

@if(empty($receipt_details->hide_price))
    <table style="width: 100%;">
        <tr>
		<td></td>
		<td></td>
            <td class="left text-right" style="width: 50%;">
                <strong>{!! $receipt_details->subtotal_label !!}</strong>
            </td >
          <!--  <td class="width-50 text-left sub-headings">Q {{$total_laec}}</td> -->
		  <td class="width-50 text-left sub-headings">{{$receipt_details->subtotal}}</td>
        </tr>
    </table>

    <!-- Shipping Charges -->
    @if(!empty($receipt_details->shipping_charges))
        <table style="width: 100%;">
            <tr>
			<td></td>
			<td></td>
                <td class="left text-right" style="width: 50%;">
                    <strong>{!! $receipt_details->shipping_charges_label !!}</strong>
                </td>
                <td class="width-50 text-right">{{$receipt_details->shipping_charges}}</td>
            </tr>
        </table>
    @endif

    <!-- Packing Charge -->
    @if(!empty($receipt_details->packing_charge))
        <table style="width: 100%;">
            <tr>
			<td></td>
			<td></td>
                <td class="left text-right" style="width: 50%;">
                    <strong>{!! $receipt_details->packing_charge_label !!}</strong>
                </td>
                <td class="width-50 text-right">{{$receipt_details->packing_charge}}</td>
            </tr>
        </table>
    @endif

    <!-- Discount -->
    @if(!empty($receipt_details->discount))
        <table style="width: 100%;">
            <tr>
			<td></td>
			<td></td>
                <td class="left text-right" style="width: 50%;">
                    <strong>{!! $receipt_details->discount_label !!}</strong>
                </td>
                <td class="width-50 text-right">(-) {{$receipt_details->discount}}</td>
            </tr>
        </table>
    @endif

    <!-- Total Line Discount -->
    @if(!empty($receipt_details->total_line_discount))
        <table style="width: 100%;">
            <tr>
			<td></td>
			<td></td>
                <td class="left text-right" style="width: 50%;">
                    <strong>{!! $receipt_details->line_discount_label !!}</strong>
                </td>
                <td class="width-50 text-right">(-) {{$receipt_details->total_line_discount}}</td>
            </tr>
        </table>
    @endif

    <!-- Additional Expenses -->
    @if(!empty($receipt_details->additional_expenses))
        @foreach($receipt_details->additional_expenses as $key => $val)
            <table style="width: 100%;">
                <tr>
				<td></td>
				<td></td>
                    <td class="left text-right" style="width: 50%;">{{$key}}:</td>
                    <td class="width-50 text-right">(+) {{$val}}</td>
                </tr>
            </table>
        @endforeach
    @endif

    <!-- Reward Points -->
    @if(!empty($receipt_details->reward_point_label))
        <table style="width: 100%;">
            <tr>
			<td></td>
			<td></td>
                <td class="left text-right" style="width: 50%;">
                    <strong>{!! $receipt_details->reward_point_label !!}</strong>
                </td>
                <td class="width-50 text-right">(-) {{$receipt_details->reward_point_amount}}</td>
            </tr>
        </table>
    @endif

    <!-- Tax -->
    @if(!empty($receipt_details->tax))
        <table style="width: 100%;">
            <tr>
			<td></td>
			<td></td>
                <td class="left text-right" style="width: 50%;">
                    <strong>{!! $receipt_details->tax_label !!}</strong>
                </td>
                <td class="width-50 text-right">(+) {{$receipt_details->tax}}</td>
            </tr>
        </table>
    @endif

    <!-- Round Off -->
    @if($receipt_details->round_off_amount > 0)
        <table style="width: 100%;">
            <tr>
			<td></td>
			<td></td>
                <td class="left text-right" style="width: 50%;">
                    <strong>{!! $receipt_details->round_off_label !!}</strong>
                </td>
                <td class="width-50 text-right">{{$receipt_details->round_off}}</td>
            </tr>
        </table>
    @endif

    <!-- Total -->
    <table style="width: 100%;">
        <tr>
		<td></td>
		<td></td>
            <td class="left text-right" style="width: 50%;" >
                <strong>{!! $receipt_details->total_label !!}</strong>
            </td>
            <td class="width-50 text-left sub-headings">{{$receipt_details->total}}</td>
        </tr>
    </table>

    <!-- Total in Words -->
    @if(!empty($receipt_details->total_in_words))
        <p class="text-right mb-0">
            <small>
                ({{$receipt_details->total_in_words}})
            </small>
        </p>
    @endif

    <!-- Payments -->
    @if(!empty($receipt_details->payments))
        @foreach($receipt_details->payments as $payment)
            <table style="width: 100%;">
                <tr>
				<td></td>
				<td></td>
                    <td class="left text-right" style="width: 50%;">{{$payment['method']}} ({{$payment['date']}})</td>
                    <td class="width-50 text-right">{{$payment['amount']}}</td>
                </tr>
            </table>
        @endforeach
    @endif

    <!-- Total Paid -->
    @if(!empty($receipt_details->total_paid))
        <table style="width: 100%;">
            <tr>
				<td></td>
				<td></td>
                <td class="left text-right" style="width: 50%;">
                    <strong>{!! $receipt_details->total_paid_label !!}</strong>
                </td>
                <td class="width-50 text-right">{{$receipt_details->total_paid}}</td>
            </tr>
        </table>
    @endif

    <!-- Total Due -->
    @if(!empty($receipt_details->total_due) && !empty($receipt_details->total_due_label))
        <table style="width: 100%;">
            <tr>
                <td class="left text-right" style="width: 50%;">
                    <strong>{!! $receipt_details->total_due_label !!}</strong>
                </td>
                <td class="width-50 text-right">{{$receipt_details->total_due}}</td>
            </tr>
        </table>
    @endif

    <!-- All Due -->
    @if(!empty($receipt_details->all_due))
        <table style="width: 100%;">
            <tr>
                <td class="left text-right" style="width: 50%;">
                    <strong>{!! $receipt_details->all_bal_label !!}</strong>
                </td>
                <td class="width-50 text-right">{{$receipt_details->all_due}}</td>
            </tr>
        </table>
    @endif
@endif

            <div class="border-bottom width-100">&nbsp;</div>
            @if(empty($receipt_details->hide_price) && !empty($receipt_details->tax_summary_label) )
	            <!-- tax -->
	            @if(!empty($receipt_details->taxes))
	            	<table class="border-bottom width-100 table-f-12">
	            		<tr>
	            			<th colspan="2" class="text-center">{{$receipt_details->tax_summary_label}}</th>
	            		</tr>
	            		@foreach($receipt_details->taxes as $key => $val)
	            			<tr>
	            				<td class="left">{{$key}}</td>
	            				<td class="right">{{$val}}</td>
	            			</tr>
	            		@endforeach
	            	</table>
	            @endif
            @endif

            @if(!empty($receipt_details->additional_notes)) <!-- LAESTRADA -->
	            <h5 >
	            Nota de venta:	{!! nl2br($receipt_details->additional_notes) !!}
</h5>
            @endif

            {{-- Barcode --}}
			@if($receipt_details->show_barcode)
				<br/>
				<img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
			@endif

			@if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
				<img class="center-block mt-5" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE')}}">
			@endif
			
			@if(!empty($receipt_details->footer_text))
				<p class="centered">
					{!! $receipt_details->footer_text !!}
				</p>
			@endif
			
        </div>
        <!-- <button id="btnPrint" class="hidden-print">Print</button>
        <script src="script.js"></script> -->
    </body>
</html>

<style type="text/css">
	img {
    max-width: inherit;
    width: auto;
}
.logo {
	float: left;
	width:35%;
	padding: 10px;
}
</style>