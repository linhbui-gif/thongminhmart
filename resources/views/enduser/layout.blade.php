<!DOCTYPE html>
<html>

<head>

    @include("enduser.components.head")
</head>

<body>
        @include("enduser.components.header_desktop")
        @yield('content')
        <div class="bg-primary space-small">
            <!-- call to action -->
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-7 col-sm-6 col-12 d-flex align-items-center">
                        <h2 class="mb10 text-white">Khi bạn cần giải pháp chúng tôi luôn sẵn sàng</h2>
{{--                        <p>Fusce venenatis lectus non est congue vitae malesuada neque lacinia. </p>--}}
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-6 col-12 text-center">
                        <a href="/lien-he" class="btn btn-default btn-lg mt10">Liên hệ ngay</a>
                    </div>
                </div>
            </div>
        </div>
        @include("enduser.components.footer")
    @include("enduser.components.script_footer")

        <div class="searchModal">
            <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="Search Here..."
                                           aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
