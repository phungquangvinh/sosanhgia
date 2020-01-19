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
				Danh Sách Banner
				<a href="add.php" class="btn btn-xs btn-primary pull-right">Thêm Mới</a>
			</h3>
		</div>
		<div class="panel-body">
			<form action="" method="GET" class="form-inline mg-bt-10">
				<select name="page" id="" class="form-control input-sm">
					<option value="">Trang</option>
					@foreach($page as $keyPage=>$valuePage)
						<option value="{{ $keyPage }}" {{ $keyPage==$searchPage ? "selected" : "" }}>{{ $valuePage }}</option>
					@endforeach
				</select>
				<select name="position" id="" class="form-control input-sm">
					<option value="">Vị Trí</option>
					@foreach($position as $keyPosition =>$valuePosition)
						<option value="{{ $keyPosition }}"  {{ $keyPosition==$searchPosition ? "selected" : "" }}>{{ $valuePosition }}</option>
					@endforeach
				</select>
				<button class="btn btn-primary btn-sm" type="submit" name="submit">Lọc</button>
				<button class="btn btn-danger btn-sm" type="submit" name="reset">Xóa điều kiện lọc</button>
			</form>
			<table class="table">
				<thead>
				<tr>
					<th width="1">ID</th>
					<th width="150">Name</th>
					<th width="200">Description</th>
					<th>Picture</th>
					<th>Picture Small</th>
					<th>Trang</th>
					<th>Vị Trí</th>
					<th>Active</th>
					<th>Sửa</th>
					<th>Xóa</th>
				</tr>
				</thead>
				<tbody>
				@foreach($showData as $key=>$value)
					<tr>
						<td>{{ $value->ban_id }}</td>
						<td>{{ $value->ban_name }}</td>
						<td>{{ $value->ban_description }}</td>
						<td>
							<img src="{{ parse_file_url($value->ban_picture) }}" alt="" ;">
						</td>
						<td>
							<img src="{{ parse_file_url($value->ban_picture_small) }}" alt="" ">
						</td>
						<td>
							@foreach($page as $keyPage=>$valuePage)
								{{ $value->page == $keyPage ? $valuePage : "" }}
							@endforeach
						</td>
						<td>
							@foreach($position as $keyPosition=>$valuePosition)
								{{ $value->position == $keyPosition ? $valuePosition : "" }}
							@endforeach
						</td>
						<td>
							@if($value->active == 1)
								<span class="label label-success">Active</span>
							@elseif($value->active == 0)
								<span class="label label-danger">Unactive</span>
							@endif
						</td>
						<td><a href="edit.php?id={{ $value->id }}" class="text-info"><i class="fa fa-edit"></i></a></td>
						<td><a href="delete.php?id={{ $value->id }}" class="text-danger js-action-delete"><i class="fa fa-trash"></i></a></td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="pull-right">
		{!! showPaginate($pageSize, $page_web, $totalPage, $_GET) !!}
	</div>

@stop
