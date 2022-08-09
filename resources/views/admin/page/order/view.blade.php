

@extends("admin.layout")


@section('content-header')
    <section class="content-header">
        <h1>
            View
        </h1>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    @include("admin.template.error")
                    @include("admin.template.notify")
                    <div class="sc-table">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-uppercase">Thông tin đơn hàng</h4>
                                <table class="table">
                                    <tr>
                                        <td><b>Mã</b></td>
                                        <td>#{{ $order->getId() }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Thời gian</b></td>
                                        <td>{{ $order->created_at->format("h:i:s d/m/Y") }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Phương thức thanh toán</b></td>
                                        <td>{{ $order->getPaymentMethod() }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tổng đơn hàng</b></td>
                                        <td><span class="text-success">{{ number_format($order->total) }} VNĐ</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Tổng ship</b></td>
                                        <td><span class="text-success">{{ number_format($order->ship ) }} VNĐ</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Coupon</b></td>
                                        <td>
                                            @if($order->coupon && is_object($order->coupon))
                                                <span class="text-success">{{ $order->coupon_code }}</span>
                                                @if($order->coupon->type == 0)
                                                    <p>-{{ $order->coupon->value }}%</p>
                                                @else
                                                    <p>-{{ number_format($order->coupon->value) }} VNĐ</p>
                                                @endif
                                            @else
                                                <span>Không có</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        @php
                                            $totalCheckout = $order->total;
                                             if($order->coupon && is_object($order->coupon)){
                                                 if($order->coupon->type == 0){
                                                      $totalCheckout = $totalCheckout - $totalCheckout * $order->coupon->value / 100;
                                                 }else{
                                                     $totalCheckout = $totalCheckout - $order->coupon->value;
                                                 }
                                             }
                                             $totalCheckout = $totalCheckout + $order->ship;
                                        @endphp
                                        <td><b>Tổng thanh toán</b></td>
                                        <td><span class="text-success">{{ number_format($totalCheckout) }} VNĐ</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Trạng thái</b></td>
                                        <td>{!!  $order->getStatus() !!} <a  data-toggle="modal" data-target="#modalStatus" href="#">Cập nhật ?</a></td>
                                    </tr>
                                    <tr>
                                        <td><b>Ghi chú</b></td>
                                        <td>{{  $order->note }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-uppercase">Thông tin khách</h4>
                                @php
                                    $address = $order->address;
                                    $user = $order->user;
                                    $config = config("edushop.status_gthk");
                                @endphp
                                <table class="table">
                                    <tr>
                                        <td><b>Họ tên</b></td>
                                        <td>@if(!empty($address->fullname))
                                                {{ $address->fullname  }}
                                            @else
                                                {{ $user->fullname()  }}
                                            @endif</td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone</b></td>
                                        <td>@if(!empty($address->phone))
                                                {{ $address->phone  }}
                                            @else
                                                {{ $user->phone  }}
                                            @endif</td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b></td>
                                        <td>@if(!empty($address->email))
                                                {{ $address->email  }}
                                            @else
                                                {{ $user->email  }}
                                            @endif</td>
                                    </tr>
                                    <tr>
                                        <td><b>Sinh nhật</b></td>
                                        <td>@if(!empty($address->email))

                                            @else
                                                {{ $user->birthday }}
                                            @endif</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @php
                            $arrKho = [];
                            $suborders = $order->suborder;
                            $orderDetail = $order->details()->where('order_detail.type', 'product' )->get();
                        @endphp
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-uppercase">Thông tin nhận hàng</h4>
                                <table class="table">
                                    <tr>
                                        <th>Họ tên</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Phưỡng/Xã</th>
                                        <th>Quận/Huyện</th>
                                        <th>Tỉnh/TP</th>
                                        <th>Địa chỉ</th>
                                    </tr>
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
                                        <td>{{ $address->WardName }}</td>
                                        <td>{{ $address->DistrictName }}</td>
                                        <td>{{ $address->CityName }}</td>
                                        <td>{{ $address->address }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-uppercase">Danh sách sản phẩm </h4>
                                <table class="table">
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    <tbody>
                                    @if(!empty($orderDetail))
                                        @foreach($orderDetail as $k => $v)
                                    <tr>
                                        <td>{{ $v->product_name }}</td>
                                        <td>{{ $v->quantity }}</td>
                                        <td>{{ number_format($v->product_price) }} VNĐ</td>
                                        <td>{{ number_format($v->total) }} VNĐ</td>
                                    </tr>
                                        @endforeach
                                    @endif
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="el-form-item">
                            <div class="el-form-item__content">
                                <a href="{{ route('admin.' . $controllerName . ".index") }}" class="el-button el-button--default"><span>Back </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalStatus" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cập nhật trạng thái đơn hàng</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.order.changeStatus',  [ 'id' => $order->id ] ) }}">
                        @php
                            $arr_status = config("edushop.order_status");
                        @endphp
                        @foreach($arr_status as $k => $v)
                            <div class="radio">
                                <label><input @if($k == $order->trangthai)  checked @endif value="{{ $k }}" type="radio" name="status_order">{{ $v }}</label>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        @csrf
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
@stop

@section('script')
    <script>
        function postGHTK(link){
            alertify.confirm('Thông báo', 'Bạn chắc chắn tạo đơn trên GHTK',
                function(){
                    window.location.href = link;
                }
                ,
                function(){

                });
        }
    </script>
@stop
