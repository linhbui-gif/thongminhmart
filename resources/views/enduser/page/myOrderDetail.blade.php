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
                           <h3 class="layout-title">Thông tin đơn hàng</h3>
                           <table class="table">
                               <tr>
                                   <td>Mã: </td>
                                   <td>#{{ $order->id }}</td>
                               </tr>
                               <tr>
                                   <td>Họ tên: </td>
                                   <td>{{ $order->name }}</td>
                               </tr>
                               <tr>
                                   <td>Số điện thoại </td>
                                   <td>{{ $order->phone }}</td>
                               </tr>
                               <tr>
                                   <td>Email </td>
                                   <td>{{ $order->email }}</td>
                               </tr>
                               <tr>
                                   <td>Địa chỉ </td>
{{--                                   <td>{{ $order->address }}</td>--}}
                               </tr>
                               <tr>
                                   <td>Phương thức thanh toán </td>
                                   <td>{!! \App\Helper\Common::showPaymentMethod($order->pay_method) !!}</td>
                               </tr>
                           </table>
                           <h3 class="layout-title">Trạng thái đơn hàng</h3>
                           <ul class="stepper stepper-vertical order-step">
                               @php
                                  $config = config("edushop.order_status");
                               @endphp
                               @foreach($config as $k => $item)
                                   @php
                                        if($k <= $order->trangthai){
                                            $status_current = "completed";
                                        }elseif($k == $order->trangthai + 1 ){
                                            $status_current = "active";
                                        }else{
                                             $status_current = "warning";
                                        }
                                   @endphp
                                   <li class="{{ $status_current }}"><a class="step-item" href="#"> <span class="circle">{{ $k + 1 }}</span><span class="label">{{ $item }}</span></a></li>
                               @endforeach
{{--                               <li class="completed"><a class="step-item" href="#"> <span class="circle">1</span><span class="label">Đặt hành thành công</span></a></li>--}}
{{--                               <li class="completed"><a class="step-item" href="#"> <span class="circle">2</span><span class="label">Hệ thống tiếp nhận</span></a></li>--}}
{{--                               <li class="completed"><a class="step-item" href="#"> <span class="circle">3</span><span class="label">Đang lấy hàng</span></a></li>--}}
{{--                               <li class="active"><a class="step-item" href="#"> <span class="circle">4</span><span class="label">Đang vận chuyển</span></a></li>--}}
{{--                               <li class="warning"><a class="step-item" href="#"> <span class="circle">5</span><span class="label">Giao hàng thành công</span></a></li>--}}
                           </ul>
                           <h3 class="layout-title">Chi tiết trạng thái đơn hàng</h3>
                           <div class="order-detail-wrapper">
                               <div class="order-detail-item">
                                   <div class="order-detail-header">Cập nhật mới nhất</div>
                                   <div class="order-detail-contents">
                                       <div class="order-content-item d-flex align-items-center">
                                           <div class="order-time">10:52</div>
                                           <div class="order-title">Giao hàng thành công</div>
                                       </div>
                                       <div class="order-content-item d-flex align-items-center">
                                           <div class="order-time">10:52</div>
                                           <div class="order-title">Giao hàng thành công</div>
                                       </div>
                                   </div>
                               </div>
{{--                               <div class="order-detail-item">--}}
{{--                                   <div class="order-detail-header">Cập nhật mới nhất</div>--}}
{{--                                   <div class="order-detail-contents">--}}
{{--                                       <div class="order-content-item d-flex align-items-center">--}}
{{--                                           <div class="order-time">10:52</div>--}}
{{--                                           <div class="order-title">Giao hàng thành công</div>--}}
{{--                                       </div>--}}
{{--                                       <div class="order-content-item d-flex align-items-center">--}}
{{--                                           <div class="order-time">10:52</div>--}}
{{--                                           <div class="order-title">Giao hàng thành công</div>--}}
{{--                                       </div>--}}
{{--                                   </div>--}}
{{--                               </div>--}}
                           </div>
                           @php
                               $details = $order->details;
                               $sum = 0;
                           @endphp

                           <table class="table">
                               <thead>
                               <th>STT</th>
{{--                               <th>Trạng thái</th>--}}
                               <th>Loại sản phẩm</th>
                               <th>Tên</th>
                               <th>Hình</th>
                               <th>Số lượng</th>
                               <th>Giá</th>
                               <th>Tổng</th>
                               </thead>
                               <tbody>
                               @foreach($details as $k => $detail)
                                   @php
                                       $config_status = config("edushop.order_status");
                                       $total = $detail->product_price * $detail->quantity;
                                       $sum += $total;
                                       $product = $detail->getProduct; // dành cả 2 course và  học liệu
                                       $status_order_detail = \App\Helper\Common::showStatusOrder($detail->trangthai);
                                       $type_name = \App\Helper\Common::showTypeProductName($detail->type);
                                   @endphp
                                   <tr>
                                       <td>{{ $k + 1 }}</td>
{{--                                       <td>{!! $status_order_detail !!}</td>--}}
                                       <td>{!! $type_name !!}</td>
                                       <td>{{ $detail->product_name  }}</td>
                                       <td><img style="max-width: 100px" class="lazyload" data-src="{{ isset($product) ?  $product->getImage() : "" }}" alt=""></td>
                                       <td>{{ $detail->quantity  }}</td>
                                       <td>{{ number_format($detail->product_price)  }} vnđ</td>
                                       <td>{{ number_format($total) }} vnđ</td>
                                   </tr>
                               @endforeach
                               <tr>
                                   <td colspan="4"><h4>Tổng tiền</h4></td>
                                   <td colspan="10" class="text-right"><h4>{{ number_format($sum) }} vnđ</h4></td>
                               </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>


@stop
