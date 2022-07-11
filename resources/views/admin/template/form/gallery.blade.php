<div class="form-group">
    <div class="panel panel-default">
        <div class="panel-heading">{{ $item['label'] }}:</div>
        <div class="panel-body">
            <div id="ctn-app-colors" class="ctn-app-colors box-gallery-ctn-app ui-sortable">
                @php
                   $old = old('galleries', @$item_model->{$item['name']} );
                   $arrGallery = [];
                    if($old != null){
                        if(!is_array($old)){
                        $arrGallery = json_decode($item_model->{$item['name']});
                        }else{
                            $arrGallery = $old;
                        }
                    }

                @endphp
                @if(count($arrGallery))
                    @foreach($arrGallery as $k => $src)
                        <div class="item-sort">
                                <div class="dynamic-box-item">
                                    <div class="box-img">
                                        <input class="dynamic-attach-id" name="galleries[]" type="hidden" value="{{ $src }}">
                                        <div class="box-icon-upload">
                                            <div class="upload-icon"></div>
                                            <div class="upload-text">Upload image</div>
                                        </div>
                                        <div class="upload-image-box">
                                            <img class="upload-image" style="display: block;" src="{{ $src }}">
                                        </div>
                                    </div>
                                    <div class="dynamic-icon-delete" style="display: none;"></div>
                                </div>
                        </div>
                    @endforeach
                @endif
                <div class="dynamic-new-box">
                    <div class="dynamic-icon-plus"></div>
                    <div class="dynamic-icon-txt">New Image</div>
                </div>
            </div>
        </div>
    </div>
</div>
