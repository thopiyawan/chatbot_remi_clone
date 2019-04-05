<html>
<head>
<title>View Student Records</title>
</head>
<body>
    <table border = "1">
            <tr>
            <td>ID</td>
            <td>First Name</td>
            <td>Lastst Name</td>
            <td>City Name</td>
            <td>Email</td>
            <td>Edit</td>
            </tr>
    @foreach ($users as $user)
    <tr>
            <td>{{ $user->doctor_id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->lastname }}</td>
            <td>{{ $user->hospital }}</td>
            <td>{{ $user->type_user }}</td>
            <td><a href = 'edit_user/{{ $user->doctor_id }}'>Edit</a></td>
    </tr>
    @endforeach
    </table>
</body>
</html>

