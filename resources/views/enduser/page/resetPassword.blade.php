@extends("enduser.layout")

@section('content')


    <div class="authen-page">
        <div class="container">
            <div class="authen-page-wrapper">
                <h3>Thay đổi mật khẩu</h3>
{{--                <p>Vui lòng nhập địa chỉ email. Hệ thống sẽ gửi một tin nhắn đến Email của bạn</p>--}}
                <form class="authen-form" method="POST" action="{{ route('user.resetPassword') }}">
                    @csrf
                    <div class="form-group">
                        <div class="form-item">
                            <label>Mật khẩu mới <span>*</span></label>
                            @error('email')
                            <div class="alert alert-danger  mt-2">{{ $message }}</div>
                            @enderror
                            @if (\Session::has('error'))
                                <div class="alert alert-danger" style="padding: 0;height: 50px">
                                    <ul>
                                        <li style="padding: 13px 10px;">{!! \Session::get('error') !!}</li>
                                    </ul>
                                </div>
                            @endif
                            <input name="password" type="password" placeholder="Nhập mật khẩu mới của bạn">
                            <label>Nhập lại mật khẩu mới <span>*</span></label>
                            @error('email')
                            <div class="alert alert-danger  mt-2">{{ $message }}</div>
                            @enderror
                            @if (\Session::has('error'))
                                <div class="alert alert-danger" style="padding: 0;height: 50px">
                                    <ul>
                                        <li style="padding: 13px 10px;">{!! \Session::get('error') !!}</li>
                                    </ul>
                                </div>
                            @endif
                            <input name="password_confirmation" type="password" placeholder="Nhập lại mật khẩu mới của bạn">
{{--                            <p class="form-error">Email không được để trống!</p>--}}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <button type="submit" class="btn">Đồng ý</button>
                        </div>
                    </div>
                    <p style="margin-bottom: 20px;">Quay lại <a href="{{  route('user.login') }}"> Đăng nhập</a></p>
                </form>
            </div>
        </div>
    </div>



@stop
