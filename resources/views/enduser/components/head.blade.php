<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
@yield('meta')
@yield('head')
@if(isset($_config))
    <link rel="shortcut icon" href="{{ $_config->favicon_url }}" />
@endif
<link rel="stylesheet" href="{{ asset('enduser/thongminhmart/assets/css/main.css') }}">
{{--<link rel="stylesheet" type="text/css" href="{{ asset('enduser/composite/css/bootstrap.min.css') }}">--}}
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@yield('css')
