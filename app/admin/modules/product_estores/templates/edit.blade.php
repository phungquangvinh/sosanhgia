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
                Cập nhật cửa hàng cho sản phẩm
                <div class="pull-right">
                    <a href="pres_index.php" class="btn btn-md btn-default"><i class="fa fa-arrow-left"></i> Quay lại</a>
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
                                        <select name="pres_product_id" id="" class="form-control">
                                            @foreach($pres_product as $value)
                                                <option value="{{$value['pro_id']}}" {{ $value['pro_id'] == $updateProductEstore->pres_product_id ? 'selected' : ''}}>{{$value['pro_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 {{bts_er($errors, 'pres_cites')}}">
                                    <label for="">Trích dẫn<b id="bt_red">( * )</b> </label>
                                    <div class="input-group col-sm-12">
                                        <textarea name="pres_cites" class="form-control" rows="3">{{$updateProductEstore->pres_cites}}</textarea>
                                    </div>
                                    <span class="help-block text-danger">{{ array_get($errors, 'pres_cites.0') }}</span>
                                </div>
                                <div class="form-group col-md-12 {{bts_er($errors, 'pres_district')}}">
                                    <label for="">Khu vực<b id="bt_red">( * )</b> </label>
                                    <div class="input-group col-sm-12">
                                        <textarea name="pres_district" class="form-control" rows="2">{{$updateProductEstore->pres_district}}</textarea>
                                    </div>
                                    <span class="help-block text-danger">{{ array_get($errors, 'pres_district.0') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group col-sm-12">
                                    <label for="">Cửa hàng</label>
                                    <div class="input-group col-sm-12">
                                        <select name="pres_estore_id" id="" class="form-control">
                                            @foreach($pres_estore as $value)
                                                <option value="{{$value['ue_id']}}" {{ $value['ue_id'] == $updateProductEstore->pres_estore_id ? 'selected' : ''}}>{{$value['ue_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'pres_link')}}">
                                    <label for="">Liên kết <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="pres_link" value="{{$updateProductEstore->pres_link}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'pres_link.0') }}</span>
                                </div>
                                <div class="form-group col-sm-6 {{bts_er($errors, 'pres_price')}}">
                                    <label for="">Giá <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="pres_price" value="{{$updateProductEstore->pres_price}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'pres_price.0') }}</span>
                                </div>
                                <div class="form-group col-sm-6 {{bts_er($errors, 'pres_rate')}}">
                                    <label for="">Đánh giá <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="pres_rate" value="{{$updateProductEstore->pres_rate}}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'pres_rate.0') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="action" value="edit">
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
@stop