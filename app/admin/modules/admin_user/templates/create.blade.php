@extends('master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>
                Create new admin user
                <a href="user_index.php" class="btn btn-sm btn-default pull-right">Go back</a>
            </h3>
        </div>
        <div class="panel-body">
            <form action="" method="POST" class="form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ array_get($errors, 'name') ? 'has-error' : '' }}">
                            <label for="name">Name</label>
                            <input id="name" type="text" value="{{ array_get($oldInputs, 'name') }}" name="name" class="form-control">
                            <span class="help-block text-danger">{{ array_get($errors, 'name.0') }}</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ array_get($errors, 'phone') ? 'has-error' : '' }}">
                            <label for="phone">Phone</label>
                            <input id="phone" type="text" value="{{ array_get($oldInputs, 'phone') }}" name="phone" class="form-control">
                            <span class="help-block text-danger">{{ array_get($errors, 'phone.0') }}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{ array_get($errors, 'login_name') ? 'has-error' : '' }}">
                            <label for="login_name">Login name</label>
                            <input id="login_name" type="text" value="{{ array_get($oldInputs, 'login_name') }}" name="login_name" class="form-control">
                            <span class="help-block text-danger">{{ array_get($errors, 'login_name.0') }}</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{ array_get($errors, 'password') ? 'has-error' : '' }}">
                            <label for="password">Password</label>
                            <input id="password" type="password" value="{{ array_get($oldInputs, 'password') }}" name="password" class="form-control">
                            <span class="help-block text-danger">{{ array_get($errors, 'password.0') }}</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{ array_get($errors, 're_password') ? 'has-error' : '' }}">
                            <label for="password">Repeat Password</label>
                            <input id="password" type="password" value="{{ array_get($oldInputs, 're_password') }}" name="re_password" class="form-control">
                            <span class="help-block text-danger">{{ array_get($errors, 're_password.0') }}</span>
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