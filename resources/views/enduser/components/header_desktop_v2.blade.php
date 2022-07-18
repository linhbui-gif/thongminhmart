{{--<!-- Nav Bar Starts here -->--}}
{{--<div class="site-mobile-menu site-navbar-target">--}}
{{--    <div class="site-mobile-menu-header">--}}
{{--        <div class="site-mobile-menu-close mt-3">--}}
{{--            <span class="iconfont-close fa fa-times js-menu-toggle"></span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="site-mobile-menu-body"></div>--}}
{{--</div>--}}

{{--<header class="site-navbar js-sticky-header site-navbar-target">--}}
{{--    @php--}}
{{--        $locale = app()->getLocale();--}}
{{--        if($locale == "vi"){--}}
{{--            $main_menu = Menu::get(1);//lay menu tieng viet trong bang menu item--}}
{{--        }else{--}}
{{--            $main_menu = Menu::get(2); //lay menu tieng hàm trong bang menu item--}}
{{--        }--}}
{{--       //--}}
{{--    @endphp--}}
{{--    <div class="container">--}}
{{--        <div class="row align-items-center">--}}
{{--            <!-- Logo -->--}}
{{--            <div class="col-6 col-lg-2">--}}
{{--                <a href="/" class="company-logo">--}}
{{--                    <img src="{{ $_config->url_picture}}" alt="">--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <!-- Logo -->--}}
{{--            <div class="col-12 col-md-10 d-none d-lg-block">--}}
{{--                <nav class="site-navigation position-relative text-right">--}}
{{--                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">--}}
{{--                        @foreach($main_menu as $menu)--}}
{{--                            <li class="has-children"><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a>--}}
{{--                                @if( $menu['child'] )--}}
{{--                                    <ul class="dropdown">--}}
{{--                                        @foreach( $menu['child'] as $child )--}}
{{--                                            <li class=""><a href="{{ $child['link'] }}" title="">{{ $child['label'] }}</a></li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul><!-- /.sub-menu -->--}}
{{--                            @endif--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                            <li> <a href="{{ route('auth.changeLang', [ 'lang' => 'vi' ]) }}" class="smooth-scroll " style="padding:0;">--}}
{{--                                    <img src="{{asset('images/vi.png')}}" alt="">--}}
{{--                                </a></li>--}}
{{--                            <li> <a href="{{ route('auth.changeLang', [ 'lang' => 'ko' ]) }}" class="smooth-scroll"><img src="{{asset('images/en.png')}}" alt=""></a></li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
{{--            </div>--}}


{{--            <div class="col-6 d-inline-block d-lg-none ml-md-0 py-3" style="position: relative; top: 3px;">--}}

{{--                <a href="#" class="burger site-menu-toggle js-menu-toggle" data-toggle="collapse"--}}
{{--                   data-target="#main-navbar">--}}
{{--                    <span></span>--}}
{{--                </a>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}

{{--</header>--}}
{{--<!-- Nav Bar Ends here -->--}}
{{--<!-- /.topbar -->--}}
{{--@php--}}
{{--    $locale = app()->getLocale();--}}
{{--    if($locale == "vi"){--}}
{{--        $main_menu = Menu::get(1);//lay menu tieng viet trong bang menu item--}}
{{--    }else{--}}
{{--        $main_menu = Menu::get(2); //lay menu tieng hàm trong bang menu item--}}
{{--    }--}}
{{--   //--}}
{{--@endphp--}}
{{--<?php--}}
{{--$categoryProduct = \App\Product_category::where('status', 'active')->orderBy('order_no', 'asc')->get();--}}
{{--$widgetContactLeft = \App\Widget::where('location','contact_content_left')->first();--}}
{{--$widgetContactRight = \App\Widget::where('location','contact_content_right')->first();--}}
{{--?>--}}

{{--<style>--}}
{{--    #navigation>ul .vn:hover>a{--}}
{{--        background: unset;--}}
{{--    } #navigation>ul .en:hover>a{--}}
{{--        background: unset;--}}
{{--    }--}}
{{--</style>--}}
{{--@if(\Request::route()->getName() == "siteIndex")--}}
{{--    <div class="header-transparent">--}}
{{--        <div class="topbar-transparent">--}}
{{--            <!-- topbar transparent-->--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 d-none d-sm-none d-lg-block d-xl-block">--}}
{{--                        {!! $widgetContactLeft->content !!}--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">--}}
{{--                        <div class="header-block">--}}
{{--                            <span class="header-link d-none d-xl-block d-md-block"><a--}}
{{--                                    href="#">info@composite.com.vn</a></span>--}}
{{--                            <span class="header-link">{!! $widgetContactRight->content !!}</span>--}}
{{--                            <span class="header-link"> <button type="submit" class="" data-toggle="modal"--}}
{{--                                                               data-target="#searchModal"> <i--}}
{{--                                        class="fa fa-search text-white"></i></button></span>--}}
{{--                            <!-- <span class="header-link"><a href="#" class="btn btn-default btn-sm">Apply Now</a></span> -->--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /.topbar transparent-->--}}
{{--        <!-- header classic -->--}}

{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12"><a href="/" class="logo"><img--}}
{{--                           src="{{ $_config->url_picture}}" style="width: 62%"--}}
{{--                            alt="Visapress an Immigration and Visa Consulting Website Template"></a></div>--}}
{{--                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">--}}
{{--                    <div id="navigation-transparent" class="navigation-transparent">--}}
{{--                        <!-- navigation -->--}}
{{--                        <ul>--}}
{{--                            @foreach($main_menu as $menu)--}}
{{--                                <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a>--}}
{{--                                    @if(!empty($menu['class'] == "san-pham"))--}}
{{--                                        <ul>--}}
{{--                                            @foreach($categoryProduct as $v)--}}
{{--                                                <li>--}}
{{--                                                    <a href="{{ route("product.productListByCategory", ["slug_category" =>$v->slug])  }}"--}}
{{--                                                       title="">{{ $v->name }}</a></li>--}}
{{--                                            @endforeach--}}

{{--                                        </ul><!-- /.sub-menu -->--}}
{{--                                @endif--}}
{{--                                    @if($menu['child'])--}}
{{--                                       @foreach( $menu['child'] as $child )--}}
{{--                                            <ul>--}}
{{--                                        <li><a href="{{ $child['link' ] }}"--}}
{{--                                               title="">{{ $child['label'] }}</a></li>--}}
{{--                                            </ul>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </li>--}}
{{--                            @endforeach--}}

{{--                                <li class="vn" style="margin-top:17px"> <a href="{{ route('auth.changeLang', [ 'lang' => 'vi' ]) }}" class="smooth-scroll " style="padding:0;">--}}
{{--                                                                    <img src="{{asset('images/vi.png')}}" alt="">--}}
{{--                                                                </a></li>--}}
{{--                                                            <li class="en"> <a href="{{ route('auth.changeLang', [ 'lang' => 'ko' ]) }}" class="smooth-scroll"><img src="{{asset('images/en.png')}}" alt=""></a></li>--}}
{{--                                <li class="position-relative"><p>--}}
{{--                                        <a href="{{route('product.cart')}}">  <i class="fa fa-cart-arrow-down"></i></a>--}}
{{--                                    </p> <span class="total-cart" style="--}}
{{--                                 position: absolute;--}}
{{--    font-size: 9px;--}}
{{--    background: red;--}}
{{--    width: 12px;--}}
{{--    height: 12px;--}}
{{--    border-radius: 50%;--}}
{{--    text-align: center;--}}
{{--    display: flex;--}}
{{--    align-items: center;--}}
{{--    justify-content: center;--}}
{{--    color: white;--}}
{{--    top: 0;--}}
{{--    right: -9px;">{{ count((array) session('cart')) }}</span></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@else--}}
{{--    <div class="topbar">--}}
{{--        <!-- topbar -->--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 d-none d-sm-none d-lg-block d-xl-block">--}}
{{--                    {!! $widgetContactLeft->content !!}--}}
{{--                </div>--}}
{{--                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">--}}
{{--                    <div class="header-block">--}}
{{--                            <span class="header-link d-none d-xl-block d-md-block"><a--}}
{{--                                    href="#">info@composite.com.vn</a></span>--}}
{{--                        <span class="header-link">{!! $widgetContactRight->content !!}</span>--}}
{{--                        <span class="header-link"> <button type="submit" class="" data-toggle="modal"--}}
{{--                                                           data-target="#searchModal"> <i--}}
{{--                                    class="fa fa-search text-white"></i></button></span>--}}
{{--                        <!-- <span class="header-link"><a href="#" class="btn btn-default btn-sm">Apply Now</a></span> -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- /.topbar -->--}}
{{--    <div class="header-classic">--}}
{{--        <!-- header classic -->--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12"><a href="/" class=""><img width="146px"--}}
{{--                                                                                                   src="{{ $_config->favicon_url }}"--}}
{{--                                                                                                   alt="Logo"></a>--}}
{{--                </div>--}}
{{--                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">--}}
{{--                    <div id="navigation" class="navigation">--}}
{{--                        <!-- navigation -->--}}
{{--                        <ul>--}}
{{--                            @foreach($main_menu as $menu)--}}
{{--                                <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a>--}}
{{--                                    @if(!empty($menu['class'] == "san-pham"))--}}
{{--                                        <ul>--}}
{{--                                            @foreach($categoryProduct as $v)--}}
{{--                                                <li>--}}
{{--                                                    <a href="{{ route("product.productListByCategory", ["slug_category" =>$v->slug])  }}"--}}
{{--                                                       title="">{{ $v->name }}</a></li>--}}
{{--                                            @endforeach--}}

{{--                                        </ul><!-- /.sub-menu -->--}}
{{--                                    @endif--}}
{{--                                    @if($menu['child'])--}}
{{--                                        @foreach( $menu['child'] as $child )--}}
{{--                                            <ul>--}}
{{--                                                <li><a href="{{ $child['link' ] }}"--}}
{{--                                                       title="">{{ $child['label'] }}</a></li>--}}
{{--                                            </ul>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                                <li class="vn" style="margin-top:17px"> <a href="{{ route('auth.changeLang', [ 'lang' => 'vi' ]) }}" class="smooth-scroll " style="padding:0;">--}}
{{--                                        <img src="{{asset('images/vi.png')}}" alt="">--}}
{{--                                    </a></li>--}}
{{--                                <li class="en"> <a href="{{ route('auth.changeLang', [ 'lang' => 'ko' ]) }}" class="smooth-scroll"><img src="{{asset('images/en.png')}}" alt=""></a></li>--}}
{{--                                <li class="position-relative"><p>--}}
{{--                                        <a href="{{route('product.cart')}}">  <i class="fa fa-cart-arrow-down"></i></a>--}}
{{--                                    </p> <span class="total-cart" style="--}}
{{--                                 position: absolute;--}}
{{--    font-size: 9px;--}}
{{--    background: red;--}}
{{--    width: 12px;--}}
{{--    height: 12px;--}}
{{--    border-radius: 50%;--}}
{{--    text-align: center;--}}
{{--    display: flex;--}}
{{--    align-items: center;--}}
{{--    justify-content: center;--}}
{{--    color: white;--}}
{{--    top: 0;--}}
{{--    right: -9px;">{{ count((array) session('cart')) }}</span></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- /.header classic -->--}}
{{--@endif--}}
{{--<!-- /.header classic -->--}}


<header class="Header">
    <div class="container">
        <div class="Header-wrapper flex justify-between"><a class="Header-logo" href="/"><img src="{{ $_config->url_picture}}" alt=""></a>
            <div class="Header-info">
                <div class="Header-info-contact flex justify-end">
                    <div class="Header-info-contact-item flex items-center">
                        <div class="Header-info-contact-item-icon"> <img src="{{ asset('enduser/thongminhmart/assets/icons/icon-phone-yellow.svg') }}" alt=""></div>
                        <div class="Header-info-contact-item-title"><strong>Đặt hàng:</strong><a href="#">0979 188 002</a><span>|</span><a href="#">0988 599 559</a></div>
                    </div>
                    <div class="Header-info-contact-item flex items-center">
                        <div class="Header-info-contact-item-icon"> <img src="{{ asset('enduser/thongminhmart/assets/icons/icon-phone-yellow.svg') }}" alt=""></div>
                        <div class="Header-info-contact-item-title"><strong>Hotline:</strong><a href="#">1900 9999</a></div>
                    </div>
                </div>
                <div class="Header-info-actions flex justify-end">
                    <div class="Header-info-search flex items-center">
                        <div class="Header-info-search-control">
                            <input type="text" placeholder="Tìm kiếm">
                        </div>
                        <div class="Header-info-search-icon"> <img src="{{ asset('enduser/thongminhmart/assets/icons/icon-search.svg') }}" alt=""></div>
                    </div>
                    <div class="Header-info-cart flex items-center">
                        <div class="Header-info-cart-icon"> <img src="{{ asset('enduser/thongminhmart/assets/icons/icon-cart-gray.svg') }}" alt=""></div>
                        <div class="Header-info-cart-content"><span>Giỏ hàng</span><strong>0 đ</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<nav class="Navigation">
    <div class="container">
        <div class="Navigation-wrapper flex items-center justify-between">
            <div class="Navigation-wrapper-item">
                <div class="Navigation-carousel owl-carousel" id="Navigation-carousel">
                    <div class="item">
                        <div class="Navigation-carousel-item">Lorem Ipsum is simply dummy text of the printing</div>
                    </div>
                    <div class="item">
                        <div class="Navigation-carousel-item">Lorem Ipsum is simply dummy text of the printing</div>
                    </div>
                    <div class="item">
                        <div class="Navigation-carousel-item">Lorem Ipsum is simply dummy text of the printing</div>
                    </div>
                    <div class="item">
                        <div class="Navigation-carousel-item">Lorem Ipsum is simply dummy text of the printing</div>
                    </div>
                </div>
            </div>
            <div class="Navigation-wrapper-item">
                <div class="Navigation-list flex items-center"> <a class="Navigation-list-item" href="#">Giới thiệu</a><a class="Navigation-list-item" href="#">Chính sách</a><a class="Navigation-list-item" href="#">Kiến thức</a><a class="Navigation-list-item" href="#">Đối tác</a><a class="Navigation-list-item" href="#">Tuyển dụng</a><a class="Navigation-list-item" href="#">Liên hệ</a>
                </div>
            </div>
        </div>
    </div>
</nav>
