
@if(!empty($data)))
<div class="slider">
    <!-- slider -->
    <div class="{{$nameCarousel ?? $nameCarousel}} owl-carousel owl-theme">
        @foreach($data as $v)
        <div class="item">
            <img src="{{$v->picture}}" alt="{{$v->name}}">
        </div>
        @endforeach
    </div>
</div>
@endif
