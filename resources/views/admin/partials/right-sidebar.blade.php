@php

$user = Auth::user();
$permissions = [];
foreach ($user->roles as $role) {
    $tmp_permissions = json_decode($role->permissions, true);
    foreach ($tmp_permissions as $permission => $is) {
        $permissions[$permission] = $is;
    }
}
$routeName = \Request::route()->getName();

@endphp

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $user->getImage() }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $user->last_name }} {{ $user->first_name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
             <li class="header">Workshop</li>
            @can('bank.index')
                <li @if (in_array($routeName, ['admin.bank.index', 'admin.bank.create'])) class="active" @endif><a href="{{ route('admin.bank.index') }}"><i
                            class="fa fa-print"></i><span>Quản lý ngân hàng</span></a></li>
            @endcan
            @can('config.edit')
                <li @if (in_array($routeName, ['admin.config.edit'])) class="active" @endif><a href="{{ route('admin.config.edit') }}"><i
                            class="fa fa-print"></i><span>Cấu hình chung</span></a></li>
            @endcan
{{--            @can('customer.index')--}}
{{--                <li @if (in_array($routeName, ['admin.customer.index', 'admin.customer.create'])) class="active" @endif><a href="{{ route('admin.customer.index') }}"><i--}}
{{--                            class="fa fa-print"></i><span>Học viên</span></a></li>--}}
{{--            @endcan--}}
{{--            @can('pages_dynamic.index')--}}
{{--                <li @if (in_array($routeName, ['pages_dynamic.index', 'pages_dynamic.create'])) class="active" @endif><a href="{{ route('admin.pages_dynamic.index') }}"><i--}}
{{--                            class="fa fa-print"></i><span>New page</span></a></li>--}}
{{--            @endcan--}}
            @can('page.index')
                <li @if (in_array($routeName, ['admin.page.index', 'admin.page.create'])) class="active" @endif><a href="{{ route('admin.page.index') }}"><i
                            class="fa fa-print"></i><span>Quản lý trang tĩnh</span></a></li>
            @endcan

            @canany(['blog_posts.index', 'blog_categories.index', 'blog_tags.index'])
                <li class="treeview @if (in_array($routeName, ['admin.blog_posts.index', 'admin.blog_posts.create', 'admin.blog_categories.index', 'admin.blog_categories.create', 'admin.blog_tags.index', 'admin.blog_tags.create'])) active @endif">
                    <a href="#"><i class="fa fa-tag"></i><span>Bài viết</span> <span class="pull-right-container"><i
                                class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        @can('blog_posts.index')
                            <li @if (in_array($routeName, ['admin.blog_posts.index', 'admin.blog_posts.create'])) class="active" @endif><a href="{{ route('admin.blog_posts.index') }}">Danh sách bài viết</a></li>
                        @endcan

                        @can('blog_categories.index')
                            <li @if (in_array($routeName, ['admin.blog_categories.index', 'admin.blog_categories.create'])) class="active" @endif><a href="{{ route('admin.blog_categories.index') }}">Danh mục</a>
                            </li>
                        @endcan

{{--                        @can('blog_tags.index')--}}
{{--                            <li @if (in_array($routeName, ['admin.blog_tags.index', 'admin.blog_tags.create'])) class="active" @endif><a href="{{ route('admin.blog_tags.index') }}">Tags</a></li>--}}
{{--                        @endcan--}}
                    </ul>
                </li>
            @endcanany

            @canany(['product_products.index', 'product_category.index', 'product_tags.index','size.index','color.index'])
                <li class="treeview @if (in_array($routeName,
                                          ['admin.product_products.index',
                                           'admin.product_products.create',
                                          'admin.product_category.index',
                                          'admin.product_category.create',
                                          'admin.product_tags.index',
                                          'admin.product_tags.create',
                                          'admin.size.index',
                                          'admin.size.create',
                                          'admin.color.index',
                                          'admin.color.create',
                                          ])) active @endif">
                    <a href="#"><i class="fa fa-product-hunt"></i><span>Sản phẩm</span> <span
                            class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        @can('product_products.index')
                            <li @if (in_array($routeName, ['admin.product_products.index', 'admin.product_products.create'])) class="active" @endif><a href="{{ route('admin.product_products.index') }}">Danh sách sản phẩm</a>
                            </li>
                        @endcan
{{--                            @can('size.index')--}}
{{--                            <li @if (in_array($routeName, ['admin.size.index', 'admin.size.create'])) class="active" @endif><a href="{{ route('admin.size.index') }}">Size Product</a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                            @can('color.index')--}}
{{--                            <li @if (in_array($routeName, ['admin.color.index', 'admin.color.create'])) class="active" @endif><a href="{{ route('admin.color.index') }}">Color Product</a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
                        @can('product_category.index')
                            <li @if (in_array($routeName, ['admin.product_category.index', 'admin.product_category.create'])) class="active" @endif><a href="{{ route('admin.product_category.index') }}">Category</a>
                            </li>
                        @endcan
                        @can('product_tags.index')
                            <li @if (in_array($routeName, ['admin.product_tags.index', 'admin.product_tags.create'])) class="active" @endif><a href="{{ route('admin.product_tags.index') }}">Hashtags</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

{{--            @canany(['warehouse.index'])--}}
{{--                <li class="treeview">--}}
{{--                    <a href="#"><i class="fa fa-link"></i> <span>Quản lý kho</span> <span--}}
{{--                            class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>--}}
{{--                    <ul class="treeview-menu">--}}
{{--                        <li><a href="{{ route('admin.warehouse.index') }}">Danh sách Kho</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
            {{-- <li class="treeview"> --}}
            {{-- <a href="#"><i class="fa fa-link"></i> <span>Giáo trình</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a> --}}
            {{-- <ul class="treeview-menu"> --}}
            {{-- <li><a href="{{ route('admin.chapter.index') }}">Chương</a></li> --}}
            {{-- <li><a href="{{ route('admin.lesson.index') }}">Bài học</a></li> --}}
            {{-- </ul> --}}
            {{-- </li> --}}
{{--            @canany(['course_courses.index', 'course_category.index'])--}}
{{--                <li class="treeview @if (in_array($routeName, ['admin.course_courses.index', 'admin.course_courses.create', 'admin.course_courses.edit', 'admin.course_category.index', 'admin.course_category.create', 'admin.lesson.editLesson', 'admin.chapter.index', 'admin.chapter.create', 'admin.chapter.edit'])) active @endif">--}}
{{--                    <a href="#"><i class="fa fa-product-hunt"></i><span>Course</span> <span class="pull-right-container"><i--}}
{{--                                class="fa fa-angle-left pull-right"></i></span></a>--}}
{{--                    <ul class="treeview-menu">--}}
{{--                        @can('course_courses.index')--}}
{{--                            <li @if (in_array($routeName, ['admin.course_courses.index', 'admin.course_courses.create', 'admin.course_courses.edit', 'admin.lesson.editLesson', 'admin.chapter.index', 'admin.chapter.create', 'admin.chapter.edit'])) class="active" @endif><a href="{{ route('admin.course_courses.index') }}">Course</a></li>--}}
{{--                        @endcan--}}
{{--                        @can('course_category.index')--}}
{{--                            <li @if (in_array($routeName, ['admin.course_category.index', 'admin.course_category.create'])) class="active" @endif><a href="{{ route('admin.course_category.index') }}">Category</a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        --}}{{-- <li><a href="#">Tags</a></li> --}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcanany--}}

            @canany(['widget.index', 'banner.index', 'notification.index'])
                <li class="treeview">
                    <a href="#"><i class="fa fa-tag"></i><span>Widgets</span> <span class="pull-right-container"><i
                                class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        @can('widget.index')
                            <li><a href="{{ route('admin.widget.index') }}">Widgets</a></li>
                        @endcan
                        @can('banner.index')
                            <li><a href="{{ route('admin.banner.index') }}">Banner</a></li>
                        @endcan
                            <li class="">
                                <a href="{{ route("admin.menu.index") }}"><span>Menu</span></a>
                            </li>
{{--                        @can('notification.index')--}}
{{--                            <li><a href="{{ route('admin.notification.index') }}">Notification</a></li>--}}
{{--                        @endcan--}}
                    </ul>
                </li>
            @endcanany

{{--            @can('coupon.index')--}}
{{--                <li><a href="{{ route('admin.coupon.index') }}"><i class="fa fa-link"></i> <span>Coupon</span></a>--}}
{{--                </li>--}}
{{--            @endcan--}}

{{--            @can('contact.index')--}}
{{--                <li><a href="{{ route('admin.contact.index') }}"><i class="fa fa-tag"></i><span>Contact</span></a>--}}
{{--                </li>--}}
{{--            @endcan--}}

{{--            @can('qa_question.index')--}}
{{--                <li @if (in_array($routeName, ['admin.qa_question.index'])) class="active" @endif>--}}
{{--                    <a href="{{ route('admin.qa_question.index') }}"><i class="fa fa-comment"></i><span>Q & A</span>--}}
{{--                        <span class="pull-right-container"></span></a>--}}
{{--                </li>--}}
{{--            @endcan--}}


{{--            @can('event.index')--}}
{{--                <li @if (in_array($routeName, ['admin.event.index'])) class="active" @endif>--}}
{{--                    <a href="{{ route('admin.event.index') }}"><i class="fa fa-comment"></i><span>Event</span> <span--}}
{{--                            class="pull-right-container"></span></a>--}}
{{--                </li>--}}
{{--            @endcan--}}


            @canany(['order.index','ship_fee_district.index'])
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Đơn hàng</span> <span class="pull-right-container"><i
                                class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        @can('order.index')
                            <li><a href="{{ route('admin.order.index') }}">Danh sách đơn hàng</a></li>
                        @endcan
                            @can('ship_fee_district.index')
                                <li><a href="{{ route('admin.ship_fee_district.index') }}">Danh sách phí ship</a></li>
                        @endcan
{{--                       --}}
{{--                        --}}
{{--                        <li><a href="{{ route('admin.order.thongke') }}">Thống kê</a></li>--}}
                    </ul>
                </li>
            @endcan
            @canany(['user.index', 'role.index', 'address.index'])
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Quản trị hệ thống</span> <span class="pull-right-container"><i
                                class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        @can('user.index')
                            <li><a href="{{ route('admin.user.index') }}">Người dùng</a></li>
                        @endcan
                        @can('role.index')
                            <li><a href="{{ route('admin.role.index') }}">Vai trò</a></li>
                        @endcan
                        {{--                        @can('address.index')--}}
                        {{--                            <li><a href="{{ route('admin.address.index') }}">Address</a></li>--}}
                        {{--                        @endcan--}}
                    </ul>
                </li>
            @endcanany
            {{-- @can('logs.indexLogs') --}}
{{--            <li @if (in_array($routeName, ['admin.logs.index'])) class="active" @endif>--}}
{{--                <a href="{{ route('admin.logs.index') }}"><i class="fa fa-link"></i><span>Logs</span> <span--}}
{{--                        class="pull-right-container"></span></a>--}}
{{--            </li>--}}
            {{-- @endcan --}}

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
