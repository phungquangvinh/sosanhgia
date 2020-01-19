@extends('master')

@section('content')
	<link rel="stylesheet" href="/assets/css/admin_template.css">
    <link rel="stylesheet" href="/assets/css/select2.min.css">
    @php
        function bts_er($errors, $name)
        {
            return array_get($errors, $name) ? 'has-error' : '';
        }
    @endphp
    @if(isset($error))
        <div class="alert alert-danger">
            <strong>Lỗi! </strong>{{$error}}
        </div>
    @endif

    <div class="panel panel-default" style="margin-left: 10px;margin-right: 10px">
    	<div class="panel-heading">
            <h3>
                Thêm
                <a href="lang_index.php" class="btn btn-sm btn-default pull-right">Hủy</a>
            </h3>
        </div>
        <div class="panel-body">
			<form action="" method="POST" role="form" enctype="multipart/form-data">
				<div role="tabpanel">
					<div class="tab-content">
						<div class="row">
							<div class="col-sm-8">
								<div class="form-group col-sm-12 {{bts_er($errors, 'lang_name')}}">
                                    <label for="">Tên <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="lang_name"
                                           value="{{ array_get($oldInputs, 'lang_name') }}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'lang_name.0') }}</span>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'lang_path')}}">
                                    <label for="">Tên viết tắt <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="lang_path"
                                           value="{{ array_get($oldInputs, 'lang_path') }}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'lang_path.0') }}</span>
                                </div>
                                <!-- <div class="form-group col-sm-12 {{bts_er($errors, 'lang_image')}}">
                                    <label for="">Ảnh <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="lang_image"
                                           value="{{ array_get($oldInputs, 'lang_image') }}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'lang_image.0') }}</span>
                                </div> -->
                                <div class="col-sm-12 img-css {{bts_er($errors, 'lang_image')}}">
                                    <label for="name" style="font-size: 14px;">Ảnh <b id="bt_red">( * )</b></label>
                                    <input id="picture" type="file" value="{{ array_get($oldInputs, 'lang_image') }}" name="lang_image" class="form-control">
                                    <span class="help-block text-danger">{{ array_get($errors, 'lang_image.0') }}</span>
                                    <div id="show-img">
                                        <img src="" alt="" width="250px" id="show_photo" style="margin-top:10px">
                                    </div>
                                </div>

                                <div class="form-group col-sm-12 {{bts_er($errors, 'lang_domain')}}">
                                    <label for="">Tên gốc <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="lang_domain"
                                           value="{{ array_get($oldInputs, 'lang_domain') }}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'lang_domain.0') }}</span>
                                </div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" value="" name="">
                <input type="hidden" name="action" value="add">
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
			</form>
        </div>
    </div>

    <script src="/assets/js/admin_template.js" type="text/javascript"></script>
    <script src="/assets/js/select2.min.js" type="text/javascript"></script>
    <script>
        $('#picture').on('change', function () {
            var fileInput = this;
            // console.log(fileInput.files[0]);
            if (fileInput.files[0]){
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_photo').attr('src', e.target.result);
                };
                reader.readAsDataURL(fileInput.files[0]);
            }

        });
    </script>
@stop