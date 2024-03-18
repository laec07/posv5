<div class="table-responsive">
<table class="table table-bordered table-striped" id="ledgercxc_table" style="width: 100%;">
    <thead>
        <tr>
            <th>client_name</th>
            <th>0 - 30 días</th>
            <th>31 - 60 días</th>
            <th>61 - 90 días</th>
            <th>91 - 120 días</th>
            <th>Más de 120 días</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total_0_30 = $total_31_60 = $total_61_90 = $total_91_120 = $total_over_120 = 0;
        @endphp
        @foreach($grouped_transactions as $client_name => $ranges)
        <tr>
            <td>{{ $client_name }}</td>
            <td>Q {{ number_format($ranges['0 - 30 días'] ?? 0, 2, '.', ',') }}</td>
            <td>Q {{ number_format($ranges['31 - 60 días'] ?? 0, 2, '.', ',') }}</td>
            <td>Q {{ number_format($ranges['61 - 90 días'] ?? 0, 2, '.', ',') }}</td>
            <td>Q {{ number_format($ranges['91 - 120 días'] ?? 0, 2, '.', ',') }}</td>
            <td>Q {{ number_format($ranges['Más de 120 días'] ?? 0, 2, '.', ',') }}</td>
        </tr>
        @php
            $total_0_30 += $ranges['0 - 30 días'] ?? 0;
            $total_31_60 += $ranges['31 - 60 días'] ?? 0;
            $total_61_90 += $ranges['61 - 90 días'] ?? 0;
            $total_91_120 += $ranges['91 - 120 días'] ?? 0;
            $total_over_120 += $ranges['Más de 120 días'] ?? 0;
        @endphp
        @endforeach

        <!-- Total de cada columna -->
        <tr>
            <th>Total</th>
            <td>Q {{ number_format($total_0_30, 2, '.', ',') }}</td>
            <td>Q {{ number_format($total_31_60, 2, '.', ',') }}</td>
            <td>Q {{ number_format($total_61_90, 2, '.', ',') }}</td>
            <td>Q {{ number_format($total_91_120, 2, '.', ',') }}</td>
            <td>Q {{ number_format($total_over_120, 2, '.', ',') }}</td>
        </tr>
    </tbody>
</table>
</div>