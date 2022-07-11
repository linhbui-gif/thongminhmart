@php
$cate_slug = 'chua-ro';
if (isset($item->category->slug)) {
    $cate_slug = $item->category->slug;
}
$link = route('course.courseDetail', ['slug_category' => $cate_slug, 'course_slug' => $item->slug]);
$ids_wishlist = session()->get('items.wishlist');

@endphp

<div class="{{ $class }}">
    <div class="product-component">
        <div class="product-image"> <a href="{{ $link }}"><img class="lazyload"
                    data-src="{{ $item->url_picture }}" alt=""></a>
            {{-- <div class="product-label red">hot</div> --}}
            @if (!empty($ids_wishlist) && is_array($ids_wishlist) && in_array($item->id, $ids_wishlist))
                <div class="product-favorite favorite-active">
                    <a href="{{ route('wishlist.add', ['id' => $item->id]) }}"><img
                            src="{{ asset('enduser/assets/icons/icon-heart-white.svg') }}" alt=""></a>
                </div>
            @else
                <div class="product-favorite">
                    <a href="{{ route('wishlist.add', ['id' => $item->id]) }}"><img
                            src="{{ asset('enduser/assets/icons/icon-heart.svg') }}" alt=""></a>
                </div>
            @endif

        </div><a class="product-title " href="{{ $link }}">{{ $item->name }}</a>
        <div class="line"> </div>
        {{-- @if ($item->price_base != $item->price_final) --}}
        {{-- <div class="d-flex flex-wrap product-old-price"> --}}
        {{-- <del>{{number_format($item->price_base) }}đ</del> --}}
        {{-- </div> --}}
        {{-- <h5 class="product-price">{{number_format($item->price_final) }}đ</h5> --}}
        {{-- @else --}}
        {{-- <h5 class="product-price">{{number_format($item->price_base) }}đ</h5> --}}
        {{-- @endif --}}
        @if ($item->price_base && $item->price_base != -1 && $item->price_base != -2)
            <h5 class="product-price">{{ number_format($item->price_base) }}đ</h5>
        @elseif($item->price_base == "-1")
            <h5 class="product-price">Miễn phí</h5>
        @elseif($item->price_base == "-2")
            <h5 class="product-price">Coming soon</h5>
        @endif

        <div class="product-tags d-flex flex-wrap">
            <div class="tag-item"><a href="{{ $link }}" style="color: white">Đăng ký ngay</a></div>
        </div>
    </div>
</div>
