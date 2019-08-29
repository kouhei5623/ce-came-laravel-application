<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

class LikeDetailController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $posts = DB::table('likes')->where('post_id', $request->post_id)->orderBy('created_at', 'desc')->get();
        $likes = array();
        //いいねしているユーザーを取得
        foreach($posts as $post){
            $likes[] = DB::table('users')->where('id', $post->user_id)->get();
        }
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
            'likes' => $likes,

            'images' => $images,
            'texts' => $texts,
        ];
        return view('detail.like', $params);
    }
}
