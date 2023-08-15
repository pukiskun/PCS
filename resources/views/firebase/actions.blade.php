<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
initial-scale=1.0">
    <title>{{ $pageTitle }}</title>
    @vite('resources/sass/app.scss')
</head>
<body>
    <div class="d-flex">
        <a href="{{ url('edit/' . $key) }}" class="btn btn-warning px-xl-4">Edit</a>
        <a href="{{ url('delete/' . $key) }}" class="btn btn-danger px-sm-4">Delete</a>
    </div>
    @vite('resources/js/app.js')
</body>
</html>
