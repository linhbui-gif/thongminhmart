@if (isset($item->{$itemField['name']}))
    <td>{{ \App\User::select('email')->where('id', $item->{$itemField['name']})->first()->email }}</td>
@else
    <td></td>
@endif
