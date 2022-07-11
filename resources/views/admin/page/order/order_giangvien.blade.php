

@extends("admin.layout")


@section('content-header')
    <section class="content-header">
        <h1>
            Đơn hàng
        </h1>
    </section>
@stop

@php

@endphp

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    @include("admin.template.error")
                    @include("admin.template.notify")
                    <div class="s-table">
                        @if(count($items) > 0)
                            <h4 class="text-uppercase">Danh sách đơn hàng</h4>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td class="item-image">Hình ảnh</td>
                                    <td class="item-name">Tên sản phẩm </td>
                                    <td class="item-name">Học viên</td>
                                    <td class="item-price">Giá</td>
                                    <td class="item-name">Số lượng </td>
                                    <td class="item-name">Tổng</td>
                                    <td class="item-name">Ngày tạo</td>
                                    <td class="item-name">Trạng thái Khóa học</td>
{{--                                    <td></td>--}}
                                </tr>
                                </thead>
                                <tbody>
                            @foreach($items as $k => $detail)
                                @php
                                    $type_name = \App\Helper\Common::showTypeProductName($detail->type);
                                    $product = $detail->getProduct()->first();
                                    $t = $detail->quantity * $detail->product_price;
                                    $order = $detail->order;
                                    $user = $order->user ?? null;

                                @endphp
                                <tr>
                                    <td><img style="max-width: 100px" src="{{ $product->url_picture }}" alt=""></td>
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
                                    <td>{{ $user != null ? $user->fullName() : "Chưa rõ" }}</td>
                                    <td>{{ number_format($detail->product_price) }} VNĐ</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ number_format($t)  }} VNĐ</td>
                                    <td>{{ $detail->created_at->format('d/m/Y h:i:s') }}</td>
                                    @if($detail->type == "course")
                                        @php
                                            $piot = null;
                                            if(!empty($user) && $user->id){
                                                $piot = DB::table('users_course')->where('user_id',$user->id)->where('course_id', $detail->product_id)->first();
                                            }

                                        @endphp
                                        <td>
                                            @if($piot)
                                                <span class="label label-success">Đã kích hoạt</span>
                                            @else
                                                <span class="label label-danger">Chưa kích hoạt</span>
                                            @endif
                                        </td>
{{--                                        <td>--}}
{{--                                            @if($piot)--}}
{{--                                                <a onclick="activeCourse('{{ route('admin.order.status_course', [ 'order_detail' => $detail->id ] ) }}?action=inactive')" href="javascript:void(0)" class="btn btn-danger btn-sm">Hủy kích hoạt khóa học</a>--}}
{{--                                            @else--}}
{{--                                                <a onclick="activeCourse('{{ route('admin.order.status_course', [ 'order_detail' => $detail->id ] ) }}?action=active')" href="javascript:void(0)" class="btn btn-success btn-sm">Kích hoạt khóa học</a>--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
                                    @endif
                                </tr>
                            @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>
                    @include("admin.template.pagination", [ 'paginator' => $items ])
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

@stop
