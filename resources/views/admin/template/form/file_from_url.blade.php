<div class="form-group">
    <div class="panel panel-default">
        <div class="panel-heading">{{ $item['label'] }}:</div>
        <div class="panel-body">
            <div id="ctn-app-colors" class="box-picture-ctn-app">
                <div class="item-sort">
                    <div class="dynamic-box-item">
                    <div class="box-img">
                        @php
                            $old = old($item['name'], @$item_model->{$item['name']} );
                        @endphp
                        @if(isset($item_model) && is_object($item_model))
                            <input class="dynamic-attach-id" name="{{ $item['name'] }}" type="hidden" value="{{ $old }}">
                        @else
                            <input class="dynamic-attach-id" name="{{ $item['name'] }}" type="hidden" value="{{ $old }}">
                        @endif

                        <div class="box-icon-upload">
                            <div class="upload-icon"></div>
                            <div class="upload-text">Upload image</div>
                        </div>
                        <div class="upload-image-box">
                            @php
                                $old = old($item['name'], @$item_model->{$item['name']} );
                            @endphp
                            @if(isset($item_model) && is_object($item_model) )
                                <img class="upload-image" style="display: block;" src="{{ $old }}">
                            @else
                                <img class="upload-image" style="display: block;" src="{{ $old }}">
                            @endif

                        </div>
                    </div>
                    <div class="dynamic-icon-delete" style="display: none;"></div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
