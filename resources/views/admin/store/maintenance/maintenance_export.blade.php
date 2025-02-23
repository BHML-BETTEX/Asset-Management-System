<table>
    <thead>
    <tr>
        <th>SL No</th>
        <th>Asset Tag</th>
        <th>Asset Type</th>
        <th>Model</th>
        <th>Purchase Date</th>
        <th>Description</th>
        <th>Strat Date</th>
        <th>End Date</th>
        <th>note</th>
        <th>Amount</th>
        <th>Currency</th>
        <th>Vendor</th>
        <th>Others</th>

    </tr>
    </thead>
    <tbody>
    @foreach($maintenance as $key => $maintenance)
        <tr>

            <td>{{ $key + 1 }}</td>
            <td>{{ $maintenance->asset_tag }}</td>
            <td>{{ $maintenance->asset_type}}</td>
            <td>{{ $maintenance->model }}</td>
            <td>{{ $maintenance->purchase_date}}</td>
            <td>{{ $maintenance->description }}</td>
            <td>{{ $maintenance->strat_date }}</td>
            <td>{{ $maintenance->end_date }}</td>
            <td>{{ $maintenance->note }}</td>
            <td>{{ $maintenance->amount }}</td>
            <td>{{ $maintenance->currency }}</td>
            <td>{{ $maintenance->vendor }}</td>
            <td>{{ $maintenance->others }}</td>
        </tr>
    @endforeach
    </tbody>
</table>