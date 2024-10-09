<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>

<body>
    <h3>Hello Admin!</h3>
    <p>Name :{{ $request['name'] }}</p>
    <p>Email :{{ $request['email'] }}</p>
    <p>Password :{{ $request['password'] }}</p>
    <p>Phone :{{ $request['phone'] }}</p>

</body>

</html>
