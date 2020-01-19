@extends('master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>
                Admin user <small>#{{ $user->id }}</small>, <small>{{ $user->name }}</small>
                <a href="user_index.php" class="btn btn-sm btn-default pull-right">Go back</a>
            </h3>
        </div>
        <div class="panel-body">
            <form action="" method="POST" class="form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ array_get($errors, 'name') ? 'has-error' : '' }}">
                            <label for="name">Name</label>
                            <input id="name" type="text" value="{{ array_get($oldInputs, 'name', $user->name) }}" name="name" class="form-control">
                            <span class="help-block text-danger">{{ array_get($errors, 'name') }}</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ array_get($errors, 'phone') ? 'has-error' : '' }}">
                            <label for="phone">Phone</label>
                            <input id="phone" type="text" value="{{ array_get($oldInputs, 'phone', $user->phone) }}" name="phone" class="form-control">
                            <span class="help-block text-danger">{{ array_get($errors, 'phone') }}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{ array_get($errors, 'login_name') ? 'has-error' : '' }}">
                            <label for="login_name">Login name</label>
                            <input id="login_name" type="text" value="{{ array_get($oldInputs, 'login_name', $user->loginname) }}" name="login_name" class="form-control">
                            <span class="help-block text-danger">{{ array_get($errors, 'login_name') }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" name="action" value="update">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@stop