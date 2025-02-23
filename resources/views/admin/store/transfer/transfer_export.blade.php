<table>
    <thead>
    <tr>
        <th>SL No</th>
        <th>Asset Tag</th>
        <th>Asset Type</th>
        <th>Model</th>
        <th>Company</th>
        <th>Description</th>
        <th>Note</th>
        <th>Transer Date</th>


    </tr>
    </thead>
    <tbody>
    @foreach($Transfer as $key => $Transfer)
        <tr>

            <td>{{ $key + 1 }}</td>
            <td>{{ $Transfer->asset_tag }}</td>
            <td>{{ $Transfer->asset_type}}</td>
            <td>{{ $Transfer->model }}</td>
            <td>{{ $Transfer->description}}</td>
            <td>{{ $Transfer->company }}</td>
            <td>{{ $Transfer->description }}</td>
            <td>{{ $Transfer->note }}</td>
            <td>{{ $Transfer->transfer_date }}</td>
        </tr>
    @endforeach
    </tbody>
</table>