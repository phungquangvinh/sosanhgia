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
    <div class="panel panel-default" style="margin-left: 10px;margin-right: 10px">
        <div class="panel-heading">
            <h3>
                Cập nhật hãng
                <a href="brands_index.php" class="btn btn-sm btn-default pull-right"><i class="fa fa-arrow-left"></i> Quay lại</a>
            </h3>
        </div>
        <div class="panel-body">
            <form action="" method="POST" role="form" enctype="multipart/form-data">
                <div role="tabpanel">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group col-sm-12 {{bts_er($errors, 'bra_name')}}">
                                    <label for="">Tên <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="bra_name" value="{{$updateBrand->bra_name}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'bra_name.0') }}</span>
                                </div>
                                <div class="col-sm-12 img-css {{bts_er($errors, 'bra_image')}}">
                                    <label for="name" style="font-size: 14px;">Logo đại diện <b id="bt_red">( * )</b></label>
                                    <input id="picture" type="file" value="{{ array_get($oldInputs, 'bra_image') }}" name="bra_image" class="form-control">
                                    <div id="show-img">
                                        <img src="{{$updateBrand->getImgBrand()}}" alt="" width="250px" id="show_photo" style="margin-top:10px">
                                    </div>
                                    <span class="help-block text-danger">{{ array_get($errors, 'bra_image.0') }}</span>
                                    <br>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group col-sm-12 {{ bts_er($errors, 'bra_content') }}">
                                    <label class="control-label">Thông tin về hãng</label>
                                    <textarea class="form-control" name="bra_content" rows="5">{{ $updateBrand->bra_content }}</textarea>
                                    <span class="help-block text-danger">{{array_get($errors, 'bra_content.0')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="action" value="edit">
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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