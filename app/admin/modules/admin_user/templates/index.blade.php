@extends('master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>
                Admin users
                <a href="user_create.php" class="btn btn-sm btn-primary pull-right">Add new</a>
            </h3>
        </div>
        <div class="panel-body">
            <form action="" method="GET" class="form form-inline" style="margin-bottom: 10px;">
                <input type="text" placeholder="Search" name="name" class="form-control input-sm">
                <button type="submit" class="btn btn-sm btn-info">
                    <i class="fa fa-search"></i> Search
                </button>
            </form>
            <table class="table table-hover table-stripped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Login Name</th>
                    <th>Phone</th>
                    <th>Access Module</th>
                    <th>Active</th>
                    <th width="30">Edit</th>
                    <th width="30">Delete</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->loginname }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            <?php
                                $userModules = \App\Models\Module::inner_join('admin_user_right', 'mod_id=adu_admin_module_id')
                                                    ->where('adu_admin_id='.$user->id)
                                                    ->select_all();
                                $userModules = $userModules ? $userModules : new \VatGia\Helpers\Collection();
                            ?>
                            @if($user->isadmin == 1)
                                <span class="label label-info">All modules</span>
                            @else
                                <a href="user_right.php?id={{ $user->id }}" class="btn btn-xs btn-danger">
                                    <i class="fa fa-key"></i> Grant access module
                                </a>
                                @foreach($userModules as $m)
                                    @if($m->adu_add == 1 || $m->adu_edit == 1 || $m->adu_delete == 1)
                                        <span class="label label-info" style="margin: 2px;">{{ $m->name }}</span>
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a href="javascript:;" class="label label-{{ $user->active == 1 ? 'success' : 'danger' }}">
                                {{ $user->active == 1 ? 'Activated' : 'Deactivated' }}
                            </a>
                        </td>
                        <td>
                            <a href="user_edit.php?id={{ $user->id }}">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="user_delete.php?id={{ $user->id }}" class="text-danger">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop