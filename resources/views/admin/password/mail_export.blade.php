<table>
    <thead>
    <tr>
        <th>SL No</th>
        <th>Display Name</th>
        <th>Mail Address</th>
        <th>Password</th>
        <th>Company</th>
        <th>Others</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mail_pass as $key => $mail_pass)
        <tr>

            <td>{{ $key + 1 }}</td>
            <td>{{ $mail_pass->display_name }}</td>
            <td>{{ $mail_pass->mail_address }}</td>
            <td>{{ $mail_pass->password }}</td>
            <td>{{ $mail_pass->company }}</td>
            <td>{{ $mail_pass->others }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
