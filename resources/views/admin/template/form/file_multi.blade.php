<div class="form-group file_picture">
    <label for="{{ $item['name'] }}">{{ $item['label'] }}:</label>
    <input multiple name="{{ $item['name'] }}[]" type="file" class="form-control picture_multi" id="{{ $item['name'] }}">
    <div class="multi_preview_image">
        @if(isset($item_model) && is_object($item_model)  )
            @php
                $arrImage = json_decode($item_model->{$item['name']});
            @endphp
            @foreach($arrImage as $k => $file_name)
                <img class="avatar_preview" width="300" src="{{  \App\Helper\Common::showThumb($folderUpload, $file_name ) }}" alt="">
            @endforeach

        @endif
    </div>

</div>
