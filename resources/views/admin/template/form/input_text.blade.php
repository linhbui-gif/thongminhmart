<div class="form-group">
    <label for="{{ $item['name'] }}">{{ $item['label'] }}:</label>
    <input value="{{ old($item['name'], @$item_model->{$item['name']} )  }}" name="{{ $item['name'] }}" type="text" class="form-control" id="{{ $item['name'] }}">
</div>
