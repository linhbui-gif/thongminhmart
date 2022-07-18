@php
    use App\Helper\NhanhService;
@endphp

@extends("enduser.layout")

@section('content')
    <style>
        .coupon-item select {
            border: none;
        }

    </style>
    @include("enduser.partials.breadcrumb", [ 'mainpage' => "Trang chủ",'name' =>'Thanh toán'])

    @php

        $fields = ['name', 'email', 'phone', 'address', 'province_id', 'district_id', 'ward_id', 'payment_method'];
        $fieldValue = [];

        foreach ($fields as $key => $value) {
             $fieldValue[$value] = old($value);
        }

    @endphp
    <div class="cart-layout checkout-layout">
        <div class="container">
            <div class="cart-layout-wrapper">
                <h3>Thanh toán</h3>
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('success') }}
                    </div>
                @endif

                <form id="frmCheckout" class="authen-form" action="{{ route('order.postCheckout') }}" method="POST">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="checkout-info-wrapper">
                                @csrf
                                @php
                                    $classActiveForm = '';
                                    $classActiveAddress = '';
                                    if ($errors->has('name') || $errors->has('email') || $errors->has('phone') || $errors->has('address') || $errors->has('province_id') || $errors->has('district_id') || $errors->has('ward_id')) {
                                        $classActiveForm = 'active';
                                        $classActiveAddress = 'hide';
                                    } elseif($errors->has('chooseAddressCurrent')){
                                        $classActiveForm = '';
                                    }
                                @endphp
                                <div class="another-address-wrapper >
                                    <div class=" form-group
                                ">
                                <div class="form-item">
                                    <label>Họ và tên <span style="color:red">*</span></label>
                                    <input name="name" value="{{ $fieldValue['name'] }}"
                                           class="@error('name') is-invalid @enderror" type="text"
                                           placeholder="Họ và tên">
                                    @error('name')
                                    <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group half">
                                <div class="form-item">
                                    <label>Địa chỉ email <span style="color:red">*</span></label>
                                    <input name="email" value="{{ $fieldValue['email'] }}"
                                           class="@error('email') is-invalid @enderror" type="text"
                                           placeholder="Email">
                                    @error('email')
                                    <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-item">
                                    <label>Số điện thoại <span style="color:red">*</span></label>
                                    <input name="phone" value="{{ $fieldValue['phone'] }}"
                                           class="@error('phone') is-invalid @enderror" type="text"
                                           placeholder="Điện thoại">
                                    @error('phone')
                                    <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-item">
                                    @php
                                        $provinces = \App\Province::orderBy('_name', 'asc')->get();
                                    @endphp
                                    <label>Chọn tỉnh <span style="color:red">*</span></label>
                                    <select name="province_id" value="{{ $fieldValue['province_id'] }}"
                                            class="@error('province_id') is-invalid @enderror custom-select"
                                            id="select_tinh">
                                        <option value="default">Chọn tỉnh</option>
                                        @foreach ($provinces as $k => $item)
                                            <option
                                                {{ $fieldValue['province_id'] == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->_name }}</option>
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
                                    <label>Chọn Quận/Huyện <span style="color:red">*</span></label>
                                    <select value="{{ $fieldValue['district_id'] }}" name="district_id"
                                            class="@error('district_id') is-invalid @enderror custom-select"
                                            id="select_quan">
                                        <option value="default">Chọn Quận/Huyện</option>
                                    </select>
                                    @error('district_id')
                                    <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-item">
                                    <label>Chọn Phường/Xã <span style="color:red">*</span></label>
                                    <select name="ward_id" value="{{ $fieldValue['ward_id'] }}"
                                            class="@error('ward_id') is-invalid @enderror custom-select"
                                            id="select_phuong">
                                        <option value="default">Chọn Phường/Xã</option>
                                    </select>
                                    @error('ward_id')
                                    <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-item">
                                    <label>Địa chỉ <span style="color:red">*</span></label>
                                    <input name="address" value="{{ $fieldValue['address'] }}"
                                           class="@error('address') is-invalid @enderror" type="text"
                                           placeholder="Địa chỉ">
                                </div>
                                @error('address')
                                <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

