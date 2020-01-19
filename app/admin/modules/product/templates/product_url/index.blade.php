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
            Danh Sách Sản Phẩm
        </h4>
    </div>

    <div class="panel-body">
        <form action="" class="form form-inline" style="margin-top: 5px;">
            <input type="text" name="id" class="form-control input-sm" placeholder="ID" value="{{ array_get($_GET, 'id') }}"/>

            <input type="text" name="key" class="form-control input-sm" placeholder="Tìm tên sản phẩm" value="{{ isset($arrayOption['pro_name']) ? $arrayOption['pro_name'] : ''}}"/>

            <select class="form-control input-sm" name="category">
                <option value="">Tìm theo danh mục</option>
                @foreach($categories as $itemCat)
                    <option value="{{ $itemCat->cat_id }}"> {{ (isset($arrayOption['pro_category_id']) && $itemCat->cat_id == intval($arrayOption['pro_category_id']) ) ? 'selected' : ''}}><?php for($i = 0; $i < $itemCat->level; $i ++) echo '|__'; ?>{{ $itemCat->cat_name }}</option>
                @endforeach
            </select>


            <button class="btn btn-primary btn-sm" type="submit">Lọc</button>
            <a href="product_index.php" class="btn btn-danger btn-sm">Reset</a>
            <a href="javascript:;" id="export" class="btn btn-sm btn-success">Xuất <i class="fa fa-file-excel-o"></i></a>
            <a href="javascript:;" id="import" class="btn btn-sm btn-warning">Nhập <i class="fa fa-file-excel-o"></i></a>
        </form>
        <br/>
        <table class="table table-hover table-stripped">
            <thead>
            <th width="10">ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Hãng</th>
            <th>Danh mục</th>
            <th style="text-align: center">Ảnh bìa</th>
            <th>Ảnh sản phẩm</th>
            <th width="80">Tạo vào ngày</th>
            <th width="80">Cập nhật vào ngày</th>
            <th width="30">Sửa</th>
            <th width="30">Xóa</th>
            </thead>
            <tbody>
            @if($listProduct)
                @foreach($listProduct as $item)
                    <tr class="dataEach">
                        <td class="idProduct">{{ $item->pro_id }}</td>
                        <td>
                            <div style="max-width:150px;">{{ $item->pro_name }}</div>
                        </td>
                        <td>{{ formatCurrency($item->pro_price) }}</td>
                        <td><b>#{{ $item->bra_id }}</b>. {{ $item->bra_name }}</td>
                        <td><b>#{{ $item->cat_id }}</b>. {{ $item->cat_name }}</td>
                        <td align="center"><img style="height: 50px" src="{{ parse_image('products', 'default', $item->pro_image) }}" alt="" title=""/></td>
                        <td align="center"><img style="height: 50px" src="{{parse_image('products', 'default', array_reverse(json_decode($item->pro_list_image, 1))[0])}}" alt="" title=""/></td>
                        <td><span style="font-size: 10px;">{{ $item->created_at }}</span></td>
                        <td><span style="font-size: 10px;">{{ $item->updated_at }}</span></td>
                        <td align="center">
                            <a href="product_edit.php?id={{ $item->pro_id }}" class="text-info"><i class="fa fa-edit"></i></a>
                        </td>
                        <td align="center">
                            <a href="product_delete.php?id={{ $item->pro_id }}" class="text-danger js-action-delete"><i class="fa fa-trash"></i></a>
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

<!-- modal keyword -->
@include('product_url/modal_keyword')

<!-- end modal keyword -->
@include('product_url/modal_export')

@include('product_url/modal_import')

<script>
    $(document).ready(function(){
        $(".showModalkeyword").click(function(){
            var dataKeyword = $(this).parents(".keyword").find(".dataKeyword").html();
            var idProduct = $(this).parents(".dataEach").find(".idProduct").html();
            $("#valueID").val(idProduct);
            $("#valueKeyword").val(dataKeyword);
            $('#type').val("keyword");

            $("#myModal").modal('show');

            $("#submit").click(function(){
                var valueIdproduct =$("#valueID").val();
                var valueDatakeyword = $("#valueKeyword").val();
                var valueType = $("#type").val();
                 $.ajax({
                    url: 'product_index.php',
                    type: 'POST',
                    data : {
                        valueIdproduct : valueIdproduct,
                        valueDatakeyword : valueDatakeyword,
                        valueType : valueType
                    }
                }).done(function(){
                    window.location.reload(true);
                });
            });

        });

        $(".showModalkeywordIgnore").click(function(){
            $dataKeywordignore = $(this).parents(".keywordIgnore").find(".dataKeywordignore").html();
            $idProduct = $(this).parents(".dataEach").find(".idProduct").html();
            $("#valueID").val($idProduct);
            $("#valueKeyword").val($dataKeywordignore);
            $('#type').val("keywordIgnore");

            $("#myModal").modal('show');

            $("#submit").click(function(){
                var valueIdproduct =$("#valueID").val();
                var valueDatakeyword = $("#valueKeyword").val();
                var valueType = $("#type").val();
                 $.ajax({
                    url: 'product_index.php',
                    type: 'POST',
                    data : {
                        valueIdproduct : valueIdproduct,
                        valueDatakeyword : valueDatakeyword,
                        valueType : valueType
                    }
                }).done(function(){
                    window.location.reload(true);
                });
            });
        });

        $('#export').click(function(e) {
            e.preventDefault();
            $('#myModalExportExcel').modal('show');
        });

        $('#import').click(function(e) {
            e.preventDefault();
            $('#myModalImportExcel').modal('show');
        });
    });
</script>


@stop
