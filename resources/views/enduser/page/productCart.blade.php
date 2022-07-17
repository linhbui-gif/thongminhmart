@if(Session::has('Cart') != null)
@foreach(Session::get('Cart')->products as $key => $value)
@if(!empty($value['productInfo']['productId']) && $value['productInfo']['productId']== $productId)
<div class="ProductDetailPage-detail-info-options-item-carts-item flex items-center">
    <div class="ProductDetailPage-detail-info-options-item-carts-item-title">{{$value['quanty']??0}} sản phẩm - Màu sắc: {{$value['productInfo']['color']??''}} - Kích cỡ: {{$value['productInfo']['size']??''}}</div>
    <div class="ProductDetailPage-detail-info-options-item-carts-item-remove delCartItem" data-id="{{ $value['productInfo']['productId'] . '-' . $value['productInfo']['color'] . '-' . $value['productInfo']['size'] }}"> <img src="{{ asset('/assets/icons/icon-x-yellow.svg') }}" alt=""></div>
</div>
@endif
@endforeach
@endif