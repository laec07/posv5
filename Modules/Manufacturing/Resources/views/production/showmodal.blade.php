<!-- resources/views/show_results_modal.blade.php -->

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="resultsModalLabel">Detalle</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @if($results->isEmpty())
                <p>No results found.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>@lang('manufacturing::lang.ingredient')</th>
                            <th>@lang('manufacturing::lang.input_quantity')</th>
                            <th>Lote No.</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $result)
                            <tr>
                                <td>{{ $result->product_name }}</td>
                                <td>{{  number_format($result->quantity, 2)}} CAJAS </td>
                                <td>{{ $result->lot_number }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

