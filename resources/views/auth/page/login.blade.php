@extends("auth.layout")

@section('title')
    {{ trans('user::auth.login') }} | @parent
@stop

@section('content')
    <div class="login-logo">
        <a href="{{ url('/') }}">Anyclass</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Hệ thống quản trị Anyclass</p>
        @include('auth.partials.notifications')

        <form action="{{ route('auth.login.post') }}" method="POST">
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" class="form-control" autofocus
                   name="email" placeholder="Email" value="{{ old('email')}}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control"
                   name="password" placeholder="Password" value="{{ old('password')}}">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember_me">Remember
                    </label>
                </div>
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    Login
                </button>
            </div>
        </div>
            @csrf
        </form>

{{--        <a href="#">forgot ?</a><br>--}}
        @if (config('asgard.user.config.allow_user_registration'))
            <a href="#" class="text-center">{{ trans('user.auth.register')}}</a>
        @endif
    </div>
@stop

