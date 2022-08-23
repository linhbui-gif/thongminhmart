<div id="thongtin" class="page_manager tab-pane fade in active">
    @php
        $content = unserialize($item->content);
    @endphp
    @if($item->id == 19)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['doitac']['name'] }}" name="content[doitac][name]" type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group ">
                    <label for="">Nội dung:</label>
                    <textarea  id="content_doitac" name="content[doitac][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['doitac']['text'] }}</textarea>
                    <script>
                        CKEDITOR.replace( 'content_doitac' );
                    </script>
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
                    <input value="{{ @$content['kinhnghiem']['name'] }}" name="content[kinhnghiem][name]" type="text" class="form-control">
                </div>
                <div class="form-group ">
                    <label for="">Nội dung:</label>
                    <textarea  id="content_exp" name="content[content_exp][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['content_exp']['text'] }}</textarea>
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
                    <input value="{{ @$content['lienhe']['name'] }}" name="content[lienhe][name]" type="text" class="form-control">
                </div>

            </div>
            <div class="col-md-12">
                <div class="form-group ">
                    <label for="">Nội dung:</label>
                    <textarea  id="content_lienhe" name="content[lienhe][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['lienhe']['text'] }}</textarea>
                    <script>
                        CKEDITOR.replace( 'content_lienhe' );
                    </script>
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
                    <input value="{{ @$content['tuyendung']['name'] }}" name="content[tuyendung][name]" type="text" class="form-control">
                </div>
                <div class="form-group ">
                    <label for="">Nội dung:</label>
                    <textarea  id="content_tuyendung" name="content[tuyendung][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['tuyendung']['text'] }}</textarea>
                    <script>
                        CKEDITOR.replace( 'content_tuyendung' );
                    </script>
                </div>
            </div>
        </div>
    @elseif($item->id == 28)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['page_about']['name'] }}" name="content[page_about][name]" type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group ">
                    <label for="">Nội dung:</label>
                    <textarea  id="page_about" name="content[about][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['about']['text'] }}</textarea>
                    <script>
                        CKEDITOR.replace( 'page_about' );
                    </script>
                </div>
            </div>

        </div>
    @elseif($item->id == 31)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['chinhsach']['name'] }}" name="content[chinhsach][name]" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Nội dung:</label>
                    <textarea  id="page_chinhsach" name="content[chinhsach][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['chinhsach']['text'] }}</textarea>
                    <script>
                        CKEDITOR.replace( 'page_chinhsach' );
                    </script>
                </div>
            </div>
        </div>

    @endif
</div>
