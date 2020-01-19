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
                Thêm ảnh cho sản phẩm
                <a href="prim_index.php" class="btn btn-sm btn-default pull-right"><i class="fa fa-arrow-left"></i> Quay lại</a>
            </h3>
        </div>
        <div class="panel-body">
            <form action="" method="POST" role="form" enctype="multipart/form-data">
                <div role="tabpanel">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group col-sm-12" {{bts_er($errors, 'prim_product_id')}}>
                                    <label for="">Sản phẩm <b id="bt_red">( * )</b></label>
                                    <div class="input-group col-sm-12">
                                        <select name="prim_product_id" id="" class="form-control">
                                            <option value="">Chọn sản phẩm</option>
                                            @foreach($prim_product as $value)
                                                <option value="{{$value['pro_id']}}">{{$value['pro_name']}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block text-danger">{{ array_get($errors, 'prim_product_id.0') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-12 img-css {{bts_er($errors, 'prim_name')}}">
                                    <label for="name" style="font-size: 14px;">Ảnh đại diện <b id="bt_red">( * )</b></label>
                                    <input id="picture" type="file" value="{{ array_get($oldInputs, 'prim_name') }}" name="prim_name[]" multiple="multiple" class="form-control">
                                    <span class="help-block text-danger">{{ array_get($errors, 'prim_name.0') }}</span>
                                    <div id="show-img">
                                        <img src="" alt="" width="250px" id="show_photo" style="margin-top:10px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="action" value="add">
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
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