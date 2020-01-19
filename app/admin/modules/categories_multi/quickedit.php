<?
require_once("inc_security.php");
//check quyền them sua xoa
checkAddEdit("edit");
$returnurl = base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));

//Khai bao Bien
$errorMsg 		= 	"";
$iQuick 			= 	getValue("iQuick","str","POST","");
$cat_type		=	getValue("cat_type","str","POST",0);
if ($iQuick == 'update'){
	$record_id = getValue("record_id", "arr", "POST", array());
	if(!empty($record_id)){
		foreach($record_id as $i => $id){
			$errorMsg="";
			//Call Class generate_form();
			$myform = new generate_form();
			//Insert to database
			$myform->add("cat_name","cat_name" . $record_id[$i],0,0,"");
			$myform->add("cat_order","cat_order" . $record_id[$i],1,0,0);
			$myform->add("cat_parent_id","cat_parent_id" . $record_id[$i],1,0,0);
			$myform->add("cat_type","cat_type",0,1,'');
			$myform->add("cat_rewrite","cat_rewrite" . $record_id[$i],0,0,'');
			//Add table
			$myform->addTable($fs_table);
			$errorMsg .= $myform->checkdata();
			echo $errorMsg;
			if($errorMsg == ""){
				$db_ex = new db_execute($myform->generate_update_SQL("cat_id",$record_id[$i]));
				//echo $myform->generate_update_SQL("cat_id",$record_id);
				//echo $errorMsg;
				unset($db_ex);
			}
		}
	}
	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
	echo "Đang cập nhật dữ liệu !";
	redirect($returnurl);

}
?>