<div class="form-group">
    <label for="{{ $item['name'] }}">{{ $item['label'] }}:</label>
    <textarea class="form-control" name="{{ $item['name'] }}" id="{{ $item['name'] }}" rows="3" cols="80">{{ old($item['name'], @$item_model->{$item['name']} )  }}</textarea>
</div>
