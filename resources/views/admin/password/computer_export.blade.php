<table>
    <thead>
    <tr>
        <th>SL No</th>
        <th>Asset Tag</th>
        <th>Employee Id</th>
        <th>Name</th>
        <th>Password</th>
        <th>Note</th>
    </tr>
    </thead>
    <tbody>
    @foreach($computer_pass as $key => $computer_pass)
        <tr>

            <td>{{ $key + 1 }}</td>
            <td>{{ $computer_pass->asset_tag }}</td>
            <td>{{ $computer_pass->emp_id }}</td>
            <td>{{ $computer_pass->emp_name }}</td>
            <td>{{ $computer_pass->password }}</td>
            <td>{{ $computer_pass->others }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
