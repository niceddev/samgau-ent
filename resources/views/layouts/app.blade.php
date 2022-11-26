<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-reboot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>
        @yield('title', 'ЕНТ')
    </title>

</head>
<body>

    @yield('content')

</body>
</html>
