@if(!empty($data))
<?php
    $className = '';
  if(@$class){
      $className = $class;
  }
  else{
      $className = "col-xl-4 col-lg-4 col-md-12 col-sm-12";
  }
?>
@foreach($data as $v)
    <div class=" {{$className}} col-12">
<div class="post-holder">
    <div class="post-img zoomimg">
        <a href="#"><img src="{{$v->url_picture}}"
                         alt="{{$v->name}}"
                         class="img-fluid w-100"></a>
    </div>
    <div class="post-header">
        <h2 class="post-title"><a href="{{route('product.productDetail',['category'=>$v->slug])}}" class="title">{{$v->name}}</a></h2>
        <p>{!! $v->short_description !!}</p>
    </div>
    <div class="post-content">
        {{$v->description}}
        <a href="{{route('product.productDetail',['category'=>$v->slug])}}" class="btn btn-default">Đọc Thêm</a>
    </div>
</div>
    </div>
@endforeach
@endif
