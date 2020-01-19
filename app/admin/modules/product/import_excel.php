<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 14/12/17
 * Time: 14:26
 */
require_once 'inc_security.php';

if($_FILES['file']['error'] == UPLOAD_ERR_NO_FILE) {
    exit("No file upload");
}

// Upload
$uploadResult = app('uploader')->upload('file');
if(!$uploadResult) {
    exit("Upload ERROR");
}

$filePath = ROOT . '/public'.parse_file_url($uploadResult);
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
$spreadsheet = $reader->load($filePath);
$workSheet = $spreadsheet->getActiveSheet();

// Define column excel
$columnId = 0;
$columnName = 1;
$columnKeyword = 2;

$data = [];

$rowIndex = -1;
foreach($workSheet->getRowIterator(2) as $row) {
    $rowIndex ++;
    $cellIndex = -1;

    foreach($row->getCellIterator() as $cell) {
        if($cell->getValue()) {
            $cellIndex ++;
            $data[$rowIndex][$cellIndex] = $cell->getValue();
        }
    }
}

foreach($data as $item) {
    if(isset($item[$columnKeyword]) && $item[$columnKeyword]) {
        \App\Models\Product::where('pro_id=' . $item[$columnId])->update([
            'pro_keywords' => $item[$columnKeyword],
            'pro_updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}

flash_message('success', 'Cập nhật thành công');
redirect('product_index.php');


