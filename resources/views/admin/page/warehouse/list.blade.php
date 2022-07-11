<table class="table table-hover">
    <thead>
    <tr>
        <th><input class="minimal" type="checkbox" id="check-all"></th>
        <th>Tên kho</th>
        <th>Địa chỉ</th>
        <th>Trạng thái</th>
    </tr>
    </thead>
    <tbody>
    @if($items->count() > 0)
        @foreach($items as $k => $item)
            @php
                $id = $item->id;
                $user = $item->user;
            @endphp
            <tr>
                <td><input name="cid[]" value="{{ $id }}" class="minimal" type="checkbox"></td>
                <td><a href="{{ route('admin.'.$controllerName.'.edit', ['id' => $id] )  }}">{{ $item->name }}</a></td>
                <td>{{ $item->address }}</td>
                @include('admin.template.table.td_status', [
                    'itemField' => [ 'name' => 'status' ],
                    'item' => $item
                ])
                <td>
                    <div class="el-button-group">
                        <a href="{{ route('admin.'.$controllerName.'.edit', ['id' => $id] )  }}" class="el-button el-button--default el-button--mini"><span><i class="fa fa-pencil"></i></span></a>
                        <a href="javascript:deleteAction('{{ route('admin.' . $controllerName . ".destroy", ['id' => $id])  }}')" class="el-button el-button--danger el-button--mini"><span><i class="fa fa-trash"></i></span></a>
                    </div>
                </td>
            </tr>
        @endforeach
    @endif


    </tbody>
</table>
