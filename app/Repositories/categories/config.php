<?php

return [
    'categories/index' => [
        'title' => 'Danh sách danh mục',
        'input' => [
            'page' => [
                'title' => 'Số trang',
                'rule' => 'integer'
            ]
        ]
    ],

    'categories/get_categories_by_id' => [
        'title' => 'Lấy danh mục theo id',
    ],

    'categories/get_categories_by_price' => [
        'title' => 'Lấy danh mục theo giá sản phẩm',
    ],

    'categories/get_categories_by_shop' => [
        'title' => 'Lấy danh mục theo cửa hàng',
    ],
];