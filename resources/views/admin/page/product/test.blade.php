<section>
    <h3>Khối "gói tour"</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Tiêu đề</label>
                <input value="{{ @$content['goitour']['tieude'] }}" name="content[goitour][tieude]" type="text" class="form-control">
            </div>
        </div>
        @for($stt = 1; $stt < 4; $stt++)
            <div class="col-md-4">
                <h4>Khối thứ {{ $stt }}</h4>
                <div class="form-group file_picture">
                    <label for="">ThumbNail:</label>
                    <input name="content[dichvu_khoi_{{ $stt }}][picture]" type="file" class="form-control" id="">
                    <p class="image-upload"><img src="{{  \App\Helper\Common::showThumb('page', $content['dichvu_khoi_' . $stt]['picture'] ) }}" alt=""></p>
                </div>
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input value="{{ $content['dichvu_khoi_' . $stt ]['name'] }}" name="content[dichvu_khoi_{{ $stt }}][name]"  type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea name="content[dichvu_khoi_{{ $stt }}][description]" class="form-control" cols="30" rows="5">{{ $content['dichvu_khoi_' . $stt ]['description'] }}</textarea>
                </div>
            </div>
        @endfor
    </div>
</section>
