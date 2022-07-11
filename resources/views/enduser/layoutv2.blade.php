<!DOCTYPE html>
<html>
<head>

    @include("enduser.components.head")
</head>
<body>
<div class="wrapper">
    @include("enduser.components.header_v2")
    @yield('content')
    @include("enduser.components.footer")
</div>
@include("enduser.components.script_footer")
</body>
</html>
