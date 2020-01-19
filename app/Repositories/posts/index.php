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
                'id' => (int)$item->use_id,
                'email' => $item->use_email,
                'phone' => $item->use_phone,
                'fullname' => $item->use_name,
                'avatar' => $item->use_avatar,
                'address' => $item->use_address,
                'gender' => static::getGenderString($item->use_gender)
            ];
        }
        return $items;
    }

    public static function getGenderString($gender)
    {
        return ($gender == 1) ? 'Male' : 'Female';
    }
}

$page = input('page') ? input('page') : 1;
$page_size = input('page_size') ? input('page_size') : 10;

$lising = \App\Models\Users\Users::pagination((int)$page, (int)$page_size)->select_all();
return [
    'vars' => UsersTransformer::transfom($lising)
];