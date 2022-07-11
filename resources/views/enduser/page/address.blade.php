@php
    use App\Helper\NhanhService;
@endphp

@extends("enduser.layout")

@section('content')

    @include("enduser.partials.breadcrumb", [ 'mainpage' => "Trang chủ",'name' => 'Địa chỉ' ])


    <div class="user-layout">
       <div class="container">
           <div class="user-layout-wrapper">
               <div class="row">
                   <div class="col-lg-3">
                       @include("enduser.components.account.sidebar")
                   </div>
                   <div class="col-lg-9">

                       <div class="user-layout-main">
                           <h3 class="layout-title">Thêm mới sổ địa chỉ</h3>
                           <form class="authen-form" action="{{ route('account.postAddress') }}" method="POST">
                               @csrf
                               <div class="form-group">
                                   <div class="form-item">
                                       @php
                                             $provinces = \App\Province::orderBy('_name','asc')->get();
                                       @endphp
                                        <label> Chọn tỉnh <span style="color:red">*<span></label>
                                       <select name="province_id" class="@error('province_id') is-invalid @enderror custom-select" id="select_tinh">
                                           <option value="default">Chọn tỉnh</option>
                                           @foreach($provinces as $k => $item)
                                               <option value="{{ $item->id }}">{{ $item->_name }}</option>
                                           @endforeach
                                       </select>
                                       @error('province_id')
                                       <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                       @enderror
                                   </div>
                               </div>
                               <input type="hidden" name="CityName">
                               <input type="hidden" name="DistrictName">
                               <input type="hidden" name="WardName">

                               <div class="form-group half">
                                   <div class="form-item">
                                    <label> Chọn Quận/Huyện <span style="color:red">*<span></label>
                                       <select name="district_id" class="@error('district_id') is-invalid @enderror custom-select" id="select_quan">
                                           <option value="default">Chọn Quận/Huyện</option>
                                       </select>
                                       @error('district_id')
                                       <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                       @enderror
                                   </div>
                                   <div class="form-item">
                                    <label> Chọn Phường/Xã <span style="color:red">*<span></label>
                                       <select name="ward_id" class="@error('ward_id') is-invalid @enderror custom-select" id="select_phuong">
                                           <option value="default">Chọn Phường/Xã</option>
                                       </select>
                                       @error('ward_id')
                                       <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                       @enderror
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="form-item">
                                   <label> Nhập địa chỉ <span style="color:red">*<span></label>
                                       <input class="@error('address') is-invalid @enderror" name="address" type="text" placeholder="Địa chỉ">
                                       @error('address')
                                       <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                       @enderror
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="form-item">
                                   <label>Nhập số điện thoại <span style="color:red">*<span></label>
                                       <input value="" type="number" class="@error('phone') is-invalid @enderror" name="phone" placeholder="Điện thoại">
                                       @error('phone')
                                       <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                       @enderror
                                   </div>
                               </div>
                                <span style="color: #958AAB; font-style: italic;"><strong>Ghi chú: </strong>(<span style="color:red">*</span>) bắt buộc</span>

{{--                               <div class="form-group half">--}}
{{--                                   <div class="form-item">--}}
{{--                                       <label>Địa chỉ:</label>--}}
{{--                                       <input type="text" placeholder="Địa chỉ">--}}
{{--                                   </div>--}}
{{--                                   <div class="form-item">--}}
{{--                                       <label>Số điện thoại:</label>--}}
{{--                                       <input type="text" placeholder="Số điện thoại">--}}
{{--                                   </div>--}}
{{--                               </div>--}}
                               <div class="form-group half">
                                   <div class="form-item"></div>
                                   <div class="form-item button-checkout">
                                       <button class="btn primary">Thêm mới</button>
                                   </div>
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
{{--                               <div class="address-item">--}}
{{--                                   <div class="address-action d-flex align-items-center">--}}
{{--                                       <button class="btn edit"><img src="./assets/icons/icon-edit-white.svg" alt=""></button>--}}
{{--                                       <button class="btn delete"><img src="./assets/icons/icon-trash-white.svg" alt=""></button>--}}
{{--                                   </div>--}}
{{--                                   <h4 class="address-name">Your address</h4>--}}
{{--                                   <div class="address-col d-flex align-items-center bold"><img src="./assets/icons/icon-home.svg" alt="">Hanoi, Vietnam</div>--}}
{{--                                   <div class="address-col d-flex align-items-center"> <img src="./assets/icons/icon-phone-outline.svg" alt="">0123456789</div>--}}
{{--                               </div>--}}
                           </div>
{{--                           <div class="pagination-wrapper d-flex justify-content-center align-items-center flex-wrap">--}}
{{--                               <div class="pagination-item arrow-left">&lt;</div>--}}
{{--                               <div class="pagination-item active">1</div>--}}
{{--                               <div class="pagination-item">2</div>--}}
{{--                               <div class="pagination-item">3</div>--}}
{{--                               <div class="pagination-item arrow-right">&gt;</div>--}}
{{--                           </div>--}}
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>



@stop

@section('script')

    <script>
        $("#select_tinh").change(function(){
            var id_tinh = $(this).val();
            layHuyenTheoTinh(id_tinh);
            var selectedText = $("#select_tinh option:selected").text();
            $("input[name='CityName']").val(selectedText);
        });

        function layHuyenTheoTinh(id_tinh){
            $("#select_quan").html('');
            $.ajax({
                url : '{{ route('ajax.getDistrict') }}?id_tinh=' + id_tinh,
                dataType:"html",
                success: function(data){
                    $("#select_quan").html(data);
                    $("#select_quan").change(function(){
                        var id_huyen = $(this).val();
                        layXaTheoHuyen(id_huyen);
                        var selectedText = $("#select_quan option:selected").text();
                        $("input[name='DistrictName']").val(selectedText);
                    });
                }
            });
        }
        function layXaTheoHuyen(id_huyen){
            $("#select_phuong").html('');
            $.ajax({
                url : '{{ route('ajax.getWard') }}?id_huyen=' + id_huyen,
                dataType:"html",
                success: function(data){
                    $("#select_phuong").html(data);
                    $("#select_phuong").change(function(){
                        var selectedText = $("#select_phuong option:selected").text();
                        $("input[name='WardName']").val(selectedText);
                    });
                }
            });
        }
    </script>

@stop
