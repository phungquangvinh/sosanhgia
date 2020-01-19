@extends('master')

@section('content')
<style>
    .dots{
        color: red;
    }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>
            Danh Sách Bài Viết
            <a href="pos_create.php" class="btn btn-sm btn-primary pull-right">Thêm mới</a>
        </h4>
    </div>

    <div class="panel-body">
        <div class="pull-left">
            <form action="" method="GET" class="form form-inline" style="margin: 20px 0;">
                <input type="text" name="id" class="form-control input-sm" placeholder="ID" value="{{ array_get($_GET, 'id') }}"/>
                <input type="text" name="key" class="form-control input-sm" placeholder="Tìm kiếm tiêu đề" value="{{ isset($arrayOption['pos_title']) ? $arrayOption['pos_title'] : ''}}"/>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-search"></i> Tìm kiếm
                </button>
                <a href="pos_index.php" class="btn btn-danger btn-sm">Reset</a>
            </form>
        </div>
        <div class="pull-right">
            {!! showPaginate($pageSize, $page, $totalPage, $_GET) !!}
        </div>
        <table class="table table-hover table-stripped">
            <thead>
            <th width="1">ID</th>
            <th width="100">Title</th>
            <th>Image</th>
            <th>Category</th>
            <th>Author</th>
            <th>Status</th>
            <th width="80">Tạo vào ngày</th>
            <th width="80">Cập nhật<br> vào ngày</th>
            <th width="30">Sửa</th>
            <th width="30">Xóa</th>
            </thead>
            <tbody>
            @if($listPost)
                @foreach($listPost as $item)
                    <tr class="dataEach">
                        <td>{{$item->pos_id}}</td>
                        <td>{{$item->pos_title}}</td>
                        <td><img src="{{$item->getImgPost()}}" style="height: 80px;width: 80px;object-fit: cover;"></td>
                        <td>{{$item->cat_name}}</td>
                        <td>{{$item->adm_name}}</td>
                        <td> <?php if ($item->pos_active == 1){ ?>
                            <span class="label label-success" onclick="return selectId({{$item->pos_id}})">Activated</span>
                            <?php }else{  ?>
                            <span class="label label-danger" onclick="return selectId({{$item->pos_id}})">Deactivated</span>
                            <?php } ?>
                        </td>
                        <td style="font-size: 10px;">{{$item->pos_created_at}}</td>
                        <td style="font-size: 10px;">{{$item->pos_updated_at}}</td>
                        <td align="center">
                            <a href="pos_edit.php?id={{ $item->pos_id }}" class="text-info"><i class="fa fa-edit"></i></a>
                        </td>
                        <td align="center">
                            <a href="pos_delete.php?id={{ $item->pos_id }}" class="text-danger js-action-delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>

                @endforeach
            @endif
            </tbody>
        </table>
        <div class="pull-right">
            {!! showPaginate($pageSize, $page, $totalPage, $_GET) !!}
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@stop

<script>
    function selectId(id) {
        $.ajax({
            url: './pos_active.php',
            type: 'GET',
            data: {
                id: id,
            }
        }).done(function (data) {

        });
        location.reload();
        return false;
    };
</script>