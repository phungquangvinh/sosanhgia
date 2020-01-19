<?
require_once("../../bootstrap.php");
require_once 'inc_security.php';

use App\Models\Product;
use App\Models\Categories\Category;



$cat_id = getValue('cat_id', 'str', 'GET', '', 3);
$cat_name = getValue('cat_name', 'str', 'GET', '', 3);
$cat_type = getValue('cat_type', 'str', 'GET', '', 3);
$cat_parent_id = getValue('cat_parent_id', 'int', 'GET', -1, 3);

$sqlWhere = "";

if($cat_id) {
    $sqlWhere .= " AND cat_id = " . (int) $cat_id;
}

if($cat_name) {
    $sqlWhere .= " AND cat_name LIKE '%". $cat_name ."%'";
}

if($cat_type) {
	$sqlWhere .= " AND cat_type = '" . $cat_type . "'";
}

if($cat_parent_id >= 0) {
	$sqlWhere .= " AND cat_parent_id =".$cat_parent_id;
}

$list = new fsDataGird("cat_id", "cat_name", translate_text("Danh mục"));

$sql		=	"1";
$listAll = array();

//Lấy tất cả danh mục cha
$menu = new menu();
$menu->getAllChild('categories_multi','cat_id','cat_parent_id',0,'1 '.$sqlWhere,'cat_all_child,cat_name,cat_type,cat_order,cat_active,cat_icon,cat_hot,cat_background_home_page',' cat_order ASC');

$categories = $menu->menu;

//_debug($categories);die;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top(translate_text("Category listing"))?>
	<?
	if(!is_array($listAll)) $listAll = array();
	?>
	<form action="" method="GET" style="margin: 10px 0;">
		<table>
			<tr>
				<td>
					<label class="label_text">Tên:</label>
					<input type="text" name="cat_name" value="<?php echo $cat_name ?>" class="textbox">
				</td>
				<td>
					<label class="label_text">ID:</label>
					<input type="text" name="cat_id" value="<?php echo $cat_id ?>" class="textbox">
				</td>
				<td>
					<label class="label_text">Loại:</label>
					<select name="cat_type">
					<?php foreach($type_arr as $key => $value): ?>
						<option value="<?php echo $key ?>" <?php echo $key == $cat_type ? 'selected="selected"' : '' ?>><?php echo $value; ?></option>
					<?php endforeach; ?>
					</select>
				</td>
				<td>
					<a href="?cat_parent_id=0" class="btn btn-xs btn-link">Danh mục cấp 1</a>
				</td>
				<td colspan="2">
					<input type="submit" class="btn btn-info btn-search" value="Tìm kiếm">
				</td>
			</tr>
		</table>

	</form>
	<table border="1" cellpadding="3" cellspacing="0" class="table" width="100%" bordercolor="<?=$fs_border?>">
		<tr style="background-color: #edeef0">
			<td class="bold bg" width="5"><input type="checkbox" id="check_all" onClick="check('1','<?=count($listAll)+1?>')"></td>
			<td class="bold bg" width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.png" border="0"></td>
			<td class="bold bg" >ID</td>
			<td class="bold bg" ><?=translate_text("Tên danh mục")?></td>
			<td class="bold bg">Icon</td>
			<td class="bold bg">Ảnh Danh Mục</td>
            <td class="bold bg">Loại danh mục</td>
			<td class="bold bg" align="center"><?=translate_text("Order")?></td>
			<td class="bold bg" align="center" width="5"><?=translate_text("Active")?></td>
			<!-- <td class="bold bg" align="center" width="">Nav</td> -->
			<td class="bold bg" align="center" width="">Hot</td>
			<td class="bold bg" align="center" width="16">Edit</td>
			<td class="bold bg" align="center" width="16">Delete</td>
		</tr>
		<form action="quickedit.php?returnurl=<?=base64_encode(getURL())?>" method="post" name="form_listing" id="form_listing" enctype="multipart/form-data">
		<input type="hidden" name="iQuick" value="update" />

		<?php

		$i = 0;

		foreach($categories as $key=>$row){
			$i++;
		?>
		<tr <? if($i%2==0) echo ' bgcolor="#FAFAFA"';?>>
			<td>
				<input type="checkbox" name="record_id[]" id="record_<?=$row["cat_id"]?>_<?=$i?>" value="<?=$row["cat_id"]?>" />
				<input type="hidden" name="cat_id" value="<?=$row["cat_id"]?>"  />
			 </td>
			<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.png" border="0" style="cursor:pointer" onClick="document.form_listing.submit()" alt="Save"></td>
			<td><?=$row["cat_id"];?></td>
			<td nowrap="nowrap">
            	<a href="javascript:;">
                    <?php
                        for($i = 0; $i < $row['level']; $i ++) echo '|__';
                        echo $row['cat_name'];
                        // echo $row['cat_all_child'];
                    ?>
                </a>
			</td>
			<td>
				<?php if (isset($row['cat_icon'])) {
					echo "Have";
				} else {
					echo "Don't Have";
				}?>
			</td>
			<td>
				<img src="<?php echo parse_file_url($row['cat_background_home_page']) ?>" alt="" height="35" />
			</td>

            <td>
                <?php echo array_get($type_arr, strtolower($row['cat_type'])) ?>
            </td>
			<td align="center">
				<a href="javascript:;"><?php echo $row['cat_order'] ?></a>
			</td>

			<td align="center"><a onclick="loadactive(this); return false;" href="active.php?record_id=<?=$row["cat_id"]?>&field=cat_active&value=<?=abs($row["cat_active"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>check_<?=$row["cat_active"];?>.gif" title="Active!"/></a></td>
			<!-- <td align="center"><a onclick="loadactive(this); return false;" href="active.php?record_id=<?=$row["cat_id"]?>&field=cat_nav&value=<?=abs($row["cat_nav"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>check_<?=$row["cat_nav"];?>.gif" title="Danh mục!"/></a></td> -->
			<td align="center"><a onclick="loadactive(this); return false;" href="active.php?record_id=<?=$row["cat_id"]?>&field=cat_hot&value=<?=abs($row["cat_hot"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>check_<?=$row["cat_hot"];?>.gif" title="Hiện ở trang chủ!"/></a></td>
			<td align="center"><a href="edit.php?record_id=<?=$row['cat_id']?>"><img src="<?=$fs_imagepath?>edit.png" /></a></td>
			<td align="center">
				<!-- <img src="<?=$fs_imagepath?>delete.png" alt="DELETE" border="0" onclick="if (confirm('Are you sure to delete?')){ window.location.href='delete.php?record_id=<?=$row["cat_id"]?>&returnurl=<?=base64_encode(getURL())?>'}" style="cursor:pointer"/> -->
			</td>
		</tr>
		<?
			}
		?>
		</form>
		</table>

<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
