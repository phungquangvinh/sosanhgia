@extends('master')

@section('content')
    <script>tinymce.init({ selector:'textarea.product_content' });</script>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <small>Sản phẩm</small> / Thay đổi / #{{ $row->pro_id }}, {{ $row->pro_name }}
                <div class="pull-right">
                    <a href="product_index.php" class="btn btn-md btn-default"><i class="fa fa-arrow-left"></i> Quay lại</a>
                </div>
            </h4>
        </div>
        <div class="panel-body">
            <form method="POST" class="form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group {{ array_get($errors, 'pro_name') ? 'has-error' : '' }}">
                                    <label class="control-label">Tên SP</label>
                                    <input type="text" name="pro_name" class="form-control" value="{{ getValue('pro_name','str','POST',$row->pro_name) }}" placeholder="Product Name">
                                    <span class="help-block text-danger">{{array_get($errors, 'pro_name.0')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group {{ array_get($errors, 'category') ? 'has-error' : '' }}">
                                    <label class="control-label">Danh mục</label>
                                    <select class="form-control" name="category">
                                        <option value="">Chọn danh mục</option>
                                        @foreach($categories as $item)
                                            <option value="{{ $item->cat_id }}" {{ $item->cat_id == getValue('category', 'int', 'POST', $row->pro_category_id) ? 'selected' : '' }}>{{ $item->cat_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block text-danger">{{array_get($errors, 'category.0')}}</span>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="">Chọn tỉnh, thành phố <b id="bt_red">( * )</b> </label>
                                    <div class="input-group col-sm-12">
                                        <select name="pro_city_id" id="" class="form-control">
                                            <option value="">Chọn thành phố</option>
                                            @foreach($cities as $datalistCities )
                                                <option value="{{$datalistCities['cit_id']}}">{{$datalistCities['cit_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

{{--                            <div class="col-sm-8">--}}
{{--                                <div class="form-group {{ array_get($errors, 'tag_name') ? 'has-error' : '' }}">--}}
{{--                                    <label class="control-label">Product Tags</label>--}}
{{--                                    <input type="text" id="tags" name="tag_name" value="{{ getValue('tag_name','str','POST',$stringInputTag) }}" class="form-control"/>--}}
{{--                                    <span class="help-block text-danger">{{array_get($errors, 'tag_name.0')}}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="col-sm-8">
                                <div class="form-group {{ array_get($errors, 'pro_price') ? 'has-error' : '' }}">
                                    <label class="control-label">Giá</label>
                                    <input type="text" name="pro_price" class="form-control" data-price="{{ isset($_REQUEST['pro_price'])?preg_replace('/\D+/', '', $_REQUEST['pro_price']):$row->pro_price }}" value="{{ format_number(isset($_REQUEST['pro_price'])?preg_replace('/\D+/', '', $_REQUEST['pro_price']):$row->pro_price ) }}" placeholder="Product Price">
                                    <span class="help-block text-danger">{{array_get($errors, 'pro_price.0')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group {{ array_get($errors, 'pro_brand') ? 'has-error' : '' }}">
                                    <label class="control-label">Hãng</label>
{{--                                    <select class="form-control" name="pro_brand">--}}
{{--                                        <option value="">Brand</option>--}}
{{--                                        @foreach($brands as $item)--}}
{{--                                            <option value="{{ $item->bra_id }}" {{ $item->bra_id == getValue('pro_brand', 'int', 'POST', $row->pro_brand_id) ? 'selected' : '' }}>{{ $item->bra_name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
                                    <input type="text" name="pro_brand" class="form-control" value="{{ $row->bra_name }}" placeholder="Product Brand">
                                    <span class="help-block text-danger">{{array_get($errors, 'pro_brand.0')}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group {{ array_get($errors, 'teaser') ? 'has-error' : '' }}">
                                            <label class="control-label">Thông tin chung của SP</label>
                                            <textarea class="form-control" name="teaser" rows="3">{{$row->prme_teaser }}</textarea>
                                            <span class="help-block text-danger">{{array_get($errors, 'teaser.0')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group {{ array_get($errors, 'content') ? 'has-error' : '' }}">
                                            <label class="control-label">Nội dung chính</label>
                                            {{--https://www.tinymce.com/docs/get-started/basic-setup/--}}
                                            <textarea class="form-control product_content" name="content" rows="10">{{ $row->prme_content }}</textarea>
                                            <span class="help-block text-danger">{{array_get($errors, 'content.0')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group {{ array_get($errors, 'pro_image') ? 'has-error' : '' }}">
                                            <label class="control-label">Ảnh bìa (Click để thay ảnh)</label>
                                            <input type="file" style="display: none" name="pro_image" value="{{ $row->pro_image }}" class="form-control pro_image"/>
                                            <div style="width: 80%; min-height: 100px; margin: auto; cursor: pointer; background: #f5f5f5; padding: 0 20px" class="show_image_product">
                                                <img src="{{ parse_file_url('md_'.$row->pro_image) }}" id="show_image" alt="" title="" style="max-width: 100%; max-height: 100%"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 img-css {{array_get($errors, 'pro_list_image') ? 'has-error' : ''}}">
                                        <label for="name" style="font-size: 14px;">Thay đổi chuỗi ảnh</label>
                                        <input id="picture" type="file" value="{{ $row->pro_list_image }}" name="pro_list_image[]" multiple="multiple" class="form-control">
                                        <div id="show-img">
                                            <img src="{{parse_image('products', 'default', array_reverse(json_decode(parse_file_url('md_'.$row->pro_list_image), 1))[0])}}" alt="" width="250px" id="show_photo" style="margin-top:10px">
                                        </div>
                                        <span class="help-block text-danger">{{ array_get($errors, 'pro_list_image.0') }}</span>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="action" value="update">
                    <button type="submit" class="btn btn-md btn-primary">Cập nhật</button>
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