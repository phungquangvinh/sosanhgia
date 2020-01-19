@extends ('master')

@section ('content')
    <style>
        .dots{
            color: red;
        }
    </style>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                Danh sách gian hàng sản phẩm
                <a href="pres_create.php" class="btn btn-sm btn-primary pull-right">Thêm mới</a>
            </h4>
        </div>
        <div class="panel-body">
            <div class="pull-left">
                <form action="" method="GET" class="form form-inline" style="margin-bottom: 10px;">
                    <input type="text" name="id" class="form-control input-sm" placeholder="ID" value="{{ array_get($_GET, 'id') }}"/>
                    <input type="text" name="key1" class="form-control input-sm" placeholder="Tên sản phẩm" value="{{ isset($arrayOption['pro_name']) ? $arrayOption['pro_name'] : ''}}"/>
                    <input type="text" name="key2" class="form-control input-sm" placeholder="Tên cửa hàng" value="{{ isset($arrayOption['ue_name']) ? $arrayOption['ue_name'] : ''}}"/>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-search"></i> Tìm kiếm
                    </button>
                    <a href="pres_index.php" class="btn btn-danger btn-sm">Reset</a>
                </form>
            </div>
            <div class="pull-right">
                {!! showPaginate($pageSize, $page, $totalPage, $_GET) !!}
            </div>
            <table class="table table-hover table-stripped">
                <thead>
                    <th>ID</th>
                    <th width="100">Sản phẩm</th>
                    <th>Cửa hàng</th>
                    <th>Giá cửa hàng</th>
                    <th width="400">Link</th>
                    <th align="center">Đánh giá</th>
                    <th width="80">Tạo vào ngày</th>
                    <th width="80">Cập nhật vào ngày</th>
                    <th width="30">Sửa</th>
                    <th width="30">Xóa</th>
                </thead>
                <tbody>
                @if($listProductEstore)
                    @foreach($listProductEstore as $item)
                        <tr class="dataEach">
                            <td>{{$item->pres_id}}</td>
                            <td>{{$item->pro_name}}</td>
                            <td>{{$item->ue_name}}</td>
                            <td>{{$item->pres_price}}đ</td>
                            <td>{{$item->pres_link}}</td>
                            <td align="center">{{$item->pres_rate}}/5</td>
                            <td style="font-size: 10px;">{{$item->pres_create_time}}</td>
                            <td style="font-size: 10px;">{{$item->pres_update_time}}</td>
                            <td align="center">
                                <a href="pres_edit.php?id={{$item->pres_id}}" class="text-info"><i class="fa fa-edit"></i></a>
                            </td>
                            <td align="center">
                                <a href="pres_delete.php?id={{$item->pres_id}}" class="text-danger js-action-delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
            <div class="pull-right">
                {!! showPaginate($pageSize, $page, $totalPage, $_GET) !!}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@stop
