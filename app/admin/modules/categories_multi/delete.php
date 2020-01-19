<?
require_once("../../bootstrap.php");
require_once 'inc_security.php';

//check quyền them sua xoa
checkAddEdit("delete");
$returnurl 		= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php"))); 
$record_id		= getValue("record_id","int","GET",0); 
//Delete data with ID
$db_del = new db_execute("DELETE FROM ". $fs_table ." WHERE " . $id_field . " IN(" . $record_id . ")", 1); 
if($db_del->row_affect >0 ) { 
	echo " Có " . $db_del->row_affect . " bản ghi đã được xóa !";
}else{
	echo " Xóa không thành công !";
}
redirect($returnurl);
unset($db_del);
?>