<div class="{{ $class }}">
    <div class="new-box-component vertical"><a class="new-image" href="{{route('new.newDetail',['slug'=>$item->slug])}}">
            <img class="lazyload" data-src="{{ $item->url_picture }}" alt="{{$item->name}}"></a>
        <div class="new-info"> <a class="new-title" href="#">{{$item->name}}</a><p class="new-des">{{$item->description}}</p>

        </div>
    </div>
</div>
