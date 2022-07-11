<div class="form-group">
    <div class="panel panel-default">
        <div class="panel-heading">{{ $label }}:</div>
        <div class="panel-body">
            <div id="ctn-app-colors" class="box-picture-ctn-app">
                <div class="dynamic-box-item">
                    <div class="box-img">
                        @if(isset($item) && !empty($item))
                            <input class="dynamic-attach-id" name="{{ $name }}" type="hidden" value="{{ $item }}">
                        @else
                            <input class="dynamic-attach-id" name="{{ $name }}" type="hidden" value="">
                        @endif

                        <div class="box-icon-upload">
                            <div class="upload-icon"></div>
                            <div class="upload-text">Upload image</div>
                        </div>
                        <div class="upload-image-box">
                            @if(isset($item) && !empty($item))
                                <img class="upload-image" style="display: block;" src="{{ $item }}">
                            @else
                                <img class="upload-image" style="display: block;">
                            @endif

                        </div>
                    </div>
                    <div class="dynamic-icon-delete" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
