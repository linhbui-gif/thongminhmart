@php
    $categories = \App\Product_category::where('status','active')->orderBy('product_categories.id','desc')->get();

@endphp
<div class="filter-item category">
    <h3>Danh mục sản phẩm </h3>
    <div class="filter-lists">
        @php
            $routeName = \Request::route()->getName();
        @endphp
        <div class="list-item d-flex align-items-center @if($routeName == "product.productList") active @endif">
            <img class="lazyload" data-src="{{asset("enduser/assets/icons/icon-filter.svg")}}" alt="">
            <span class="list-title">
                @if($routeName == "product.productList")
                    Tất cả sản phẩm
                @else
                    <a href="{{ route('product.productList') }}" style="color:black;">Tất cả sản phẩm</a>
                @endif

            </span>
            <span class="list-total">{{ \App\Product_products::where('status','active')->count() }}</span>
        </div>
        @foreach($categories as $cat)
            @php
                $link = $cat->getLink();
            @endphp
            <div class="list-item d-flex align-items-center  @if(isset($category) && ($category->id == $cat->id) ) active @endif">
                <img class="lazyload" data-src="{{asset("enduser/assets/icons/icon-filter.svg")}}" alt="">
                <span class="list-title">
                    @if(isset($category) && ($category->id == $cat->id) )
                        {{ $cat->name }}
                    @else
                        <a href="{{ $link }}" style="color:black;">{{ $cat->name }}</a>
                    @endif
                </span>
                <span class="list-total">({{ $cat->products()->where('product_products.status','active')->count() }})</span>
            </div>
        @endforeach
    </div>
</div>
