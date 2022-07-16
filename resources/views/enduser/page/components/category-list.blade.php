@if(isset($data))
<div class="ProductCategory-list-item">
    <div class="ProductCategory-list-item-image"><a href="{{ route("product.productListByCategory", ["slug_category" => $data->slug])  }}"> <img src="{{@$data->url_picture}}" alt="{{@$data->name}}"></a></div>
    <a class="ProductCategory-list-item-title" href="{{ route("product.productListByCategory", ["slug_category" => $data->slug])  }}">{{$data->name}}</a>
</div>
@endif
