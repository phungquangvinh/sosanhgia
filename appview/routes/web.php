<?php

/**
 * Xem hướng dẫn sử dụng app('route') tại link:
 * https://github.com/mrjgreen/phroute
 */

use VatGia\Helpers\Facade\Route;

Route::filter('auth', function () use ($app) {
    if (!app('user')->logged) {
        return redirect('/login');
    }
    return null;
});


Route::get('/{slug}/c-{id:\d+}?.html',[\AppView\Controllers\CategoryProductController::class, 'getCategory']);
Route::get('/{slug}/d-{id:\d+}?.html',[\AppView\Controllers\DetailProductController::class, 'getDetail']);
Route::get(['/', 'homepage'],[\AppView\Controllers\HomeController::class, 'index']);

Route::get(['/posts/{slug}-{id}', 'post_detail'], [\AppView\Controllers\PostController::class, 'detail']);

Route::get(
    ['/login', 'login'],
    [AppView\Controllers\Auth\AuthController::class, 'showLoginForm']
);

Route::get(
    ['/idvg/login-callback', 'login-callback'],
    [AppView\Controllers\Auth\AuthController::class, 'loginCallback']
);

Route::get(
    ['/logout', 'logout'],
    [AppView\Controllers\Auth\AuthController::class, 'logout']
);

Route::get(
    ['/profile', 'profile'],
    [AppView\Controllers\Auth\AuthController::class, 'showProfile'],
    [
        'before' => ['auth'],
    ]
);

Route::get('/news/{slug}-{id}', [AppView\Controllers\ListController::class, 'list']);

Route::get('tin-tuc.html', [AppView\Controllers\PostController::class, 'index']);

Route::get(['/search', 'search'],[AppView\Controllers\SearchController::class, 'getSearch']);

//Route::get(['/seenProduct', 'seen'],[AppView\Controller\HomeController::class, 'getseenProduct']);

Route::post('/AjaxSearchController',[AppView\Controllers\AjaxSearchController::class, 'getSearch']);