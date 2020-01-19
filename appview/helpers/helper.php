<?php


use Nht\Hocs\Core\Uploads;

date_default_timezone_set('Asia/Ho_Chi_Minh');

function add3Dots($string, $limit)
{
    $dots = "...";
    $length = strlen($string);
    if ($length > $limit) {
        $string = substr($string, 0, $limit) . $dots;
    }
    echo $string;
}

function cut_string2($str, $length, $char = "...")
{
    //Nếu chuỗi cần cắt nhỏ hơn $length thì return luôn
    $strlen = mb_strlen($str, "UTF-8");
    if ($strlen <= $length) {
        return $str;
    }

    //Cắt chiều dài chuỗi $str tới đoạn cần lấy
    $substr = mb_substr($str, 0, $length, "UTF-8");
    if (mb_substr($str, $length, 1, "UTF-8") == " ") {
        return $substr . $char;
    }

    //Xác định dấu " " cuối cùng trong chuỗi $substr vừa cắt
    $strPoint = mb_strrpos($substr, " ", "UTF-8");

    //Return string
    if ($strPoint < $length - 20) {
        return $substr . $char;
    } else {
        return mb_substr($substr, 0, $strPoint, "UTF-8") . $char;
    }
}

function resetAllChild($table, $id_field, $field_parent, $field_has_child, $field_all_child, $sqlWhere, $order_clause){
    $class_menu         = new menu;
    $arrayHeaderMenu    = $class_menu->getAllChild($table, $id_field ,$field_parent, 0, $sqlWhere,"" . $id_field . "," . $field_has_child . "", $order_clause,0,1,0);

    $listparent = array();
    $level      = -1;
    // Lặp từ trên xuống dưới để lấy các cat con( dựa vào level)
    for($i = 0; $i < count($arrayHeaderMenu) ; $i++){
        $listid = $arrayHeaderMenu[$i][$id_field];
        // Lặp các danh mục tiếp theo nếu level của danh mục tiếp theo lớn hơn thì đấy chính là cấp con
        $cat_has_child = 0;
        for($j = $i + 1; $j < count($arrayHeaderMenu); $j++){
            if($arrayHeaderMenu[$j]['level'] > $arrayHeaderMenu[$i]['level']){
                $listid .= ", " . $arrayHeaderMenu[$j][$id_field];
                $cat_has_child = 1;
            }else{
                // Đã hết cấp con
                break;
            }
        }
        $listid = convert_list_to_list_id($listid);
        // Cập nhật database
        $db_update  = new db_execute("UPDATE " . $table . " SET " . $field_has_child . " = " . $cat_has_child . ", " . $field_all_child . " = '" . $listid . "' WHERE " . $id_field . " = " . intval($arrayHeaderMenu[$i][$id_field]));
        unset($db_update);
    }
}

// upload ảnh từ url vào folder ngay tháng năm

// generate_name : truyền vào url ảnh để ra random 1 tên
// getPathDateTime : truyền vào tên ảnh sau khi generate , $pre_path là folder uploads/
// get_image : truỳen vào url

function generate_name($filename)
{
    $name = "";
    for ($i = 0; $i < 3; $i++) {
        $name .= chr(rand(97, 122));
    }
    $today = getdate();
    $name .= $today[0];
    $ext = substr($filename, (strrpos($filename, ".") + 1));
    return date("Y_m_d", time()) . '_' . $name . "." . $ext;
}

function generate_name2($filename)
{
    $ipClient = time() . uniqid() . rand(111111, 999999) . rand(111111, 999999);

    $frefix = date("Y_m_d") . '___' . time() . '___';
    $nFilename = str_replace('.', '--', $filename);
    $nFilename = removeTitle($nFilename);
    $filenameMd5 = $frefix . md5($nFilename . $ipClient);
    $ext = substr($filename, (strrpos($filename, ".") + 1));
    return $filenameMd5 . '.' . $ext;
}

function get_image($url, $pathFile)
{
    $filename = generate_name($url);
    $path = $pathFile . date("Y/m/d", time()) . '/' . $filename;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . $path, 'w+6');
    fwrite($fp, $result);
    fclose($fp);

    return $filename;
}

function get_image_by_name()
{

}

