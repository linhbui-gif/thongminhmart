@extends("enduser.layout")

@section('content')
    <style>

    </style>
    @include("enduser.partials.breadcrumb", [ 'mainpage' => "Trang chủ",'name' =>'Thanh toán thành công'])
    @php
        $banks = \App\Bank::where('status','active')->get();
        $arrKho = [];
        $suborders = $order->suborder;
        $order_course = $order->details()->where('order_detail.type', 'course' )->where('order_detail.compo_id', null)->where('order_detail.kho_id', null)->get();
    @endphp
    <div class="cart-layout checkout-layout">
        <div class="container">
            <div class="cart-layout-wrapper">
                <h3>Đặt hàng thành công</h3>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkout-info-wrapper ">
                            @if(Session::has('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                        </div>
                        <h2 class="time_and_sku_order">
                            <span>[Đơn hàng: #{{ sprintf("%06d", $order->getId()) }}]</span>
                            <span> ({{ $order->created_at->format("h:i \p\h\ú\\t d/m/Y") }})</span>
                        </h2>

                        <div class="tab-content-order">
                            <div class="" id="tab_ship">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><b class="text-bold">Phương thức thanh toán</b></td>
                                                <td>
                                                    @php
                                                        $payment_method = $order->pay_method;
                                                    @endphp
                                                    @if($payment_method == "cod")
                                                        COD - thanh toán khi nhận hàng
                                                    @elseif($payment_method == "bank")
                                                        @php
                                                            $bank = \App\Bank::find($order->bank);
                                                        @endphp
                                                        <p style="display: block"><b class="badge badge-success">Chuyển khoản ngân hàng</b></p>
                                                        <p style="display: block">Thông tin chuyển khoản</p>
                                                        <p style="display: block"><b>Chủ tài khoản:</b> {{ $bank->chutaikhoan }}</p>
                                                        <p style="display: block"><b>Số tài khoản:</b> {{ $bank->stk }}</p>
                                                        <p style="display: block">{{ $bank->name }}</p>
                                                        @if($bank->chinhanh)
                                                            <p style="display: block"><b>Chi nhánh:</b> {{ $bank->chinhanh }}</p>
                                                        @endif
                                                        @php
                                                            $strNoiDung = "";
                                                        @endphp
                                                        @if(count($suborders) > 0)

                                                            @foreach($suborders as $k => $sub)
                                                                @php
                                                                    $strNoiDung .= "," . $sub->id;
                                                                @endphp
                                                            @endforeach
                                                            @php
                                                                $strNoiDung = substr($strNoiDung, 1);
                                                            @endphp
                                                        @endif
                                                        <p class="content_payment" style="display: block"><b>Nội dung:</b> <b><span>CK{{ $order->id }}</span></b></p>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b class="text-bold">Tổng đơn hàng</b></td>
                                                <td><span class="">{{ number_format($order->total) }} VNĐ</span></td>
                                            </tr>
                                            @php
                                                $totalCheckout = $order->total;
                                            @endphp
                                            @if($order->coupon && is_object($order->coupon))
                                                <tr>
                                                    <td><b class="text-bold">Mã giảm giá: <span class="text-success">{{ $order->coupon_code }}</span></b></td>
                                                    @if($order->coupon->type == 0)
                                                        @php
                                                            $totalCheckout = $totalCheckout - $totalCheckout * $order->coupon->value / 100;
                                                        @endphp
                                                        <td><b class="text-success">{{ $order->coupon->value }}%</b></td>
                                                    @else
                                                        @php
                                                            $totalCheckout = $totalCheckout - $order->coupon->value;
                                                        @endphp
                                                        <td><b class="text-success">{{ number_format($order->coupon->value) }} đ</b></td>
                                                    @endif
                                                </tr>
                                            @endif
                                            <tr>
                                                <td><b class="text-bold">Tổng ship</b></td>
                                                <td><span class="">{{ number_format($order->ship ) }} VNĐ</span></td>
                                            </tr>
                                            <tr>
                                                <td><b class="text-bold">Tổng thanh toán</b></td>
                                                <td><span class="total_checkout_main">{{ number_format($totalCheckout + $order->ship) }} VNĐ</span></td>
                                            </tr>
                                        </table>
                                        @if(count($suborders) > 0)
                                            @foreach($suborders as $k => $suborder)
                                                @php
                                                    $khoObj = \App\Warehouse::find($suborder->warehouse_id);
                                                    $details = $suborder->details;
                                                    $subtotal = 0;
                                                @endphp
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <td class="item-name">Mã</td>
                                                        <td class="item-image">Hình ảnh</td>
                                                        <td class="item-name">Tên sản phẩm </td>
                                                        <td class="item-name">Loại sản phẩm </td>
                                                        <td class="item-price">Giá</td>
                                                        <td class="item-name">Số lượng </td>
                                                        <td class="item-name">Tổng</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($details as $k => $detail)
                                                        @php
                                                            $type_name = \App\Helper\Common::showTypeProductName($detail->type);
                                                            $product = $detail->getProduct()->first();
                                                            $subtotal += $detail->product_price;
                                                            $t = $detail->quantity * $detail->product_price;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $detail->id }}</td>
                                                            <td><img style="max-width: 100px" class="lazyload" data-src="{{ $product->url_picture }}" alt=""></td>
                                                            <td>
                                                                {{ $detail->product_name }}
                                                                @if($detail->type == "course")
                                                                    @php
                                                                        $compo = \App\Compo::find($detail->compo_id);
                                                                    @endphp
                                                                    @if($compo)
                                                                        <p>Compo: {{ $compo->name }}</p>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td><span class="label label-info">{!! \App\Helper\Common::showTypeProductName($detail->type) !!}</span></td>
                                                            <td>{{ number_format($detail->product_price) }} VNĐ</td>
                                                            <td>{{ $detail->quantity }}</td>
                                                            <td>{{ number_format($t)  }} VNĐ</td>
                                                        </tr>

                                                    @endforeach
                                                    <tr>
                                                        <td colspan="6" class="item-image">
                                                            <span class="text-bold">Tạm tính</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ number_format($subtotal) }} VNĐ</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" class="item-image">
                                                            <span class="text-bold">Ship</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ number_format($suborder->ship) }} VNĐ</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="6" class="item-image">
                                                            <span class="text-bold">Tổng ( tổng đơn hàng + ship )</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ number_format($subtotal + $suborder->ship) }} VNĐ</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="6" class="item-image">
                                                            <span class="text-bold">Trạng thái <i class="fa fa-truck"></i></span>
                                                        </td>
                                                        @php
                                                            $suborder_status = 'Đã tiếp nhận';
                                                            $suborder_status_code = 2;
                                                            //$suborder->save();
                                                            //$order_status = $res['order']['status'];
                                                        @endphp
                                                        <td>
                                                            @if(in_array($suborder_status, [ 5, 6]))
                                                                <span class="badge badge-success">{{  $suborder_status }}</span>
                                                            @else
                                                                <span class="badge badge-warning">{{  $suborder_status }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            @endforeach
                                        @endif

                                        @php
                                            $address = $order->address;
                                        @endphp
                                        <h2 class="time_and_sku_order"><span>Địa chỉ giao hàng</span></h2>

                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Họ tên</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Phưỡng/Xã</th>
                                                <th>Quận/Huyện</th>
                                                <th>Tỉnh/TP</th>
                                                <th>Địa chỉ</th>
                                            </tr>
                                            </thead>

                                            <tr>
                                                <td>
                                                    @if(!empty($address->fullname))
                                                        {{ $address->fullname  }}
                                                    @else
                                                        {{ $user->fullname()  }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($address->phone))
                                                        {{ $address->phone  }}
                                                    @else
                                                        {{ $user->phone  }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($address->email))
                                                        {{ $address->email  }}
                                                    @else
                                                        {{ $user->email  }}
                                                    @endif
                                                </td>
                                                <td>{{ $address->WardName }}</td>
                                                <td>{{ $address->DistrictName }}</td>
                                                <td>{{ $address->CityName }}</td>
                                                <td>{{ $address->address }}</td>
                                            </tr>
                                        </table>

                                    </div>

                                </div>
                            </div>
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
            layHuyenTheoTinh(id_tinh)
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
                }
            });
        }
    </script>

@stop
