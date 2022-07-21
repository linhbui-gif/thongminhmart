<table class="table table-hover">
    <thead>
    <tr>
        <th><input class="minimal" type="checkbox" id="check-all"></th>
        <th>Mã</th>
        <th>Khách hàng</th>
        <th>Phương thức</th>
        <th>Tổng</th>
        <th>Ship</th>
        <th>Coupon</th>
        <!-- <th>Thanh toán</th> -->
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
        <th>Ngày tạo</th>
        <th>Cập nhật</th>
        <th>#</th>
    </tr>
    </thead>
    <tbody>
    @if($items->count() > 0)
        @foreach($items as $k => $item)
            @php
                $id = $item->id;
                $user = $item->user;
                 $totalCheckout = $item->total;
                 if($item->coupon && is_object($item->coupon)){
                     if($item->coupon->type == 0){
                          $totalCheckout = $totalCheckout - $totalCheckout * $item->coupon->value / 100;
                     }else{
                         $totalCheckout = $totalCheckout - $item->coupon->value;
                     }
                 }
                 $totalCheckout = $totalCheckout + $item->ship;
            @endphp
            <tr>
                <td><input name="cid[]" value="{{ $id }}" class="minimal" type="checkbox"></td>
                <td><a href="{{ route('admin.order.detail', [ 'id' => $id ]) }}">#{{ $item->getId() }}</a></td>
                <td>@if($user) {{ $user->fullname() }}@endif</td>
{{--                <td>{{ $user->email }}</td>--}}
                <td>
                    @if($item->pay_method == "cod")
                        COD
                    @elseif($item->pay_method == "bank")
                        Chuyển khoản
                    @endif
                </td>
                <td><span>{{ number_format($item->total) }} VNĐ</span></td>
                <td><span>{{ number_format($item->ship) }} VNĐ</span></td>
                <td>
                    @if($item->coupon && is_object($item->coupon))
                            <span class="text-success">{{ $item->coupon_code }}</span>
                            @if($item->coupon->type == 0)
                                <p>-{{ $item->coupon->value }}%</p>
                            @else
                                 <p>-{{ number_format($item->coupon->value) }} VNĐ</p>
                            @endif
                    @else
                        <span>Không có</span>
                    @endif
                </td>
                <td><span class="text-success">{{ number_format($totalCheckout) }} VNĐ</span></td>
                <td>{!!  $item->getStatus() !!}</td>
                <td>{{ $item->created_at->format("h:i:s d/m/Y") }}</td>
                <td>{{ $item->updated_at->format("h:i:s d/m/Y") }}</td>
                <td>
                    <div class="el-button-group">
{{--                        <a href="{{ route('admin.'.$controllerName.'.edit', ['id' => $id] )  }}" class="el-button el-button--default el-button--mini"><span><i class="fa fa-pencil"></i></span></a>--}}
                        <a href="javascript:deleteAction('{{ route('admin.' . $controllerName . ".destroy", ['id' => $id])  }}')" class="el-button el-button--danger el-button--mini"><span><i class="fa fa-trash"></i></span></a>
                    </div>
                </td>
            </tr>
        @endforeach
    @else

    @endif
    </tbody>
</table>
