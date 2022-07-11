<table class="table table-hover">
    <thead>
        <tr>
            <th><input class="minimal" type="checkbox" id="check-all"></th>
            @foreach ($listFields as $k => $itemField)
                @if ($itemField['type'] == 'custom')
                    <th>Trả lời</th>
                @else
                    <th>{{ $itemField['label'] }}</th>
                @endif

            @endforeach
        </tr>
    </thead>
    <tbody>
        @if ($items->count() > 0)
            @foreach ($items as $k => $item)
                @php
                    $id = $item->id;
                @endphp
                <tr>
                    <td><input name="cid[]" value="{{ $id }}" class="minimal" type="checkbox"></td>
                    @foreach ($listFields as $k => $itemField)
                        @switch ($itemField['type'])
                            @case('text')
                                @include ("admin.template.table.td_text")
                            @break
                            @case('status')
                                @include ("admin.template.table.td_status")
                            @break
                            @case('thumb')
                                @include ("admin.template.table.td_thumb")
                            @break
                            @case('datetime')
                                @include ("admin.template.table.td_datetime")
                            @break
                            @case('input_ordering')
                                @include ("admin.template.table.input_ordering")
                            @break
                            @case('text_in_array')
                                @include ("admin.template.table.td_text_in_array")
                            @break
                            @case('text_foreign')
                                @include ("admin.template.table.td_text_foreign")
                            @break
                            @case('custom')
                                <td>
                                    @if (empty($item['answer']))
                                        <span class="label label-danger">Chưa trả lời</span>
                                    @else
                                        <span class="label label-success">Đã trả lời</span>
                                    @endif
                                </td>

                            @break
                        @endswitch
                    @endforeach
                    <td>@include("admin.template.action")</td>
                </tr>
            @endforeach
        @else

        @endif
    </tbody>
</table>
