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
<main class="main__checkout">
    <section class="checkout-complete">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7 col-12 ofsset-md-2">
                    <div class="checkout__detail-desktop">
                        <div class="checkout__detail-top">
                            <div class="list-img"><img src="{{$_config->url_picture}}" width="240px" alt=""></div>
                            <h1 class="title-complete">Đặt Hàng Thành Công</h1>
                        </div>
                        <div class="checkout__detail-bottom">
                            <p class="descrip-pay">Cảm ơn bạn đã đặt hàng tại <a class="descrip-pay__link" href="https://thongminhmart.com/">https://thongminhmart.com</a></p>
                            <p class="total-pay">Thông tin đơn hàng đã gửi về Email của bạn !!</p>
                            <div class="support-check">
                                <p class="info-cont">Để được hỗ trợ vui lòng gọi vào hotline<span class="number-phone">0988.888.888</span><span> hoặc Zalo</span><span class="number-phone">0986.666.666</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
