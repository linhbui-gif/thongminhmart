@php
    $user = Auth::user();
    $permissions = [];
    foreach ($user->roles as $role) {
        $tmp_permissions = json_decode($role->permissions, true);
        foreach ($tmp_permissions as $permission => $is) {
            $permissions[$permission] = $is;
        }
    }
    $quyen = $controller . ".active";

@endphp
@if(isset($permissions[$quyen]) && $permissions[$quyen] == true)
<div class="form-group">
    <label>{{ $item['label'] }}:</label>
     <div class="checkbox">
        <label><input @if(old($item['name'],@$item_model->{$item['name']} ) == "active") checked @endif name="{{ $item['name'] }}" value="active" class="minimal" type="checkbox"> {{ $item['label'] }}</label>
    </div>
</div>
@endif
