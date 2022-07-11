<div id="thongtin_en" class="page_manager tab-pane fade in">
    @php
            $content = unserialize($item->content_ko)??'';
    @endphp
    @if($item->id == 19)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Khối tiêu đề du thuyền của Aliga</label>
                    <input value="{{ @$content['duthuyen' ]['name'] }}" name="content_ko[duthuyen][name]"  type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Khối các hoạt động </label>
                    <input value="{{ @$content['activity' ]['name'] }}" name="content_ko[activity][name]"  type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Khối đánh giá của khách hàng</label>
                    <input value="{{ @$content['client' ]['name'] }}" name="content_ko[client][name]"  type="text" class="form-control">
                </div>
                <div class="col-12">
                    <h3>Khối kêu gọi hành động</h3>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <input value="{{ @$content['call' ]['name'] }}" name="content_ko[call][name]"  type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tên Button</label>
                        <input value="{{ @$content['call' ]['button'] }}" name="content_ko[call][button]"  type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Link Button</label>
                        <input value="{{ @$content['call' ]['link'] }}" name="content_ko[call][link]"  type="text" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Khối đối tác</label>
                    <input value="{{ @$content['partner' ]['name'] }}" name="content_ko[partner][name]"  type="text" class="form-control">
                </div>

            </div>

        </div>

    @elseif($item->id == 21)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$item->name }}" type="text" class="form-control">
                </div>
                <div class="form-group ">
                    <label for="">Nội dung:</label>
                    <textarea  id="content_finder" name="content[finder][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['finder']['text'] }}</textarea>
                    <script>
                        CKEDITOR.replace( 'content_finder' );
                    </script>
                </div>
            </div>
        </div>
    @elseif($item->id == 22)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['kinhnghiem']['name'] }}" name="content_ko[kinhnghiem][name]" type="text" class="form-control">
                </div>
                <div class="form-group ">
                    <label for="">Nội dung:</label>
                    <textarea  id="content_exp" name="content_ko[content_exp][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['content_exp']['text'] }}</textarea>
                    <script>
                        CKEDITOR.replace( 'content_exp' );
                    </script>
                </div>
            </div>
        </div>
    @elseif($item->id == 23)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['lienhe']['name'] }}" name="content_ko[lienhe][name]" type="text" class="form-control">
                </div>

            </div>
        </div>
    @elseif($item->id == 24)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$item->name }}" type="text" class="form-control">
                </div>
            </div>
        </div>

    @elseif($item->id == 26)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$item->name }}" type="text" class="form-control">
                </div>
            </div>
        </div>
    @elseif($item->id == 27)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['tuyendung']['name'] }}" name="content_ko[tuyendung][name]" type="text" class="form-control">
                </div>
                <div class="form-group ">
                    <label for="">Nội dung:</label>
                    <textarea  id="content_tuyendung_ko" name="content_ko[tuyendung][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['tuyendung']['text'] }}</textarea>
                    <script>
                        CKEDITOR.replace( 'content_tuyendung_ko' );
                    </script>
                </div>
            </div>
        </div>
    @elseif($item->id == 28)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['page_about']['name'] }}" name="content_ko[page_about][name]" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input value="{{ @$content['page_about']['description'] }}" name="content_ko[page_about][description]" type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Khối đối tác</label>
                    <input value="{{ @$content['partner']['name'] }}" name="content_ko[partner][name]"  type="text" class="form-control">
                </div>

            </div>

        </div>
    @elseif($item->id == 31)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['tintuc']['name'] }}" name="content_ko[tintuc][name]" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input value="{{ @$content['tintuc']['description'] }}" name="content_ko[tintuc][description]" type="text" class="form-control">
                </div>
            </div>
        </div>

    @endif
</div>
