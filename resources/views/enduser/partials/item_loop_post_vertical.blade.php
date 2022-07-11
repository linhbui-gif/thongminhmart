<div class="{{ $class }}"><a class="new-image" href="{{route('new.newDetail',['slug'=>$new->slug])}}"> <img class="lazyload" data-src="{{$new->url_picture }}" alt="{{$new->name}}"></a>
    <div class="new-info"> <a class="new-title" href="{{route('new.newDetail',['slug'=>$new->slug])}}">{{$new->name}}</a>
        <p class="new-des">{{$new->description}} .</p>
    </div>
</div>
