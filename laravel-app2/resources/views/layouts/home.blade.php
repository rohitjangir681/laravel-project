<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JobEntry - Job Portal Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    @include('home-include/head')
</head>

<body>
    <div class="container-xxl bg-white p-0">
    @include('home-include/nav')
    
    @yield('content')
        
    </div>
        @include('home-include/footer')
</body>

</html>