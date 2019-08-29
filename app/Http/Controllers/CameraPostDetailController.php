<?php

namespace App\Http\Controllers;

use App\CameraPost;
use App\CameraComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

class CameraPostDetailController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $camera = DB::table('camera_posts')->where('id', $request->camera_id)->first();
        $other = CameraPost::find($request->camera_id)->user;
        $comments = CameraPost::find($request->camera_id)->camera_comment;
        // 返信
        $reply = DB::table('users')->where('id', $request->res)->first();
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
            'camera' => $camera,
            'other' => $other,
            'comments' => $comments,
            'reply' => $reply,

            'images' => $images,
            'texts' => $texts,
        ];
        return view('detail.camera_post', $params);
    }

    public function post(Request $request)
    {
        // バリデーションの処理
        $this->validate($request, CameraComment::$rules, CameraComment::$messages);
        $comment = new CameraComment;
        // コメント
        $comment->comment = $request->comment;
        // ユーザーid
        $comment->user_id = Auth::user()->id;
        // 投稿id
        $comment->camera_post_id = $request->camera_id;
        // 投稿者の名前
        $comment->user_name = Auth::user()->name;
        // 投稿者の写真
        $comment->user_picture = Auth::user()->picture;
        $comment->save();
        unset($comment['_token']);
        // トップページへリダイレクト
        return redirect('/camera_post_detail?camera_id='.$request->camera_id );
    }
}
