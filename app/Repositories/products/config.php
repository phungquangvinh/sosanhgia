<?php
/**
 * Created by ntdinh1987.
 * User: ntdinh1987
 * Date: 12/8/16
 * Time: 11:50 AM
 */

return [
    'products/index' => [
        'title' => 'Danh sách sp',
    ],
    'products/get_product_by_id' => [
        'title' => 'lấy chi tiết sản phẩm',
    ],
    'products/add_to_cookie' => [
        'title' => 'Thêm sản phẩm vào danh sách SP đã xem',
        'input' => [
            'pro_id' => [
                'title' => 'Id sản phẩm',
                'rule' => 'required|integer',
            ],
        ],
    ],
    'products/get_product_by_cookie' => [
        'title' => 'Lấy danh sách sản phẩm đã xem',
    ],
];