<div class="el-button-group">
    <a href="{{ route('admin.'.$controllerName.'.edit', ['id' => $id] )  }}" class="el-button el-button--default el-button--mini"><span><i class="fa fa-pencil"></i></span></a>
    <a href="javascript:deleteAction('{{ route('admin.' . $controllerName . ".destroy", ['id' => $id])  }}')" class="el-button el-button--danger el-button--mini"><span><i class="fa fa-trash"></i></span></a>
</div>