function get_name_image($url, $pathFile)
{
    $sExtension = substr($url['name'], (strrpos($url['name'], ".") + 1));
    $sExtension = strtolower($sExtension);

    if ($url['size'] / 1024 / 1024 < 10) {
        $extensions = array('jpg', 'png', 'gif', 'jpeg', 'PNG', 'JPG', 'JPEG', 'GIF');
        if (in_array($sExtension, $extensions)) {
            $filename = generate_name($url['name']);
            $path = $_SERVER['DOCUMENT_ROOT'] . $pathFile . date("Y/m/d", time()) . '/' . $filename;
            move_uploaded_file($url['tmp_name'], $path);
            return $filename;
        } else {
            return '';
        }
    }
    return '';
}

function get_name_image_array($url, $pathFile)
{
    $sExtension = substr($url['name'], (strrpos($url['name'], ".") + 1));
    $sExtension = strtolower($sExtension);

    if ($url['size'] / 1024 / 1024 < 10) {
        $extensions = array('jpg', 'png', 'gif', 'jpeg', 'PNG', 'JPG', 'JPEG', 'GIF');
        if (in_array($sExtension, $extensions)) {
            $filename = generate_name($url['name']);
            $path = $_SERVER['DOCUMENT_ROOT'] . $pathFile . date("Y/m/d", time()) . '/' . $filename;
            move_uploaded_file($url['tmp_name'], $path);
            return $filename;
        } else {
            return '';
        }
    }
    return '';
}

function upload_validate_image($file, $pathFile, $width, $height)
{

    $arrayType = ['image/png', 'image/jpeg'];

    foreach ($file as $key => $value) {
        if ($value['size'] > 2048000) {
            return 'Ảnh : "' . $value['name'] . '" có size > 2mb ';
        } elseif (!in_array($value['type'], $arrayType)) {
            return 'Ảnh : "' . $value['name'] . '" có định dạng không đúng ';
        } else {
            $fileName = generate_name($value['name']);
            $path = $_SERVER['DOCUMENT_ROOT'] . $pathFile . date("Y/m/d", time()) . '/' . $fileName;
            move_uploaded_file($value['tmp_name'], $path);

            // resize
            $pathResize = $_SERVER['DOCUMENT_ROOT'] . $pathFile . date("Y/m/d", time()) . '/' . $fileName;
            smart_resize_image2($pathResize, null, $width, $height, false, $pathResize, false, false, 100);

            // đưa tất cả tên ảnh đã upload thành công vào mảng
            $arrImage[] = $fileName;
        }
    }
    return $arrImage;
}

function create_path_time($fileName)
{
    return date("Y/m/d", time()) . '/' . $fileName;
}

// tạo folder ngày tháng năm
function create_folder($path)
{
    // Lấy ngày, tháng, năm hiện tại
    $date_current = date('Y/m/d', time());
    $dir = $path;
    $day_current = substr($date_current, 8, 2);
    $month_current = substr($date_current, 5, 2);
    $year_current = substr($date_current, 0, 4);

    // Tạo folder năm hiện tại
    if (!is_dir($dir . $year_current)) {
        mkdir($dir . '/' . $year_current . '/', 0700);
    }

    // Tạo folder tháng hiện tại
    if (!is_dir($dir . $year_current . '/' . $month_current)) {
        mkdir($dir . $year_current . '/' . $month_current . '/', 0700);
    }

    // Tạo folder ngày hiện tại
    if (!is_dir($dir . $year_current . '/' . $month_current . '/' . $day_current)) {
        mkdir($dir . $year_current . '/' . $month_current . '/' . $day_current . '/', 0700);
    }
}

function create_folder_full_permissions($path)
{
    // edit:ducpanda
    // chmod folder with 0777
    $date_current = date('Y/m/d', time());
    $dir = $path;
    $day_current = substr($date_current, 8, 2);
    $month_current = substr($date_current, 5, 2);
    $year_current = substr($date_current, 0, 4);

    // Tạo folder năm hiện tại
    if (!is_dir($dir . $year_current)) {
        mkdir($dir . '/' . $year_current . '/', 0777, true);
    }

    // Tạo folder tháng hiện tại
    if (!is_dir($dir . $year_current . '/' . $month_current)) {
        mkdir($dir . $year_current . '/' . $month_current . '/', 0777);
    }

    // Tạo folder ngày hiện tại
    if (!is_dir($dir . $year_current . '/' . $month_current . '/' . $day_current)) {
        mkdir($dir . $year_current . '/' . $month_current . '/' . $day_current . '/', 0777);
    }
}

