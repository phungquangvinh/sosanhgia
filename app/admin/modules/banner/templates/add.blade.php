@extends('master')

@section('content')
	<style>
		#image{
			width: 28%;
		}
		#image img{
			width: 100%;
			height: 170px;
		}
		#image_small{
			width: 28%;
		}
		#image_small img{
			width: 100%;
			height: 170px;
		}
		.clear{
			clear: both;
		}

	</style>
	<div class="panel">
		<div class="panel-heading">
			<h3 class="text-center">Thêm mới banner</h3>
		</div>
		<div class="panel-body">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name">
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<input type="text" class="form-control" name="description">
				</div>
				<div class="form-group">
					<label for="picture">Picture</label>
					<input type="file" class="form-control" name="picture" id="uploadImg">
					<div class="form-group col-sm-12 row " id="image">

					</div>
				</div>
				<div class="clear"></div>
				<div class="form-group">
					<label for="picture_small">Picture Small</label>
					<input type="file" class="form-control" name="picture_small" id="uploadFile" >
					<div class="form-group col-sm-12 row " id="image_small">

					</div>
				</div>
				<div class="clear"></div>
				<div class="form-group">
					<label for="page">Page</label>
					<select name="page" id="page" class="form-control">
						@foreach($page as $key=>$value)
							<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="position">Position</label>
					<select name="position" id="position" class="form-control">
						@foreach($position as $key=>$value)
							<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="active">Active</label>
					<select name="active" id="active" class="form-control">
						@foreach($active as $key=>$value)
							<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<button class="btn btn-primary" type="submit" name="submit">Thêm Mới</button>
			</form>
		</div>
	</div>

	<script type="text/javascript">
		$("#uploadFile").change(function () {
			$('#image_small').html("");
			var total_file = document.getElementById("uploadFile").files.length;
			for (var i = 0; i < total_file; i++) {
				$('#image_small').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'>");
			}
		});

		$("#uploadImg").change(function () {
			$('#image').html("");
			var total_file = document.getElementById("uploadImg").files.length;
			for (var i = 0; i < total_file; i++) {
				$('#image').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'>");
			}
		});
	</script>


@stop