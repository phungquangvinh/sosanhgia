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
                Danh sách ảnh của sản phẩm
                <a href="prim_create.php" class="btn btn-sm btn-primary pull-right">Thêm mới</a>
            </h4>
        </div>
        <div class="panel-body">
            <div class="pull-left">
            <form action="" method="GET" class="form form-inline" style="margin: 20px 0;">
                <input type="text" name="key" class="form-control input-sm" placeholder="Tên sản phẩm" value="{{ isset($arrayOption['pro_name']) ? $arrayOption['pro_name'] : ''}}"/>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-search"></i> Search
                </button>
                <a href="prim_index.php" class="btn btn-danger btn-sm">Reset</a>
            </form>
            </div>
            <div class="pull-right">
                {!! showPaginate($pageSize, $page, $totalPage, $_GET) !!}
            </div>
            <table class="table table-hover table-stripped">
                <thead>
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th>Ảnh</th>
                    <th width="30">Edit</th>
                    <th width="30">Delete</th>
                </thead>
                <tbody>
                    @if($productImages)
                        @foreach($productImages as $item)
                            <tr class="dataEach">
                                <td>{{$item->prim_id}}</td>
                                <td>{{$item->pro_name}}</td>
{{--                                <td style=" max-width:200px"><img style="height: 80px" src="{{$item->getImgProduct()}}" alt="" title=""/></td>--}}
                                <td style=" max-width:200px"><img style="height: 80px" src="{{parse_image('product_images', 'default', array_reverse(json_decode($item->prim_name, 1))[0])}}" alt="" title=""/></td>
                                <td>
                                    <a href="prim_edit.php?id={{$item->prim_id}}" class="text-info"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="prim_delete.php?id={{$item->prim_id}}" class="text-danger js-action-delete"><i class="fa fa-trash"></i></a>
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