<div class="form-group file_picture">
    <label for="{{ $item['name'] }}">{{ $item['label'] }}:</label>
    <input name="{{ $item['name'] }}" type="file" class="form-control file_picture_one" id="{{ $item['name'] }}">
    @if(isset($item_model) && is_object($item_model)  )
        <p ><img class="image_preview" width="max-width:300px" src="{{  \App\Helper\Common::showThumb($folderUpload, $item_model->{$item['name']} ) }}" alt=""></p>
    @endif
</div>
