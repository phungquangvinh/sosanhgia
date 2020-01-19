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
                Danh sách tag
                <a href="tag_create.php" class="btn btn-sm btn-primary pull-right">Thêm mới</a>
            </h4>
        </div>
        <div class="panel-body">
            <form action="" method="GET" class="form form-inline" style="margin-bottom: 10px;">
                <input type="text" name="id" class="form-control input-sm" placeholder="ID" value="{{ array_get($_GET, 'id') }}"/>
                <input type="text" name="key" class="form-control input-sm" placeholder="Tag" value="{{ isset($arrayOption['tag_name']) ? $arrayOption['tag_name'] : ''}}"/>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-search"></i> Tìm kiếm
                </button>
                <a href="tag_index.php" class="btn btn-danger btn-sm">Reset</a>
            </form>
            <br/>
            <table class="table table-hover table-stripped">
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Meta title</th>
                    <th>Meta keywords</th>
                    <th>Meta description</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th width="30">Edit</th>
                    <th width="30">Delete</th>
                </thead>
                <tbody>
                    @if($listTags)
                    @foreach($listTags as $item)
                    <tr class="dataEach">
                        <td class="idTags">{{$item->tag_id}}</td>
                        <td>{{$item->tag_name}}</td>
                        <td>{{$item->tag_slug}}</td>
                        <td>{{$item->tag_meta_title}}</td>
                        <td>{{$item->tag_meta_keywords}}</td>
                        <td>{{$item->tag_meta_description}}</td>
                        <td><span style="font-size: 10px;">{{$item->tag_created_at}}</span></td>
                        <td><span style="font-size: 10px;">{{ $item->tag_updated_at }}</span></td>
                        <td>
                            <a href="tag_edit.php?id={{$item->tag_id}}" class="text-info"><i class="fa fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="tag_delete.php?id={{$item->tag_id}}" class="text-danger js-action-delete"><i class="fa fa-trash"></i></a>
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
