<?php

include 'inc_security.php';

use BlackBear\Validation\Validator;
use App\Models\Product;
use App\Models\Categories\Category;
use App\Models\Brand;
use App\Models\ProductMeta;
use App\Models\ProductTag;
use App\Models\Tags;
use App\Models\City;

$pro_name = getValue('pro_name', 'str', 'POST', '');
$pro_price = getValue('pro_price', 'int', 'POST', '');
$pro_image = isset($_FILES['pro_image']) ? $_FILES['pro_image'] : [];
$pro_list_image = isset($_FILES['pro_list_image']) ? $_FILES['pro_list_image'] : [];
$pro_brand_id = getValue('pro_brand_id', 'str', 'POST', '');
$pro_category_id = getValue('pro_category_id', 'str', 'POST', '');
$pro_city_id = getValue('pro_city_id', 'int', 'POST', '');

$action = getValue('action', 'str', 'POST', '', '');

$pro_categories = Category::where('cat_type="product"')->select_all();
$pro_brands = Brand::select_all();
$pro_city = City::select_all();
// $pro_user_estore = UserEstore::select_all();

if ('add' == $action) {
    $validator = new Validator;

    $rules = [
        'pro_name' => 'required|min:5|max:100',
        'pro_price' => 'required|min:4|max:10',
        'pro_image' => 'required',
    ];
    $messages =[
        'pro_name.required' => 'Vui lòng nhập tên sản phẩm',
        'pro_name.min' => 'Tên sản phẩm cần dài hơn 5 kí tự',
        'pro_name.max' => 'Tên sản phẩm cần ngắn hơn 100 kí tự',
        'pro_price.required' => 'Vui lòng nhập giá',
        'pro_price.min' => 'Số giá cần dài hơn 4 kí tự',
        'pro_price.max' => 'Số giá cần ngắn hơn 10 kí tự',
        'pro_image.required' => 'Vui lòng chọn ảnh',
    ];

    $validator ->setData($_POST)->setRules($rules)->setMessages($messages);
    if( ! $validator->passes() ) {
        $errors = $validator->getErrors();
        flash_message('error', 'Xác thực lỗi! vui lòng check lại các trường trong form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }

    $pro_list_image = '';
    if (isset($_FILES['pro_list_image']) && count($_FILES['pro_list_image']) > 0) {
        create_folder_full_permissions($_SERVER['DOCUMENT_ROOT'] . "/uploads/products/default/");

        if ($_FILES['pro_list_image']['error'][0] == 0) {

            for ($i = 0; $i < count($_FILES['pro_list_image']['name']); $i++) {
                $url['name'] = $_FILES['pro_list_image']['name'][$i];
                $url['tmp_name'] = $_FILES['pro_list_image']['tmp_name'][$i];
                $url['size'] = $_FILES['pro_list_image']['size'][$i];
                $name = generate_name($url['name']);
                $nameImage[$i] = get_name_image_array($url, '/uploads/products/default/');
                $listImg = parse_image_no_size('uploads/products/default', $name);
            }
            $pro_list_image = json_encode($nameImage);
        }
    }


    if($validator->passes($_REQUEST, $rules, $messages)) {

        if ($_FILES['pro_image']['error'] == 0) {
            $proImage = upload_img('products',$pro_image);
        }

        $productsInsert = Product::insert([
            'pro_name' => $pro_name,
            'pro_hash_name' => md5($pro_name),
            'pro_price' => $pro_price,
            'pro_image' => isset($proImage) ? $proImage : '',
            'pro_brand_id' => $pro_brand_id,
            'pro_category_id' => $pro_category_id,
            'pro_city_id' => $pro_city_id,
        ]);


        $metaExist = ProductMeta::where('prme_product_id='.$productsInsert)->select();
        if($metaExist) {
            ProductMeta::where('prme_product_id='.$productsInsert)->insert([
                'prme_teaser'   => getValue('teaser', 'str', 'POST', ''),
                'prme_content'   => getValue('content', 'str', 'POST', '')
            ]);
        } else {
            ProductMeta::insert([
                'prme_product_id' => $productsInsert,
                'prme_teaser'   => getValue('teaser', 'str', 'POST', ''),
                'prme_content'   => getValue('content', 'str', 'POST', '')
            ]);
        }

        $arrayTags = ProductTag::where("pota_product_id=".$productsInsert)
                                ->left_join('tags', "pota_tag_id=tag_id")
                                ->select_all();

        $stringInputTag = '';
        if($arrayTags){
            foreach ($arrayTags as $value){
                if($stringInputTag != ''){
                     $stringInputTag = $stringInputTag.'_-_'.$value->tag_name;
                }else{
                     $stringInputTag = $value->tag_name;
                }
            }
        }

        $strTags = getValue('tag_name', 'str', 'POST', '');
        $arrTags = explode('_-_', $strTags);
        $arrTagId = array();
        // xoa het post tag cua post id
        ProductTag::where('pota_product_id='.$productsInsert)->delete();
        for($i = 0; $i < count($arrTags); $i++){
            $array = array();
            $array['tag_name'] = trim(preg_replace('/\s+/',' ',$arrTags[$i]));
            $checkTag = Tags::where("tag_name='".$array['tag_name']."'")->select();
            if($checkTag){
                $idTagName = $checkTag->tag_id;
            }else{
                $array['tag_slug'] = preg_replace('/\s+/', '-', removeAccent($arrTags[$i]));
                $array['tag_created_at'] = date('Y-m-d h:i:s');
                $idTagName = Tags::insert($array);
            }
            ProductTag::insert(array('pota_product_id'=>$productsInsert, 'pota_tag_id'=>$idTagName));
        }

        flash_message('success', 'Tạo sản phẩm thành công');
        //redirect('product_index.php');
    }
}

echo $template->render('product_url/create', compact('load_header','pro_categories','pro_brands','pro_city'));