@extends('master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>
                <small>Grant access module to user</small>
                <strong>{{ $user->name }}</strong>
                <a href="user_index.php" class="btn btn-sm btn-default pull-right">
                    <i class="fa fa-arrow-left"></i> Go back
                </a>
            </h3>
        </div>
        <div class="panel-body">
            <h3>Modules</h3>
            <table class="table table-hover table-stripped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th width="30">Add</th>
                        <th width="30">Edit</th>
                        <th width="30">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($modules as $module)
                        <tr>
                            <td>{{ $module->name }}</td>
                            <td>
                                @if($mapUserModules[$module->id]['add'] == 1)
                                    <i data-module_id="{{ $module->id }}" data-right="add" class="action-grant-right fa fa-check-square fa-2x"></i>
                                @else
                                    <i data-module_id="{{ $module->id }}" data-right="add" class="action-grant-right fa fa-square-o fa-2x"></i>
                                @endif
                            </td>
                            <td>
                                @if($mapUserModules[$module->id]['edit'] == 1)
                                    <i data-module_id="{{ $module->id }}" data-right="edit" class="action-grant-right fa fa-check-square fa-2x"></i>
                                @else
                                    <i data-module_id="{{ $module->id }}" data-right="edit" class="action-grant-right fa fa-square-o fa-2x"></i>
                                @endif
                            </td>
                            <td>
                                @if($mapUserModules[$module->id]['delete'] == 1)
                                    <i data-module_id="{{ $module->id }}" data-right="delete" class="action-grant-right fa fa-check-square fa-2x"></i>
                                @else
                                    <i data-module_id="{{ $module->id }}" data-right="delete" class="action-grant-right fa fa-square-o fa-2x"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(function() {
           $('.action-grant-right').click(function() {
               var $this = $(this);
                $.ajax({
                    url: "ajax_grant_access_module.php",
                    data: {
                        module_id: $this.data('module_id'),
                        right: $this.data('right'),
                        user_id: {{ $user->id }}
                    },
                    type: "POST",
                    dataType: "json",
                    success: function(response) {
                        window.location.reload();
                    }
                })
           });
        });
    </script>
@stop