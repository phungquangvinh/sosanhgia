<?php
/**
 * Created by PhpStorm.
 * User: Stephen Nguyen
 * Date: 4/27/2017
 * Time: 5:10 PM
 */

namespace AppView\Controllers;


use AppView\Repository\PostRepository;
use AppView\Repository\PostRepositoryInterface;
use VatGia\Cache\Facade\Cache;
use App\Models\Post;

class PostController extends FrontEndController
{

    public function index()
    {
        $posts = model('posts/get_list')->load();
        $posts = $posts['vars'];
        return $this->renderView('posts/index', ['posts' => $posts]);
    }

    public function detail($slug,$pos_id)
    {       

        $posts = model('posts/get_post_by_id')->load([
            'pos_id' => $pos_id,
        ]);
        $post = $posts['vars'];

        $postDetail['view'] = view('posts/detail')->render([
            'post' => $post
        ]);
        return view('layout/master')->render(["postDetail" => $postDetail]);
    }
}