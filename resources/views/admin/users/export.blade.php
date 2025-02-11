<table>
    <thead>
    <tr>
        <th>SL No</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $users)
        <tr>
            <td>{{ $users->id }}</td>
            <td>{{ $users->name }}</td>
            <td>{{ $users->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
