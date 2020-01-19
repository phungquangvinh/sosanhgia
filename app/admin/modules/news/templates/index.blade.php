@extends('master')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h4>
			Danh sách tin tức
			<a href="nes_create.php" class="btn btn-sm btn-primary pull-right">Thêm mới</a>
		</h4>
	</div>

	<div class="panel-body">
		<form action="" class="form form-inline" style="margin-top: 5px;">

			<input type="text" value="{{isset($_GET['name']) ? $_GET['name'] :''}}" name="name" class="form-control input-sm" placeholder="Tìm kiếm tin tức" value="" />
			<input type="date" class="form-control input-sm" name="start">
			<span>-</span>
			<input type="date" class="form-control input-sm" name="end">
			<input type="hidden" name="action" value="filter">
			<button class="btn btn-primary btn-sm" type="submit">Tìm kiếm</button>
			<a href="nes_index.php" class="btn btn-danger btn-sm">Reset</a>
		</form>
		<br/>
		<table class="table table-hover table-stripped">
			<thead>
				<th>Id</th>
				<th>Tiêu đề</th>
				<th>Mô tả</th>
				<th>Nội dung</th>
				<th style="text-align: center">Ảnh</th>
				<th>Thể loại danh mục</th>
				<th>Tác giả</th>
				<th>Trạng thái</th>
				<th>Created at</th>
				<th>Updated at</th>
				<th width="30">Edit</th>
				<th width="30">Delete</th>
			</thead>
			<tbody>
				@if($dataTable)
					@foreach($dataTable as $item)
						<tr class="dataEach">
							<td class="idProduct">{{$item->nes_id}}</td>
							<td>
								<div style="max-width:200px;">{{$item->nes_title}}</div>
							</td>
							<td style="max-width:200px; height: 83px; overflow: hidden">{{$item->nes_description}}</td>
							<td>
								<div style="max-width:200px;height: 83px; overflow: hidden">{{$item->nes_content}}</div></td>
							<td style="text-align: center">
								<img src="{{ parse_image('news', 'default', $item->nes_image) }}" style="height: 80px;width: 80px;object-fit: cover;">
							</td>
							<td>{{$item->nes_type_id}}</td>
							<td>{{$item->nes_author_id}}</td>
							<td> <?php if ($item->nes_active == 1){ ?>
								<span class="label label-success" onclick="return selectId({{$item->nes_id}})">Activated</span>
								<?php }else{  ?>
		                            <span class="label label-danger" onclick="return selectId({{$item->nes_id}})">Deactivated</span>
		                        <?php } ?>
							</td>
							<td><span style="font-size: 10px;">{{ date('d-m-Y', $item->nes_create_time)}}</span></td>
							<td><span style="font-size: 10px;">{{ $item->nes_update_time ? date('d-m-Y', $item->nes_update_time) : "" }}</span></td>
							<td>
								<a href="nes_edit.php?id={{$item->nes_id}}" class="text-info"><i class="fa fa-edit"></i></a>
							</td>
							<td>
								<a href="nes_delete.php?id={{$item->nes_id}}" class="text-danger js-action-delete"><i class="fa fa-trash"></i></a>
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
				url: './tag_active.php',
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