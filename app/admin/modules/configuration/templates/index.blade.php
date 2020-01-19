@extends('master')

@section('content')
    <style>
        img{
            height: 80px;
            width: 80px;
            object-fit: cover;
        }
    </style>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>
                Danh Sách
                <a href="con_create.php" class="btn btn-xs btn-primary pull-right">Thêm Mới</a>
            </h3>
        </div>
        <div class="panel-body">

            <table class="table">
                <thead>
                <tr>
                    <th width="150">Admin Email</th>
                    <th width="200">Address</th>
                    <th>Hotline</th>
                    <th>Logo Top</th>
                    <th>Logo Bottom</th>
                    <th>Facebook</th>
                    <th>Twitter</th>
                    <th>Youtube</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                @foreach($configuration as $key=>$value)
                    <tr>
                        <td>{{ $value->admin_email }}</td>
                        <td>{{ $value->address }}</td>
                        <td>{{ $value->hotline }}</td>
                        <td>
                            <img src="{{ parse_file_url($value->logo_top) }}" alt="" ">
                        </td>
                        <td>
                            <img src="{{ parse_file_url($value->logo_bottom) }}" alt="" ">
                        </td>
                        <td>{{ $value->facebook }}</td>
                        <td>{{ $value->twitter }}</td>
                        <td>{{ $value->youtube }}</td>

                        <td><a href="con_edit.php?id={{ $value->id }}" class="text-info"><i class="fa fa-edit"></i></a></td>
                        <td><a href="con_delete.php?id={{ $value->id }}" class="text-danger js-action-delete"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="pull-right">
        {!! showPaginate($pageSize, $page, $totalPage, $_GET) !!}
    </div>

@stop
