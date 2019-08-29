<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

class UserpageController extends Controller
{
    public function index(Request $request)
    {
        // 今ログインしているユーザーを取得
        $auth_user = Auth::user();
        // ユーザーを取得
        $user = DB::table('users')->where('id', $request->user_id)->first();
        // ユーザーの投稿を取得
        $posts = User::find($request->user_id)->post;
        $camera_posts = User::find($request->user_id)->camera_post;
        //フォローしたかどうかの判別
        $defaultFollowed = DB::table('follows')->where('follow', $auth_user->id)->where('follower', $request->user_id)->first();
        if(count($defaultFollowed) == 0){
            $defaultFollowed == false;
        } else {
            $defaultFollowed == true;
        }
        // フォロー数・フォロワー数のカウント
        $followCount = DB::table('follows')->where('follow', $request->user_id)->count();
        $followerCount = DB::table('follows')->where('follower', $request->user_id)->count();
        $followUserCount = DB::table('follows')->where('follow', $auth_user->id)->count();
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
            'auth_user' => $auth_user,
            'user' => $user,
            'posts' => $posts,
            'camera_posts' => $camera_posts,
            'defaultFollowed' => $defaultFollowed,
            'followCount' => $followCount,
            'followerCount' => $followerCount,
            'followUserCount' => $followUserCount,

            'images' => $images,
            'texts' => $texts,
        ];
        return view('userpage.index', $params);
    }
}
