<?php

/**
 * Created by vatgia-framework.
 * Date: 6/26/2017
 * Time: 1:28 PM
 */
class UsersTransformer
{
    public static function transfom(\VatGia\Helpers\Collection $listing)
    {
        $items = [];
        if (!$listing) {
            return [];
        }
        foreach ($listing as $item) {
            $items[] = [
                'nes_id' => (int)$item->nes_id,
                'nes_title' => $item->nes_title,                
                'nes_meta_title' => $item->nes_meta_title,
                'nes_meta_keyword' => $item->nes_meta_keyword,
                'nes_meta_description' => $item->nes_meta_description,
                'nes_slug' => $item->nes_slug,
                'nes_description' => $item->nes_description,
                'nes_content' => $item->nes_content,
                'nes_image' => $item->nes_image,
                'nes_author_id' => $item->nes_author_id,
                'nes_active' => $item->nes_active,
                'nes_type_id' => $item->nes_type_id,
                'nes_views' => $item->nes_views,
                'nes_create_time' => $item->nes_create_time,
                'nes_update_time' => $item->nes_update_time,
                'cat_name' => $item->cat_name,
            ];
        }
        return $items;
    }
}

$lising = \App\Models\News::limit(3)->order_by('nes_id', 'DESC')->select_all();
$lisings = \App\Models\News::limit(4)
    ->where('nes_active = 1')
    ->order_by('nes_id', 'DESC')
    ->select_all();
$pc = \App\Models\News::limit(5)
    ->where('nes_active = 1')
    ->order_by('nes_id', 'DESC')
    ->select_all();
$tin_tuc_theo_type = \App\Models\News::limit(10)
    ->order_by('nes_id', 'DESC')
    ->select_all();
    // dd($pc);die;


return [
    'vars' => [
        'getNews' => UsersTransformer::transfom($lising),
        'hotNews' => UsersTransformer::transfom($lisings),
        'pc' => UsersTransformer::transfom($pc),
        'tin_tuc_theo_type' => UsersTransformer::transfom($tin_tuc_theo_type),
    ]
];