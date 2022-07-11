<div class="menu-mobile-component">
    <div class="menu-mobile-wrapper"><img class="menu-close" data-src="" alt="">
        <form class="menu-search d-flex" action="#">
            <input type="text" placeholder="Bạn cần tìm gì ?">
            <button class="d-flex align-items-center justify-content-center" type="submit"><img
                    src="{{ asset('enduser/assets/icons/icon-search-white.svg') }}" alt=""></button>
        </form>
        <div class="line"></div>
        <h3 class="menu-title">Liên kết</h3>
        <div class="menu-category-wrapper">
            <div class="category-item d-flex align-items-center flex-wrap justify-content-between"><a
                    class="category-title" href="/">Trang chủ</a>
            </div>
            <div class="category-item d-flex align-items-center flex-wrap justify-content-between"><a
                    class="category-title" href="{{ route('product.productList') }}">Khoá học</a>
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
            <div class="category-item d-flex align-items-center flex-wrap justify-content-between"><a
                    class="category-title" href="{{ route('SiteTeacher') }}">Trở thành giảng viên</a>
            </div>
        </div>
        <h3 class="menu-title">Danh mục</h3>
        @php
            $category = \App\Course_category::where('status', 'active')->get();
        @endphp
        <div class="menu-category-wrapper">
            @foreach ($category as $key => $cat)
                <div class="category-item d-flex align-items-center flex-wrap justify-content-between"><a
                        class="category-title"
                        href="{{ route('course.courseListInCategory', ['slug_category' => $cat->slug]) }}">{{ $cat->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<nav class="nav-mobile">
    <div class="container">
        <div class="nav-wrapper d-flex  justify-content-between"> <a class="nav-item" href="/">
                <div class="header-btn"><img   src="{{ asset('enduser/assets/icons/icon-home-pink.svg') }}" alt="">
                </div>
                <div class="nav-text">Trang chủ</div>
            </a>
            <div class="nav-item">
                <div class="header-btn menu"> <img src="{{ asset('enduser/assets/icons/icon-bar-pink.svg') }}" alt="">
                </div>
                <div class="nav-text">Danh mục</div>
            </div><a class="nav-item" href="{{ route('product.productList') }}">
                <div class="header-btn"><img src="{{ asset('enduser/assets/icons/icon-shopping-bag-pink.svg') }}"
                        alt=""></div>
                <div class="nav-text">Cửa hàng</div>
            </a><a class="nav-item" href="{{ route('wishlist.show') }}">
                @php
                    $wishlist = session()->get('items.wishlist');
                    $countWish = $wishlist != null ? count($wishlist) : 0;
                @endphp
                <div class="header-btn">
                    <div class="circle-notification">{{ $countWish }}</div><img
                        src="{{ asset('enduser/assets/icons/icon-heart-pink.svg') }}" alt="">
                </div>
                <div class="nav-text">Yêu thích</div>
            </a><a class="nav-item" href="{{ route('account.myProfile') }}">
                <div class="header-btn"><img src="{{ asset('enduser/assets/icons/icon-user-pink.svg') }}" alt="">
                </div>
                <div class="nav-text">Cá nhân</div>
            </a>
        </div>
    </div>
</nav>
