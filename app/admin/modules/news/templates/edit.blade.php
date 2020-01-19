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
                Cập nhật tin tức
                <a href="nes_index.php" class="btn btn-sm btn-default pull-right">Quay lại</a>
            </h3>
        </div>
        <div class="panel-body">
            <form action="" method="POST" role="form" enctype="multipart/form-data">

                <div role="tabpanel">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group col-sm-12 {{bts_er($errors, 'nes_title')}}">
                                    <label for="">Tiêu đề <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="nes_title"
                                           value="{{$dataUpdate->nes_title}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'nes_title.0') }}</span>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'nes_meta_title')}}">
                                    <label for="">Từ khóa (Meta) Title <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="nes_meta_title"
                                           value="{{$dataUpdate->nes_meta_title}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'nes_meta_title.0') }}</span>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'nes_meta_keyword')}}">
                                    <label for="">Từ khóa (Meta) Keyword <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="nes_meta_keyword"
                                           value="{{$dataUpdate->nes_meta_keyword}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'nes_meta_keyword.0') }}</span>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'nes_meta_description')}}">
                                    <label for="">Từ khóa (Meta) Description <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="nes_meta_description"
                                           value="{{$dataUpdate->nes_meta_description}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'nes_meta_description.0') }}</span>
                                </div>

                                <div class="form-group col-md-12 {{bts_er($errors, 'nes_description')}}">
                                    <label for="">Mô tả ngắn<b id="bt_red">( * )</b> </label>
                                    <div class="input-group col-sm-12">
                                            <textarea name="nes_description" id="input"
                                                      class="form-control">{{$dataUpdate->nes_description}}</textarea>
                                    </div>
                                    <span class="help-block text-danger">{{ array_get($errors, 'nes_description.0') }}</span>
                                </div>

                                <div class="form-group col-md-12 {{bts_er($errors, 'nes_content')}}">
                                    <label for="">Nội dung <b id="bt_red">( * )</b> </label>
                                    <textarea name="nes_content" class="form-control ckeditor" id="ckeditor1">{{$dataUpdate->nes_content}}</textarea>
                                    <span class="help-block text-danger">{{ array_get($errors, 'nes_content.0') }}</span>
                                </div>


                            </div>
                            <div class="col-sm-4">
                                <div class="form-group col-sm-12">
                                    <label for="">Thể loại tin tức</label>
                                    <div class="input-group col-sm-12">
                                        <select name="type_id" id="" class="form-control">
                                            @foreach($category as $value)
                                                <option value="{{$value['cat_id']}}" {{ $value['cat_id'] == $dataUpdate->nes_type_id ? 'selected' : ''}}>{{$value['cat_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-12 {{bts_er($errors, 'nes_author_id')}}">
                                    <label for="">Tác giả <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="nes_author_id" value="{{$dataUpdate->nes_author_id}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'nes_author_id.0') }}</span>
                                </div>

                                <div class="form-group col-sm-12 {{bts_er($errors, 'nes_active')}}">
                                    <label>Trạng thái</label>
                                    <div class="input-group col-sm-12">
                                        <input type="radio" name="nes_active" value="1" {{ $dataUpdate->nes_active == 1 ? 'checked' : ''}}><span style="color: green">Activated</span>
                                        <input type="radio" name="nes_active" value="0" {{ $dataUpdate->nes_active == 0 ? 'checked' : ''}}><span style="color: red">Deactivated</span>
                                    </div>
                                </div>

                                <div class="col-sm-12 img-css {{bts_er($errors, 'nes_image')}}">
                                    <label for="name" style="font-size: 14px;">Ảnh đại diện <b id="bt_red">( * )</b></label>
                                    <input id="picture" type="file" value="{{ array_get($oldInputs, 'nes_image') }}"
                                           name="nes_image" class="form-control">
                                    <div id="show-img">
                                        <img src="{{ parse_image('news', 'default', $dataUpdate->nes_image) }}" alt="" width="250px" id="show_photo" style="margin-top:10px">
                                    </div>
                                    <span class="help-block text-danger">{{ array_get($errors, 'nes_image.0') }}</span>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="action" value="edit">
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-primary">Cập nhật tin tức</button>
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