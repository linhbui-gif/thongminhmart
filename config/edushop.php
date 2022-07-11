<?php
return [
    'end-user' => [
        'pathView' => 'enduser.page.'
    ],
    'order_status' => [
        0 => 'Chưa hoàn tất',
        4 => 'Hoàn tất',
        5 => 'Đã hủy'
    ],
    'payment_method' => [
        'cod' => 'COD ( thanh toán khi nhận được hàng )',
        'bank' => 'Chuyển khoản ngân hàng' ,
    ],
    'type_product' => [
        'course' => 'Khóa học',
        'product' => 'Học liệu, học cụ',
    ],
    'ghtk' => [
        'link' => 'https://services.ghtklab.com',
        'token' => '5d575ff68b54Ff104fC70Ec70c3076c1c7419BC2'
    ],
    'status_gthk' => [
       '-1' => 'Hủy đơn hàng',
        1 => 'Chưa tiếp nhận',
        2 => 'Đã tiếp nhận',
        3=>'Đã lấy hàng/Đã nhập kho',
        4=>'Đã điều phối giao hàng/Đang giao hàng',
        5 => 'Đã giao hàng/Chưa đối soát',
        6 => 'Đã đối soát',
        7 => 'Không lấy được hàng',
        8 => 'Hoãn lấy hàng',
        9 => 'Không giao được hàng',
        10 => 'Delay giao hàng',
        11 => 'Đã đối soát công nợ trả hàng',
        12 => 'Đã điều phối lấy hàng/Đang lấy hàng',
        13 => 'Đơn hàng bồi hoàn',
        20 => 'Đang trả hàng (COD cầm hàng đi trả)',
        21 => 'Đã trả hàng (COD đã trả xong hàng)',
        123 => 'Shipper báo đã lấy hàng',
        127 => 'Shipper (nhân viên lấy/giao hàng) báo không lấy được hàng',
        128 => 'Shipper báo delay lấy hàng',
        45 => 'Shipper báo đã giao hàng',
        49 => 'Shipper báo không giao được giao hàng',
        410 => 'Shipper báo delay giao hàng'
    ]
];
