<div class="menu-component">
    <div class="container">
        <div class="menu-component-wrap">
            <div class="row fix-row-no-padding">
                <div class="col-md-3 col-lg-3 no-padding">
                    <div class="menu-category d-flex align-items-center">
                        <div class="category-btn d-flex align-items-center">
                            {{--                            <img src="{{asset('enduser/assets/icons/icon-bars.svg')}}" alt="">--}}
                            DANH MỤC
                            {{--                            <img src="{{asset('enduser/assets/icons/icon-angle-down.svg')}}" alt="">--}}
                        </div>
                        <ul class="dropdown-menu" role="menu">
                            @php
                                $category = \App\Course_category::where('status','active')->get();
                            @endphp
                            @foreach($category as $key => $cat)
                                <li data-submenu-id="{{$cat->slug.$key}}">
                                    <a class="d-flex align-items-center category-link" href="{{route('course.courseListInCategory', [ 'slug_category' => $cat->slug ])}}" style="padding: 7px 15px;">
                                        {{--                                    <div class="category-icon"><img src="{{asset('enduser/assets/icons/icon-angle-right.svg')}}" alt=""></div>--}}
                                        <span>{{$cat->name}}</span>
                                    </a>
                                    <div class="popover" id="san-pham-noi-bat-menu">
                                        <div class="d-flex flex-wrap">
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                            {{--                            <li data-submenu-id="nguyen-lieu-theu-menu">--}}
                            {{--                                <a class="d-flex align-items-center category-link" href="#">--}}
                            {{--                                    <div class="category-icon"><img src="{{asset('enduser/assets/icons/icon-angle-right.svg')}}" alt=""></div><span>Nguyên liệu thêu</span>--}}
                            {{--                                    <div class="category-arrow"><img src="{{asset('enduser/assets/icons/icon-caret-right.svg')}}" alt=""></div>--}}
                            {{--                                </a>--}}
                            {{--                                <div class="popover" id="nguyen-lieu-theu-menu">--}}
                            {{--                                    <div class="d-flex flex-wrap">--}}
                            {{--                                        <div class="col-lg-4">--}}
                            {{--                                            <div class="submenu-item">--}}
                            {{--                                                <h2 class="title">Chỉ thêu len 1</h2>--}}
                            {{--                                                <ul class="submenu-list">--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                </ul>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-lg-4">--}}
                            {{--                                            <div class="submenu-item">--}}
                            {{--                                                <h2 class="title">Chỉ thêu len 2</h2>--}}
                            {{--                                                <ul class="submenu-list">--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                </ul>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-lg-4">--}}
                            {{--                                            <div class="submenu-item">--}}
                            {{--                                                <h2 class="title">Chỉ thêu len 3</h2>--}}
                            {{--                                                <ul class="submenu-list">--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                    <li class="list-item"><a class="list-link d-flex align-items-center" href="#">Chỉ thêu len</a></li>--}}
                            {{--                                                </ul>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </li>--}}
                            <div class="category-show-all d-flex align-items-center" id="categoryShowAll" style="padding-left: 25px">
                                {{--                                <img src="{{asset('enduser/assets/icons/icon-angle-right.svg')}}" alt="">--}}
                                Xem thêm ...
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-lg-9 no-padding">
                    <div class="header-menu-wrapper d-flex">
                        <div class="header-menu-item d-flex align-items-center"> <a class="menu-link" href="/">Trang chủ</a>
                        </div>
                        <div class="header-menu-item d-flex align-items-center"> <a class="menu-link" href="{{route('course.courseList')}}">Khoá học</a>
                        </div>
                        <div class="header-menu-item d-flex align-items-center"> <a class="menu-link" href="{{route('product.productList')}}">Cửa hàng</a>
                        </div>
                        <div class="header-menu-item d-flex align-items-center"> <a class="menu-link" href="{{ route('page.review') }}">Đánh giá</a>
                        </div>
                        <div class="header-menu-item d-flex align-items-center"> <a class="menu-link" href="{{route('page.tutorial')}}">Hướng dẫn</a>
                        </div>
                        <div class="header-menu-item d-flex align-items-center"> <a class="menu-link" href="{{route('SiteTeacher')}}">Trở thành giảng viên</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
