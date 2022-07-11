<header class="header-mobile">
    <div class="container">
        <div class="header-mobile-wrapper d-flex align-items-center justify-content-between">
            <div class="header-logo"><a href="/"><img src="{{ asset('enduser/assets/images/logo-mobile.png') }}"
                        alt=""></a></div>
            <div class="header-action d-flex align-items-center">
                <div class="header-btn tooltip-wrapper">
                    <a href="{{ route('order.cart') }}">
                        <div class="tooltip-content bottom-center">Giỏ hàng</div>
                        <div class="circle-notification">{{ \Cart::getContent()->count() }}</div><img
                            src="{{ asset('enduser/assets/icons/icon-shopping-cart-white.svg') }}" alt="">
                    </a>
                </div>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <div class="header-logout header-btn tooltip-wrapper" style="margin-left: 10px; margin-right: 0px">
                        <div class="tooltip-content bottom-center">Đăng xuất</div>
                        <a href="{{route('user.logout')}}">
                            <img src="{{asset('enduser/assets/icons/icon-logout-white.svg')}}" alt="">
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>

<div class="menu-mobile-component">
    <div class="menu-mobile-wrapper"><img class="menu-close " src="{{ asset('enduser/assets/icons/icon-close.svg') }}"
            alt="menu-close">
        <form class="menu-search d-flex" action="{{ route('course.searchResult') }}">
            <input name="search" type="text" placeholder="Bạn cần tìm gì ?">
            <button class="d-flex align-items-center justify-content-center" type="submit"><img
                    src="{{ asset('enduser/assets/icons/icon-search-white.svg') }}" alt="menu"></button>
        </form>
        <div class="line"></div>
        <h3 class="menu-title">Liên kết</h3>
        <div class="menu-category-wrapper">
            <div class="category-item d-flex align-items-center flex-wrap justify-content-between"><a
                    class="category-title" href="/">Trang chủ</a>
            </div>
            <div class="category-item d-flex align-items-center flex-wrap justify-content-between"><a
                    class="category-title" href="{{ route('course.courseList') }}">Khoá học</a>
            </div>
            <div class="category-item d-flex align-items-center flex-wrap justify-content-between"><a
                    class="category-title" href="{{ route('product.productList') }}">Cửa hàng</a>
            </div>
            <div class="category-item d-flex align-items-center flex-wrap justify-content-between"><a
                    class="category-title" href="{{ route('page.review') }}">Đánh giá</a>
            </div>
            <div class="category-item d-flex align-items-center flex-wrap justify-content-between"><a
                    class="category-title" href="{{ route('page.tutorial') }}">Hướng dẫn</a>
            </div>
        </div>
        <h3 class="menu-title">Danh mục</h3>
        <div class="menu-category-wrapper">
            @php
                $category = \App\Course_category::where('status', 'active')->get();
            @endphp
            @foreach ($category as $key => $cat)
                <div class="category-item d-flex align-items-center flex-wrap justify-content-between"><a
                        class="category-title"
                        href="{{ route('course.courseListInCategory', ['slug_category' => $cat->slug]) }}">{{ $cat->name }}</a>
                </div>
            @endforeach

        </div>
    </div>
</div>
