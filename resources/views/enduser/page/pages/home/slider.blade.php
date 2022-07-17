@if(!empty($data)))
<div class="Banner">
    <div class="container">
        <div class="Banner-wrapper">
            <div class="owl-carousel" id="Banner-carousel">
                @foreach($data as $v)
                <div class="item">
                    <div class="Banner-carousel-item"> <img src="{{$v->picture}}" alt="{{$v->name}}"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif