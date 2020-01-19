<div class="modal fade" id="myModalImportExcel" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Import Excel</h4>
            </div>
            <div class="modal-body">
                <form action="import_excel.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id">Chọn từ máy tính</label>
                        <input type="file" name="file">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-sm">Import</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Hủy Bỏ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>