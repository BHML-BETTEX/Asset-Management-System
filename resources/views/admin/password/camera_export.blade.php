<table>
    <thead>
    <tr>
        <th>SL No</th>
        <th>Camera No</th>
        <th>Possition</th>
        <th>Password</th>
        <th>Company</th>
        <th>Note</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Camera_pass as $key => $Camera_pass)
        <tr>

            <td>{{ $key + 1 }}</td>
            <td>{{ $Camera_pass->camera_no }}</td>
            <td>{{ $Camera_pass->possition }}</td>
            <td>{{ $Camera_pass->password }}</td>
            <td>{{ $Camera_pass->company }}</td>
            <td>{{ $Camera_pass->others }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
