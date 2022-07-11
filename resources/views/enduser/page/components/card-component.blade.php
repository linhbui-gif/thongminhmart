
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
<div class="coaching-card">
    <!-- coaching card -->
    <div class="coaching-card-img zoomimg">
        <a href="{{route('new.newDetail',['slug'=>$blog->slug])}}"><img width="100%" src="{{$blog->url_picture}}" alt="{{$blog->name}}" class="img-fluid"></a>
    </div>
    <div class="coaching-card-body">
        <h2 class="coaching-card-title"><a href="{{route('new.newDetail',['slug'=>$blog->slug])}}" class="title">{{$blog->name}}</a></h2>
        <p>{!! $blog->description !!}</p>
        <a href="{{route('new.newDetail',['slug'=>$blog->slug])}}" class="btn-link-primary">Read More</a>
    </div>
</div>
    </div>

