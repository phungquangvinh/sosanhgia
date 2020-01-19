<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sửa từ khóa</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="id">ID :</label>
                        <input type="text" id="valueID" name="id" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="keywords">Từ khóa:</label>
                        <textarea type="text" class="form-control" id="valueKeyword" name="keywords" rows="5"> </textarea>
                    </div>
                    <input type="text" hidden name="type" id="type">
                    <div class="text-center">
                        <button type="button" name="submitKeyword" class="btn btn-primary" id="submit">Cập Nhật</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy Bỏ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>