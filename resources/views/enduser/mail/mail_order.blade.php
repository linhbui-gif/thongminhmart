<h2>Thông tin đơn hàng</h2>
<table>
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
        <td>{{ $order->address }}</td>
    </tr>
    <tr>
        <td>Phương thức thanh toán </td>
        <td>{{ $order->pay_method }}</td>
    </tr>
</table>
<h2>Chi tiết đơn hàng</h2>
@php
    $details = $order->details;
    $sum = 0;
@endphp
<table>
    <thead>
        <th>STT</th>
        <th>Tên</th>
        <th>Số lượng</th>
        <th>Giá</th>
        <th>Tổng</th>
    </thead>
    <tbody>
@foreach($details as $k => $detail)
        @php
            $total = $detail->product_price * $detail->quantity;
            $sum += $total;
        @endphp
        <tr>
            <td>{{ $k + 1 }}</td>
            <td>{{ $detail->product_name  }}</td>
            <td>{{ $detail->quantity  }}</td>
            <td>{{ number_format($detail->product_price)  }} vnđ</td>
            <td>{{ number_format($total) }}</td>
            <td><a href="#">Xem</a></td>
        </tr>
@endforeach
        <tr>
            <td colspan="4"><h4>Tổng tiền</h4></td>
            <td colspan="10"><h4>{{ number_format($sum) }} vnđ</h4></td>
        </tr>
    </tbody>
</table>
