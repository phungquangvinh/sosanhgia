@extends('master')

@section('content')
    <style>
        #image{
            width: 28%;
        }
        #image img{
            width: 100%;
            height: 170px;
        }
        #image_small{
            width: 28%;
        }
        #image_small img{
            width: 100%;
            height: 170px;
        }
        .clear{
            clear: both;
        }

    </style>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="text-center">Thêm mới </h3>
        </div>
        <div class="panel-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="admin_email">Admin-email</label>
                    <input type="email" class="form-control" name="admin_email">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address">
                </div>

                <div class="form-group">
                    <label for="hotline">Hotline</label>
                    <input type="text" class="form-control" name="hotline">
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" name="facebook">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" name="twitter">
                </div>
                <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <input type="text" class="form-control" name="youtube">
                </div>
                <div class="form-group">
                    <label for="logo_top">Logo Top</label>
                    <input type="file" class="form-control" name="logo_top" id="uploadImg">
                    <div class="form-group col-sm-12 row " id="image">

                    </div>
                </div>
                <div class="clear"></div>
                <div class="form-group">
                    <label for="logo_bottom">Logo Bottom</label>
                    <input type="file" class="form-control" name="logo_bottom" id="uploadFile" >
                    <div class="form-group col-sm-12 row " id="image_small">

                    </div>
                </div>
                <div class="clear"></div>

                <button class="btn btn-primary" type="submit" name="submit">Thêm Mới</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $("#uploadFile").change(function () {
            $('#image_small').html("");
            var total_file = document.getElementById("uploadFile").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#image_small').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'>");
            }
        });

        $("#uploadImg").change(function () {
            $('#image').html("");
            var total_file = document.getElementById("uploadImg").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#image').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'>");
            }
        });
    </script>


@stop