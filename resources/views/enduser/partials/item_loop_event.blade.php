<div class="{{ $class }}">
    <div class="new-box-component vertical"><a class="new-image" href="{{route('page.showEvent',['id'=>$item->id])}}">
            <img class="lazyload" data-src="{{ $item->getImage() }}" alt=""></a>
        <div class="new-info"> <a class="new-title" href="{{route('page.showEvent',['id'=>$item->id])}}">{{$item->name}}</a>
            <p></p>
{{--            <p class="new-des countdownJs" data-date="{{$item->countdown}}"></p>--}}
        </div>
    </div>
</div>
