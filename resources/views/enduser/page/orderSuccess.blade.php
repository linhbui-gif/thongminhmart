@extends("enduser.layout")
@section('content')

<?php
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$stringDefaulr =  substr(str_shuffle($permitted_chars), 0, 10);
?>
<main class="main__checkout">
    <section class="checkout-complete">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7 col-12 offset-md-2">
                    <div class="checkout__detail-desktop">
                        <div class="checkout__detail-top">
                            <div class="list-img"><img src="{{$_config->url_picture}}" width="240px" alt=""></div>
                            <h1 class="title-complete">Đặt Hàng Thành Công</h1>
                        </div>
                        <div class="checkout__detail-bottom">
                            <p class="descrip-pay">Cảm ơn bạn đã đặt hàng tại <a class="descrip-pay__link" href="https://thongminhmart.com/">https://thongminhmart.com</a></p>
                            <p class="total-pay">Thông tin đơn hàng đã gửi về Email của bạn !!</p>
                            <div class="support-check">
                                <p class="info-cont">Để được hỗ trợ vui lòng gọi vào hotline<span class="number-phone">0912 997 500</span><span> hoặc Zalo</span><span class="number-phone">0932.86 85 85</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include("enduser.components.footer")
</main>
<style>

    .checkout__detail-desktop {
        margin: 20px 0;
        background: #fff;
        padding: 31px 60px 50px 60px;
        border-radius: 5px
    }

    .checkout__detail-desktop .checkout__detail-top {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        background: #fff;
        padding: 31.05px 21px 27px 21px
    }

    .checkout__detail-desktop .checkout__detail-top .title-complete {
        color: black;
        font-size: 22px;
        font-family: Inter, sans-serif;
        font-weight: 500;
        line-height: 26px;
        margin-top: 14px
    }

    .checkout__detail-desktop .checkout__detail-bottom .descrip-pay {
        font-size: 16px;
        font-family: Inter, sans-serif;
        font-weight: 500;
        line-height: 22px
    }

    .checkout__detail-desktop .checkout__detail-bottom .descrip-pay .descrip-pay__link {
        color: #555;
        cursor: pointer
    }

    .checkout__detail-desktop .checkout__detail-bottom .total-pay {
        line-height: 21px;
        font-size: 14px;
        margin-top: 17px
    }

    .checkout__detail-desktop .checkout__detail-bottom .total-pay span {
        color: #eb5757;
        font-size: 16px;
        font-family: Inter, sans-serif;
        font-weight: 500
    }

    .checkout__detail-desktop .checkout__detail-bottom .code-product {
        font-family: Inter, sans-serif;
        font-size: 14px;
        color: #4f4f4f;
        margin: 19px 0
    }

    .checkout__detail-desktop .checkout__detail-bottom .code-product span.code {
        font-weight: 500
    }

    .checkout__detail-desktop .checkout__detail-bottom .info-product {
        font-family: Inter, sans-serif;
        font-size: 14px;
        color: #4f4f4f;
        margin-bottom: 24px
    }

    .checkout__detail-desktop .checkout__detail-bottom .info-product a {
        margin-left: 4px;
        text-decoration: underline;
        color: #377dff
    }

    .checkout__detail-desktop .checkout__detail-bottom .support-check {
        padding-top: 37px;
        border-top: 1px solid #d1d1d1
    }

    .checkout__detail-desktop .checkout__detail-bottom .support-check .info-cont {
        font-size: 12px;
        font-style: normal;
        font-weight: 400
    }

    .checkout__detail-desktop .checkout__detail-bottom .support-check .number-phone {
        margin-left: 4px;
        color: #377dff;
        font-size: 14px;
        text-decoration: underline
    }
    @media (max-width: 767px) {
        .checkout__detail-desktop .checkout__detail-top .title-complete {
            font-size: 19px;
        }
    }
@endsection
