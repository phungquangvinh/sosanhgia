<?

require_once dirname(__FILE__) . '/bootstrap.php';

//Chống bot truy cập
$denyconnect = new denyconnect();

$loginpath="login.php";
if (!isset($_SESSION["logged"])){
	redirect($loginpath);
}
else{
	if ($_SESSION["logged"] != 1){
		redirect($loginpath);
	}
}
$framemainsrc = 'blank.htm';
$db_language			= new db_query("SELECT tra_text,tra_keyword FROM admin_translate");
$langAdmin 				= array();
foreach($db_language->fetch() as $row) {
	$langAdmin[$row["tra_keyword"]] = $row["tra_text"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator Website</title>
<style>

</style>
<link rel="stylesheet" type="text/css" media="screen" href="resource/css/style.css" />
<link rel="stylesheet" type="text/css" media="screen" href="resource/css/jquery-ui.css" />

<script src="resource/js/jquery.js" type="text/javascript"></script>
<script src="resource/js/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>
<script src="resource/js/jquery.layout.js" type="text/javascript"></script>

<script language="JavaScript">
function calcHeight(id){
   if(!$("#"+id).attr("data-loaded")){
      //var divHeight = $("#tabs").height() - 50;
      var divHeight = $(window).height() - 100;
      $("#"+id).height(divHeight);
      $("#"+id).attr("data-loaded","true");
   }
}
</script>

<script type="text/javascript">
jQuery(document).ready(function(){

	$("#test-list").sortable({
			handle : '.handle',
			axis: 'y',
			update : function () {
			  var order = $('#test-list').sortable('serialize');
				$.ajax({
					url: "resource/process-sortable.php",
					type: "post",
					data: order,
					error: function(){
						alert("Lỗi load dữ liệu");
					}
				});
			  //alert(order);
				//$("#info").load("process-sortable.php?"+order);
			}
		 });

		/*----------------------------------------*/

		$('body').layout({
			resizerClass: 'ui-state-default',
			spacing_open: 11,
			spacing_closed: 11,
			slideTrigger_open: 'mouseleave'

		});

		/*----------------------------------------*/

		var maintab = jQuery('#tabs','#RightPane').tabs({
	        add: function(e, ui) {
	            // append close thingy
	            $(ui.tab).parents('li:first')
	                .append('<span class="ui-tabs-close ui-icon ui-icon-close" title="Close Tab"></span>')
	                .find('span.ui-tabs-close')
	                .click(function() {
	                    maintab.tabs('remove', $('li', maintab).index($(this).parents('li:first')[0]));
	                });
	            // select just added tab
	            maintab.tabs('select', '#' + ui.panel.id);
	        }
	    });
	    //$("#tabs").sortable({
	    	//items: "li",
	    	//axis: 'x'
	    //});
});
</script>
</head>
<body style="font-size: 11px;">

	<div class="ui-layout-north"><? include("resource/php/inc_header.php");?></div>

  	<div id="LeftPane" class="ui-layout-west">
		<? include('resource/php/inc_left.php');?>
	</div>
   <!-- #LeftPane -->
	<div id="RightPane" class="ui-layout-center" style="overflow: hidden;"><!-- Tabs pane -->
   	<div id="tabs" class="">
   	<ul>
			<li><a href="#tabs-1">Trang chủ</a></li>
		</ul>
		<div id="tabs-1" style="font-size:12px; display: block;">
         <div>
            <? include('intro.php'); ?>
         </div>
			<!--
         <iframe id="idframe_0" src="intro.php" frameborder="0" width="100%" onresize="calcHeight('idframe_0');" onLoad=calcHeight('idframe_0');></iframe>
         -->
		</div>
   	</div>
	</div> <!-- #RightPane -->

<script type="text/javascript">
		var hei = $(document).height() - $(".ui-layout-north").height() - 20;
		$("#tabs").css("min-height", hei);
		//$("#abc").text("Reload: " + hei);
		function reload(id){
			document.getElementById(id).src = document.getElementById(id).src;
		}

		/*----------------------------------------*/

		$(".m").click(function(){
			var stt = $(".id_tab", $(this)).html();
			var idtab = "#tab_" + stt;
			var title = "<span class='relo reload_hide' title='Reload Tab'></span>" + $(".title_tab", $(this)).html() + "<span id='raquo'>&raquo;</span>" + $(this).find("a").text();
			var source = $(this).find("a").attr("href");

			if($(idtab).html() != null) {
				$("#tabs").tabs("select", idtab);
				var txt = $("div[class$='ui-corner-bottom']").find("iframe").attr("id");
				reload(txt);
			}
			else{
				$("#tabs").tabs("add", idtab, title);
				$(idtab, "#tabs").append("<iframe id='idframe_" + stt + "' src='" + source + "' frameborder='0' width='100%' height='560px' onLoad=\"calcHeight('idframe_" + stt + "');\"></iframe>");
			}
         jQuery.colorbox.close("User added succesfully");
			//$("#txt").text($(source).html());
			//$("#abc").text(source);

			$(".relo").click(function(){
				var txt = $("div[class$='ui-corner-bottom']").find("iframe").attr("id");
				reload(txt);
				//var txt = $("li[class*='ui-tabs-selected']").find("a").attr("href");
				//var key = txt.substring(5, 6);
				//var idframe = "idframe_" + txt;
				//$("#abc").text("Reload: " + txt);
			});	//reload
		});
		/*----------------------------------------*/

		$(".infoacc").click(function(){
			var stt = $(this).attr("id");
			var idtab = "#tab_" + stt;
			var title = "<span class='relo reload_hide' title='Reload Tab'></span>" + $(this).html();
			var source = $(".sourceacc", $(this)).html();

			if($(idtab).html() != null) {
				$("#tabs").tabs("select", idtab);
				var txt = $("div[class$='ui-corner-bottom']").find("iframe").attr("id");
				reload(txt);
			}
			else{
				$("#tabs").tabs("add", idtab, title);
				$(idtab, "#tabs").append("<iframe id='idframe_" + stt + "' src='" + source + "' frameborder='0' width='100%' height='560px' ></iframe>");
			}

			$(".relo").click(function(){
				var txt = $("div[class$='ui-corner-bottom']").find("iframe").attr("id");
				reload(txt);
			});
		});
	</script>
</body>

</html>