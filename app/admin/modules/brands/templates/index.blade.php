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
                Brands
                <a href="brands_create.php" class="btn btn-sm btn-primary pull-right">Thêm hãng mới</a>
            </h4>
        </div>
        <div class="panel-body">
            <div class="pull-left">
                <form action="" method="GET" class="form form-inline" style="margin: 20px 0;">
                    <input type="text" name="id" class="form-control input-sm" placeholder="ID" value="{{ array_get($_GET, 'id') }}"/>
                    <input type="text" name="key" class="form-control input-sm" placeholder="Tên hãng" value="{{ isset($arrayOption['bra_name']) ? $arrayOption['bra_name'] : ''}}"/>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-search"></i> Tìm kiếm
                    </button>
                    <a href="brands_index.php" class="btn btn-danger btn-sm">Reset</a>
                </form>
            </div>
            <div class="pull-right">
                {!! showPaginate($pageSize, $page, $totalPage, $_GET) !!}
            </div>
            <table class="table table-hover table-stripped">
                <thead>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Logo</th>
                    <th>Nội dung</th>
                    <th>Create time</th>
                    <th>Updated time</th>
                    <th width="30">Sửa</th>
                    <th width="30">Xóa</th>
                </thead>
                <tbody>
                @if($listBrand)
                    @foreach($listBrand as $item)
                        <tr class="dataEach">
                            <td>{{$item->bra_id}}</td>
                            <td>{{$item->bra_name}}</td>
                            <td><img style="height: 50px" src="{{$item->getImgBrand()}}" alt="" title=""/></td>
                            <td>{{$item->bra_content}}</td>
                            <td style="font-size: 10px;">{{$item->bra_created_at}}</td>
                            <td style="font-size: 10px;">{{$item->bra_updated_at}}</td>
                            <td align="center">
                                <a href="brands_edit.php?id={{$item->bra_id}}" class="text-info"><i class="fa fa-edit"></i></a>
                            </td>
                            <td align="center">
                                <a href="brands_delete.php?id={{$item->bra_id}}" class="text-danger js-action-delete"><i class="fa fa-trash"></i></a>
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