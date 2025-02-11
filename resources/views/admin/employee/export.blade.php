<table>
    <thead>
    <tr>
        <th>SL No</th>
        <th>Employee Id</th>
        <th>Name</th>
        <th>Department</th>
        <th>Designation</th>
        <th>Join Date</th>
        <th>Phone Number</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employee as $employee)
        <tr>
            <td>{{ $employee->id }}</td>
            <td>{{ $employee->emp_id }}</td>
            <td>{{ $employee->emp_name }}</td>
            <td>{{ $employee->rel_to_departmet->department_name, }}</td>
            <td>{{ $employee->rel_to_designation->designation_name }}</td>
            <td>{{ $employee->join_date }}</td>
            <td>{{ $employee->phone_number }}</td>
            <td>{{ $employee->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
