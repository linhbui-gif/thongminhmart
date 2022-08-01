<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="google-site-verification" content="CHyuN6P8flY4F8EgBnbdiWy5KIgJDNvkZTIGLj5dhPM" />
@yield('meta')
@yield('head')
@if(isset($_config))
    <link rel="shortcut icon" href="{{ $_config->favicon_url }}" />
@endif
<link rel="stylesheet" type="text/css" href="{{ asset('enduser/thongminhmart/assets/css/main.css') }}">
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@yield('css')
