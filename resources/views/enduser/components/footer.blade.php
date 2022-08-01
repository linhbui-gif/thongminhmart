@php
    $widgets = \App\Widget::where('location', 'LIKE' , 'footer%')->get();
    $locations = [];
    foreach($widgets as $k => $widget){
        $locations[$widget->location] = $widget;
    }
@endphp
<!-- Footer starts here -->
{{--<section id="footer-sec">--}}
{{--    <footer>--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                    <div class="footer-col">--}}
{{--                        <h5>{{$locations['footer_block_1']->name}}</h5>--}}
{{--                        <ul>--}}
{{--                            {!! $locations['footer_block_1']->content !!}--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                    <div class="footer-col">--}}
{{--                        <h5>{{$locations['footer_block_2']->name}}</h5>--}}
{{--                        <ul>--}}
{{--                            {!! $locations['footer_block_2']->content !!}--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                    <div class="footer-contact footer-col">--}}
{{--                        <h5 >{{$locations['footer_block_3']->name}}</h5>--}}
{{--                        {!! $locations['footer_block_3']->content !!}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                    <div class="footer-col">--}}
{{--                        <div class="footer-contact">--}}
{{--                            <h5>{{$locations['footer_block_4']->name}}</h5>--}}
{{--                            <ul>--}}
{{--                                {!! $locations['footer_block_4']->content !!}--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="container-fluid footer-copy">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6 col-md-6 col-sm-12">--}}
{{--                        <p>Copyright © 2021 Moric. All rights reserved.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </footer>--}}
{{--</section>--}}
<!-- Footer ends here -->
{{--<div class="footer-dark">--}}
{{--    <!-- Footer -->--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-3 col-6">--}}
{{--                <div class="widget-footer">--}}
{{--                    <h3 class="widget-title">{{$locations['footer_block_1']->name}}</h3>--}}
{{--                    <ul class="listnone arrow-footer">--}}
{{--                        {!! $locations['footer_block_1']->content !!}--}}
{{--                     </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-3 col-6">--}}
{{--                <div class="widget-footer">--}}
{{--                    <h3 class="widget-title">{{$locations['footer_block_2']->name}}</h3>--}}
{{--                    <ul class="listnone arrow-footer">--}}
{{--                        {!! $locations['footer_block_2']->content !!}--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-3 col-6">--}}
{{--                <div class="widget-footer">--}}
{{--                    <h3 class="widget-title">{{$locations['footer_block_3']->name}}</h3>--}}
{{--                    {!! $locations['footer_block_3']->content !!}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-2 col-6">--}}
{{--                <div class="widget-footer widget-social">--}}
{{--                    <h3 class="widget-title">Connect</h3>--}}
{{--                    <ul class="listnone">--}}
{{--                        <li><a href="#"><i class="fa fa-facebook social-icon"></i> Facebook</a></li>--}}
{{--                        <li><a href="#"><i class="fa fa-twitter social-icon"></i> Twitter</a></li>--}}
{{--                        <li><a href="#"><i class="fa fa-instagram social-icon"></i> Instagram</a></li>--}}
{{--                        <li><a href="#"><i class="fa fa-youtube social-icon"></i> Youtube</a></li>--}}
{{--                        <li><a href="#"><i class="fa fa-linkedin social-icon"></i> Linked In</a></li>--}}
{{--                    </ul>--}}
{{--                    <h3 class="widget-title">{{$locations['footer_block_4']->name}}</h3>--}}
{{--                    <ul class="listnone">--}}
{{--                        {!! $locations['footer_block_4']->content !!}--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- /.footer -->--}}
<footer class="Footer">
    <div class="container">
        <div class="Footer-wrapper">
            <div class="Footer-wrapper-item">
                <div class="Footer-services flex items-center justify-between">
                    <div class="Footer-services-item flex items-center">
                        <div class="Footer-services-item-icon"><img
                                src="{{ asset('enduser/thongminhmart/assets/icons/icon-shield.svg') }}" alt=""></div>
                        <div class="Footer-services-item-title">DỊCH VỤ UY TÍN</div>
                    </div>
                    <div class="Footer-services-item flex items-center">
                        <div class="Footer-services-item-icon"><img
                                src="{{ asset('enduser/thongminhmart/assets/icons/icon-refresh.svg') }}" alt=""></div>
                        <div class="Footer-services-item-title">ĐỔI TRẢ TRÒNG VÒNG 7 NGÀY</div>
                    </div>
                    <div class="Footer-services-item flex items-center">
                        <div class="Footer-services-item-icon"><img
                                src="{{ asset('enduser/thongminhmart/assets/icons/icon-delivery.svg') }}" alt=""></div>
                        <div class="Footer-services-item-title">GIAO HÀNG TOÀN QUỐC</div>
                    </div>
                </div>
            </div>
            <div class="Footer-wrapper-item flex justify-between">
                <div class="Footer-col">
                    <div class="Footer-col-title">Thông tin khác</div>
                    <div class="Footer-lists"><a class="Footer-lists-item" href="#">Giới thiệu Thông Minh Mart</a><a
                            class="Footer-lists-item" href="#">Chính sách bảo hành</a><a class="Footer-lists-item"
                                                                                         href="#">Chính sách vận
                            chuyển</a><a class="Footer-lists-item" href="#">Chính sách đổi hàng & hoàn tiền</a></div>
                </div>
                <div class="Footer-col">
                    <div class="Footer-col-title">Kết nối với chúng tôi</div>
                    <div class="Footer-socials flex flex-wrap"><a class="Footer-socials-item" href="#"
                                                                  target="_blank"><img
                                src="{{ asset('enduser/thongminhmart/assets/icons/icon-facebook.svg') }}" alt=""></a><a
                            class="Footer-socials-item" href="#" target="_blank"><img
                                src="{{ asset('enduser/thongminhmart/assets/icons/icon-youtube.svg') }}"
                                alt=""></a><a class="Footer-socials-item" href="#" target="_blank"><img
                                src="{{ asset('enduser/thongminhmart/assets/icons/icon-zalo.svg') }}"
                                alt=""></a><a class="Footer-socials-item" href="#" target="_blank"><img
                                src="{{ asset('enduser/thongminhmart/assets/icons/icon-tiktok.s') }}vg"
                                alt=""></a>
                        <div class="Footer-socials-item bct"><img
                                src="{{ $_config->url_picture}}" alt=""></div>
                    </div>
                </div>
                <div class="Footer-col flex">
                    <div class="Footer-col-item">
                        <div class="Footer-favicon"><img
                                src="{{ asset('enduser/thongminhmart/assets/images/favicon.png') }}" alt=""></div>
                    </div>
                    <div class="Footer-col-item">
                        <div class="Footer-col-title">CÔNG TY CỔ PHẦN TM&DV SMARTCHOISE</div>
                        <div class="Footer-lists">
                            <div class="Footer-lists-item">Địa chỉ: 130A25 - Nghĩa Tân - Cầu Giấy - Hà Nội</div>
                            <a class="Footer-lists-item" href="tel: 0932868585">Điện thoại: Zalo - 093 286 8585</a><a
                                class="Footer-lists-item" href="mailto: thongminhmart@gmail.com">Email:
                                thongminhmart@gmail.com</a><a class="Footer-lists-item" href="www.thongminhmart.vn">Website:
                                www.thongminhmart.vn</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
