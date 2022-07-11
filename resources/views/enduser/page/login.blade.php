@extends("enduser.layout")

@section('content')

    <div class="authen-page">
        <div class="container">
            <div class="authen-page-wrapper">
                @if(Session::has('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ Session::get('success') }}
                                    </div>
                @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('error') }}
                        </div>
                    @endif
                <h3>ĐĂNG NHẬP</h3>
                <p>Vui lòng nhập địa chỉ email và mật khẩu của bạn</p>
                <form class="authen-form" action="{{route('user.postlogin')}}">
                    @csrf
                    <div class="form-group">
                        <div class="form-item">
                            <label>Địa chỉ Email <span>*</span></label>
                            <input type="text" class="@error('email') is-invalid @enderror" name="email" placeholder="Hãy điền địa chỉ email của bạn">
                            @error('email')
                            <div class="alert alert-danger  mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <label>Mật khẩu <span>*</span></label>
                            <input type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Hãy điền mật khẩu của bạn">
                            @error('password')
                            <div class="alert alert-danger  mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <button class="btn" type="submit">Đăng nhập</button>
                        </div>
                    </div>
                    <p style="margin-bottom: 30px; margin-top: -15px;"><a href="{{ route('user.forgotPassword')  }}">Quên mật khẩu ?</a></p>
                    <p style="margin-bottom: 5px;">Chưa có tài khoản? <a href="{{route('user.register')}}">Tạo tài khoản ngay</a></p>
                    <p style="margin-bottom: 20px;">Hoặc <span>Đăng nhập bằng</span></p>
                    <div class="form-group half" style="padding-bottom: 10px">
                        <div class="form-item">
                            <a style="height: 40px;color: #fff;background: #3b5998;border-radius: 30px;" href="{{ route('user.loginProvider', 'facebook') }}" class="d-flex align-items-center justify-content-center facebook"><img style="width: 20px" src="{{ asset('enduser/assets/icons/icon-facebook-white.svg') }}" alt="">Facebook</a>
                        </div>
                        <div class="form-item">
                            <a style="height: 40px;color: #fff;background: #d7342d;border-radius: 30px;" class="d-flex align-items-center justify-content-center google" href="{{ route('user.loginProvider', 'google') }}"><img  style="width: 20px" src="{{ asset('enduser/assets/icons/icon-google-white.svg') }}" alt="">Google</a>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: -15px;">
                        <div class="form-item">
                            <a style="height: 40px;color: #fff;background: #2792f0;border-radius: 30px;" href="{{ route('user.loginProvider', 'zalo') }}" class="d-flex align-items-center justify-content-center zalo"><img src="{{ asset('enduser/assets/icons/icon-zalo-white.svg') }}" alt="">Zalo</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@stop
