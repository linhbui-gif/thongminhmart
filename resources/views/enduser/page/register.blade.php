@extends("enduser.layout")

@section('content')

    <div class="authen-page">
        <div class="container">
            <div class="authen-page-wrapper">
                <h3>ĐĂNG KÝ</h3>
                <p>Vui lòng điền vào các thông tin bên dưới</p>
                <form class="authen-form" method="post" action="{{route('user.postregister')}}">
                    @csrf
                    <div class="form-group">
                        <div class="form-item">
                            <label>Họ <span>*</span></label>
                            <input value="{{ old('first_name', '') }}" type="text" class="@error('first_name') is-invalid @enderror" name="first_name"  placeholder="Họ">
                            @error('first_name')
                            <div class="alert alert-danger  mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <label>Tên <span>*</span></label>
                            <input value="{{ old('last_name', '') }}" type="text" class="@error('last_name') is-invalid @enderror" name="last_name"  placeholder="Tên">
                            @error('last_name')
                            <div class="alert alert-danger  mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <label>Tên tài khoản <span>*</span></label>
                            <input value="{{ old('username', '') }}" type="text" class="@error('username') is-invalid @enderror" name="username"  placeholder="Hãy điền tên tài khoản của bạn">
                            @error('username')
                            <div class="alert alert-danger  mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <label>Địa chỉ Email <span>*</span></label>
                            @if (\Session::has('error'))
                                <div class="alert alert-danger" style="padding: 0;height: 50px">
                                    <ul>
                                        <li style="padding: 13px 10px;">{!! \Session::get('error') !!}</li>
                                    </ul>
                                </div>
                            @endif
                            <input value="{{ old('email', '') }}" type="text" class="@error('email') is-invalid @enderror" name="email"  placeholder="Hãy điền địa chỉ email của bạn">
                            @error('email')
                            <div class="alert alert-danger  mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <label>Mật khẩu <span>*</span></label>
                            <input type="password" class="@error('password') is-invalid @enderror" name="password"  placeholder="Hãy điền mật khẩu của bạn">
                            @error('password')
                            <div class="alert alert-danger  mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <label>Xác nhận mật khẩu <span>*</span></label>
                            <input type="password" class="@error('password') is-invalid @enderror" name="password_confirmation" placeholder="Hãy điền xác nhận mật khẩu của bạn">
                            @error('password')
                            <div class="alert alert-danger  mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <button class="btn" type="submit">Đăng ký</button>
                        </div>
                    </div>
                    <p style="margin-bottom: 30px; margin-top: -15px;">Đã có tài khoản? <a href="{{route('user.login')}}">Đăng nhập ngay</a></p>
                    <p style="margin-bottom: 20px;">Hoặc <span>Đăng ký bằng</span></p>
                    <div class="form-group half">
                        <div class="form-item">
                            <button class="d-flex align-items-center justify-content-center facebook"><img src="{{ asset('enduser/assets/icons/icon-facebook-white.svg') }}" alt="">Facebook</button>
                        </div>
                        <div class="form-item">
                            <button class="d-flex align-items-center justify-content-center google"><img src="{{ asset('enduser/assets/icons/icon-google-white.svg') }}" alt="">Google</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@stop
