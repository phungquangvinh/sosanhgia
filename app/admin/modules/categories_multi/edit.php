<?php
require_once("../../bootstrap.php");
require_once 'inc_security.php';

checkAddEdit("edit");

$fs_redirect        = base64_decode(getValue("url", "str", "GET", base64_encode("listing.php")));
$record_id          = getValue("record_id");

//Khai báo biến khi thêm mới
$fs_title           = "Sửa thông tin danh mục";
$fs_action          = getURL();
$fs_errorMsg        = "";


// Lấy giá trị từ POST
$cat_name            =  getValue('cat_name', 'str', 'POST', '');
$cat_slug            =  removeTitle($cat_name);
$cat_parent_id       =  getValue('cat_parent_id', 'int', 'POST', '');
$cat_type            =  getValue('cat_type', 'str', 'POST', '');
$cat_rewrite         =  getValue('cat_rewrite', 'str', 'POST', 0);
$cat_url             =  getValue('cat_url', 'str', 'POST', '');
$cat_show            =  getValue('cat_show', 'int', 'POST', '');
$cat_title_seo       =  getValue('cat_title_seo', 'str', 'POST', '');
$cat_keywords_seo    =  getValue('cat_keywords_seo', 'str', 'POST', '');
$cat_description_seo =  getValue('cat_description_seo', 'str', 'POST', '');
$cat_teaser          =  getValue('cat_teaser', 'str', 'POST', '');
$cat_description     =  getValue('cat_description', 'str', 'POST', '');
$cat_order           =  getValue('cat_order', 'int', 'POST', 0);
$cat_active          =  getValue('cat_active', 'int', 'POST', 0);
$cat_keywords        =  getValue('cat_keywords', 'str', 'POST', '');
$cat_icon            =  getValue('cat_icon', 'str', 'POST', '');
  
// _debug($cat_icon_hover);
//Call Class generate_form();
$myform = new generate_form();
$myform->add('cat_name', 'cat_name', 0, 1, '', 1, 'Chưa nhập tên danh mục');
$myform->add('cat_keywords', 'cat_keywords', 0, 1, '', 1, '');

$myform->add('cat_parent_id', 'cat_parent_id', 0, 1, 0);
$myform->add('cat_type', 'cat_type', 0, 1, '', 1, 'Chưa chọn loại danh mục');
$myform->add('cat_has_child', 'cat_has_child', 1, 1, 0);
$myform->add('cat_active', 'cat_active', 1, 1, 0);
$myform->add('cat_order', 'cat_order', 1, 1, 0);
$myform->add('cat_rewrite', 'cat_rewrite', 0, 1, '');
$myform->add('cat_description', 'cat_description', 0, 1, '');
$myform->add('cat_slug', 'cat_slug', 0, 1, '');
$myform->add('cat_icon', 'cat_icon', 0, 1, '');

if (isset($_FILES['cat_icon']) && $_FILES['cat_icon']['error'] == UPLOAD_ERR_OK) {
    $cat_icon = app('uploader')->upload('cat_icon');
    $myform->add('cat_icon', 'cat_icon', 0, 1, '');
}
if (isset($_FILES['cat_background_home_page']) && $_FILES['cat_background_home_page']['error'] == UPLOAD_ERR_OK) {
    $cat_background_home_page = app('uploader')->upload('cat_background_home_page');
    $myform->add('cat_background_home_page', 'cat_background_home_page', 0, 1, '');
}
// die;
$myform->addTable('categories_multi');
// _debug($myform);

$myform->evaluate();

