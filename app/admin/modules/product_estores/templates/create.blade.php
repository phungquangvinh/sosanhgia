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
                Thêm cửa hàng cho sản phẩm
                <a href="pres_index.php" class="btn btn-sm btn-default pull-right"><i class="fa fa-arrow-left"></i> Quay lại</a>
            </h3>
        </div>
        <div class="panel-body">
            <form action="" method="POST" role="form" enctype="multipart/form-data">
                <div role="tabpanel">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group col-sm-12 {{bts_er($errors, 'pres_product_id')}}">
                                    <label for="">Chọn sản phẩm <b id="bt_red">( * )</b></label>
                                    <div class="input-group col-sm-12">
                                        <select name="pres_product_id" id="" class="form-control">
                                            {{--<option value="">Chọn sản phẩm</option>--}}
                                            @foreach($pres_product as $value)
                                                <option value="{{$value['pro_id']}}">{{$value['pro_name']}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block text-danger">{{ array_get($errors, 'pres_product_id.0') }}</span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 {{ bts_er($errors, 'pres_cites') }}">
                                    <label class="control-label">Trích dẫn thông tin sản phẩm</label>
                                    <textarea class="form-control" name="pres_cites" rows="3">{{ array_get($oldInputs, 'pres_cites') }}</textarea>
                                    <span class="help-block text-danger">{{array_get($errors, 'pres_cites.0')}}</span>
                                </div>
                                <div class="form-group col-sm-12 {{ bts_er($errors, 'pres_district') }}">
                                    <label class="control-label">Địa chỉ bán hàng</label>
                                    <textarea class="form-control" name="pres_district" rows="2">{{ array_get($oldInputs, 'pres_district') }}</textarea>
                                    <span class="help-block text-danger">{{array_get($errors, 'pres_district.0')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group col-sm-12 {{bts_er($errors, 'pres_estore_id')}}">
                                    <label for="">Chọn cửa hàng <b id="bt_red">( * )</b></label>
                                    <div class="input-group col-sm-12">
                                        <select name="pres_estore_id" id="" class="form-control">
                                            {{--<option value="">Chọn cửa hàng</option>--}}
                                            @foreach($pres_estore as $value)
                                                <option value="{{$value['ue_id']}}">{{$value['ue_name']}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block text-danger">{{ array_get($errors, 'pres_estore_id.0') }}</span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 {{bts_er($errors, 'pres_link')}}">
                                    <label for="">Liên kết <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="pres_link" value="{{ array_get($oldInputs, 'pres_link') }}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'pres_link.0') }}</span>
                                </div>
                                <div class="form-group col-sm-6 {{bts_er($errors, 'pres_price')}}">
                                    <label for="">Giá <b id="bt_red">( * )</b> </label>
                                    <input type="text" class="form-control" name="pres_price" value="{{ array_get($oldInputs, 'pres_price') }}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'pres_price.0') }}</span>
                                </div>
                                <div class="form-group col-sm-6 {{bts_er($errors, 'pres_rate')}}">
                                    <label for="">Đánh giá: ?/5 <b id="bt_red">( * )</b> </label>
                                    <input type="number" min="1" max="5" class="form-control" name="pres_rate" value="{{ array_get($oldInputs, 'pres_rate') }}">
                                    <span class="help-block text-danger">{{ array_get($errors, 'pres_rate.0') }}</span>
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
@stop