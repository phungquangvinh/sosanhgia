@extends('master')

@section('content')
    <style type="text/css" media="screen">
        .show-img{
            width: 25%;
            position: relative;
        }
        .item_img{
            position: relative;
        }
        .show-img img{
            width: 100%;
            height: 165px;
        }
        .image_preview img{
            width: 100%;
            height: 165px;
        }
        .image_preview{
            width: 25%;
            position: relative;
        }
        .remove_img_preview {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 20px;
            height: 20px;
            background: #000;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            cursor: pointer;
        }



        .item_img {
            margin-bottom: 0;
            margin-top: 10px;
        }
    </style>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="text-center">Cập nhật  </h3>
        </div>
        <div class="panel-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="admin_email">Admin-email</label>
                    <input type="email" class="form-control" name="admin_email" value="{{ $dataEdit->admin_email }}">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $dataEdit->address }}">
                </div>

                <div class="form-group">
                    <label for="hotline">Hotline</label>
                    <input type="text" class="form-control" name="hotline" value="{{ $dataEdit->hotline }}">
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="{{ $dataEdit->facebook }}">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" name="twitter" value="{{ $dataEdit->twitter }}">
                </div>
                <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <input type="text" class="form-control" name="youtube" value="{{ $dataEdit->youtube }}">
                </div>
                <div class="form-group">
                    <label for="logo_top">Logo Top</label>
                    <input type="file" class="form-control" name="logo_top" id="uploadImg">
                    <div class="show-img">
                        <div class="item_img">
                            <img src="{{ parse_file_url($dataEdit->logo_top) }}" alt=""  id="img-upload" >
                            <span class="remove_img_preview">X</span>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="form-group">
                    <label for="logo_bottom">Logo Bottom</label>
                    <input type="file" class="form-control" name="logo_bottom" id="uploadFile" >
                    <div class="image_preview">
                        <div class="item_img">
                            <img src="{{ parse_file_url($dataEdit->logo_bottom) }}" alt="" >
                            <span class="remove_img_preview">X</span>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>

                <button class="btn btn-primary" type="submit" name="submit">Cập nhật</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $('.remove_img_preview').click(function (event) {
            if (confirm('Bạn có chắc muốn xóa ảnh này')) {
                var img = $(this).parent();
                var imgName = img.attr('data-name');
                // console.log(imgName);
                var id = img.attr('data-id');
                $.ajax({
                    url: 'ajax_delete_img_item.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        'id': id,
                        'imgName': imgName,
                    },
                    asyc: true,
                    success: function (result) {
                        img.remove();

                    }
                });
            }

        });


        $("#uploadFile").change(function () {
            $('.image_preview').html("");
            var total_file = document.getElementById("uploadFile").files.length;
            for (var i = 0; i < total_file; i++) {
                $('.image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'>");
            }
        });

        $("#uploadImg").change(function () {
            $('.show-img').html("");
            var total_file = document.getElementById("uploadImg").files.length;
            for (var i = 0; i < total_file; i++) {
                $('.show-img').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'>");
            }
        });
    </script>


@stop