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
    <script>tinymce.init({ selector:'textarea.product_content' });</script>
    <div class="panel panel-default" style="margin-left: 10px;margin-right: 10px">
        <div class="panel-heading">
            <h3>
                Thêm sản phẩm
                <a href="product_index.php" class="btn btn-sm btn-default pull-right"><i class="fa fa-arrow-left"></i> Quay lại</a>
            </h3>
        </div>
        <div class="panel-body">
            <form action="" method="POST" role="form" enctype="multipart/form-data">
                <div role="tabpanel">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group col-sm-12 {{bts_er($errors, 'pro_name')}}">
                                    <label for="">Tên SP <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="pro_name"
                                           value="{{ array_get($oldInputs, 'pro_name') }}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'pro_name.0') }}</span>
                                </div>

                                <div class="form-group col-sm-12 {{bts_er($errors, 'pro_price')}}">

                                    <label for="">Price <b id="bt_red">( * )</b> </label>
                                    <input type="number" class="form-control" name="pro_price">
                                    <span class="help-block text-danger">{{ array_get($errors, 'pro_price.0') }}</span>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'tag_name') }}">
                                    <label class="control-label">Product Tags</label>
                                    <input type="text" id="tags" name="tag_name" value="{{ array_get($oldInputs, 'tag_name') }}" class="form-control"/>
                                    <span class="help-block text-danger">{{array_get($errors, 'tag_name.0')}}</span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group {{ bts_er($errors, 'teaser') }}">
                                            <label class="control-label">Thông tin chung của SP</label>
                                            <textarea class="form-control" name="teaser" rows="3">{{ array_get($oldInputs, 'teaser') }}</textarea>
                                            <span class="help-block text-danger">{{array_get($errors, 'teaser.0')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group {{ bts_er($errors, 'content') }}">
                                            <label class="control-label">Nội dung chính</label>

                                            {{--https://www.tinymce.com/docs/get-started/basic-setup/--}}

                                            <textarea class="form-control product_content" name="content" rows="10">{{ array_get($oldInputs, 'content') }}</textarea>
                                            <span class="help-block text-danger">{{array_get($errors, 'content.0')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group col-sm-12">
                                    <label for="">Chọn hãng SP <b id="bt_red">( * )</b> </label>
                                    <div class="input-group col-sm-12">
                                        <select name="pro_brand_id" id="" class="form-control">
                                            <option value="">Chọn hãng sản phẩm</option>
                                            @foreach($pro_brands as $value)
                                                <option value="{{$value['bra_id']}}">{{$value['bra_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="">Chọn danh mục SP <b id="bt_red">( * )</b> </label>
                                    <div class="input-group col-sm-12">
                                        <select name="pro_category_id" id="" class="form-control">
                                            <option value="">Chọn loại sản phẩm</option>
                                            @foreach($pro_categories as $value)
                                                @if($value->cat_has_child == 1)
                                                    <option style="font-weight: bold;" value="{{$value['cat_id']}}">{{$value['cat_name']}}</option>
                                                @else
                                                    <option value="{{$value['cat_id']}}">- {{$value['cat_name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group col-sm-12">
                                    <label for="">Chọn tỉnh, thành phố <b id="bt_red">( * )</b> </label>
                                    <div class="input-group col-sm-12">
                                        <select name="pro_city_id" id="" class="form-control">
                                            <option value="">Chọn thành phố</option>
                                            @foreach($pro_city as $datalistCities )
                                                <option value="{{$datalistCities['cit_id']}}">{{$datalistCities['cit_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-sm-12 img-css {{bts_er($errors, 'pro_image')}}">
                                    <label for="name" style="font-size: 14px;">Chọn ảnh bìa</label>
                                    <input id="picture" type="file" value="{{ array_get($oldInputs, 'pro_image') }}" name="pro_image" class="form-control">
                                    <span class="help-block text-danger">{{ array_get($errors, 'pro_image.0') }}</span>
                                    <div id="show-img">
                                        <img src="" alt="" width="250px" id="show_photo" style="margin-top:10px">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="col-sm-12 img-css {{bts_er($errors, 'pro_list_image')}}">
                                    <label for="name" style="font-size: 14px;">Chọn chuỗi ảnh SP</label>
                                    <input id="picture" type="file" value="{{ array_get($oldInputs, 'pro_list_image') }}" name="pro_list_image[]" multiple="multiple" class="form-control">
                                    <span class="help-block text-danger">{{ array_get($errors, 'pro_list_image.0') }}</span>
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
    <script src="assets/js/admin_template.js" type="text/javascript"></script>
    <script src="assets/js/select2.min.js" type="text/javascript"></script>
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
