<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Weidner\Goutte\GoutteFacade as GoutteFacade;


class PostController extends Controller
{
    // 普通に開いた場合の表示
    public function index()
    {
        $user = Auth::user();
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

            'images' => $images,
            'texts' => $texts,
        ];
        return view('create.post', $params);
    }
    // データが送信された場合
    public function post(Request $request)
    {
        // バリデーションの処理
        $this->validate($request, Post::$rules, Post::$messages);
        $post = new Post;
        // タイトル
        $post->title = $request->title;
        // 詳細
        $post->message = $request->message;
        // 使用カメラ
        $post->camera_name = $request->camera_name;
        // 写真
        $post->picture = basename($request->file('picture')->store('public/post_img'));
        // 誰が投稿したのかを保存
        $post->user_id = Auth::user()->id;
        // 投稿者の名前
        $post->user_name = Auth::user()->name;
        // 投稿者の写真
        $post->user_picture = Auth::user()->picture;
        $post->save();
        unset($post['_token']);
        // トップページへリダイレクト
        return redirect('../');
    }
}
