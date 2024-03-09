<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laravel eCommerce Project</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    @include('includes.web-head')
</head>

<body>
    @include('includes.web-header')


    @include('includes.web-nav')


    @yield('content')


    @include('includes.web-footer')
</body>
</html>