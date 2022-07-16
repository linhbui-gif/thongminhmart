<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="google-site-verification" content="CHyuN6P8flY4F8EgBnbdiWy5KIgJDNvkZTIGLj5dhPM" />
@yield('meta')
@yield('head')
@if(isset($_config))
    <link rel="shortcut icon" href="{{ $_config->favicon_url }}" />
@endif
<!-- Bootstrap -->
<link href="{{ asset('enduser/composite/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- FontAwesome 4.0 CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('enduser/composite/css/font-awesome.min.css') }}">
<!-- Google Font CSS -->
<link
    href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700%7cPT+Serif:400,400i,700,700i"
    rel="stylesheet">
<!-- owl.carousel.min.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('enduser/composite/css/owl.carousel.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('enduser/composite/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('enduser/composite/css/magnific-popup.css') }}">
<!-- fontello.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('enduser/composite/css/fontello.css') }}">
<!-- Style CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('enduser/composite/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('enduser/composite/css/product.css') }}">
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@yield('css')
