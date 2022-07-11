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
                                        <td><b>Tổng thanh toán</b></td>
                                        <td><span class="text-success">{{ number_format($order->getTotalPrice()) }} VNĐ</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Trạng thái</b></td>
                                        <td>{!!  $order->getStatus() !!} <a  data-toggle="modal" data-target="#modalStatus" href="#">Cập nhật ?</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-uppercase">Thông tin khách</h4>
                                @php
                                    $user = $order->user;
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
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-uppercase">Thông tin nhận hàng</h4>
                                <table class="table">
                                    <tr>
                                        <th>Họ tên</th>
                                        <th>Phone</th>
                                        <th>Phưỡng/Xã</th>
                                        <th>Quận/Huyện</th>
                                        <th>Tỉnh/TP</th>
                                        <th>Địa chỉ</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->ward->_name }}</td>
                                        <td>{{ $order->district->_name }}</td>
                                        <td>{{ $order->province->_name }}</td>
                                        <td>{{ $order->address }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-uppercase">Danh sách sản phẩm</h4>
                                @php
                                    $details = $order->details;

                                @endphp
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td class="item-image">Hình ảnh</td>
                                        <td class="item-name">Tên sản phẩm </td>
                                        <td class="item-name">Loại sản phẩm </td>
                                        <td class="item-price">Giá</td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($details as $k => $detail)
                                        @php
                                            $type_name = \App\Helper\Common::showTypeProductName($detail->type);
                                            $product = $detail->getProduct()->first();
                                        @endphp
                                        <tr>
                                            <td><img style="max-width: 100px" src="{{ $product->getImage() }}" alt=""></td>
                                            <td>{{ $detail->product_name }}</td>
                                            <td>{!! $type_name !!}</td>
                                            <td>{{ number_format($detail->product_price) }} VNĐ</td>
                                        </tr>

                                    @endforeach


                                    <tr>
                                        <td colspan="3" class="item-image" style="padding: 20px 5px;">
                                            <h4>TỔNG</h4>
                                        </td>
                                        <td class="item-action">
                                            <h4><span class="text-success">{{ number_format($order->getTotalPrice()) }} VNĐ</span></h4>
                                        </td>
                                    </tr>
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
