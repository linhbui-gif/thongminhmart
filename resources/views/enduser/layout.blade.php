<!DOCTYPE html>
<html>

<head>
    @include("enduser.components.head")
</head>

<body>
    <div id="top"></div>
    @include("enduser.components.header_desktop")
    @include("enduser.components.navigation")
    @include("enduser.components.notify")
    @yield('content')

    @include("enduser.components.footer")
    @include("enduser.components.script_footer")


</body>

</html>