<h5>Phương thức giao hàng</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios3"  id="exampleRadios3" value="1" checked>
                            <label class="form-check-label" for="exampleRadios3">
                                Giao hàng tận nơi
                            </label>
                        </div>
                        <h5>Phương thức thanh toán</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="2" checked >
                            <label class="form-check-label" for="exampleRadios1">
                                Chuyển khoản
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="3">
                            <label class="form-check-label" for="exampleRadios2">
                                Thanh toán khi nhận hàng
                            </label>
                        </div>
                        <div class="form-group half">
                            <div class="form-item"><a href="#">Quay lại giỏ hàng</a></div>
                        </div>

                    </div>

            </div>
            <div class="col-lg-5">
                <div class="checkout-products">
                    <div class="product-list-wrapper">

                        <button class="btn primary w-100 mt-4" type="button" onclick="submitCheckout()">Tiến
                            hành thanh toán
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    </div>

@stop

@section('script')

    <script>
        var address_id = "0";
        var donvivanchuyen = "0";
        var province_name = "";
        var district_name = "";

        function tinh(id_tinh) {
            layHuyenTheoTinh(id_tinh);
            var selectedText = $("#select_tinh option:selected").text();
            province_name = selectedText;
            $("input[name='CityName']").val(selectedText);

            district_name = '';
            $("input[name='DistrictName']").val(district_name);
            $("input[name='WardName']").val('');

            getShippingFeeById(province_name, district_name);
        }

        function huyen(id_huyen) {
            layXaTheoHuyen(id_huyen);
            var selectedText = $("#select_quan option:selected").text();
            district_name = selectedText;
            $("input[name='DistrictName']").val(selectedText);

            $("input[name='WardName']").val('');
            getShippingFeeById(province_name, district_name);
        }

        var province_id = {!! json_encode(old('province_id')) !!};
        var district_id = {!! json_encode(old('district_id')) !!};
        var ward_id = {!! json_encode(old('ward_id')) !!};

        if (province_id && province_id != 'default') {
            tinh(province_id);
        }

        if (district_id && district_id != 'default') {
            console.log('vao huyen');
            huyen(district_id);
        }

        $("#select_tinh").change(function () {
            var id_tinh = $(this).val();
            tinh(id_tinh);
        });

        function layHuyenTheoTinh(id_tinh) {
            $("body").append(
                '<div id="overlay"><img class="img_spin" src="{{ asset('enduser/assets/images/spin.png') }}" alt=""></div>'
            );
            $("#select_quan").html('');
            $.ajax({
                url: '{{ route('ajax.getDistrict') }}?id_tinh=' + id_tinh,
                dataType: "html",
                success: function (data) {

                    String.prototype.splice = function (idx, rem, str) {
                        return this.slice(0, idx) + str + this.slice(idx + Math.abs(rem));
                    };

                    var index = data.indexOf(`value="${district_id}"`);

                    var result = data.splice(index, 0, "selected ");

                    if (district_id) {
                        $("#select_quan").html(result);
                    } else {
                        $("#select_quan").html(data);
                    }

                    $("#select_quan").change(function () {
                        var id_huyen = $(this).val();
                        huyen(id_huyen);
                    });
                    $("#overlay").remove();
                },

            });
        }

        function layXaTheoHuyen(id_huyen) {
            $("body").append(
                '<div id="overlay"><img class="img_spin" src="{{ asset('enduser/assets/images/spin.png') }}" alt=""></div>'
            );
            $("#select_phuong").html('');
            $.ajax({
                url: '{{ route('ajax.getWard') }}?id_huyen=' + id_huyen,
                dataType: "html",
                success: function (data) {

                    String.prototype.splice = function (idx, rem, str) {
                        return this.slice(0, idx) + str + this.slice(idx + Math.abs(rem));
                    };

                    var index = data.indexOf(`value="${ward_id}"`);

                    var result = data.splice(index, 0, "selected ");

                    var selectedText = $("#select_quan option:selected").text();
                    district_name = selectedText;
                    console.log('huyen');
                    console.log(district_name);
                    $("input[name='DistrictName']").val(selectedText);
                    if (district_name != "" && province_name != "") {
                        getShippingFeeById(province_name, district_name);
                    }
                    if (ward_id) {
                        $("#select_phuong").html(result);
                    } else {
                        $("#select_phuong").html(data);
                    }

                    $("#select_phuong").change(function () {
                        var selectedText = $("#select_phuong option:selected").text();
                        $("input[name='WardName']").val(selectedText);
                    });
                    $("#overlay").remove();
                }
            });
        }

        function getShippingFeeById(province, district) {
            checkShip = false;
            if (province == "" || district == "") {
                $("#shipFee").text("Chưa xác định");
                return;
            }
            $("body").append(
                '<div id="overlay"><img class="img_spin" src="{{ asset('enduser/assets/images/spin.png') }}" alt=""></div>'
            );

            $.ajax({
                url: '{{ route('ajax.getShipping') }}',
                data: {
                    'province_name': province,
                    'district_name': district
                },
                dataType: 'html',
                success: function (data) {

                },
                error: function () {
                    alert('Lỗi tính phí vận chuyển');
                    $("#overlay").remove();
                }
            });
        }

        function number_format(number, decimals, dec_point, thousands_point) {

            if (number == null || !isFinite(number)) {
                throw new TypeError("number is not valid");
            }

            if (!decimals) {
                var len = number.toString().split('.').length;
                decimals = len > 1 ? len : 0;
            }

            if (!dec_point) {
                dec_point = '.';
            }

            if (!thousands_point) {
                thousands_point = ',';
            }

            number = parseFloat(number).toFixed(decimals);

            number = number.replace(".", dec_point);

            var splitNum = number.split(dec_point);
            splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
            number = splitNum.join(dec_point);

            return number;
        }

        $("input[name='address_id']").change(function () {
            var id = $(this).val();
            address_id = id;
            getShippingFee();
        });
        $("input[name='inp_donvivanchuyen']").change(function () {
            var id = $(this).val();
            donvivanchuyen = id;
            getShippingFee();
            getShippingFeeById(province_name, district);
        });
        $(".btn-tinh-ship").click(function () {
            var province = $("input[name='CityName']").val();
            var district = $("input[name='DistrictName']").val();

            if (province != "" && district != "") {
                getShippingFeeById(province, district);
            } else {
                alert('Vui lòng chọn địa chỉ hợp lệ')
            }
        });
    </script>
    <script>
        function submitCheckout() {
            $("#frmCheckout").submit();
        }

        $("#select_coupon").change(function () {
            var v = $(this).val();
            if (v != "default") {
                $("#inp_coupon").val(v);
            }
        })
    </script>
    <script>
        $(document).ready(function () {
            var sub = $(".list-atm");
            if ($("#mobile-banking").is(":checked")) {
                sub.show(100);
            } else {
                resetForm();
                sub.hide();
            }
            // get address
            var address_id_old = $("input[name='address_id']").val();
            if (address_id && address_id != "" && address_id != "0") {
                address_id = address_id_old;
                console.log('dia chi');
                console.log(address_id);
                getShippingFee();
            }
            var id_address = $("input[name='address_id']:checked").val();
            if (id_address && id_address != null && id_address != "") {
                address_id = id_address;
                getShippingFee();
            }


        });
        $("input[name='payment_method']").change(function () {
            var checked = $("#mobile-banking").is(":checked");
            var sub = $(".list-atm");
            if (checked) {
                sub.show(100);
            } else {
                resetForm();
                sub.hide(100);
            }
        });

        function resetForm() {
            $(".list-atm .form-subitem input[type='radio']").prop("checked", false);
        }
    </script>
@stop
