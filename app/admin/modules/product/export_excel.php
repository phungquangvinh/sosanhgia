<?php

require_once 'inc_security.php';

$id = getValue('id','int','GET',0);
$maxRows = 150;
$products = \App\Models\Product::where('pro_id >'.$id)
    ->where('pro_keywords IS NULL')
    ->fields('pro_id,pro_name,pro_keywords')
    ->pagination(0, $maxRows)->select_all();


$fileName = "giaca_org_product_from_{$id}.xlsx";
$filePath = ROOT.'/public/exports/'.$fileName;

$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

$spreadsheet->getActiveSheet()->setCellValue('A1', "ID");
$spreadsheet->getActiveSheet()->setCellValue('B1', "Name");
$spreadsheet->getActiveSheet()->setCellValue('C1', "Keyword");

$row = 1;
foreach($products as $item) {
    $row ++;
    $spreadsheet->getActiveSheet()->setCellValue("A{$row}", $item->id);
    $spreadsheet->getActiveSheet()->setCellValue("B{$row}", $item->name);
    $spreadsheet->getActiveSheet()->setCellValue("C{$row}", $item->keywords);
}
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
$writer->save($filePath);

// Download
header('Content-type: application/vnd.ms-excel');
header('Pragma: public'); 	// required
header('Expires: 0');		// no cache
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($filePath)).' GMT');
header('Cache-Control: private',false);
header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.filesize($filePath));	// provide file size
header('Connection: close');
readfile($filePath);
exit();