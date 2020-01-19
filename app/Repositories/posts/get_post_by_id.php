<?php

use App\Models\News;
use VatGia\Cache\Facade\Cache;

$post = Cache::get('news_detail_' . input('id'));
if (!$post) {
    $post = News::with([
        [
            'author',
            function ($model) {
                return $model->where('use_active = 1');
            }
        ],
        'tags'
    ])
        ->from('posts')->find('pos_id = ' . input('id'));
}

$post1 = News::with([
    'tags',
    ['author', function ($model) {
        return $model->where('use_active = 1');
    }]
])->all();

//dd($post1->toArray());
//dd($post->toArray(false), $post1);
if ($post) {
    return [
        'vars' => [
            'id' => (int)$post->id,
            'title' => $post->title,
            'author' => [
                'id' => $post->author->id,
                'name' => $post->author->name,
            ],
        ],
    ];
} else {
    return [
        'vars' => [],
    ];
}