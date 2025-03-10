<table>
    <thead>
    <tr>
        <th>SL No</th>
        <th>Asset Tag</th>
        <th>Asset Type</th>
        <th>Model</th>
        <th>Description</th>
        <th>Company</th>
        <th>Employee ID</th>
        <th>Employee Name</th>
        <th>Designation</th>
        <th>Department</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Note</th>
        <th>Issue Date</th>
        <th>Return Date</th>



    </tr>
    </thead>
    <tbody>
    @foreach($issues as $key => $issues)
        <tr>

            <td>{{ $key + 1 }}</td>
            <td>{{ $issues->asset_tag }}</td>
            <td>{{ $issues->asset_type }}</td>
            <td>{{ $issues->model }}</td>
            <td>{{ $issues->description }}</td>
            <td>{{ $issues->others }}</td>
            <td>{{ $issues->emp_id }}</td>
            <td>{{ $issues->emp_name }}</td>
            <td>{{ $issues->designation_id }}</td>
            <td>{{ $issues->department_id }}</td>
            <td>{{ $issues->phone_number }}</td>
            <td>{{ $issues->email }}</td>
            <td>{{ $issues->others }}</td>
            <td>{{ $issues->issue_date }}</td>
            <td>{{ $issues->return_date }}</td>


        </tr>
    @endforeach
    </tbody>
</table>