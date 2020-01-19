<?
$users = array('aff_vg' => 'facebook_google');
$realm	= "dev.affiliate.vatgia.vn";

function check_authen(){
	global $realm;
	if ( empty($_SERVER['PHP_AUTH_DIGEST']) ) {
	    @header('HTTP/1.1 401 Unauthorized');
	    @header('WWW-Authenticate: Digest realm="'.$realm.'",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');
	    die('Text to send if user hits Cancel button');
	}
}
// function to parse the http auth header
function http_digest_parse($txt)
{
    // protect against missing data
	$needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));

    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}



//Pass fake login
$pass_fake			=	'jdfhkjdhfdkhdkf';
//Kiem tra xem ip nay co duoc phep vao admin hay khong
$ip					= $_SERVER['REMOTE_ADDR'];
$ip_fake				=	$_SERVER['REMOTE_ADDR'];
$check_ip 			= 0;
$mod_file			= 0;

if(!checkIpLogin()){
	die("<h3 align='center'>Ban chua co quyen truy cap vao trang nay.</h3>");
}


// require_once("../../../classes/form.php");
// require_once("../../../functions/functions.php");
// require_once("../../../functions/file_functions.php");
// require_once("../../../functions/date_functions.php");
// require_once("../../../functions/resize_image.php");
// require_once("../../../functions/simple_html_dom.php");
// require_once("../../../functions/ads/ads_functions.php");
// require_once("../../../functions/translate.php");
// require_once("../../../functions/pagebreak.php");
// require_once("../../../classes/generate_form.php");
// require_once("../../../classes/form.php");
// require_once("../../../classes/html_cleanup.php");
// require_once("../../../classes/upload.php");
// require_once("../../../classes/tinyMCE.php");
// require_once("../../../classes/menu.php");
// require_once("../../../classes/create_category.php");
// require_once("grid.php");

//$wys_path				= "../../resource/wysiwyg_editor/";
//require_once($wys_path . "fckeditor.php");

require_once("template.php");
$admin_id 				= getValue("user_id","int","SESSION");
$lang_id	 				= getValue("lang_id","int","SESSION");;

//phan khai bao bien dung trong admin
$fs_stype_css			= "../css/css.css";
$fs_template_css		= "../css/template.css";
$fs_border 				= "#f9f9f9";
$fs_bgtitle 			= "#DBE3F8";
$fs_imagepath 			= "../../resource/images/";
$fs_scriptpath 		= "../../resource/js/";
$fs_denypath			= "../../error.php";
$wys_cssadd				= array();
$wys_cssadd				= "/css/all.css";
$sqlcategory 			= "";
$fs_category			= checkAccessCategory();
//phan include file css

$load_header 			= '<link href="../../resource/css/css.css" rel="stylesheet" type="text/css">';
//$load_header 			.= '<link href="../../resource/css/css1.css" rel="stylesheet" type="text/css">';
$load_header            .= '<link href="../../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">';
$load_header 			.= '<link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">';
$load_header 			.= '<link href="../../resource/css/style.css" rel="stylesheet" type="text/css">';
$load_header 			.= '<link href="../../resource/css/template.css" rel="stylesheet" type="text/css">';
$load_header 			.= '<link href="../../resource/css/grid.css" rel="stylesheet" type="text/css">';
$load_header 			.= '<link href="../../resource/css/thickbox.css" rel="stylesheet" type="text/css">';
$load_header 			.= '<link href="../../resource/css/calendar.css" rel="stylesheet" type="text/css">';
$load_header 			.= '<link href="../../resource/css/reset-bootstrap.css" rel="stylesheet" type="text/css">';
$load_header 			.= '<link href="../../resource/css/jquery.contextMenu.css" rel="stylesheet" type="text/css">';
$load_header 			.= '<link href="../../resource/js/jwysiwyg/jquery.wysiwyg.css" rel="stylesheet" type="text/css">';
$load_header 			.= '<link href="../../resource/css/3dots.css" rel="stylesheet" type="text/css">';
// $load_header            .= '<link href="../../resource/css/datatables.min.css" rel="stylesheet" type="text/css">';

