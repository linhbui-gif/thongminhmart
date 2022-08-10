@php
    $user = Auth::user();
@endphp
<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">Thongminhmart</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Thongminhmart</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
{{--                <li class="dropdown tasks-menu">--}}
{{--                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">--}}
{{--                        @if(app()->getLocale() == "vi")--}}
{{--                            Tiếng Việt--}}
{{--                        @else--}}
{{--                            English--}}
{{--                        @endif--}}
{{--                        <span class="caret"></span></button>--}}
{{--                    <ul class="dropdown-menu">--}}
{{--                        <li><a href="{{ route("auth.changeLang", ['lang' => 'en']) }}">English</a></li>--}}
{{--                        <li><a href="{{ route("auth.changeLang", ['lang' => 'vi']) }}">Tiếng Việt</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ \App\Helper\Common::showThumb('user', $user->picture, 'standard' ) }}" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ $user->last_name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ \App\Helper\Common::showThumb('user', $user->picture, 'standard' ) }}" class="img-circle" alt="User Image">

                            <p>
                                {{ $user->first_name }} {{ $user->last_name }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/my-profile" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('auth.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>



            </ul>
        </div>
    </nav>
</header>