function resize_image_array($path, $fileName, $arrResize = array())
{
    $file = $path . 'default/' . create_path_time($fileName);
    $resizeMedium = $path . 'medium/' . create_path_time($fileName);
    $resizeSmall = $path . 'small/' . create_path_time($fileName);
    if (count($arrResize) > 0) {
        smart_resize_image2($file, null, $arrResize['medium']['width'], $arrResize['medium']['height'], false, $resizeMedium, false, false, 100);
        smart_resize_image2($file, null, $arrResize['small']['width'], $arrResize['small']['height'], false, $resizeSmall, false, false, 100);
    } else {
        smart_resize_image2($file, null, 380, 285, false, $resizeMedium, false, false, 100);
        smart_resize_image2($file, null, 180, 134, false, $resizeSmall, false, false, 100);
    }
}

function parse_image_no_size($folder, $fileName)
{
    if ($fileName == "") {
        return "";
    } else {
        $explode = explode('_', $fileName);
        $source = '/uploads/' . $folder . '/' . $explode[0] . '/' . $explode[1] . '/' . $explode[2] . '/' . $fileName;
        return $source;
    }
}

function parse_image($folder, $size, $fileName)
{
    if ($fileName == "") {
        return "";
    } else {
        $explode = explode('_', $fileName);
        $source = '/uploads/' . $folder . '/' . $size . '/' . $explode[0] . '/' . $explode[1] . '/' . $explode[2] . '/' . $fileName;
        return $source;
    }
}

function parse_image_by_file($folder, $fileName)
{
    if ($fileName == "") {
        return "";
    } else {
        $explode = explode('_', $fileName);
        $source = '/uploads/' . $folder . '/' . $fileName;
        return $source;
    }
}

// lay ra phan tu dau tien cua chuoi json
function get_first_from_json($folder, $size, $data)
{
    if ($data == "") {
        return "";
    } else {
        $dataJson = json_decode($data, 1);
        $firstValue = isset($dataJson[0]) ? $dataJson[0] : "";
        $image = parse_image($folder, $size, $firstValue);
        return $image;
    }
}

function limit_json($json, $limit)
{
    $dataJson = json_decode($json);
    $i = 0;
    $data = array();
    foreach ($dataJson as $key => $value) {
        if ($i++ == $limit) {
            break;
        }
        $data[] = $value;
    }
    return $data;
}

function get_time_from_input_date($date, $status)
{
    $explode = explode('-', $date);
    $year = $explode[0];
    $month = $explode[1];
    $day = $explode[2];
    if ($status == 'start') {
        $hour = 0;
        $minute = 0;
        $second = 0;
    } elseif ($status == 'end') {
        $hour = 23;
        $minute = 59;
        $second = 59;
    }
    return mktime($hour, $minute, $second, $month, $day, $year);
}

function convert_date_to_int($date)
{
    $explode = explode('/', $date);
    if (isset($explode[0]) && isset($explode[1]) && isset($explode[2])) {
        $day = intval($explode[0]);
        $month = intval($explode[1]);
        $year = intval($explode[2]);
        return mktime(0, 0, 0, $month, $day, $year);
    }
}

function convert_day_to_second($day)
{
    return $day * 24 * 60 * 60;
}

function minifyJS($arr)
{
    minify($arr, 'https://javascript-minifier.com/raw');
}

function minifyCSS($arr)
{
    minify($arr, 'https://cssminifier.com/raw');
}

function minify($arr, $url)
{
    foreach ($arr as $key => $value) {
        $handler = fopen($value, 'w') or die("File <a href='" . $value . "'>" . $value . "</a> error!<br />");
        fwrite($handler, getMinified($url, file_get_contents($key)));
        fclose($handler);
        echo "File <a href='" . $value . "'>" . $value . "</a> done!<br />";
    }
}

