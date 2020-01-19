<?php
/**
 * Created by PhpStorm.
 * User: irapcover
 * Date: 24/05/2017
 * Time: 11:26
 */
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductMeta;
// use App\Models\ProductTag;
use App\Models\Tags;
use App\Models\Categories\Category;
use BlackBear\Validation\Validator;
use App\Models\City;

include 'inc_security.php';

$cities = City::select_all();

$action = getValue('action', 'str', 'POST', '');
$id = getValue('id', 'int', 'GET', 0);
$pro_image = isset($_FILES['pro_image']) ? $_FILES['pro_image'] : [];
$pro_list_image = isset($_FILES['pro_list_image']) ? $_FILES['pro_list_image'] : [];
$pro_city_id = getValue('pro_city_id', 'int', 'POST', '');

// $arrayTags = ProductTag::where("pota_product_id=".$id)
//     ->left_join('tags', "pota_tag_id=tag_id")
//     ->select_all();
// $stringInputTag = '';
// if($arrayTags){
//     foreach ($arrayTags as $value){
//         if($stringInputTag != ''){
//             $stringInputTag = $stringInputTag.'_-_'.$value->tag_name;
//         }else{
//             $stringInputTag = $value->tag_name;
//         }
//     }
// }

$row = Product::inner_join('categories_multi', 'pro_category_id=cat_id')->where('pro_id='.$id)->select();
//dd($row->toArray());

if($action == 'update') {

    $vRules = [
        'pro_name' => 'required',
        'pro_price' => 'required',
        'category' => 'required',
        'pro_brand' => 'required',
        'teaser'=> 'required',
        'content' => 'required',
        'pro_city_id' => 'required'
    ];

    $vMessage = [
        'pro_name.required' => 'Vui lòng nhập tên sản phẩm',
        'pro_price.required' => 'Vui lòng nhập giá sản phẩm',
        'category.required' => 'Vui lòng chọn danh mục',
        'pro_brand.required' => 'Vui lòng nhập tên hãng',
        'teaser.required'=> 'Vui lòng nhập mô tả ngắn cho sản phẩm',
        'content.required' => 'Vui lòng nhập nội dung mô tả sản phẩm',
        'pro_city_id.required' => 'Vui lòng chọn địa điểm'
    ];

    $validator = new Validator($_POST, $vRules, $vMessage);
    if( ! $validator->passes() ) {
        $errors = $validator->getErrors();
        flash_message('error', 'Please check the form');
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

    if($validator->passes($_REQUEST, $vRules, $vMessage)) {
        // Tạo brand trước
        $brandName = getValue('pro_brand', 'str', 'POST', '');
        $brandName = trim($brandName);
        $brandNameHash = removeAccent($brandName);
        $brandNameHash = mb_strtolower($brandNameHash);
        $brandNameHash = md5($brandNameHash);

        $brandExist = Brand::where('bra_name_hash = "'.$brandNameHash.'"')->select();
        if(!$brandExist) {
            $lastBrandId = Brand::insert([
                'bra_name' => $brandName,
                'bra_name_hash' => $brandNameHash,
                'bra_created_at' => date('Y-m-d H:i:s'),
                'bra_updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            $lastBrandId = $brandExist->bra_id;
        }

        $proPrice = getValue('pro_price', 'str', 'POST', '');
        $proPrice = preg_replace('/\D+/', '', $proPrice);

        if ($_FILES['pro_image']['error'] == 0) {
            $proImage = upload_img('products',$pro_image);
        }

        Product::where('pro_id='.$id)->update([
            'pro_name'   => getValue('pro_name', 'str', 'POST', ''),
            'pro_category_id' => getValue('category', 'int', 'POST', 0),
            'pro_brand_id'    => $lastBrandId,
            'pro_price'       => $proPrice,
            'pro_image'       => isset($proImage) ? $proImage : $row->pro_image,
            'pro_hash_name' => md5(getValue('pro_name', 'str', 'POST', '')),
            'pro_city_id' => $pro_city_id,
        ]);


        flash_message('success', 'Cập nhật sản phẩm thành công');
        redirect('product_index.php');
    }
}


echo $template->render('product_url/edit', compact( 'row', 'vgSiteId', 'categories', 'load_header', 'cities'));

