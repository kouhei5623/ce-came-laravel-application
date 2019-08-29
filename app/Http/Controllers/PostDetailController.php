<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostDetailController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $post = DB::table('posts')->where('id', $request->post_id)->first();
        $other = Post::find($request->post_id)->user;
        $comments = Post::find($request->post_id)->comment;
        // 返信
        $reply = DB::table('users')->where('id', $request->res)->first();
        //いいねが押されたかどうか
        $defaultLiked = DB::table('likes')->where('user_id', Auth::user()->id)->where('post_id', $request->post_id)->first();
        if(count($defaultLiked) == 0){
            $defaultLiked == false;
        }else{
            $defaultLiked == true;
        }
        //いいねの数
        $count = DB::table('likes')->where('post_id', $request->post_id)->count();
        $params = [
            'user' => $user,
            'post' => $post,
            'other' => $other,
            'comments' => $comments,
            'reply' => $reply,
            'defaultLiked' => $defaultLiked,
            'count' => $count
        ];
        return view('detail.post', $params);
    }

    public function post(Request $request)
    {
        // バリデーションの処理
        $this->validate($request, Comment::$rules, Comment::$messages);
        $comment = new Comment;
        // コメント
        $comment->comment = $request->comment;
        // ユーザーid
        $comment->user_id = Auth::user()->id;
        // 投稿id
        $comment->post_id = $request->post_id;
        // 投稿者の名前
        $comment->user_name = Auth::user()->name;
        // 投稿者の写真
        $comment->user_picture = Auth::user()->picture;
        $comment->save();
        unset($comment['_token']);
        // トップページへリダイレクト
        return redirect('/post_detail?post_id='.$request->post_id);
    }
}
