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
                Danh sách Menu
                <a href="menu_create.php" class="btn btn-sm btn-primary pull-right">Thêm menu mới</a>
            </h4>
        </div>
        <div class="panel-body">
            <div class="pull-left">
                <form action="" method="GET" class="form form-inline" style="margin: 20px 0;">
                    <input type="text" name="id" class="form-control input-sm" placeholder="ID" value="{{ array_get($_GET, 'id') }}"/>
                    <input type="text" name="key" class="form-control input-sm" placeholder="Tên cửa hàng" value="{{ isset($arrayOption['ue_name']) ? $arrayOption['ue_name'] : ''}}"/>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-search"></i> Tìm kiếm
                    </button>
                    <a href="ue_index.php" class="btn btn-danger btn-sm">Reset</a>
                </form>
            </div>
            <table class="table table-hover table-stripped">
                <thead>
                    <th>ID</th>
                    <th>Menu</th>
                    <th>Icon</th>
                    <th>Ghi chú</th>
                    <th>Link</th>
                    <th>Tạo vào ngày</th>
                    <th>Cập nhật vào ngày</th>
                    <th width="30">Sửa</th>
                    <th width="30">Xóa</th>
                </thead>
                <tbody>
                    @if($listMenu)
                        @foreach($listMenu as $item)
                            <tr class="dataEach">
                                <td>{{$item->menu_id}}</td>
                                <td>{{$item->menu_name}}</td>
                                <td><img height="35" src="{{$item->getImgMenu()}}" alt="" title=""/></td>
                                <td>{{$item->menu_description}}</td>
                                <td><a href="http://{{$item->menu_link}}" target="_blank">{{$item->menu_link}}</a></td>
                                <td>{{$item->menu_created_time}}</td>
                                <td>{{$item->menu_updated_time}}</td>
                                <td align="center">
                                    <a href="menu_edit.php?id={{$item->menu_id}}" class="text-info"><i class="fa fa-edit"></i></a>
                                </td>
                                <td align="center">
                                    <a href="menu_delete.php?id={{$item->menu_id}}" class="text-danger js-action-delete"><i class="fa fa-trash"></i></a>
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