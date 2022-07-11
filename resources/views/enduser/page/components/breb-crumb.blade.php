
<div class="page-breadcrumb">
    <!-- page breadcrumb -->
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        @if(!empty($data))
                            @foreach($data as $k => $v)
                            <li class="breadcrumb-item {{$k % 2 == 0 ? "active" : ""}}" aria-current="page">{{@$v['name']}}</li>
                            @endforeach
                      @endif
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
