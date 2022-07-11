@php
    $user= Auth::user();
@endphp
<div class="user-sidebar-component">
    <div class="user-avatar"> <img src="{{ isset($user) ? strpos($user->picture, 'https:') === 0 ? $user->picture : $user->getImage() : "#" }}" alt=""></div>
    <div class="user-name">{{ isset($user) ? $user->fullname() : ""}}</div>
    <div class="user-sidebar-list">
        <a class="list-item d-flex align-items-center justify-content-between" href="{{ route('account.myProfile') }}"> <span>Thông tin</span><img class="lazyload" data-src="{{ asset('enduser/assets/icons/icon-information.svg') }}" alt=""></a>
        <a class="list-item d-flex align-items-center justify-content-between" href="{{ route('account.myCoupon') }}"> <span>Mã</span><img class="lazyload" data-src="{{ asset('enduser/assets/icons/icon-tickets.svg') }}" alt=""></a>
{{--        <a class="list-item d-flex align-items-center justify-content-between" href="#"> <span>Yêu thích</span><img src="{{ asset('enduser/assets/icons/icon-heart.svg') }}" alt=""></a>--}}
        <a class="list-item d-flex align-items-center justify-content-between" href="{{ route('account.myOrder') }}"> <span>Đơn hàng của tôi</span><img class="lazyload" data-src="{{ asset('enduser/assets/icons/icon-order.svg') }}" alt=""></a>
        <a class="list-item d-flex align-items-center justify-content-between" href="{{route('account.address')}}"> <span>Địa chỉ</span><img class="lazyload" data-src="{{ asset('enduser/assets/icons/icon-order.svg') }}" alt=""></a>
        <a class="list-item d-flex align-items-center justify-content-between" href="{{route('account.myCourses')}}"> <span>Khoá học của tôi</span><img class="lazyload" data-src="{{ asset('enduser/assets/icons/icon-book.svg') }}" alt=""></a>
{{--        <a class="list-item d-flex align-items-center justify-content-between" href="#"> <span>Học</span><img src="{{ asset('enduser/assets/icons/icon-study.svg') }}" alt=""></a>--}}
{{--        <a class="list-item d-flex align-items-center justify-content-between" href="{{route('account.changePassword')}}"> <span>Đổi mật khẩu</span><img src="{{ asset('enduser/assets/icons/icon-password.svg') }}" alt=""></a>--}}
        <a class="list-item d-flex align-items-center justify-content-between" href="{{ route('account.myQuestions') }}"> <span>Câu hỏi</span><img class="lazyload" data-src="{{ asset('enduser/assets/icons/icon-question.svg') }}" alt=""></a>
        @if($user->is_giangvien() || $user->is_admin())
            <a class="list-item d-flex align-items-center justify-content-between" href="{{ route('admin.welcome.index') }}"> <span>Quản trị</span><img class="lazyload" data-src="{{ asset('enduser/assets/icons/icon-question.svg') }}" alt=""></a>
        @endif
        <a class="list-item d-flex align-items-center justify-content-between" href="{{ route('user.logout') }}"> <span>Đăng xuất</span><img class="lazyload" data-src="{{ asset('enduser/assets/icons/icon-logout.svg') }}" alt=""></a>
    </div>
</div>
