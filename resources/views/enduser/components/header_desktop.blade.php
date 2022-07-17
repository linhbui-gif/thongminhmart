<header class="Header">
    <div class="container">
        <div class="Header-wrapper flex justify-between"><a class="Header-logo" href="{{ route('siteIndex') }}"><img src="{{ asset('/assets/images/logo.svg') }}" alt=""></a>
            <div class="Header-info">
                <div class="Header-info-contact flex justify-end">
                    <div class="Header-info-contact-item flex items-center">
                        <div class="Header-info-contact-item-icon"> <img src="{{ asset('/assets/icons/icon-phone-yellow.svg') }}" alt=""></div>
                        <div class="Header-info-contact-item-title"><strong>Đặt hàng:</strong><a href="#">0979 188 002</a><span>|</span><a href="#">0988 599 559</a></div>
                    </div>
                    <div class="Header-info-contact-item flex items-center">
                        <div class="Header-info-contact-item-icon"> <img src="{{ asset('/assets/icons/icon-phone-yellow.svg') }}" alt=""></div>
                        <div class="Header-info-contact-item-title"><strong>Hotline:</strong><a href="#">1900 9999</a></div>
                    </div>
                </div>
                <div class="Header-info-actions flex justify-end">
                    <div class="Header-info-search flex items-center">
                        <div class="Header-info-search-control">
                            <input type="text" placeholder="Tìm kiếm">
                        </div>
                        <div class="Header-info-search-icon"> <img src="{{ asset('/assets/icons/icon-search.svg') }}" alt=""></div>
                    </div>
                    <div class="Header-info-cart flex items-center">
                        <div class="Header-info-cart-icon"> <img src="{{ asset('/assets/icons/icon-cart-gray.svg') }}" alt=""></div>
                        <div class="Header-info-cart-content"><span>Giỏ hàng</span><strong>0 đ</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>