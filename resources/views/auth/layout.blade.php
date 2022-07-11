<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            Login
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/bower_components/alertify/alertify.core.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}"/>

    <script src="{{ asset('admin/bower_components/jquery/dist/jquery.js') }}"></script>

</head>
<body class="hold-transition login-page">

<div class="login-box">
    @yield('content')
</div>

<!-- Bootstrap -->
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/alertify/alertify.js') }}"></script>
<script src="{{ asset('admin/dist/js/script.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
