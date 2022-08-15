

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
                        <form class="Header-info-search-control" method="get" action="{{route('product.searchProduct')}}">
                            <input type="text" name="keyword" placeholder="Tìm kiếm">
                        </form>
                        <div class="Header-info-search-icon"><img
                                src="{{ asset('enduser/thongminhmart/assets/icons/icon-search.svg') }}" alt=""></div>
                    </div>
                    <div class="Header-info-cart flex items-center">
                        <div class="Header-info-cart-icon"> <img src="{{ asset('enduser/thongminhmart/assets/icons/icon-cart-gray.svg') }}" alt=""></div>
                        <div class="Header-info-cart-content"><span><a style="color:black" href="{{route('product.checkout')}}">Giỏ hàng</a> </span>
                            <strong><a href="{{route('product.checkout')}}">
                                    @if(@session('cart')->totalPrice )
                                        {!! number_format(session('cart')->totalPrice) ?? "" !!}
                                    @else
                                        0
                                    @endif đ
                            </strong></div>
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
