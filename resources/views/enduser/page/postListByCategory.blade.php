@extends("enduser.layout")

@section('content')

    <div class="blog_page_bg">
        <div class="container">
            <!--breadcrumbs area start-->
            <div class="breadcrumbs_area breadcrumbs_blog mb-96">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb_content text-center">
                            <H2>Lĩnh vực hoạt động <span></span></H2>
                            <ul>
                                <li><a href="/">Trang chủ / </a></li>
                                <li><a href="#">{{$category->name}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--breadcrumbs area end-->

            <!--blog page section start-->
            <div class="blog_page_section mb-140">
                <div class="row blog_page_gallery">
                    @if($blogs->count() > 0)
                    @foreach($blogs as $blog)
                        @if($blog)
                            <div class="col-lg-4 col-md-6 col-sm-6 gird_item">
                                <article class="single_blog wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                                    <figure>
                                        <div class="blog_thumb">
                                            <a href="{{route('new.newDetail',['slug'=>$blog->slug])}}"><img src="{{ $blog->url_picture }}" alt=""></a>
                                        </div>
                                        <figcaption class="blog_content">
                                            <div class="blog_meta">
                                                <span> {{$blog->updated_at}}</span>
                                            </div>
                                            <h3><a href="{{route('new.newDetail',['slug'=>$blog->slug])}}"> {{$blog->name}}</a>
                                            </h3>
                                            <a href="{{route('new.newDetail',['slug'=>$blog->slug])}}">Continue <i class="ei ei-arrow_right"></i></a>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        @endif
                    @endforeach
                    @else
                        <p>Không tìm thấy dữ liêu phù hợp</p>
                        @endif
                </div>
                <div class="pagination_style pagination blog_pagination justify-content-center">
                    {{$blogs->links()}}

                </div>

            </div>
            <!--blog page section end-->
        </div>
    </div>
@stop
