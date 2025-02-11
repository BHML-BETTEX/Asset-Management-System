<table>
    <thead>
    <tr>
        <th>SL No</th>
        <th>Display Name</th>
        <th>Mail Id</th>
        <th>Phone</th>
        <th>Password</th>
        <th>Company</th>
        <th>Note</th>

    </tr>
    </thead>
    <tbody>
    @foreach($DingPassword as $key => $DingPassword)
        <tr>

            <td>{{ $key + 1 }}</td>
            <td>{{ $DingPassword->display_name }}</td>
            <td>{{ $DingPassword->mail_id }}</td>
            <td>{{ $DingPassword->phone }}</td>
            <td>{{ $DingPassword->password }}</td>
            <td>{{ $DingPassword->company }}</td>
            <td>{{ $DingPassword->note }}</td>

        </tr>
    @endforeach
    </tbody>
</table>