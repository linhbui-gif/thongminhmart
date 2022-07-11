<div class="form-group">
    <label for="{{ $item['name'] }}">{{ $item['label'] }}:</label>
    <input value="{{ old($item['name'], @$item_model->{$item['name']} )  }}" name="{{ $item['name'] }}" type="number" class="form-control" id="{{ $item['name'] }}">
</div>
