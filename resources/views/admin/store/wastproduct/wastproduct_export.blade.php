<table>
    <thead>
    <tr>
        <th>SL No</th>
        <th>Asset Tag</th>
        <th>Asset Type</th>
        <th>Model</th>
        <th>Purchase Date</th>
        <th>Description</th>
        <th>asset_sl_no</th>
        <th>Date</th>
        <th>note</th>
    </tr>
    </thead>
    <tbody>
    @foreach($WastProduct as $key => $WastProduct)
        <tr>

            <td>{{ $key + 1 }}</td>
            <td>{{ $WastProduct->asset_tag }}</td>
            <td>{{ $WastProduct->asset_type}}</td>
            <td>{{ $WastProduct->model }}</td>
            <td>{{ $WastProduct->purchase_date}}</td>
            <td>{{ $WastProduct->description }}</td>
            <td>{{ $WastProduct->asset_sl_no }}</td>
            <td>{{ $WastProduct->date }}</td>
            <td>{{ $WastProduct->note }}</td>
        </tr>
    @endforeach
    </tbody>
</table>