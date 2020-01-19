@extends('master')

@section('content')
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
    <script>tinymce.init({ selector:'textarea.post_content' });</script>
    <div class="panel panel-default" style="margin-left: 10px;margin-right: 10px">
        <div class="panel-heading">
            <h3>
                Cập nhật tin tức
                <a href="pos_index.php" class="btn btn-sm btn-default pull-right"><i class="fa fa-arrow-left"></i> Quay lại</a>
            </h3>
        </div>
        <div class="panel-body">
            <form action="" method="POST" role="form" enctype="multipart/form-data">
                <div role="tabpanel">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group col-sm-12 {{bts_er($errors, 'pos_title')}}">
                                    <label for="">Tiêu đề <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="pos_title" value="{{$updateListPost->pos_title}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'pos_title.0') }}</span>
                                </div>
                                <div class="form-group col-sm-12 {{ bts_er($errors, 'pos_teaser') }}">
                                    <label class="control-label">Nội dung <b id="bt_red">( * )</b></label>
                                    {{--https://www.tinymce.com/docs/get-started/basic-setup/--}}
                                    <textarea class="form-control post_content" name="pos_teaser" rows="10">{{$updateListPost->pos_teaser}}</textarea>
                                    <span class="help-block text-danger">{{array_get($errors, 'pos_teaser.0')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group col-sm-12">
                                    <label for="">Chọn danh mục <b id="bt_red">( * )</b> </label>
                                    <div class="input-group col-sm-12">
                                        <select name="category_id" id="" class="form-control">
                                            @foreach($pos_category as $value)
                                                <option value="{{$value['cat_id']}}" {{ $value['cat_id'] == $updateListPost->pos_category_id ? 'selected' : ''}}>{{$value['cat_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'pos_active')}}">
                                    <label>Trạng thái</label><br>
                                    <input type="radio" name="pos_active" value="1" {{ $updateListPost->pos_active == 1 ? 'checked' : ''}}><span style="color: green">Activated</span>
                                    <input type="radio" name="pos_active" value="0" {{ $updateListPost->pos_active == 0 ? 'checked' : ''}}><span style="color: red">Deactivated</span>
                                </div>
                                <div class="col-sm-12 img-css {{bts_er($errors, 'pos_image')}}">
                                    <label for="name" style="font-size: 14px;">Ảnh đại diện <b id="bt_red">( * )</b></label>
                                    <input id="picture" type="file" value="{{ array_get($oldInputs, 'pos_image') }}" name="pos_image" class="form-control">
                                    <div id="show-img">
                                        <img src="{{$updateListPost->getImgPost()}}" alt="" width="250px" id="show_photo" style="margin-top:10px">
                                    </div>
                                    <span class="help-block text-danger">{{ array_get($errors, 'pos_image.0') }}</span>
                                    <br>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'pos_author_id')}}">
                                    <label for="">Nhập tên tác giả <b id="bt_red">( * )</b> </label>
                                    <div class="input-group col-sm-12">
                                        <select name="pos_author_id" id="" class="form-control">
                                            @foreach($pos_author as $value)
                                                <option value="{{$value['adm_id']}}" {{ $value['adm_id'] == $updateListPost->pos_author_id ? 'selected' : ''}}>{{$value['adm_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="" name="pos_admin_id">
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