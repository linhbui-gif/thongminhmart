@extends("enduser.layout")

@section('content')

    @include("enduser.partials.breadcrumb", [ 'mainpage' => "Trang chủ",'name' => 'Thông tin của tôi' ])


    <div class="user-layout">
       <div class="container">
           <div class="user-layout-wrapper">
               <div class="row">
                   <div class="col-lg-3">
                       @include("enduser.components.account.sidebar")
                   </div>
                   <div class="col-lg-9">
                       <div class="user-layout-main">
                           <h3 class="layout-title">Thông tin cá nhân</h3>
                           @if(Session::has('success'))
                           <div class="alert alert-success alert-dismissible">
                               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               {{ Session::get('success') }}
                           </div>
                           @endif
                           @if(Session::has('success_pass'))
                               <div class="alert alert-success alert-dismissible">
                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                   {{ Session::get('success_pass') }}
                               </div>
                           @endif
                           <form lang="vn" method="POST" class="authen-form" action="{{ route('account.changeProfile') }}">
                               @csrf
                               <div class="form-group half">
                                   <div class="form-item">
                                       <label>Họ <span color="red">*</span></label>
                                       <input name="first_name" value="{{ $user->first_name }}" type="text" placeholder="Họ">
                                       @error('first_name')
                                       <p class="form-error">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="form-item">
                                       <label>Tên<span color="red">*</span></label>
                                       <input name="last_name" value="{{ $user->last_name }}" type="text" placeholder="Tên">
                                       @error('last_name')
                                       <p class="form-error">{{ $message }}</p>
                                       @enderror
                                   </div>
                               </div>
                               <div class="form-group half">
                                   <div class="form-item">
                                       <label>Ngày sinh<span color="red">*</span></label>
                                       <input class="datepicker" name="birthday" value="{{ implode("/", array_reverse(explode("-", $user->birthday))) }}" placeholder="Ngày sinh">
                                       @error('birthday')
                                       <p class="form-error">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="form-item">
                                       <label>Email<span color="red">*</span></label>
                                       <input value="{{ $user->email }}" type="text" placeholder="Email" disabled="disabled"">
                                   </div>
                               </div>
                               <div class="form-group half">
                                   <div class="form-item">
                                       <label>Số điện thoại<span color="red">*</span></label>
                                       <input name="phone" value="{{ $user->phone }}" type="text" placeholder="Số điện thoại">
                                       @error('phone')
                                        <p class="form-error">{{ $message }}</p>
                                       @enderror
                                   </div>
                               </div> 
                               <span style="color: #958AAB; font-style: italic;"><strong>Ghi chú: </strong>(<span style="color:red">*</span>) bắt buộc</span>
                               <div class="form-group half">
                                   <div class="form-item"></div>
                                   <div class="form-item button-checkout">
                                       <button type="submit" class="btn primary">Cập nhật </button>
                                   </div>
                               </div>
                           </form>
                           <h3 class="layout-title">Thay đổi mật khẩu</h3>

                           <form method="POST" class="authen-form" action="{{ route('account.changePassword') }}">
                               @csrf
                               <div class="form-group half">
                                   <div class="form-item">
                                       <label>Mật khẩu cũ<span color="red">*</span></label>
                                       <input name="old_pass" type="password" placeholder="Mật khẩu cũ">
                                       @if(Session::has('error'))
                                           <p class="form-error">{{ Session::get('error') }}</p>
                                       @endif
                                   </div>
                                   <div class="form-item">
                                       <label>Mật khẩu mới <span color="red">*</span></label>
                                       <input name="password" type="password" placeholder="Mật khẩu mới">
                                       @error('password')
                                       <p class="form-error">{{ $message }}</p>
                                       @enderror
                                   </div>
                               </div>
                               <div class="form-group half align-items-end">
                                   <div class="form-item">
                                       <label>Xác nhận mật khẩu mới <span color="red">*</span></label>
                                       <input name="password_confirmation" type="password" placeholder="Xác nhận mật khẩu mới">
                                   </div>
                                                                

                                  
                               </div>
                                 <span style="color: #958AAB; font-style: italic;"><strong>Ghi chú: </strong>(<span style="color:red">*</span>) bắt buộc</span>
                                <div class="form-item button-checkout">
                                       <button type="submit" class="btn primary">Thay đổi mật khẩu</button>
                                   </div>

                           </form>

                           <h3 class="layout-title">Sổ địa chỉ</h3>
                           <div class="address-list-wrapper">
                               @php
                                   $user = Auth::user();
                                   $addresses = $user->addresses()->orderBy('address.id' , 'DESC')->get();
                               @endphp
                               @if($addresses && count($addresses) > 0)
                                   @foreach($addresses as $k => $address)
                                       <div class="address-item">
                                           <div class="address-action d-flex align-items-center">
                                               <a href="{{ route('account.editAddress', [ 'id' => $address->id ] ) }}" class="btn edit"><img src="{{ asset('enduser/assets/icons/icon-edit-white.svg') }}" alt=""></a>
                                               <a href="{{ route('account.deleteAddress', [ 'id' => $address->id ] ) }}" class="btn delete"><img src="{{ asset('enduser/assets/icons/icon-trash-white.svg') }}" alt=""></a>
                                           </div>
                                           <h4 class="address-name">Your address</h4>
                                           <div class="address-col d-flex align-items-center bold"><img src="{{ asset('enduser/assets/icons/icon-home.svg') }}" alt="">{{ $address->address }}</div>
                                           <div class="address-col d-flex align-items-center"> <img src="{{ asset('enduser/assets/icons/icon-phone-outline.svg') }}" alt="">{{ $address->phone }}</div>
                                       </div>
                                   @endforeach
                               @else
                                   <p>Chưa có địa chỉ nào</p>
                               @endif
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
@stop

@section('script')
    <script type="text/javascript">
        $(function() {
            $( ".datepicker" ).datepicker( $.datepicker.regional[ "vi" ] );
        });
    </script>
@endsection
