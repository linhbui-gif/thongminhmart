@extends("enduser.layout")

@section('content')

    @include("enduser.partials.breadcrumb", [ 'mainpage' => "Trang chủ",'name' => 'Đơn hàng' ])


    <div class="user-layout">
       <div class="container">
           <div class="user-layout-wrapper">
               <div class="row">
                   <div class="col-lg-3">
                      @include("enduser.components.account.sidebar")
                   </div>
                   <div class="col-lg-9">
                       <div class="user-layout-main">
                           <h3 class="layout-title">Đơn hàng của tôi</h3>
                           <div class="user-layout-table">
                               <table class="my-course-table">
                                   <thead>
                                   <tr>
                                       <td class="col-center">STT</td>
                                       <td class="col-center nowrap">Mã</td>
                                       <td class="col-center nowrap">Thời gian</td>
                                       <td class="col-center nowrap">Trạng thái</td>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @foreach($orders as $k => $order)
                                       @php
                                           $config = config("edushop.order_status");
                                           $sku = "#" . $order->id;
                                           $link = route('account.myOrderDetail', [ 'order_id' => $order->id ]);

                                       @endphp
                                   <tr>
                                       <td class="col-center">{{ $k + 1 }}</td>
                                       <td class="course-content"><a href="{{ $link }}">{{ $sku }}</a></td>
                                       <td class="col-center nowrap">{{ $order->created_at->format('h:i:s d-m-Y') }}</td>

                                       <td class="tags">
                                           <div class="tag-group d-flex flex-wrap justify-content-center"> <a class="active tag-item" href="my-order-detail.html">{{ $config[$order->trangthai] }}</a></div>
                                       </td>
                                   </tr>
                                   @endforeach
                                   </tbody>
                               </table>
                           </div>
                           @include('enduser.components.account.pagination', ['paginator' => $orders])
                       </div>

                   </div>
               </div>
           </div>
       </div>
   </div>


@stop
