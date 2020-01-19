@extends('master')

@section('content')
	<style type="text/css" media="screen">
		.show-img{
			width: 25%;
			position: relative;
		}
		.item_img{
			position: relative;
		}
		.show-img img{
			width: 100%;
			height: 165px;
		}
		.image_preview img{
			width: 100%;
			height: 165px;
		}
		.image_preview{
			width: 25%;
			position: relative;
		}
		.remove_img_preview {
			position: absolute;
			top: -10px;
			right: -10px;
			width: 20px;
			height: 20px;
			background: #000;
			border-radius: 50%;
			text-align: center;
			line-height: 20px;
			color: #fff;
			font-size: 10px;
			font-weight: bold;
			cursor: pointer;
		}



		.item_img {
			margin-bottom: 0;
			margin-top: 10px;
		}
	</style>
	<div class="panel">
		<div class="panel-heading">
			<h3>Cập nhật banner</h3>
		</div>
		<div class="panel-body">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" value="{{ $dataEdit->name }}">
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<input type="text" class="form-control" name="description" value="{{ $dataEdit->description }}">
				</div>

				<div class="form-group">
					<label for="picture">Picture</label>
					<div class="show-img">
						<div class="item_img">
							<img src="{{ parse_file_url($dataEdit->picture) }}" alt=""  id="img-upload" >
							<span class="remove_img_preview">X</span>
						</div>
					</div>
					<input type="file" class="form-control" name="picture" id="uploadImg">
				</div>
				<div class="form-group">
					<label for="picture_small">Picture Small</label>
					<div class="image_preview">
						<div class="item_img">
							<img src="{{ parse_file_url($dataEdit->picture_small) }}" alt="" >
							<span class="remove_img_preview">X</span>
						</div>
					</div>
					<input type="file" class="form-control" name="picture_small" id="uploadFile">
				</div>
				<div class="form-group">
					<label for="page">Page</label>
					<select name="page" id="" class="form-control">
						@foreach($page as $key=>$value)
							<option value="{{ $key }}" {{ $key == $dataEdit->page ? 'selected': '' }} >{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="position">Position</label>
					<select name="position" id="" class="form-control">
						@foreach($position as $key=>$value)
							<option value="{{ $key }}" {{ $key == $dataEdit->position ? 'selected' : '' }}>{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="active">Active</label>
					<select name="active" id="" class="form-control">
						@foreach($active as $key=>$value)
							<option value="{{ $key }}" {{ $key == $dataEdit->active ? 'selected' : '' }}>{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<button class="btn btn-primary" name="submit" type="submit">Cập Nhật</button>
			</form>
		</div>
	</div>


	<script type="text/javascript">
		$('.remove_img_preview').click(function (event) {
			if (confirm('Bạn có chắc muốn xóa ảnh này')) {
				var img = $(this).parent();
				var imgName = img.attr('data-name');
				// console.log(imgName);
				var id = img.attr('data-id');
				$.ajax({
					url: 'ajax_delete_img_item.php',
					type: 'POST',
					dataType: 'JSON',
					data: {
						'id': id,
						'imgName': imgName,
					},
					asyc: true,
					success: function (result) {
						img.remove();

					}
				});
			}

		});


		$("#uploadFile").change(function () {
			$('.image_preview').html("");
			var total_file = document.getElementById("uploadFile").files.length;
			for (var i = 0; i < total_file; i++) {
				$('.image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'>");
			}
		});

		$("#uploadImg").change(function () {
			$('.show-img').html("");
			var total_file = document.getElementById("uploadImg").files.length;
			for (var i = 0; i < total_file; i++) {
				$('.show-img').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'>");
			}
		});
	</script>

@stop

