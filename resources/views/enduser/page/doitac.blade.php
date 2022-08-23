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
    <?php
    $dataBreb = [
        [
            "name" => @$page_content['doitac']['name']
        ]
    ];
    ?>
    @include("enduser.page.components.breb-crumb",['data' => $dataBreb])
    <div class="container">
        <div class="content mt-5 bg-white ">
            <h1>{{@$page_content['doitac']['name']}}</h1>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="content-area">
                        {!! @$page_content['doitac']['text'] !!}

                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
