@php
    $product_featured = \App\Product_products::where('type', 'features')->orderBy('id', 'desc')->limit(8)->get();
@endphp
@foreach($product_featured as $p)
    @include("enduser.partials.item_loop_product", [ 'product' => $p , 'class' => 'item'])
@endforeach
