<div class="section-header d-flex align-items-center justify-content-between">
    <h2 class="d-flex align-items-center">
        <img src="{{ $icon }}" alt="">{{ $name }}

    </h2>
    @if(isset($more))
    <a class="d-flex align-items-center" href="{{ $more }}">Xem tất cả<img src="{{ asset('enduser/assets/icons/icon-angle-right.svg') }}" alt=""></a>
    @endif
</div>
