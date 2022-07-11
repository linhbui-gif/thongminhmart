<div class="form-group">
    <label for="{{ $item['name'] }}">{{ $item['label'] }}:</label>
    <textarea name="{{ $item['name'] }}" id="ck_{{ $item['name'] }}" rows="10" cols="80">{{ old($item['name'], @$item_model->{$item['name']} )  }}</textarea>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( "ck_{{ $item['name'] }}" , options);
    </script>
</div>
