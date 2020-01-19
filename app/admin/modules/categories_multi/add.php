<?
require_once("../../bootstrap.php");
require_once 'inc_security.php';
checkAddEdit("add");

$ErrorCode 	= '';
$use_key		= random();
$use_group	= 1;
$use_active	=	1;
$use_date	= time();
$use_security = rand(1,9999);


//Khai báo biến khi thêm mới
$add				= "add.php?cat_parent_id=".getValue('cat_parent_id', 'int', 'GET');
$listing			= "listing.php";
$after_save_data	= getValue("after_save_data", "str", "POST", $add);
$fs_title			= translate("Thêm mới danh mục");
$fs_action			= getURL();
$fs_redirect		= $after_save_data;
$fs_errorMsg		= "";
$cat_has_child		=	0;


// Lấy giá trị từ POST
$cat_name            =	getValue('cat_name','str','POST','');
$cat_slug            =  removeTitle($cat_name);
$cat_parent_id       =	getValue('cat_parent_id','int','POST','');
$cat_type            =	getValue('cat_type','str','POST','');
$cat_rewrite         =	getValue('cat_rewrite','str','POST',0);
$cat_url             =	getValue('cat_url','str','POST','');
$cat_show            =	getValue('cat_show','int','POST',1);
$cat_title_seo       =	getValue('cat_title_seo','str','POST','');
$cat_keywords_seo    =	getValue('cat_keywords_seo','str','POST','');
$cat_description_seo =	getValue('cat_description_seo','str','POST','');
$cat_teaser          =	getValue('cat_teaser','str','POST','');
$cat_description     =	getValue('cat_description','str','POST','');
$cat_order           =	getValue('cat_order','int','POST',0);
$cat_active          =	getValue('cat_active','int','POST',1);
$cat_keywords        =  getValue('cat_keywords','str','POST','');
$cat_icon            =  getValue('cat_icon','str','POST','');


//Call Class generate_form();
$myform = new generate_form();
$myform->add('cat_name','cat_name',0,1,'',1,'Chưa nhập tên danh mục');
$myform->add('cat_keywords','cat_keywords',0,1,'',1,'');

$myform->add('cat_parent_id','cat_parent_id',1,1,0);
$myform->add('cat_type','cat_type',0,1,'',1,'Chưa chọn loại danh mục');
$myform->add('cat_has_child','cat_has_child',1,1,0);
$myform->add('cat_active','cat_active',1,1,0);
$myform->add('cat_order','cat_order',1,1,0);
$myform->add('cat_rewrite','cat_rewrite',0,1,'');
$myform->add('cat_description','cat_description',0,1,'');
$myform->add('cat_slug', 'cat_slug', 0, 1, '');
$myform->add('cat_icon', 'cat_icon', 0, 1, '');

$myform->addTable('categories_multi');

$myform->evaluate();


$action	= getValue("action", "str", "POST", "");
if($action == "execute"){
	$fs_errorMsg		.=		$myform->checkdata();
	if($fs_errorMsg == '') {
		$db_excute 	=	new db_execute($myform->generate_insert_SQL());
		unset($db_excute);
		if($cat_parent_id != 0){
			$db_excute	=	new db_execute("UPDATE categories_multi SET cat_has_child = 1 WHERE cat_id = ".$cat_parent_id);
			unset($db_excute);

         $cat_type   = getValue("cat_type","str","POST", "");
         if($cat_type != "") resetAllChild($fs_table, "cat_id", "cat_parent_id", "cat_has_child", "cat_all_child", "cat_type='" . $cat_type . "'", "cat_order ASC");
		}
		redirect($fs_redirect);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<?
//add form for javacheck
$myform->addFormname("add");

$myform->checkjavascript();
//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->evaluate();

// $fs_errorMsg .= $myform->strErrorField;
?>
<script>

$(function(){
   // set_max_order();
   change_write();
});
function locdau(str){
   str= str.toLowerCase();
   str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
   str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
   str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
   str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
   str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
   str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
   str= str.replace(/đ/g,"d");
   str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-");
   /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
   str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
   str= str.replace(/^\-+|\-+$/g,"");
   //cắt bỏ ký tự - ở đầu và cuối chuỗi
   return str;
}
function change_write()
{
   var rewrite = locdau($('#cat_name').val());
   var parent_select = $('#cat_parent_id option:selected');
   parent_id = $(parent_select).val();
   if(parent_id > 0){
      var parent_rewrite = arr_parent_rewite[parent_id];
      rewrite = parent_rewrite + '/' + rewrite;
   }
   $('#cat_rewrite').val(rewrite);
}
function set_max_order(){
   var parent_select = $('#cat_parent_id option:selected');
   parent_id = $(parent_select).val();
   if(parent_id == 0){
      $('#cat_order').val(parseInt(parent_max_order)+1);
   }else{
      $('#cat_order').val(parseInt(arr_parent_order[parent_id])+1);
   }
}
$(function(){
   $('#cat_name').focus();
   $('#cat_name').keyup(function(){
      change_write();
   });
});
</script>

</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top($fs_title)?>
<? /*------------------------------------------------------------------------------------------------*/ 

?>
	<p align="center" style="padding-left:10px;">
	<?
	$form = new form();
	$form->create_form("add", $fs_action, "post", "multipart/form-data",'onsubmit="validateForm(); return false;"');
	$form->create_table();
	?>
	<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
	<?=$form->errorMsg($fs_errorMsg)?>
   <?=$form->select("Loại danh mục", "cat_type", "cat_type", $type_arr, $cat_type, "")?>
   <?php echo $form->select('Cấp cha', 'cat_parent_id', 'cat_parent_id', $arrayCategoriesOption, getValue('cat_parent_id', 'int', 'POST', 0)) ?>
   <?=$form->text("Icon", "cat_icon", "cat_icon", $cat_icon, "Icon", 1, 250, "", 255, "", "", "")?>
	<?=$form->text("Tên danh mục", "cat_name", "cat_name", $cat_name, "Tên danh mục", 1, 250, "", 255, "", "", "")?>
   <?=$form->textarea("Từ Khóa", "cat_keywords", "cat_keywords", $cat_keywords, "Từ khóa", 1, 450, 50, 255, "", "", "")?>
	<?=$form->text("Order", "cat_order", "cat_order", $cat_order, "", 1, 50, "", 255, "", "", "")?>
	<?=$form->checkbox("Active",'cat_active','cat_active',1,$cat_active,'')?>
	<?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, ""); ?>
	<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", "");?>
	<?=$form->hidden("action", "action", "execute", "");?>
	<?=$form->hidden("valradio", "valradio", 0)?>
	<?
	$form->close_table();
	$form->close_form();
	unset($form);
	?>
	</p>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>

<script type="text/javascript">
   $(function() {
      $('#cat_type').on('change', function() {
         var $this = $(this);
         $.ajax({
            url : "ajax_get_category_by_type.php",
            type : "GET",
            dataType: "json",
            data: {
               type: $this.val().toUpperCase()
            },
            success: function(response) {
               var firstOption = $('#cat_parent_id').find('option').first();
               $('#cat_parent_id option').not(firstOption).remove();
               for(var i in response) {
                  var item = response[i];
                  var otherOption = $('<option value="'+item.id+'">'+item.name+'</option>');
                  otherOption.insertAfter(firstOption);
               }
            }
         });
      });
   });
</script>

</body>

</html>