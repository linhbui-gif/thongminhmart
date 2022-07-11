@php
    $product_featured = \App\Product_products::where('status','active')->orderBy('id', 'desc')->limit(8)->get();
   $link = $product->getLink();
@endphp
@foreach($product_featured as $product)
    <div class="swiper-slide">
        <article class="single_blog wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
            <figure>
                <div class="blog_thumb">
                    <a href="{{ $link }}"><img src="{{ $product->url_picture }}" alt=""></a>
                </div>
                <figcaption class="blog_content">
                    <div class="blog_meta">
                        <span>{{ $product->updated_at }}</span>
                    </div>
                    <h3><a href="{{ $link }}">{{ $product->name }}</a>
                    </h3>
                    <a href="{{ $link }}">Continue <i class="ei ei-arrow_right"></i></a>
                </figcaption>
            </figure>
        </article>
    </div>
@endforeach
