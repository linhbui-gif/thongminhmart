@extends("enduser.layout")

@section('content')
    <?php

    $widgetAbout = \App\Widget::where('location','content_about_mb')->first();
    $widgetChinhsahc= \App\Widget::where('location','content_chinhsach_mb')->first();
    $widgetLienhe= \App\Widget::where('location','content_contact_mobile')->first();
    ?>
    <div class="AnotherInfoPage">
    <div class="container">
        <div class="AnotherInfoPage-wrapper">
            <div class="Collapse">
                <div class="Collapse-item">
                    <div class="Collapse-item-header flex items-center justify-between">
                        <div class="Collapse-item-header-title">Về chúng tôi</div>
                        <div class="Collapse-item-header-arrow"><svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 1L7 7L1 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round"></path></svg></div>
                    </div>
                    <div class="Collapse-item-body style-content">
                        {!! @$widgetAbout->content !!}                    </div>
                </div>
                <div class="Collapse-item">
                    <div class="Collapse-item-header flex items-center justify-between">
                        <div class="Collapse-item-header-title">Điều khoản chính sách</div>
                        <div class="Collapse-item-header-arrow"><svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 1L7 7L1 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round"></path></svg></div>
                    </div>
                    <div class="Collapse-item-body style-content">
                        {!! @$widgetChinhsahc->content !!}
                    </div>
                </div>
                <div class="Collapse-item">
                    <div class="Collapse-item-header flex items-center justify-between">
                        <div class="Collapse-item-header-title">Thông tin liên hệ</div>
                        <div class="Collapse-item-header-arrow"><svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 1L7 7L1 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round"></path></svg></div>
                    </div>
                    <div class="Collapse-item-body style-content">
                        {!! @$widgetLienhe->content !!}
                    </div>
                </div>
                <div class="Collapse-item">
                    <div class="Collapse-item-header flex items-center justify-between">
                        <div class="Collapse-item-header-title">Kết nối với chúng tôi</div>
                        <div class="Collapse-item-header-arrow"><svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 1L7 7L1 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round"></path></svg></div>
                    </div>
                    <div class="Collapse-item-body style-content">
                        <div class="AnotherInfoPage-socials flex flex-wrap justify-center"><a class="AnotherInfoPage-socials-item" href="#" target="_blank"><img src="./assets/icons/icon-facebook.svg" alt=""></a><a class="AnotherInfoPage-socials-item" href="#" target="_blank"><img src="./assets/icons/icon-youtube.svg" alt=""></a><a class="AnotherInfoPage-socials-item" href="#" target="_blank"><img src="./assets/icons/icon-zalo.svg" alt=""></a><a class="AnotherInfoPage-socials-item" href="#" target="_blank"><img src="./assets/icons/icon-tiktok.svg" alt=""></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
