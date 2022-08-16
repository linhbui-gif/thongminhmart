<!DOCTYPE html>
<html>

<head>
    @include("enduser.components.head")
</head>

<body>
<div id="top"></div>
@include("enduser.components.header_desktop_v2")
@yield('content')
@include("enduser.components.footer")
@include("enduser.components.script_footer")
<div class="ButtonsCta">
    <div class="ButtonsCta-item"><a href="#"><img src="{{ asset('enduser/thongminhmart/assets/images/image-button-cta-zalo.png') }}" alt=""></a></div>
    <div class="ButtonsCta-item"><a href="tel:0932.86 85 85"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"/></svg></a></div>
    <div class="ButtonsCta-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-messenger" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1"/><path d="M8 13l3 -2l2 2l3 -2"/></svg></a></div>
</div>
<a class="ButtonToTop" href="#top"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#000" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15"/></svg></a>
</body>

</html>
