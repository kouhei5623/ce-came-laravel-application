<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function like(Post $post, Request $request)
    {
        $like = new Like;
        $like->user_id = $request->user_id;
        $like->post_id = $post->id;
        $like->save();
        unset($like['_token']);

        $params = [
            'like' => $request->count,
        ];
        // ポストデーブルのいいねカウントを更新
        DB::table('posts')->where('id', $post->id)->update($params);
        return response()->json([]);
    }

    public function unlike(Post $post, Request $request)
    {
        $unlike = DB::table('likes')->where('user_id', $request->user_id)->where('post_id', $post->id)->delete();
        $params = [
            'like' => $request->count,
        ];
        // ポストデーブルのいいねカウントを更新
        DB::table('posts')->where('id', $post->id)->update($params);
        return response()->json([]);
    }
}
