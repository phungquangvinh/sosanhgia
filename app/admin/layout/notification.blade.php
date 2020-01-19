<?php
    $success = flash_message('success');
    $error = flash_message('error');
?>
@if($success)
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Thành công!</strong> {{ $success }}
    </div>
@endif

@if($error)
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Lỗi!</strong> {{ $error }}
    </div>
@endif