//Get action variable for add new data
$action             = getValue("action", "str", "POST", "");
//Check $action for insert new data
if ($action == "execute") {
    if ($fs_errorMsg == "") {
        $fs_errorMsg        .=      $myform->checkdata();

        if ($fs_errorMsg == '') {
            //echo $myform->generate_insert_SQL();
            $sqlUpdate = $myform->generate_update_SQL('cat_id', $record_id);
            // _debug($sqlUpdate);die;
            $db_excute  =   new db_execute($sqlUpdate);
            unset($db_excute);

            if ($cat_parent_id != 0) {
                $db_excute  =   new db_execute("UPDATE categories_multi SET cat_has_child = 1 WHERE cat_id = ".$cat_parent_id);
                unset($db_excute);
                $cat_type   = getValue("cat_type", "str", "POST", "");
            
                if ($cat_type != "") {
                    // resetAllChild($fs_table, "cat_id", "cat_parent_id", "cat_has_child", "cat_all_child", "cat_type='" . $cat_type . "'", "cat_order ASC");
                }
            }
            redirect($fs_redirect);
        }
    }//End if($fs_errorMsg == "")
}//End if($action == "insert")

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<?php

//add form for javacheck
$myform->addFormname("add");

$myform->checkjavascript();
//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->evaluate();
$fs_errorMsg .= '';

//lay du lieu cua record can sua doi
$db_data    = new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
if ($row         = $db_data->fetch(true)) {
    foreach ($row as $key => $value) {
        if ($key!='lang_id' && $key!='admin_id') {
            $$key = $value;
        }
    }
} else {
    exit();
}
unset($db_data);

$allCategoriesLevel1 = App\Models\Categories\Category::where('cat_type = "'.$cat_type.'"')->select_all();
if (!$allCategoriesLevel1) {
    $allCategoriesLevel1 = new VatGia\Helpers\Collection();
}
$arrayCategoriesOption = [
    0 => 'Chọn cấp cha'
];

foreach ($allCategoriesLevel1 as $item) {
    $arrayCategoriesOption[$item->cat_id] = $item->cat_name;
}

?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?php /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top($fs_title)?>
<?php /*------------------------------------------------------------------------------------------------*/ ?>
    <p align="center" style="padding-left:10px;">
    <?php
    $form = new form();
    $form->create_form("add", $fs_action, "post", "multipart/form-data", 'onsubmit="validateForm(); return false;"');
    $form->create_table();

    ?>

    <?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
    <?=$form->errorMsg($fs_errorMsg)?>
    <?=$form->select("Loại danh mục", "cat_type", "cat_type", $type_arr, strtolower($cat_type), "")?>
    <?php echo $form->select('Cấp cha', 'cat_parent_id', 'cat_parent_id', $arrayCategoriesOption, $cat_parent_id) ?>
    <?=$form->text("Icon", "cat_icon", "cat_icon", $cat_icon, "Icon", 1, 250, "", 255, "", "", "")?>
   
    <?=$form->text("Tên danh mục", "cat_name", "cat_name", $cat_name, "Tên danh mục", 1, 250, "", 255, "", "", "")?>
    <?=$form->textarea("Từ khóa", "cat_keywords", "cat_keywords", $cat_keywords, "Từ khóa", 1, 450, 50, 255, "", "", "")?>

    <?=$form->text("Order", "cat_order", "cat_order", $cat_order, "", 1, 50, "", 255, "", "", "")?>
    <?=$form->checkbox("Active", 'cat_active', 'cat_active', 1, $cat_active, '')?>

    <?=$form->hidden("valradio", "valradio", 0)?>
    <tr>
        <td class="form_name">Ảnh danh mục : </td>
        <td class="form_text">
            <img src="<?php echo parse_file_url($cat_background_home_page) ?>" height="65" />
            <input type="file" name="cat_background_home_page" />
        </td>
    </tr>

    <tr>
        <td class="form_name">Mô tả ngắn: </td>
        <td class="form_text">
            <input type="text" name="cat_description" class="form_control" style="width: 350px;" value="<?php echo $cat_description ?>">
        </td>
    </tr>

    <?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", "");?>
    <?=$form->hidden("action", "action", "execute", "");?>
    <?php
    $form->close_table();
    $form->close_form();
    unset($form);
    ?>
    </p>
<?php /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_bottom() ?>
<?php /*------------------------------------------------------------------------------------------------*/ ?>

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