<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

class MainController extends Controller
{
    public function index()
    {
        // 今ログインしているユーザーを取得
        $user = Auth::user();
        // 投稿を取得
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();
        $camera_posts = DB::table('camera_posts')->orderBy('created_at', 'desc')->limit(10)->get();
        //投稿ランキング取得
        $post_ranks = DB::table('posts')->orderBy('like', 'desc')->limit(5)->get();
        // ユーザーランキング取得
        $user_ranks = DB::table('users')->orderBy('follower', 'desc')->limit(5)->get();
        // 自作ブログをスクレイピング
        $goutte = GoutteFacade::request('GET', 'https://koublog.site/');
        $images = array();
        $texts = array();
        $goutte->filter('.page_img')->filter('img')->each(function ($node) use (&$images) {
            $images[] = $node->attr('src');
        });
        $goutte->filter('.ttl')->filter('a')->each(function ($node) use (&$texts) {
            $texts[] = $node->text();
        });
        $params = [
            'user' => $user,
            'posts' => $posts,
            'camera_posts' => $camera_posts,
            'post_ranks' => $post_ranks,
            'user_ranks' => $user_ranks,

            'images' => $images,
            'texts' => $texts,
        ];
        return view('index', $params);
    }
}