function getMinified($url, $content)
{
    $postdata = array('http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query(array('input' => $content))));
    return file_get_contents($url, false, stream_context_create($postdata));
}

function getFileInPage($pathFile)
{
    if (file_exists($pathFile)) {
        return file_get_contents($pathFile);
    } else {
        return '';
    }
}

function convertIntToDate($int)
{
    // count $int = 8
    // $date = date_create($int);
    // return date_format($date, "m/d/Y");
    return date($int, "m/d/Y");
}

function convertIntDate($dateInt)
{
    return date("H:i , d/m/Y", $dateInt);
}

if (!function_exists('isArrNotNull')) {
    /**
     * check empty array
     *
     * @param array $array
     * @return true or false
     */
    function isArrNotNull($array)
    {
        if (is_array($array) && count($array) > 0 && !empty($array)) {
            return true;
        }
        return false;
    }
}
if (!function_exists('isArrNotNull2')) {
    /**
     * check empty array
     *
     * @param array $array
     * @return true or false
     */
    function isArrNotNull2($array)
    {
        if (is_array($array) && !empty($array)) {
            return true;
        }
        return false;
    }
}


if (!function_exists('isNotNull')) {
    /**
     * check empty var
     *
     * @param str $str
     * @return true or false
     */
    function isNotNull($str)
    {
        if (isset($str) && !is_null($str) && !empty($str) && $str != '') {
            return true;
        }
        return false;
    }
}


if (!function_exists('arr_filter_Search')) {
    /**
     * Filter and search data with options
     * Developed by Ducpanda
     * @param array $listWhere | $listWhere[0]: name row | $listWhere[1]: value
     * @param array $listOrderBy | $listOrderBy[0]: name row | $listOrderBy[1]: value
     * @param array $paginate | $paginate[0]: page | $paginate[1]: page size
     * @param Boolean $getData | 1 or any number get data now | 2 continue query
     * @param max value add to array is 2
     * @return collection
     */
    function arr_filter_Search($model, $listWhere = [], $listOrderBy = [], $paginate = [], $getData = 1)
    {
        if (is_null($model)) {
            $model = $this;
        }
        if (isArrNotNull($listWhere) && count($listWhere) < 2) {
            $model->where($listWhere[0], $listWhere[1]);
        }
        if (isArrNotNull($listOrderBy) && count($listOrderBy) < 2) {
            $model->order_by($listOrderBy[0], $listOrderBy[1]);
        }
        if (isArrNotNull($paginate) && count($paginate) < 2) {
            $model->pagination($paginate[0], $paginate[1]);
        }
        if ($getData != 2) {
            return $model->select_all();
        } else {
            return $model;
        }
    }
}


// function changeImgToAmpImg($data = null)
// {
//     if (!is_null($data)) {
//         $remoteSrcset = str_replace('srcset', '', $data);
//         $addWithToImg = str_replace('data-natural-width', "height='610' width", $remoteSrcset);
//         $remoteImportant = str_replace('width', "layout='responsive' width", $addWithToImg);
//         $addHeightToImg = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $remoteImportant);
//         $result = preg_replace(
//             '/(<img[^>]+>(?:<\/img>)?)/i',
//             '$1</amp-img>',
//             $addHeightToImg
//         );
//         echo str_replace('<img', '<amp-img', $result);
//     }
// }

function addChecked($name, $vl)
{
    if (isset($name) && $_GET[$name] == $vl) {
        return 'checked = "checked"';
    }
    return '';
}

// function cvListImgToArr($str)
// {
//     $data = explode(',', $str);
//     return $data;
// }

if (!function_exists('showCategories')) {
    /**
     * show categories
     * @param array $data
     * @param Author : Ducpanda -TTS
     * @return mixed
     */
    function showCategories($categories, $parent_id = 0, $char = '', $select_id = [])
    {
        foreach ($categories as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['cat_parent_id'] == $parent_id) {
                if ($item['cat_parent_id'] == 0) {
                    $idPr = "id='text_b'";
                } else {
                    $idPr = " ";
                }

                if (is_array($select_id) && !empty($select_id) && $select_id[0] == $item['cat_id']) {
                    echo '<option value="' . $item['cat_id'] . '" selected>';
                } else {
                    echo '<option ' . $idPr . ' value="' . $item['cat_id'] . '">';
                }

                echo $char . $item['cat_name'];
                echo '</option>';

                // Xóa chuyên mục đã lặp
                unset($categories[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($categories, $item['cat_id'], $char . '--- ', [$select_id[0]]);
            }
        }
    }
}


if (!function_exists('checkSlugTable')) {
    function checkSlugTable($model, $slugInTable, $slug)
    {
        $idAnd = 1;
        $idAnd++;
        $checkSlug = $model::where($slugInTable, $slug)->first();
        if (!empty($checkSlug)) {
            $slug .= $idAnd;
            return checkSlugTable($model, $slugInTable, $slug); //đệ quy tiếp
        }
        return $slug;
    }
}

function searchForId($id, $array)
{
    foreach ($array as $key => $val) {
        if ($val['pro_id'] === $id) {
            return $array[$key]['quantity'] += 1;
        }
    }
    return null;
}

function genStar($star)
{
    $ckUnit = '';
    for ($i = 0; $i < $star; $i++) {
        $ckUnit .= '<i class="fa fa-star"></i>';
    }
    if ($star < 5) {
        for ($i = 0; $i < 5 - $star; $i++) {
            $ckUnit .= '<i class="fa fa-star" style="color:#dcdcdc"></i>';
        }
    }

    return $ckUnit;
}

function checkInArray($array, $value)
{
    if (isArrNotNull($array) && $value) {
        if (in_array($value, $array)) {
            return true;
        }
        return false;
    }
    return false;
}


function checkPropertyIdInObject($object, $value, $field = 'hlp_property_id')
{
    if (isNotNull($object)) {
        $data = $object->where($field, $value);
        if (isNotNull($data) && count($data) > 0) {
            return 'selected';
        }
        return '';
    }
    return '';
}


function checkPropertyIdInArray($arraya, $vl, $field = 'property_id')
{
    if (in_array($vl, $arraya)) {
        return 'selected';
    }
    return '';
}


function searchInArray($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }

    return $results;
}

function convertToImage($folder, $size, $fileName)
{
    if ($fileName) {
        return parse_image($folder, $size, $fileName);
    }
    return '/assets/images/user_avatar_fake.jpg';
}

function calculateStar($star, $total)
{
    if (!$star || !$total) {
        return 0;
    }
    return round(($star * 100) / $total) . '%';
}


function upload_img($folder, $fileName)
{
    create_folder_full_permissions($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $folder . "/default/");

    $filename = $fileName;
    $image = get_name_image($filename, '/uploads/' . $folder . '/default/');
    return $image;
}

function to_slug($str)
{
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}

function saveImageFromBase64($value)
{
    list($type, $value) = explode(';', $value);
    list(, $extension) = explode('/', $type);
    list(, $value) = explode(',', $value);
    $path = 'images/' . uniqid() . '.' . $extension;
    $value = base64_decode($value);
    file_put_contents(storage_path($path), $value);
    return $path;
}

function smart_resize_image2($file,
                             $string = null,
                             $width = 0,
                             $height = 0,
                             $proportional = false,
                             $output = 'file',
                             $delete_original = true,
                             $use_linux_commands = false,
                             $quality = 100,
                             $grayscale = false
){
    if ($height <= 0 && $width <= 0) return false;
    if ($file === null && $string === null) return false;

    # Setting defaults and meta
    $info = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
    $image = '';
    $final_width = 0;
    $final_height = 0;
    list($width_old, $height_old) = $info;
    $cropHeight = $cropWidth = 0;
    switch ($info[2]) {
        case IMAGETYPE_JPEG:
            $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);
            break;
        case IMAGETYPE_GIF:
            $file !== null ? $image = imagecreatefromgif($file) : $image = imagecreatefromstring($string);
            break;
        case IMAGETYPE_PNG:
            $file !== null ? $image = imagecreatefrompng($file) : $image = imagecreatefromstring($string);
            break;
        default:
            return false;
    }

    $ratio = $width / $width_old;
    $new_w = $width;
    $new_h = $height_old * $ratio;

    //if that didn't work
    if ($new_h > $height) {
        $ratio = $height / $height_old;
        $new_h = $height;
        $new_w = $width_old * $ratio;
    }
    $image_resized = imagecreatetruecolor($new_w, $new_h);
    imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $new_w, $new_h, $width_old, $height_old);


    # Taking care of original, if needed
    if ($delete_original) {
        if ($use_linux_commands) exec('rm ' . $file);
        else @unlink($file);
    }

    # Preparing a method of providing result
    switch (strtolower($output)) {
        case 'browser':
            $mime = image_type_to_mime_type($info[2]);
            header("Content-type: $mime");
            $output = NULL;
            break;
        case 'file':
            $output = $file;
            break;
        case 'return':
            return $image_resized;
            break;
        default:
            break;
    }

    # Writing image according to type to the output destination and image quality
    switch ($info[2]) {
        case IMAGETYPE_GIF:
            imagegif($image_resized, $output);
            break;
        case IMAGETYPE_JPEG:
            imagejpeg($image_resized, $output, $quality);
            break;
        case IMAGETYPE_PNG:
            $quality = 9 - (int)((0.9 * $quality) / 10.0);
            imagepng($image_resized, $output, $quality);
            break;
        default:
            return false;
    }

    return true;
}

