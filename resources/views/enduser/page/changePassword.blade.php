@extends("enduser.layout")

@section('content')
    @include("enduser.partials.breadcrumb")

    <div class="user-layout">
        <div class="container">
            <div class="user-layout-wrapper">
                <div class="row">
                    <div class="col-lg-3">
                        @include("enduser.components.account.sidebar")
                    </div>
                    <div class="col-lg-9">
                        <div class="user-layout-main">
                            <h3 class="layout-title">Thay đổi mật khẩu</h3>
                            @if(Session::has('success_pass'))
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('success_pass') }}
                                </div>
                            @endif
                            <form method="POST" class="authen-form" action="{{ route('account.changePassword') }}">
                                @csrf
                                <div class="form-group half">
                                    <div class="form-item">
                                        <label>Mật khẩu cũ:</label>
                                        <input name="old_pass" type="password" placeholder="Mật khẩu cũ">
                                        @if(Session::has('error'))
                                            <p class="form-error">{{ Session::get('error') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-item">
                                        <label>Mật khẩu mới:</label>
                                        <input name="password" type="password" placeholder="Mật khẩu mới">
                                        @error('password')
                                        <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group half align-items-end">
                                    <div class="form-item">
                                        <label>Xác nhận mật khẩu mới:</label>
                                        <input name="password_confirmation" type="password" placeholder="Xác nhận mật khẩu mới">
                                    </div>
                                    <div class="form-item button-checkout">
                                        <button type="submit" class="btn primary">Thay đổi mật khẩu</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
