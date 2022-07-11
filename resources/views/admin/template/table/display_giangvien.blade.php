

@php
    $v = $item->of_giangvien;
@endphp

@if($v)
    <td>{{ $v->fullName() }}</td>
@else
    <td><span class="label label-danger">Chưa rõ</span>̃</td>
@endif
