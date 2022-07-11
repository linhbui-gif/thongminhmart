

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
                                    $user = $order->user;
                                    $config = config("edushop.status_gthk");
                                @endphp
                                <table class="table">
                                    <tr>
                                        <td><b>Họ tên</b></td>
                                        <td>{{ $user->fullname() }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone</b></td>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b></td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Sinh nhật</b></td>
                                        <td>{{ $user->birthday }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @php
                            $address = $order->address;
                            $arrKho = [];
                            $suborders = $order->suborder;
                            $order_course = $order->details()->where('order_detail.type', 'course' )->where('order_detail.compo_id', null)->where('order_detail.kho_id', null)->get();

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
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12">--}}

{{--                                @if(count($order_course) > 0)--}}
{{--                                    <h4 class="text-uppercase">Danh sách đơn hàng không vận chuyển</h4>--}}
{{--                                    <table class="table table-bordered">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <td class="item-image">Hình ảnh</td>--}}
{{--                                            <td class="item-name">Tên khóa học </td>--}}
{{--                                            <td class="item-price">Giá</td>--}}
{{--                                            <td class="item-name">Số lượng </td>--}}
{{--                                            <td class="item-name">Tổng</td>--}}
{{--                                            <td>Trạng thái</td>--}}
{{--                                            <td></td>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                            @php--}}
{{--                                                $total_course = 0;--}}
{{--                                            @endphp--}}
{{--                                            @foreach($order_course as $k => $detail)--}}
{{--                                                @php--}}
{{--                                                    $type_name = \App\Helper\Common::showTypeProductName($detail->type);--}}
{{--                                                    $product = $detail->getProduct()->first();--}}
{{--                                                    $t = $detail->quantity * $detail->product_price;--}}
{{--                                                    $total_course += $t;--}}
{{--                                                    $compo = \App\Compo::find($detail->compo_id);--}}
{{--                                                    $warehouse = \App\Warehouse::find($detail->kho_id);--}}
{{--                                                    $piot = DB::table('users_course')->where('user_id',$user->id)->where('course_id', $detail->product_id)->first();--}}
{{--                                                @endphp--}}
{{--                                                <tr>--}}
{{--                                                    <td><img style="max-width: 100px" src="{{ $product->url_picture }}" alt=""></td>--}}
{{--                                                    <td>--}}
{{--                                                        <p>{{ $detail->product_name }}</p>--}}

{{--                                                    </td>--}}
{{--                                                    <td>{{ number_format($detail->product_price) }} VNĐ</td>--}}
{{--                                                    <td>{{ $detail->quantity }}</td>--}}
{{--                                                    <td>{{ number_format($t)  }} VNĐ</td>--}}
{{--                                                    <td>--}}
{{--                                                        @if($piot)--}}
{{--                                                            <span class="label label-success">Đã kích hoạt</span>--}}
{{--                                                        @else--}}
{{--                                                            <span class="label label-danger">Chưa kích hoạt</span>--}}
{{--                                                        @endif--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}

{{--                                                        @if($piot)--}}
{{--                                                            <a onclick="activeCourse('{{ route('admin.order.status_course', [ 'order_detail' => $detail->id ] ) }}?action=inactive')" href="javascript:void(0)" class="btn btn-danger btn-sm">Hủy kích hoạt khóa học</a>--}}
{{--                                                        @else--}}
{{--                                                            <a onclick="activeCourse('{{ route('admin.order.status_course', [ 'order_detail' => $detail->id ] ) }}?action=active')" href="javascript:void(0)" class="btn btn-success btn-sm">Kích hoạt khóa học</a>--}}
{{--                                                        @endif--}}

{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                            <tr>--}}
{{--                                                <td colspan="6" class="item-image">--}}
{{--                                                    <span>Tổng</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <span>{{ number_format($total_course) }} VNĐ</span>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}


{{--                                @endif--}}

{{--                                @if(count($suborders) > 0)--}}
{{--                                    <h4 class="text-uppercase">Danh sách đơn hàng có vận chuyển</h4>--}}
{{--                                    @foreach($suborders as $k => $suborder)--}}
{{--                                        @php--}}
{{--                                            $khoObj = \App\Warehouse::find($suborder->warehouse_id);--}}
{{--                                            $details = $suborder->details;--}}
{{--                                            $subtotal = 0;--}}
{{--                                        @endphp--}}
{{--                                        <p class="text-uppercase text-bold">Kho: {{ $khoObj->name }}</p>--}}
{{--                                        <p>Người đại diện: {{ $khoObj->contact_name }}</p>--}}
{{--                                        <p>Địa chỉ: {{ $khoObj->address }}</p>--}}
{{--                                        <p>Số điện thoại: {{ $khoObj->phone }}</p>--}}
{{--                                        <table class="table table-bordered">--}}
{{--                                            <thead>--}}
{{--                                            <tr>--}}
{{--                                                <td class="item-image">Hình ảnh</td>--}}
{{--                                                <td class="item-name">Tên sản phẩm </td>--}}
{{--                                                <td class="item-name">Loại sản phẩm </td>--}}
{{--                                                <td class="item-price">Giá</td>--}}
{{--                                                <td class="item-name">Số lượng </td>--}}
{{--                                                <td class="item-name">Tổng</td>--}}
{{--                                                <td class="item-name">Trạng thái</td>--}}
{{--                                                <td></td>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}

{{--                                            @foreach($details as $k => $detail)--}}
{{--                                                @php--}}
{{--                                                    $type_name = \App\Helper\Common::showTypeProductName($detail->type);--}}
{{--                                                    $product = $detail->getProduct()->first();--}}
{{--                                                    $subtotal += $detail->product_price;--}}
{{--                                                    $t = $detail->quantity * $detail->product_price;--}}
{{--                                                @endphp--}}
{{--                                                <tr>--}}
{{--                                                    <td><img style="max-width: 100px" src="{{ $product->url_picture }}" alt=""></td>--}}
{{--                                                    <td>--}}
{{--                                                        {{ $detail->product_name }}--}}
{{--                                                        @if($detail->type == "course")--}}
{{--                                                            @php--}}
{{--                                                                $compo = \App\Compo::find($detail->compo_id);--}}
{{--                                                            @endphp--}}
{{--                                                            @if($compo)--}}
{{--                                                                <p>Compo: {{ $compo->name }}</p>--}}
{{--                                                            @endif--}}
{{--                                                        @endif--}}
{{--                                                    </td>--}}
{{--                                                    <td><span class="label label-info">{!! \App\Helper\Common::showTypeProductName($detail->type) !!}</span></td>--}}
{{--                                                    <td>{{ number_format($detail->product_price) }} VNĐ</td>--}}
{{--                                                    <td>{{ $detail->quantity }}</td>--}}
{{--                                                    <td>{{ number_format($t)  }} VNĐ</td>--}}
{{--                                                    @if($detail->type == "course")--}}
{{--                                                        @php--}}
{{--                                                            $piot = DB::table('users_course')->where('user_id',$user->id)->where('course_id', $detail->product_id)->first();--}}
{{--                                                        @endphp--}}
{{--                                                        <td>--}}
{{--                                                            @if($piot)--}}
{{--                                                                <span class="label label-success">Đã kích hoạt</span>--}}
{{--                                                            @else--}}
{{--                                                                <span class="label label-danger">Chưa kích hoạt</span>--}}
{{--                                                            @endif--}}
{{--                                                        </td>--}}
{{--                                                        <td>--}}
{{--                                                            @if($piot)--}}
{{--                                                                <a onclick="activeCourse('{{ route('admin.order.status_course', [ 'order_detail' => $detail->id ] ) }}?action=inactive')" href="javascript:void(0)" class="btn btn-danger btn-sm">Hủy kích hoạt khóa học</a>--}}
{{--                                                            @else--}}
{{--                                                                <a onclick="activeCourse('{{ route('admin.order.status_course', [ 'order_detail' => $detail->id ] ) }}?action=active')" href="javascript:void(0)" class="btn btn-success btn-sm">Kích hoạt khóa học</a>--}}
{{--                                                            @endif--}}
{{--                                                        </td>--}}
{{--                                                    @endif--}}
{{--                                                </tr>--}}

{{--                                            @endforeach--}}
{{--                                            <tr>--}}
{{--                                                <td colspan="6" class="item-image">--}}
{{--                                                    <span>Ship</span>--}}
{{--                                                </td>--}}
{{--                                                <td colspan="2">--}}
{{--                                                    <span>{{ number_format($suborder->ship) }} VNĐ</span>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td colspan="6" class="item-image">--}}
{{--                                                    <span>Tạm tính</span>--}}
{{--                                                </td>--}}
{{--                                                <td colspan="2">--}}
{{--                                                    <span>{{ number_format($subtotal) }} VNĐ</span>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td colspan="6" class="item-image">--}}
{{--                                                    <span>Tổng ( tổng đơn hàng + ship )</span>--}}
{{--                                                </td>--}}
{{--                                                <td colspan="2">--}}
{{--                                                    <span>{{ number_format($subtotal + $suborder->ship) }} VNĐ</span>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td colspan="6" class="item-image">--}}
{{--                                                    <span>Trạng thái <i class="fa fa-truck"></i></span>--}}
{{--                                                    @if(!$suborder->mavandon)--}}
{{--                                                        <a onclick="postGHTK('{{ route('admin.order.postGHTK', [ 'order_id' => $order->id, 'warehouse_id' => $suborder->warehouse_id  ]) }}')" href="javascript:void(0)">Chuyển đơn hàng sang GHTK</a>--}}
{{--                                                    @endif--}}
{{--                                                </td>--}}
{{--                                                @php--}}

{{--                                                    $res =\App\Helper\Common::getStatusOrder($suborder->mavandon);--}}


{{--                                                @endphp--}}
{{--                                                <td colspan="2">--}}
{{--                                                    @if(isset($res['success']) && $res['success'] == false)--}}
{{--                                                        <span class="label label-danger">Chưa gửi GHTK</span>--}}
{{--                                                    @else--}}
{{--                                                        @php--}}
{{--                                                            $order_status = $res['order']['status'];--}}
{{--                                                            $config_status = config("edushop.status_gthk");--}}
{{--                                                        @endphp--}}
{{--                                                        @if(in_array($order_status, [ 5, 6]))--}}
{{--                                                            <span class="label label-success">{{  $config_status[$order_status] }}</span>--}}
{{--                                                        @else--}}
{{--                                                            <span class="label label-warning">{{  $config_status[$order_status] }}</span>--}}
{{--                                                        @endif--}}
{{--                                                    @endif--}}

{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}

{{--                                    @endforeach--}}
{{--                                @endif--}}

{{--                            </div>--}}
{{--                        </div>--}}
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
