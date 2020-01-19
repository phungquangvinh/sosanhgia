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
            <h4>
                Sửa ảnh cho sản phẩm
                <div class="pull-right">
                    <a href="prim_index.php" class="btn btn-md btn-default"><i class="fa fa-arrow-left"></i> Quay lại</a>
                </div>
            </h4>
        </div>
        <div class="panel-body">
            <form action="" method="POST" role="form" enctype="multipart/form-data">
                <div role="tabpanel">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group col-sm-12">
                                    <label for="">Sản phẩm</label>
                                    <div class="input-group col-sm-12">
                                        <select name="prim_product_id" id="" class="form-control">
                                            @foreach($prim_product as $value)
                                                <option value="{{$value['pro_id']}}" {{ $value['pro_id'] == $updateProductImage->prim_product_id ? 'selected' : ''}}>{{$value['pro_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-12 img-css {{bts_er($errors, 'prim_name')}}">
                                    <label for="name" style="font-size: 14px;">Ảnh đại diện <b id="bt_red">( * )</b></label>
                                    <input id="picture" type="file" value="{{ array_get($oldInputs, 'prim_name') }}" name="prim_name[]" multiple="multiple" class="form-control">
                                    <div id="show-img">
{{--                                        <img src="{{$updateProductImage->getImgProduct()}}" alt="" width="250px" id="show_photo" style="margin-top:10px">--}}
                                        <img src="{{parse_image('product_images', 'default', array_reverse(json_decode($updateProductImage->prim_name, 1))[0])}}" alt="" width="250px" id="show_photo" style="margin-top:10px">
                                    </div>
                                    <span class="help-block text-danger">{{ array_get($errors, 'prim_name.0') }}</span>
                                    <br>
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