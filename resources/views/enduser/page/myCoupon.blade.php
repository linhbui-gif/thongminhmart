@extends("enduser.layout")

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@silvermine/videojs-quality-selector@1.2.4/dist/css/quality-selector.css">
@stop

@section('content')

    @include("enduser.partials.breadcrumb", [ 'mainpage' => "Trang chủ",'name' => 'Coupon' ])


    <div class="user-layout">
       <div class="container">
           <div class="user-layout-wrapper">
               <div class="row">
                   <div class="col-lg-3">
                       @include("enduser.components.account.sidebar")
                   </div>
                   <div class="col-lg-9">
                       <div class="user-layout-main">
                           <h3 class="layout-title">Mã của tôi</h3>
{{--                           <div class="table-header-action d-flex justify-content-between">--}}
{{--                               <div class="action-item"></div>--}}
{{--                               <div class="action-item">--}}
{{--                                   <button class="btn primary">Thêm Coupon</button>--}}
{{--                               </div>--}}
{{--                           </div>--}}
                           <div class="user-layout-table">
                               @php
                                   $coupons = [];
                               @endphp
                               @if(count($coupons) > 0)
                               <table class="my-course-table">
                                   <thead>
                                   <tr>
                                       <td class="col-center">STT</td>
                                       <td class="col-center">Mã</td>
                                       <td class="course-content">Giảm</td>
                                       <td class="col-center nowrap">Ngày hết hạn</td>
                                       <td class="col-center nowrap">Trạng thái</td>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @foreach($coupons as $k => $coupon)
                                       @php
                                            if($coupon->type == 0){
                                                $val = $coupon->value . "%";
                                            }else{
                                                $val = number_format($coupon->value) . " VNĐ";
                                            }
                                            $current = \Carbon\Carbon::now();
                                       @endphp
                                   <tr>
                                       <td class="col-center">{{ $k + 1 }}</td>
                                       <td class="col-center nowrap">{{ $coupon->name }}</td>
                                       <td class="course-content"><span class="text-success">{{ $val }}</span></td>
                                       <td class="col-center nowrap">{{ $coupon->expire->format("d/m/Y") }}</td>
                                        <td>
                                            @if($coupon->expire < $current)
                                                <div class="tag-group d-flex flex-wrap justify-content-center">
                                                    <div class="tag-item unactive">Hết hạn</div>
                                                </div>
                                            @else
                                                <div class="tag-group d-flex flex-wrap justify-content-center">
                                                    <div class="tag-item active">Hoạt động</div>
                                                </div>
                                            @endif
                                        </td>
                                   </tr>
                                   @endforeach

                                   </tbody>
                               </table>
                                   @endif
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
