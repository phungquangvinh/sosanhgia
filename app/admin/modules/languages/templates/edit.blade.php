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
                Cập nhật ngôn ngữ
                <a href="lang_index.php" class="btn btn-sm btn-default pull-right">Huỷ</a>
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
                                           value="{{$dataUpdate->lang_name}}" >
                                    <span class="help-block text-danger">{{ array_get($errors, 'lang_name.0') }}</span>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'lang_path')}}">
                                    <label for="">Tên viết tắt <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="lang_path"
                                           value="{{$dataUpdate->lang_path}}" >
                                    <span class="help-block text-danger">{{ array_get($errors, 'lang_path.0') }}</span>
                                </div>
                                <div class="col-sm-12 img-css {{bts_er($errors, 'lang_image')}}">
                                    <label for="name" style="font-size: 14px;">Ảnh <b id="bt_red">( * )</b></label>
                                    <input id="picture" type="file" value="{{ array_get($oldInputs, 'lang_image') }}"
                                           name="lang_image" class="form-control">
                                    <div id="show-img" class="show_image_product">
                                        <img src="{{ parse_file_url('md_'.$row->lang_image) }}" alt="" width="50%" id="show_image" style="margin-top:10px">
                                    </div>
                                    <span class="help-block text-danger">{{ array_get($errors, 'lang_image.0') }}</span>
                                    <br>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'lang_domain')}}">
                                    <label for="">Tên gốc <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="lang_domain"
                                           value="{{$dataUpdate->lang_domain}}" >
                                    <span class="help-block text-danger">{{ array_get($errors, 'lang_domain.0') }}</span>
                                </div>
							</div>
						</div>
        			</div>
				</div>
				<input type="hidden" value="" name="">
                <input type="hidden" name="action" value="edit">
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
        	</form>
        </div>
	</div>

    <script>
        var configElement = {
            eInputFile: "pro_image",
            eBoximg: "show_image_product",
            eInputTagInsert: 'tags'
        };
        (function(){
            $('.'+configElement.eBoximg).click(function () {
                $('.'+configElement.eInputFile).trigger('click');
            });
            $('.'+configElement.eInputFile).change(function(){
                readURL(this, '#show_image');
            });
            showImgDefault('#show_image');
            $('#'+configElement.eInputTagInsert).tagsInput({
                'autocomplete_url': 'ajax.php',
                'placeholderColor' : '#666666',
                'width':'100%',
                'defaultText':'',
                'delimiter': '_-_',
                'autocomplete':{
                    source: function(request, response) {
                        $.ajax({
                            url: "ajax.php",
                            dataType: "json",
                            data: {
                                postalcode_startsWith: request.term
                            },
                            success: function(data) {
                                response( $.map( data.tag, function( item ) {
                                    return {
                                        label: item.tag_name
                                        //value: item.tag_id
                                    }
                                }));
                            }
                        })
                    }
                }
            });
        })();

    </script>
    @stop