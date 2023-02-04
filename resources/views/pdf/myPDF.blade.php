<!DOCTYPE html>
<html lang="en">
<head>
    <title>User's PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <p>This is a PDF of User details</p>
  
    <table class="table table-bordered" aria-describedby="PDF Table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
    </table>
  
</body>
</html>