/**
 * [pictureProductThumb description]
 * @param  [type]  $filename   [description]
 * @param  integer $max_width  "100x100","200x200","150x150","400x400","800x800"
 * @param  integer $max_height "100x100","200x200","150x150","400x400","800x800"
 * @return [type]              [description]
 */
function pictureProductThumb($filename, $max_width = 0, $max_height = 0)
{
    if($filename == "") return '';
    $timeFile = substr(preg_replace("/([^0-9])/", "", $filename), 0, 10);
    $timeFile = intval($timeFile);

    if(date('Y', $timeFile) > date('Y'))
        $timeFile   =   0;

    $ext    =   "";
    if($max_width > 0 && $max_height > 0)
    {
        $ext    =   $max_width . "x" . $max_height;
    }
    elseif($max_width > 0)
    {
        $ext    =   "w" . $max_width;
    }
    elseif($max_height > 0)
    {
        $ext    =   "h" . $max_height;
    }
    else
    {
        $ext    =   $max_width . "x" . $max_height;
    }

    return "https://cdn.vatgia.vn/pictures/thumb/" . $ext . date("/Y/m/", $timeFile) . $filename;
}

function pictureProductFullsize($filename)
{
    $timeFile = substr(preg_replace("/([^0-9])/", "", $filename), 0, 10);
    $timeFile = intval($timeFile);

    if(date('Y', $timeFile) > date('Y'))
        $timeFile   =   0;

    return "https://cdn.vatgia.vn/pictures/fullsize/" . date("Y/m/d/", $timeFile) . $filename;
}

