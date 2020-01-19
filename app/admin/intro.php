<div style="padding: 20px;">
<div id="welcome">
	<h1>Chào mừng bạn đến với trang quản lý website</h1>
</div>

<div id="body">
	<h2>Giá trị nền tảng của công ty:</h2>
	<ul style="list-style: none;">
		<li><span style="color: #ff9900;font-weight: bold;">Mục tiêu</span>: Living Internet. Xây dựng công ty số một giúp cuộc sống tốt hơn qua internet.</li>
		<li><span style="color: #ff9900;font-weight: bold;">Cá nhân</span>: Không bao giờ thỏa mãn với bản thân. Luôn cố gắng hết sức để ngày hôm nay sẽ tốt hơn hôm qua.</li>
		<li><span style="color: #ff9900;font-weight: bold;">Quản lý</span>: Luôn quan tâm đến nhân viên, đào tạo cho kế thừa để phát triển.</li>
		<li><span style="color: #ff9900;font-weight: bold;">Khách hàng</span>: Không bao giờ tiếc thời gian công sức để thỏa mãn khách hàng. Khách hàng là ông chủ duy nhất.</li>
	</ul>
</div>
</div>
<script src="resource/js/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" href="resource/js/colorbox/example5/colorbox.css" />
<?php
$isAdmin = isset($_SESSION["isAdmin"]) ? intval($_SESSION["isAdmin"]) : 0;
$user_id = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : 0;
$sql = '';
if($isAdmin != 1){
   $sql = ' INNER JOIN admin_user_right ON(adu_admin_module_id  = mod_id AND adu_admin_id = ' . $user_id . ')';
}

$db_menu = new db_query("SELECT * FROM modules " . $sql . " ORDER BY mod_order ASC");

?>
<div id="desktop_bound">
<!--
   <div id="" class="desktop_module_bound">
      <div class="desktop_icon home"></div>
      Index asdas sda  ád
   </div>
-->
<?php
$i=0;
$id_tab = 1;
foreach($db_menu->fetch() as $row) {
   if(file_exists("modules/" . $row["mod_path"] . "/inc_security.php")===true){
      $i++;
      $title_tab = $row["mod_name"];
      $arraySub = explode("|",$row["mod_listname"]);
		$arrayUrl = explode("|",$row["mod_listfile"]);
?>
   <div id="" class="desktop_module_bound" title="<?=$title_tab?>" href="#module_function_<?=$row['mod_id']?>">
      <div class="desktop_icon folder"></div>
      <?=$title_tab?>
      <div style="display: none;">
         <div id="module_function_<?=$row['mod_id']?>" class="module_function">
         <?php
         foreach($arraySub as $index => $function){
            $url = isset($arrayUrl[$index]) ? $arrayUrl[$index] : '#';
         ?>
            <div class="desktop_module_function_bound m" id="<?=$id_tab?>">
               <span class="id_tab" style="display: none;"><?=$id_tab?></span>
               <a onclick="return false" target="_blank" href="modules/<?=$row["mod_path"]?>/<?=$url?>">
                  <div class="desktop_module_function_icon"></div>
                  <?=$function?>
               </a>
					<span style="padding: 0; display: none;" class="title_tab"><?=$title_tab?></span>
            </div>
         <?php
            $id_tab++;
         }
         ?>
         </div>
      </div>
   </div>
<?php
   }
}
?>
<style>
.desktop_module_bound, .desktop_module_function_bound{
   cursor: pointer;
   text-align: center;
   display: block;
   float: left;
   padding: 10px;
   width: 80px;
   position: relative;
   height: 100px;
   border: 1px dotted transparent;
}
.desktop_module_bound:active{
   border: 1px dotted gray;
}
.desktop_icon,.desktop_module_function_icon{
   margin-left: 16px;
   width: 48px;
   height: 48px;
   overflow: hidden;
   background: url(resource/images/desktop/folder.png) no-repeat top center;
}
.home{
   background: url(resource/images/desktop/home.png) no-repeat top center;
}
.module_function{
   padding: 20px;
}
</style>
<script>
$(".desktop_module_bound").colorbox({inline:true, width:"50%", rel:'desktop_icon'});
var Desktop = Desktop || {
   start: function()
   {

   },
   end: function()
   {

   }
}
Desktop.start();
</script>
</div>
