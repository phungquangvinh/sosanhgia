@extends ('master')

@section ('content')

<div class="panel panel-default">
	<div class="panel-heading">
		<h4>
			Danh sách ngôn ngữ
			<!-- <a href="lang_create.php" class="btn btn-sm btn-primary pull-right">Thêm mới</a> -->
		</h4>
	</div>

	<div class="panel-body">
		<form action="" class="form form-inline" style="margin-top: 5px;">
			<input type="text" value="{{isset($_GET['name']) ? $_GET['name'] :''}}" name="name" class="form-control input-sm" placeholder="Tìm kiếm ngôn ngữ" value="" />
            <input type="date" class="form-control input-sm" name="start">
            <span>-</span>
            <input type="date" class="form-control input-sm" name="end">
            <input type="hidden" name="action" value="filter">
            <button class="btn btn-primary btn-sm" type="submit">Tìm kiếm</button>
            <a href="tag_index.php" class="btn btn-danger btn-sm">Reset</a>
		</form>
		<br/>
		<table class="table table-hover table-stripped">
			<thead>
				<th>Id</th>
				<th>Name</th>
				<th>Name path</th>
				<th style="text-align: center">Images</th>
				<th>Domain</th>
				<th width="30">Edit</th>
                <th width="30">Delete</th>
			</thead>
			<tbody>
				@if($languages)
				@foreach($languages as $item)
				<tr class="dataEach">
					<td class="idLanguages">{{$item->lang_id}}</td>
					<td>{{$item->lang_name}}</td>
					<td>{{$item->lang_path}}</td>
					<td style="text-align: center">
						<img style="height: 50%" src="{{ parse_file_url('sm_'.$item->lang_image) }}" alt="">
					</td>
					<td>{{$item->lang_domain}}</td>
					<td>
                        <a href="lang_edit.php?id={{$item->lang_id}}" class="text-info"><i class="fa fa-edit"></i></a>
					</td>
					<td>
						<a href="lang_delete.php?id={{$item->lang_id}}" class="text-danger js-action-delete"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
        <div class="clearfix"></div>
	</div>
</div>

@stop