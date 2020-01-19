<div class="modal fade" id="myModalExportExcel" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Export Excel ( Tối đa 15.000 dòng )</h4>
            </div>
            <div class="modal-body">
                <form action="export_excel.php" method="GET">
                    <div class="form-group">
                        <label for="id">ID lớn nhất(x) : (<small>From x, Size 15000</small>)</label>
                        <input type="text" placeholder="Nhập ID này để xuất 15.000 sp lớn hơn nó" name="id" class="form-control input-sm">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-sm">Export</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Hủy Bỏ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>