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
                Cập nhật
                <a href="tag_index.php" class="btn btn-sm btn-default pull-right">Quay lại</a>
            </h3>
        </div>
         <div class="panel-body">
         	<form action="" method="POST" role="form" enctype="multipart/form-data">
         		<div role="tabpanel">
         			<div class="tab-content">
         				<div class="row">
         					<div class="col-sm-8">
         						<div class="form-group col-sm-12 {{bts_er($errors, 'tag_name')}}">
                                    <label for="">Name <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="tag_name"
                                           value="{{$dataUpdate->tag_name}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'tag_name.0') }}</span>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'tag_slug')}}">
                                    <label for="">Slug <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="tag_slug"
                                           value="{{$dataUpdate->tag_slug}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'tag_slug.0') }}</span>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'tag_meta_title')}}">
                                    <label for="">Meta title <b id="bt_red"></b> </label>
                                    <input type="text" class="form-control" name="tag_meta_title"
                                           value="{{$dataUpdate->tag_meta_title}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'tag_meta_title.0') }}</span>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'tag_meta_keywords')}}">
                                    <label for="">Meta keywords <b id="bt_red"></b> </label>
                                    <input type="text" class="form-control" name="tag_meta_keywords"
                                           value="{{$dataUpdate->tag_meta_keywords}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'tag_meta_keywords.0') }}</span>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'tag_meta_description')}}">
                                    <label for="">Meta description <b id="bt_red"></b> </label>
                                    <input type="text" class="form-control" name="tag_meta_description"
                                           value="{{$dataUpdate->tag_meta_description}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'tag_meta_description.0') }}</span>
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
    @stop