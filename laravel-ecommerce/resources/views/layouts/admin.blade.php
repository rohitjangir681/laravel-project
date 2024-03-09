<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laravel eCommerce Project</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    @include('includes.head')
</head>

<body class="skin-blue">
    <div class="wrapper">
        <div class="content-wrapper">
            @include('includes.header')
            <!-- Left side column. contains the logo and sidebar -->
            @include('includes.nav')

            <!-- Right side column. Contains the navbar and content of the page -->
            @yield('content')
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.0
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All
            rights reserved.
        </footer>
        @include('includes.footer')
    </div><!-- ./wrapper -->

</body>

</html>
