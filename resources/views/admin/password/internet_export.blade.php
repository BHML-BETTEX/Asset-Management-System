<table>
    <thead>
    <tr>
        <th>SL No</th>
        <th>Internet Name</th>
        <th>Position</th>
        <th>Password</th>
        <th>Company</th>
        <th>Note</th>
    </tr>
    </thead>
    <tbody>
    @foreach($internetPassword as $key => $internetPassword)
        <tr>

            <td>{{ $key + 1 }}</td>
            <td>{{ $internetPassword->internet_name }}</td>
            <td>{{ $internetPassword->position }}</td>
            <td>{{ $internetPassword->password }}</td>
            <td>{{ $internetPassword->company }}</td>
            <td>{{ $internetPassword->note }}</td>
        </tr>
    @endforeach
    </tbody>
</table>