//phan include file script
$load_header 			.= '<script language="javascript" src="../../assets/js/jquery.min.js"></script>';
$load_header 			.= '<script language="javascript" src="../../assets/bootstrap/js/bootstrap.min.js"></script>';
$load_header 			.= '<script language="javascript" src="../../resource/js/grid.js"></script>';
$load_header 			.= '<script language="javascript" src="../../resource/js/library.js"></script>';
$load_header 			.= '<script language="javascript" src="../../resource/js/thickbox.js"></script>';
$load_header 			.= '<script language="javascript" src="../../resource/js/calendar.js"></script>';
$load_header 			.= '<script language="javascript" src="../../resource/js/tooltip.jquery.js"></script>';
$load_header 			.= '<script language="javascript" src="../../resource/js/jquery.jeditable.js"></script>';
$load_header 			.= '<script language="javascript" src="../../resource/js/swfObject.js"></script>';
$load_header 			.= '<script language="javascript" src="../../resource/js/jquery.contextMenu.js"></script>';
// $load_header 			.= '<script language="javascript" src="../../resource/js/jwysiwyg/jquery.wysiwyg.js"></script>';
//$load_header 			.= '<script language="javascript" src="../../resource/js/windowProm/windowprompt.js"></script>';
// $load_header 			.= '<script language="javascript" src="../../resource/js/datatables.min.js"></script>';

$load_header .= '<link rel="stylesheet" type="text/css" href="../../assets/css/jquery.tagsinput.css"/>';
$load_header .= '<script src="../../assets/js/jquery.tagsinput.js"></script>';

$load_header .= '<link href="../../resource/js/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">';
$load_header .= '<script src="../../resource/js/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"></script>';

$load_header .= '<link href="../../resource/js/jquery-ui/jquery-ui.min.css" rel="stylesheet"/>';
$load_header .= '<script src="../../resource/js/jquery-ui/jquery-ui.min.js"></script>';

$load_header .= '<script src="../../assets/js/tinymce.min.js"></script>';

$load_header .= '<link href="../../assets/css/common.css" rel="stylesheet" />';

$load_header .= '<script src="../../resource/js/admin.js"></script>';

// Select 2
$load_header .= '<link type="text/css" rel="stylesheet" href="../../assets/js/select2/css/select2.min.css" />';
$load_header .= '<script src="../../assets/js/select2/js/select2.full.min.js"></script>';

// Chart js
$load_header .= '<script src="../../assets/js/Chart.min.js"></script>';


$fs_change_bg			= 'onMouseOver="this.style.background=\'#DDF8CC\'" onMouseOut="this.style.background=\'#FEFEFE\'"';
//phan ngon ngu admin
$db_language			= new db_query("SELECT tra_text,tra_keyword FROM admin_translate");
$langAdmin 				= array();
foreach($db_language->fetch() as $row){
	$langAdmin[$row["tra_keyword"]] = $row["tra_text"];
}

// Get config from database
$db_con	= new db_query("SELECT * from configuration");
if ($row= $db_con->fetch(true)){
	while (list($data_field, $data_value) = each($row)) {
		if (!is_int($data_field)){
			//tao ra cac bien config
			$$data_field = $data_value;
			//echo $data_field . "= $data_value <br>";
		}
	}
}
$db_con->close();
unset($db_con);

//Admin city security
$fs_error	= "../../error.php";

$userlogin	= getValue("userlogin", "str", "SESSION", "", 1);
$password	= getValue("password", "str", "SESSION", "", 1);
$lang_id		= getValue("lang_id", "int", "SESSION", 1);

$db_admin_user = new db_query("SELECT *
							 FROM admin_user
							 WHERE adm_loginname='" . $userlogin . "' AND adm_password='" . $password . "' AND adm_active=1 AND adm_delete = 0");

$admin_id	= 0;
$is_admin	= 0;
//Check xem user co ton tai hay khong
if ($row = $db_admin_user->fetch(true)){
	$admin_id	= intval($row["adm_id"]);
	$is_admin	= $row["adm_isadmin"];
}
unset($db_admin_user);

$arrayApprove				= array( 0 => array("Chưa duyệt","Chưa duyệt", "#FFFDFB")
										  ,1 => array("Đã duyệt", "Đã được duyệt", "#FFFFC1")
										  ,2 => array("Duyệt lại", "Đã được duyệt", "#FFFFC1")
										  ,10 => array("Không duyệt", "Quảng cáo không được duyệt vui lòng sửa lại!", "#FF9D3C")
										  ,11 => array("Bị khóa", "Quảng cáo của bạn đã bị khóa", "#BF6000")
										  );
$arrayAprrove1				= array(-1 => "Tất cả",20 => "Đã xóa");
foreach($arrayApprove as $key=>$arr){
	$arrayAprrove1[$key]	=	$arr[0];
}
?>
