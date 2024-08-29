@php
	$common_settings = session()->get('business.common_settings');
@endphp

<div class="row">
	<div class="col-md-12">
		<hr>
		<table class="table table-slim" id="stock_history_table">
			<thead>
			<tr>
				<th>Prducto</th>
				<th>@lang('lang_v1.type')</th>
				<th>@lang('lang_v1.quantity_change')</th>
				@if(!empty($common_settings['enable_secondary_unit']))
					<th>@lang('lang_v1.quantity_change') (@lang('lang_v1.secondary_unit'))</th>
				@endif
				<th>@lang('lang_v1.new_quantity')</th>
				@if(!empty($common_settings['enable_secondary_unit']))
					<th>@lang('lang_v1.new_quantity') (@lang('lang_v1.secondary_unit'))</th>
				@endif
				<th>@lang('lang_v1.date')</th>
				<th>@lang('purchase.ref_no')</th>
				<th>@lang('lang_v1.customer_supplier_info')</th>
			</tr>
			</thead>
			<tbody>
			@forelse($stock_history as $history)
				<tr>
					<td>{{$history['name']}}</td>
					<td>{{$history['type_label']}}</td>
					@if($history['quantity_change'] > 0 )
						<td class="text-success"> +<span class="display_currency" data-is_quantity="true">{{$history['quantity_change']}}</span>
						</td>
					@else
						<td class="text-danger"><span class="display_currency text-danger" data-is_quantity="true">{{$history['quantity_change']}}</span>
						</td>
					@endif

					@if(!empty($common_settings['enable_secondary_unit']))
						@if($history['quantity_change'] > 0 )
							<td class="text-success">
								@if(!empty($history['purchase_secondary_unit_quantity']))
									+<span class="display_currency" data-is_quantity="true">{{$history['purchase_secondary_unit_quantity']}}</span> {{$stock_details['second_unit']}}
								@endif
							</td>
						@else
							<td class="text-danger">
								@if(!empty($history['sell_secondary_unit_quantity']))
									-<span class="display_currency" data-is_quantity="true">{{$history['sell_secondary_unit_quantity']}}</span> {{$stock_details['second_unit']}}
								@endif
							</td>
						@endif
					@endif
					<td>
						<span class="display_currency" data-is_quantity="true">{{$history['stock']}}</span>
					</td>
					@if(!empty($common_settings['enable_secondary_unit']))
						<td>
							@if(!empty($stock_details['second_unit']))
								<span class="display_currency" data-is_quantity="true">{{$history['stock_in_second_unit']}}</span> {{$stock_details['second_unit']}}
							@endif
						</td>
					@endif
					<td>{{@format_datetime($history['date'])}}</td>
					<td>
						{{$history['ref_no']}}

						@if(!empty($history['additional_notes']))
							@if(!empty($history['ref_no']))
							<br>
							@endif
							{{$history['additional_notes']}}
						
						@endif
					</td>
					<td>
						{{$history['contact_name'] ?? '--'}} 
						@if(!empty($history['supplier_business_name']))
						 - {{$history['supplier_business_name']}}
						@endif
					</td>
				</tr>
			@empty
				<tr><td colspan="5" class="text-center">
					@lang('lang_v1.no_stock_history_found')
				</td></tr>
			@endforelse
			</tbody>
		</table>
	</div>
</div>