function createlink($module = "", $row = array()){
    $strlink = '';
    switch($module){
        // case "category":
        //     $strlink = '/' . removeTitle($row["nTitle"]) . "/c-" . $row["iData"] . ".html";
        //     break;
        case "product":
            $strlink = '/' . removeTitle($row["nTitle"]) . "/c-" . $row["iData"] . ".html";
            break;
        case "product_detail":
            $strlink = '/'  . removeTitle($row["nTitle"]) . "/d-" . $row["iData"].".html";
            break;
        case "news":
            $strlink = '/' . 'tin-tuc/' . removeTitle($row["nTitle"]) . ".html";
            break;
        case "news_detail":
            $strlink = '/' .  'tin-tuc/' . removeTitle($row["nTitle"]) . "-" . $row['iData'] . ".html";
            break;
        case "static":
            $strlink = '/' . 'static/' . removeTitle($row["nTitle"]) . '-id' . $row["iData"];
            break;
        
    }
    return $strlink;
}

function generateURL_product($iCat,$iPro,$pro_name){
    //global $array_url_rewrite_replace;
    $array_url_rewrite_replace = array("/","-",",","&","?","#","'",'"',"@","\\","~","(",")",".",";","*","  ","‘","’",'“','”',"%","$","^","!",":");
    //replace các ký tự đặc biệt
    $pro_name = str_replace($array_url_rewrite_replace," ",trim($pro_name));
    $pro_name = str_replace("  "," ",trim($pro_name));

    $pro_name = str_replace(" ","-",trim($pro_name));
    $pro_name = str_replace("--","-",trim($pro_name));

    $pro_name = urlencode(mb_strtolower($pro_name,"UTF-8"));

    $newlink = "/" . $iCat . "/" . $iPro . "/" . $pro_name . ".html";

    return $newlink;
}