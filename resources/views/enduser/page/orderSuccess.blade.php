@extends("enduser.layout")
@section('content')
@section('css')
<style scoped>
    .success-order .icon {
        text-align: center;
    }

    .success-order .body {
        text-align: center;
    }

    .success-order .body .title {
        font-weight: bold;
        font-size: 18px;
    }

    .success-order .footer {
        text-align: center;
        font-weight: 500;
    }

    .success-order .footer .title {
        font-weight: 500;
        color: brown;
    }
</style>
@endsection
<?php
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$stringDefaulr =  substr(str_shuffle($permitted_chars), 0, 10);
?>
<!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area Start <<<<<<<<<<<<<<<<<<<< -->
<div class="Breadcrumb">
    <div class="container">
        <div class="Breadcrumb-wrapper">
            <div class="Breadcrumb-list flex flex-wrap"><a class="Breadcrumb-list-item" href="{{ route('siteIndex') }}">Trang chủ</a>
                <div class="Breadcrumb-list-item arrow">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L7 7L1 13" stroke="#777777" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>
                <!-- <a class="Breadcrumb-list-item" href="danh-sach-san-pham.html">Danh sách sản phẩm</a>
                <div class="Breadcrumb-list-item arrow">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L7 7L1 13" stroke="#777777" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div><a class="Breadcrumb-list-item" href="chi-tiet-san-pham.html">Chi tiết</a> -->
            </div>
        </div>
    </div>
</div>
<!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area End <<<<<<<<<<<<<<<<<<<< -->
<div class="cart_area section_padding_20 clearfix">
    <div class="container">
        <div class="success-order">
            <div class="icon">
                <svg width="152" height="132" viewBox="0 0 152 132" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M126.995 27.553C131.339 27.9754 140.427 26.5755 142.02 17.597C143.613 8.6184 147.873 6.1324 149.804 6.01172" stroke="#F3603F" stroke-width="3" stroke-linecap="round" />
                    <circle cx="88.4153" cy="64.1746" r="43.4363" fill="#2F80ED" />
                    <g filter="url(#filter0_d)">
                        <circle cx="88.4154" cy="64.1746" r="36.9793" stroke="white" stroke-opacity="0.7" stroke-width="2" />
                    </g>
                    <path d="M107.718 54.672C107.718 55.8547 107.254 56.9966 106.41 57.8123L86.7906 76.8175C85.9046 77.6332 84.7232 78.1226 83.4996 78.1226C82.2761 78.1226 81.0947 77.6332 80.2509 76.8175L70.4202 67.3149C69.5764 66.4992 69.1123 65.3573 69.1123 64.1746C69.1123 62.9918 69.6186 61.8907 70.4624 61.0342C71.3485 60.2186 72.4876 59.7699 73.7112 59.7291C74.9347 59.7291 76.0739 60.1778 76.9599 60.9934L83.4996 67.3149L99.87 51.4909C100.756 50.6752 101.895 50.2266 103.119 50.2266C104.342 50.2673 105.481 50.716 106.367 51.5724C107.211 52.3881 107.718 53.4893 107.718 54.672Z" fill="white" />
                    <path d="M120.937 107.609C124.992 108.781 132.832 113.232 131.75 121.666" stroke="#F7B23B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M2 95.7073C8.22259 98.0508 21.6376 99.7318 25.5166 87.7068M25.5166 87.7068C26.0824 84.3935 25.5167 77.8395 18.7284 78.1305C17.4354 81.3226 16.9827 87.7068 25.5166 87.7068ZM25.5166 87.7068C28.3451 88.2321 34.9233 87.731 38.6084 81.5246" stroke="#6E89FA" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="100.747" cy="127.835" r="4.16347" fill="#637BFE" />
                    <circle cx="140.107" cy="61.9057" r="3.66347" stroke="#C05EFD" />
                    <circle cx="74.0164" cy="4.55935" r="4.55935" fill="#53B175" />
                    <circle cx="86.9615" cy="12.2555" r="2.40784" fill="#F3603F" />
                    <circle cx="33.8916" cy="47.6181" r="3.7197" stroke="#F7B23B" />
                    <circle cx="43.5837" cy="114.152" r="4.13989" stroke="#53B175" />
                    <circle r="2.21665" transform="matrix(-1 0 0 1 87.8019 123.06)" fill="#53B175" />
                    <defs>
                        <filter id="filter0_d" x="46.436" y="25.1953" width="83.9586" height="83.9586" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                            <feOffset dy="3" />
                            <feGaussianBlur stdDeviation="2" />
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.12 0" />
                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
                        </filter>
                    </defs>
                </svg>
            </div>
            <div class="body">
                <p class="title">Chúc mừng bạn đã đặt hàng thành công</p>
                <p class="note">Mã giao dịch: <span>{{$stringDefaulr}}</span></p>
            </div>

            <div class="footer">
                <p class="title">Chúng tôi sẽ liên hệ với bạn ngay sau khi nhận được đơn hàng</p>
                <p class="title">Mọi thắc mắc xin vui lòng liên hệ hotline: 0347576999</p>
                <div class="footer-btn" style="padding: 40px;">

                    <a href="{{ route('siteIndex') }}"><button type="button" class="btn btn-secondary">Trở về trang chủ</button></a>
                    <a href="{{ route('siteIndex') }}"><button type="button" class="btn btn-warning">Mua thêm sản phẩm</button></a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection