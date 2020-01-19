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
                Thêm cửa hàng
                <a href="menu_index.php" class="btn btn-sm btn-default pull-right"><i class="fa fa-arrow-left"></i> Quay lại</a>
            </h3>
        </div>

        <div class="panel-body">
            <form action="" method="POST" role="form" enctype="multipart/form-data">
                <div role="tabpanel">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group col-sm-12 {{bts_er($errors, 'menu_name')}}">
                                    <label for="">Tên Menu <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" id="menu_name" name="menu_name" value="{{ array_get($oldInputs, 'menu_name') }}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'menu_name.0') }}</span>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'menu_description')}}">
                                    <label for="">Nội dung <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="menu_description" value="{{ array_get($oldInputs, 'menu_description') }}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'menu_description.0') }}</span>
                                </div>
                                
                                <div class="form-group col-sm-12 {{bts_er($errors, 'menu_link')}}">
                                    <label for="">Link <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" id="menu_link" name="menu_link" value="{{ array_get($oldInputs, 'menu_link') }}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'menu_link.0') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group col-sm-12 {{bts_er($errors, 'menu_category')}}">
                                    <label for="">Category <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" id="search_cat" placeholder="Chọn một category...">
                                    <select class="form-control" id="menu_category" name="menu_category">
                                        @foreach($category as $category)
                                            @if($category->cat_has_child == 1)
                                                <option style="font-weight: bold;" value="{{$category->cat_id}}">{{$category->cat_name}}</option>
                                            @else
                                                <option value="{{$category->cat_id}}">- {{$category->cat_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-12 img-css {{bts_er($errors, 'menu_icon')}}">
                                    <label for="name" style="font-size: 14px;">Ảnh đại diện <b id="bt_red">( * )</b></label>
                                    <input id="picture" type="file" value="{{ array_get($oldInputs, 'menu_icon') }}" name="menu_icon" class="form-control">
                                    <span class="help-block text-danger">{{ array_get($errors, 'menu_icon.0') }}</span>
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
                    <button type="submit" class="btn btn-primary">Thêm menu</button>
                </div>
            </form>
        </div>
    </div>
    <script src="/assets/js/admin_template.js" type="text/javascript"></script>
    <script src="/assets/js/select2.min.js" type="text/javascript"></script>
    <script>
    $(document).ready(function(){
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
        
        $("#menu_category").on('change', function() {  
            var menuCat = $(this).val();
            var menuName = $("#menu_name").val();
            var slug = 'cat-' + menuCat + '.htm';
            $('#menu_link').val('/' + to_slug(menuName) + '/' + slug);          
        }); 
        $("#menu_name").on('keyup', function() {
            var menuName = $(this).val();
            let menuCat = $("#menu_category").val();
            var slug = 'cat-' + menuCat + '.htm';
            $('#menu_link').val('/' + to_slug(menuName) + '/' + slug);
        });  

        $("#search_cat").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#menu_category option").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }); 
    });        
    </script>
@stop