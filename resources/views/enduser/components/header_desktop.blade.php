@php
    $locale = app()->getLocale();
    if($locale == "vi"){
        $main_menu = Menu::get(1);//lay menu tieng viet trong bang menu item
    }else{
        $main_menu = Menu::get(2); //lay menu tieng hàm trong bang menu item
    }
   //
@endphp
<header class="Header">
    <div class="container">
        <div class="Header-wrapper flex justify-between"><a class="Header-logo" href="/"><img
                    src="{{ $_config->url_picture}}" alt=""></a>
            <div class="Header-info">
                <div class="Header-info-contact flex justify-end">
                    <div class="Header-info-contact-item flex items-center">
                        <div class="Header-info-contact-item-icon"><img
                                src="{{ asset('enduser/thongminhmart/assets/icons/icon-phone-yellow.svg') }}" alt="">
                        </div>
                        <div class="Header-info-contact-item-title"><strong>Đặt hàng:</strong><a href="#">0979 188
                                002</a><span>|</span><a href="#">0988 599 559</a></div>
                    </div>
                    <div class="Header-info-contact-item flex items-center">
                        <div class="Header-info-contact-item-icon"><img
                                src="{{ asset('enduser/thongminhmart/assets/icons/icon-phone-yellow.svg') }}" alt="">
                        </div>
                        <div class="Header-info-contact-item-title"><strong>Hotline:</strong><a href="#">1900 9999</a>
                        </div>
                    </div>
                </div>
                <div class="Header-info-actions flex justify-end">
                    <div class="Header-info-search flex items-center">
                        <form class="Header-info-search-control" method="get" action="{{route('product.searchProduct')}}">
                            <input type="text" name="keyword" placeholder="Tìm kiếm">
                        </form>
                        <div class="Header-info-search-icon"><img
                                src="{{ asset('enduser/thongminhmart/assets/icons/icon-search.svg') }}" alt=""></div>
                    </div>
                    <div class="Header-info-cart flex items-center">
                        <div class="Header-info-cart-icon"><img
                                src="{{ asset('enduser/thongminhmart/assets/icons/icon-cart-gray.svg') }}" alt=""></div>
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
                <div class="marquee-container">
                    <div class="marquee flex items-center">
                        <div class="item">
                            <div class="marquee-item">1. Lorem Ipsum is simply dummy text of the printing</div>
                        </div>
                        <div class="item">
                            <div class="marquee-item">2. Lorem Ipsum is simply dummy text of the printing</div>
                        </div>
                        <div class="item">
                            <div class="marquee-item">3. Lorem Ipsum is simply dummy text of the printing</div>
                        </div>
                        <div class="item">
                            <div class="marquee-item">4. Lorem Ipsum is simply dummy text of the printing</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Navigation-wrapper-item">
                <div class="Navigation-list flex items-center">
                    @foreach($main_menu as $menu)
                        <a href="{{ $menu['link'] }}" class="Navigation-list-item">{{ $menu['label'] }}</a>
                        @if($menu['child'])
                            @foreach( $menu['child'] as $child )
                                <ul>
                                    <li><a href="{{ $child['link' ] }}"
                                           title="">{{ $child['label'] }}</a></li>
                                </ul>
                            @endforeach
                        @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="NavigationMobile">
    <div class="NavigationMobile-wrapper flex items-center justify-between">
        <a class="active trangchu NavigationMobile-wrapper-item" href="/">
            <span class="NavigationMobile-wrapper-item-icon">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path
                        class="fill" fill-rule="evenodd" clip-rule="evenodd"
                        d="M14.7832 4.46262L10.4744 0.900018C9.02296 -0.300006 6.97704 -0.300006 5.52562 0.900018L1.21678 4.46262C0.440472 5.10447 0 6.07764 0 7.09304V12.6487C0 14.4528 1.38732 16 3.2 16H4.8C5.68366 16 6.4 15.2837 6.4 14.4V11.7982C6.4 10.7842 7.16168 10.047 8 10.047C8.83832 10.047 9.6 10.7842 9.6 11.7982V14.4C9.6 15.2837 10.3163 16 11.2 16H12.8C14.6127 16 16 14.4528 16 12.6487V7.09304C16 6.07765 15.5595 5.10447 14.7832 4.46262Z"
                        fill="#929191"/></svg></span><span class="NavigationMobile-wrapper-item-title">Trang chủ</span></a><a
            class="danhmuc NavigationMobile-wrapper-item" href="/"><span class="NavigationMobile-wrapper-item-icon"><svg
                    width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path
                        class="fill stroke"
                        d="M6.54466 1.83712C6.8318 2.12426 6.99312 2.51371 6.99312 2.91978V6.47089C6.99312 6.60822 6.93857 6.73991 6.84146 6.83702C6.74436 6.93412 6.61266 6.98867 6.47534 6.98867H2.91978C2.51371 6.98867 2.12426 6.82736 1.83712 6.54022C1.54998 6.25308 1.38867 5.86364 1.38867 5.45756V2.91978C1.38867 2.51371 1.54998 2.12426 1.83712 1.83712C2.12426 1.54998 2.51371 1.38867 2.91978 1.38867H5.46201C5.86808 1.38867 6.25752 1.54998 6.54466 1.83712Z"
                        fill="#929191" stroke="#929191"/><path class="fill stroke"
                                                               d="M13.0757 1.38868L13.0768 1.38868C13.2782 1.38823 13.4776 1.42751 13.6638 1.50426C13.8499 1.58101 14.0191 1.69372 14.1617 1.83594C14.3042 1.97816 14.4173 2.1471 14.4944 2.33308L14.9563 2.14149L14.4944 2.33308C14.5716 2.51906 14.6113 2.71843 14.6113 2.91979V5.45756C14.6113 5.86364 14.45 6.25308 14.1628 6.54022C13.8757 6.82736 13.4863 6.98867 13.0802 6.98867H9.52462C9.38729 6.98867 9.25559 6.93412 9.15849 6.83702C9.06139 6.73992 9.00684 6.60822 9.00684 6.4709V2.91979C9.00684 2.51371 9.16815 2.12427 9.45529 1.83713C9.74243 1.54999 10.1319 1.38868 10.538 1.38868L13.0757 1.38868Z"
                                                               fill="#929191" stroke="#929191"/><path
                        class="fill stroke"
                        d="M6.99312 13.0797C6.99312 13.4858 6.8318 13.8752 6.54466 14.1623C6.25752 14.4495 5.86808 14.6108 5.46201 14.6108H2.91978C2.51371 14.6108 2.12426 14.4495 1.83712 14.1623L1.48357 14.5159L1.83712 14.1623C1.54998 13.8752 1.38867 13.4858 1.38867 13.0797V10.5375C1.38867 10.1314 1.54999 9.74194 1.83712 9.4548C2.12426 9.16766 2.51371 9.00635 2.91978 9.00635H6.47534C6.61266 9.00635 6.74436 9.0609 6.84146 9.158C6.93857 9.25511 6.99312 9.3868 6.99312 9.52413V13.0797Z"
                        fill="#929191" stroke="#929191"/><path class="fill stroke"
                                                               d="M13.0768 14.6108H13.0757H10.538C10.1319 14.6108 9.74243 14.4495 9.45529 14.1623C9.16815 13.8752 9.00684 13.4858 9.00684 13.0797V9.52413C9.00684 9.3868 9.06139 9.2551 9.15849 9.158C9.25559 9.0609 9.38729 9.00635 9.52462 9.00635H13.0802C13.4863 9.00635 13.8757 9.16766 14.1628 9.4548L14.5164 9.10125L14.1628 9.4548C14.45 9.74194 14.6113 10.1314 14.6113 10.5375V13.0797C14.6113 13.281 14.5716 13.4804 14.4944 13.6664L14.9563 13.858L14.4944 13.6664C14.4173 13.8524 14.3042 14.0213 14.1617 14.1635C14.0191 14.3057 13.8499 14.4185 13.6638 14.4952C13.4776 14.572 13.2782 14.6112 13.0768 14.6108Z"
                                                               fill="#929191" stroke="#929191"/></svg></span><span
                class="NavigationMobile-wrapper-item-title">Danh mục</span></a><a
            class="giohang NavigationMobile-wrapper-item" href="/thanh-toan"><span
                class="NavigationMobile-wrapper-item-icon"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"><path class="fill"
                                                                                                         d="M12.1183 11.896C11.0907 11.895 10.2569 12.7272 10.2559 13.7548C10.2548 14.7824 11.0871 15.6163 12.1147 15.6173C13.1423 15.6183 13.9761 14.786 13.9771 13.7584C13.9771 13.7578 13.9771 13.7573 13.9771 13.7567C13.9762 12.7301 13.1448 11.898 12.1183 11.896Z"
                                                                                                         fill="#929191"/><path
                        class="fill"
                        d="M15.4185 2.9863C15.374 2.97768 15.3288 2.9733 15.2834 2.97323H3.95454L3.77511 1.77287C3.66332 0.975689 2.98144 0.38257 2.17644 0.382324H0.717701C0.321318 0.382324 0 0.703643 0 1.10003C0 1.49641 0.321318 1.81773 0.717701 1.81773H2.17823C2.26948 1.81706 2.34672 1.88501 2.35765 1.97563L3.46291 9.55095C3.61444 10.5135 4.44242 11.2237 5.41685 11.2268H12.8827C13.8209 11.228 14.6302 10.5687 14.8187 9.64964L15.9868 3.82729C16.0621 3.43812 15.8077 3.06161 15.4185 2.9863Z"
                        fill="#929191"/><path class="fill"
                                              d="M7.56003 13.6771C7.51633 12.6797 6.69315 11.8945 5.69471 11.898C4.66796 11.9395 3.86923 12.8055 3.91073 13.8322C3.95054 14.8174 4.75196 15.6005 5.73778 15.6175H5.78264C6.80925 15.5725 7.60499 14.7038 7.56003 13.6771Z"
                                              fill="#929191"/></svg></span><span
                class="NavigationMobile-wrapper-item-title">Giỏ hàng</span></a><a
            class="tintuc NavigationMobile-wrapper-item" href="/kien-thuc"><span
                class="NavigationMobile-wrapper-item-icon"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"><path class="fill"
                                                                                                         d="M11.8872 8.30016C11.2025 7.61484 11.9803 6.65828 11.8975 6.43703C11.8975 6.43703 11.8953 6.43297 11.8872 6.42516C11.879 6.41703 11.875 6.41484 11.875 6.41484C11.654 6.33172 10.6975 7.11016 10.0122 6.42516C9.2709 5.68391 10.0403 4.83391 9.89497 4.35453C9.77528 3.95891 8.90184 2.73078 8.24309 1.87891C7.49434 1.90641 6.77965 2.06953 6.12278 2.34484C5.75684 5.28422 6.02997 5.80641 6.05497 5.84703C6.32122 6.27797 7.42184 5.96297 7.92997 6.78453C8.40934 7.56047 7.68997 8.40172 7.86278 8.57453C7.87059 8.58266 7.87465 8.58484 7.87497 8.58484C8.0959 8.66797 9.05247 7.88953 9.73778 8.57453C10.554 9.39109 10.0487 10.5011 9.83278 10.9752C9.52903 11.6436 7.76403 12.958 7.14309 13.4152L7.38715 13.9661C7.73809 14.0292 8.09965 14.0623 8.46872 14.0623C9.75934 14.0623 10.9578 13.6589 11.9443 12.9714C11.9147 12.9589 11.8853 12.9452 11.8559 12.9308C11.2122 12.612 10.8125 11.9677 10.8125 11.2498C10.8125 9.46203 13.0928 8.69359 14.175 10.1077C14.3528 9.63453 14.4737 9.13359 14.5284 8.61359C13.8297 8.67453 12.3784 8.79078 11.8872 8.30016Z"
                                                                                                         fill="#929191"/><path
                        class="fill"
                        d="M11.75 11.2501C11.75 11.8323 12.2744 12.2874 12.8813 12.1673L12.8816 12.167C13.1597 11.8751 13.4091 11.5554 13.625 11.2133C13.5783 9.99822 11.75 10.038 11.75 11.2501Z"
                        fill="#929191"/><path class="fill"
                                              d="M6.11781 10.6996C6.18844 11.0987 6.51062 11.9293 6.76062 12.5318C7.12381 12.261 8.79084 10.997 8.97969 10.5871C9.30906 9.86336 9.33469 9.49773 9.07469 9.23773C9.06656 9.22961 9.0625 9.22742 9.0625 9.22742C8.84147 9.14423 7.88513 9.9227 7.19969 9.23773C6.46706 8.50511 7.32119 7.58352 7.1325 7.27773C6.92634 6.94383 5.79397 7.20789 5.2575 6.34023C5.10844 6.09867 4.92219 5.58617 5.02719 3.92805C5.05187 3.53898 5.08687 3.17055 5.11844 2.88086C3.46687 3.9718 2.375 5.84523 2.375 7.96867C2.375 8.1018 2.37938 8.23367 2.38781 8.36461C2.70188 8.3243 3.1175 8.2768 3.5525 8.24461C5.27938 8.11648 5.7525 8.33961 5.98781 8.57461C6.72784 9.31464 6.02166 10.1544 6.11781 10.6996Z"
                                              fill="#929191"/><path class="fill"
                                                                    d="M5.33359 9.24748C5.28609 9.22217 4.94141 9.07467 3.53547 9.18623C3.15891 9.21623 2.79859 9.25748 2.51953 9.29311C2.91109 11.0537 4.06672 12.53 5.61922 13.3544L5.98016 13.0972C5.73828 12.5272 5.29609 11.4375 5.19422 10.8628C5.05956 10.1009 5.54406 9.47364 5.33359 9.24748Z"
                                                                    fill="#929191"/><path class="fill"
                                                                                          d="M9.47852 1.95898C9.99914 2.66461 10.647 3.60242 10.7926 4.08305C11.0311 4.8712 10.4627 5.55067 10.6754 5.76242C10.6835 5.77055 10.6876 5.77273 10.6876 5.77273C10.9086 5.85592 11.865 5.07745 12.5504 5.76242C13.2351 6.44761 12.4572 7.40417 12.5401 7.62555C12.5401 7.62555 12.5407 7.62648 12.5423 7.62836C12.8809 7.80477 14.1754 7.70583 14.5554 7.67055C14.4157 4.78836 12.2641 2.42523 9.47852 1.95898Z"
                                                                                          fill="#929191"/><path
                        class="fill"
                        d="M12.2194 0.938125C12.0322 1.18719 11.8934 1.47438 11.8172 1.78625C10.795 1.23375 9.64125 0.9375 8.46875 0.9375C4.59156 0.9375 1.4375 4.09156 1.4375 7.96875C1.4375 11.8803 4.59156 15.0625 8.46875 15.0625V16C4.04594 16 0.5 12.3528 0.5 7.96875C0.5 3.56469 4.06406 0 8.46875 0C9.78063 0 11.0719 0.327188 12.2194 0.938125Z"
                        fill="#929191"/><path class="fill"
                                              d="M14.0938 3.75C13.3183 3.75 12.6875 3.11916 12.6875 2.34375C12.6875 1.56834 13.3183 0.9375 14.0938 0.9375C14.8692 0.9375 15.5 1.56834 15.5 2.34375C15.5 3.11916 14.8692 3.75 14.0938 3.75Z"
                                              fill="#929191"/></svg></span><span
                class="NavigationMobile-wrapper-item-title">Tin tức</span></a><a
            class="thongtinkhac NavigationMobile-wrapper-item" href="/thong-tin-khac"><span
                class="NavigationMobile-wrapper-item-icon"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"><g
                        clip-path="url(#clip0_204_464)"><path class="fill"
                                                              d="M15.6836 15.0873C15.4863 14.9724 14.2853 14.2287 13.6428 12.884C15.1435 11.4808 15.9971 9.52867 15.9971 7.53085C15.9971 3.39616 12.3918 0.000976562 7.99853 0.000976562C3.60528 0.000976562 0 3.39616 0 7.53085C0 11.6655 3.60528 15.0607 7.99853 15.0607C8.58828 15.0607 9.22175 15.0054 10.0958 14.8218C12.3929 16.0424 14.4547 16.0081 15.2392 15.9958C15.5884 15.9914 15.8419 16.0545 15.9724 15.6937C16.0607 15.4517 15.9301 15.1722 15.6836 15.0873ZM8.93588 11.3114C8.93588 11.829 8.51622 12.2488 7.99853 12.2488C7.48084 12.2488 7.06119 11.829 7.06119 11.3114V7.53085C7.06119 7.01316 7.48084 6.59351 7.99853 6.59351C8.51622 6.59351 8.93588 7.01316 8.93588 7.53085V11.3114ZM7.99853 5.15629C7.48084 5.15629 7.06119 4.73657 7.06119 4.21895C7.06119 3.70126 7.48084 3.2816 7.99853 3.2816C8.51622 3.2816 8.93588 3.70126 8.93588 4.21895C8.93588 4.7366 8.51622 5.15629 7.99853 5.15629Z"
                                                              fill="#929191"/></g><defs><clipPath id="clip0_204_464"><rect
                                width="16" height="16" fill="white"/></clipPath></defs></svg></span><span
                class="NavigationMobile-wrapper-item-title">Thông tin khác</span></a>
    </div>
</div>

<?php
$categoryProducts = \Illuminate\Support\Facades\DB::table("product_categories")->select(['name', 'url_picture', 'slug'])->where('status', 'active')->orderBy('id', 'desc')->get();
?>
<div class="ProductCategoryDrawer">
    <div class="ProductCategoryDrawer-overlay"></div>
    <div class="ProductCategoryDrawer-main">
        @if(!empty($categoryProducts))
            @foreach($categoryProducts as $k => $data)
                <a class="ProductCategoryDrawer-main-item"
                   href="{{ route("product.productListByCategory", ["slug_category" => $data->slug])  }}">
            <span class="ProductCategoryDrawer-main-item-image">
                <img src="{{@$data->url_picture}}" alt="{{$data->name}}">
            </span>
                    <span class="ProductCategoryDrawer-main-item-title">{{$data->name}}</span>
                </a>
            @endforeach
        @endif
    </div>
</div>
