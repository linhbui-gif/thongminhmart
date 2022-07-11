@extends("enduser.layout")
@section('head')
    @php
        $locale = app()->getLocale();

        if($locale == "vi") {
            $page_content = unserialize($page->content);
        }
        else{
             $page_content = unserialize($page->content_ko);
        }
    @endphp
@stop
@section('content')

    @php

        $blogs = \App\Helper\Common::getFromCache('blogs');
        if(!$blogs) {
          $blogs = \App\blog_posts::where('status','active')->orderBy('order_no','asc')->limit(3)->get();
          \App\Helper\Common::putToCache('blogs',$blogs);
        }
       $lastItemBlog = \App\blog_posts::where('status','active')->orderBy('id','desc')->first()->id;
    @endphp

    <?php
    $dataBreb = [
        [
            "name" => "tin tức"
        ]
    ];
    ?>
    @include("enduser.page.components.breb-crumb",['data' => $dataBreb])
    <div class="content">
        <div class="container">
            {{ csrf_field() }}
            <div class="row" id="post_data">
            </div>

        </div>
    </div>

@stop
@section('script')
    <script>
        $(document).ready(function(){

            var _token = $('input[name="_token"]').val();
            load_data('', _token);
            function load_data(id="", _token)
            {
                $.ajax({
                    url:"{{ route('ajaxProduct') }}",
                    method:"POST",
                    data:{id:id, _token:_token},
                    success:function(data)
                    {
                        $('#load_more_button').remove();
                        $('#post_data').append(data);
                    }
                })
            }

            $(document).on('click', '#load_more_button', function(){
                var id = $(this).data('id');
                $('#load_more_button').html('<b>Loading...</b>');
                load_data(id, _token);
            });

        });

    </script>
@endsection
