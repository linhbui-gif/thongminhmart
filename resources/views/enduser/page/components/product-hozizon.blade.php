@if(!empty($data))
@foreach($data as $v)
<div class="item">
    <div class="carousel-img">
        <img src="{{$v->url_picture}}" alt="{{$v->name}}" class="img-fluid">
        <div class="overlay-category">
            <p class="category-overlay-text text-center">
                {{$v->name}}
            </p>
        </div>
    </div>
</div>
@endforeach
@endif
