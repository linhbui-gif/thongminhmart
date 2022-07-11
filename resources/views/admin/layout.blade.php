<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Starter</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/skin-blue.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/app.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/myapp.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/all.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/alertifyjs/css/alertify.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/alertifyjs/css/themes/default.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/dist/css/select2.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/morris.js/morris.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css' ) }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/jquery-ui/jquery-ui.css' ) }}">
    <script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/morris.js/morris.js') }}"></script>
    <script src="{{ asset('admin/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/plugins/kcfinder/adapters/jquery.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="{{ asset('admin/dist/jquery-ui/jquery-ui.js') }}"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}'
        };
    </script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
   @include("admin.partials.top-nav")
   @include("admin.partials.right-sidebar")
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content-header')

        <!-- Main content -->
        <section class="content container-fluid">

         @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
   @include("admin.partials.footer")
    <div class="control-sidebar-bg"></div>
</div>
@include("admin.partials.script")
@yield('script')
</body>
</html>
