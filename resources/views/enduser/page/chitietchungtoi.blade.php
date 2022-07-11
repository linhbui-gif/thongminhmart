@extends("enduser.layout")
<?php
$widgetssss = \App\Widget::where('location','chitiet')->first();
?>
@section('content')

<div class="container" style="margin-top:10rem;">
    <div class="breadcrumbs_area bread_blog_details mb-96">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content text-center">
                    <h2>Chi tiết về chúng tôi</h2>
                    <ul>
                        <li><a href="/">Home / </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {!! @$widgetssss->content !!}
        </div>
    </div>
</div>
    @endsection
