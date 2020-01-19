<?php


/**
 * Url register
 * @return url
 */
function url_register()
{
    $urlRegister = 'https://id.vatgia.com/v2/dang-ky/vatgia/tai-khoan-thuong?service=vatgia&amp;_cont=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . '/pages/idvg_callback.php?refer=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']));
    return $urlRegister;
}


/**
 * Url login
 * @return url
 */
function url_login()
{
    $urlLogin = 'https://id.vatgia.com/dang-nhap/oauth?&client_id=affiliate&_cont=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . '/login/idvg-callback?refer=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']));

    return $urlLogin;
}

/**
 * Url login cashback
 * @return url
 */
function url_login_cashback()
{
    $urlLogin = 'https://id.vatgia.com/dang-nhap/oauth?&client_id=affiliate&_cont=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . '/cashback/login/idvg-callback?refer=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']));

    return $urlLogin;
}

/**
 * Url register cashback
 * @return url
 */
function url_register_cashback()
{
    $urlRegister = 'https://id.vatgia.com/v2/dang-ky/vatgia/tai-khoan-thuong?service=vatgia&amp;_cont=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . '/pages/cashback/idvg_callback.php?refer=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']));
    return $urlRegister;
}


/**
 * 404 url
 * @return url
 */
function url_404()
{
    return '/not-found.html';
}

/**
 * Url post
 * @param  int $id
 * @param  string $slug
 * @return string
 */
function url_post($id, $slug)
{
    return '/post/' . removeTitle($slug) . '-' . $id.'.html';
}


/**
 * Url post category
 * @param  int $id
 * @param  string $slug
 * @return string
 */
function url_post_category($id, $slug)
{
    return '/post/category/' . removeTitle($slug) . '-' . $id.'.html';
}

if( ! function_exists('url_post_archive') ) {
    /**
     * Post archive
     * @return string
     */
    function url_post_archive() {
        return '/tin-tuc.html';
    }
}

if( ! function_exists('url_post_search') ) {

    /**
     * Tìm kiếm tin tức
     * @return string
     */
    function url_post_search() {
        return '/tim-kiem/tin-tuc';
    }
}


if( ! function_exists('url_product_category') ) {
    /**
     * Url product category
     * @param  integer $id
     * @param  string $slug
     * @return string
     */
    function url_product_category($id, $slug) {
        return '/collection/'.implode('-', [removeTitle($slug), $id]).'.html';
    }
}

if( ! function_exists('url_product') ) {
    /**
     * Url product detail
     * @param  integer $id
     * @param  string $slug
     * @return string
     */
    function url_product($id, $slug) {
        return '/product/'.implode('-', [removeTitle($slug), $id]).'.html';
    }
}

if( ! function_exists('url_category') ) {
    /**
     * Cây danh mục
     * @return string
     */
    function url_category() {
        return '/danh-muc.html';
    }
}

if( ! function_exists('url_tag') ) {
    /**
     * Url tag
     * @param  string $slug
     * @return string
     */
    function url_tag($slug) {
        return '/tag/'.removeTitle($slug);
    }
}
if (! function_exists('url_restaurant_detail')) {
    /**
     * Post archive
     * @return string
     */
    function url_detail($slug = '', $id = '')
    {
        if ($id) {
            return $slug.'-'.$id.'.html';
        }
        return url_404();
    }
}