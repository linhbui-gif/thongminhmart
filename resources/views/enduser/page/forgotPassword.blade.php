@extends("enduser.layout")

@section('content')


    <div class="authen-page">
        <div class="container">
            <div class="authen-page-wrapper">
                <h3>Quên mật khẩu</h3>
{{--                <p>Vui lòng nhập địa chỉ email. Hệ thống sẽ gửi một tin nhắn đến Email của bạn</p>--}}
                <form class="authen-form" method="POST" action="{{ route('user.senMail') }}">
                    @csrf
                    <div class="form-group">
                        <div class="form-item">
                            <label>Địa chỉ Email <span>*</span></label>
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
                            @if (\Session::has('success'))
                                <div class="alert alert-success" style="padding: 0;height: 50px">
                                    <ul>
                                        <li style="padding: 13px 10px;">{!! \Session::get('success') !!}</li>
                                    </ul>
                                </div>
                            @endif
                            <input name="email" type="text" placeholder="Hãy điền địa chỉ email của bạn">
{{--                            <p class="form-error">Email không được để trống!</p>--}}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <button type="submit" class="btn">Gửi liên kết</button>
                        </div>
                    </div>
                    <p style="margin-bottom: 20px;">Quay lại <a href="{{  route('user.login') }}"> Đăng nhập</a></p>
                </form>
            </div>
        </div>
    </div>



@stop
