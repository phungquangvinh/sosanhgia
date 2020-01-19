@extends ('master')

@section ('content')
    <style>
        .dots{
            color: red;
        }
    </style>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                Danh sách người dùng đăng ký
            </h4>
        </div>
        <div class="panel-body">
            <div class="pull-left">
                <form action="" method="GET" class="form form-inline" style="margin: 20px 0;">
                    <input type="text" name="id" class="form-control input-sm" placeholder="ID" value="{{ array_get($_GET, 'id') }}"/>
                    <input type="text" name="key" class="form-control input-sm" placeholder="Tên người dùng" value="{{ isset($arrayOption['use_name']) ? $arrayOption['use_name'] : ''}}"/>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-search"></i> Tìm kiếm
                    </button>
                    <a href="user_index.php" class="btn btn-danger btn-sm">Reset</a>
                </form>
            </div>
            <div class="pull-right">
                {!! showPaginate($pageSize, $page, $totalPage, $_GET) !!}
            </div>
            <br>
            <table class="table table-hover table-stripped">
                <thead>
                    <th>ID</th>
                    <th>ID Vật giá</th>
                    <th>Tên</th>
                    <th>Ảnh đại diện</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th style="text-align: right">Địa chỉ</th>
                    <th></th>
                    <th>Trạng thái</th>
                </thead>
                <tbody>
                    @if($listUser)
                        @foreach($listUser as $item)
                            <tr class="dataEach">
                                <td>{{$item->use_id}}</td>
                                <td>{{$item->use_id_vatgia}}</td>
                                <td>{{$item->use_name}}</td>
                                <td><img style="height: 50px" src="{{$item->use_avatar}}" alt="" title=""/></td>
                                <td>{{$item->use_phone}}</td>
                                <td>{{$item->use_email}}</td>
                                <td align="right">{{$item->use_address}}</td>
                                <td align="left">{{$item->cit_name}}</td>
                                <td> <?php if ($item->use_active == 1){ ?>
                                    <span class="label label-success" onclick="return selectId({{$item->use_id}})">Activated</span>
                                    <?php }else{  ?>
                                    <span class="label label-danger" onclick="return selectId({{$item->use_id}})">Deactivated</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="pull-right">
                {!! showPaginate($pageSize, $page, $totalPage, $_GET) !!}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@stop

<script>
    function selectId(id) {
        $.ajax({
            url: './user_active.php',
            type: 'GET',
            data: {
                id: id,
            }
        }).done(function (data) {

        });
        location.reload();
        return false;
    };
</script>