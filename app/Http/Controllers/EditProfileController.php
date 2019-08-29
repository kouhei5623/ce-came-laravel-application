<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditProfileController extends Controller
{
    public function index(Request $request)
    {
        // 今ログインしているユーザーを取得
        $user = Auth::user();
        $params = [
            'user' => $user,
        ];
        return view('edit.profile', $params);
    }

    public function post(Request $request)
    {
        // プロフィール編集バリデーション
        $this->validate($request, User::$rules, User::$messages);
        // ユーザーテーブルのpictureカラムが空か写真が入っているかを判定
        if($request->picture === null){
            $params = [
                'name' => $request->name,
                'profile' => $request->profile,
                // 写真が入っていないときは０を代入
                'picture' => '0',
            ];

            $other_params = [
                'user_name' => $request->name,
                'user_picture' => '0',
            ];
        // 写真が入っている時
        }else{
            $params = [
                'name' => $request->name,
                'profile' => $request->profile,
                'picture' => basename($request->file('picture')->store('public/user_img')),
            ];

            $other_params = [
                'user_name' => $request->name,
                'user_picture' => basename($request->file('picture')->store('public/user_img')),
            ];
        }
        // ユーザーテーブルを更新
        DB::table('users')->where('id', $request->user_id)->update($params);
        // コメントのユーザーネームと写真を更新
        DB::table('comments')->where('user_id', $request->user_id)->update($other_params);
        // 投稿のユーザーネームと写真を更新
        DB::table('posts')->where('user_id', $request->user_id)->update($other_params);
        // カメラ投稿のユーザーネームと写真を更新
        DB::table('camera_posts')->where('user_id', $request->user_id)->update($other_params);
        // カメラコメントのユーザーネームと写真を更新
        DB::table('camera_comments')->where('user_id', $request->user_id)->update($other_params);
        return redirect('/userpage?user_id='.$request->user_id);
    }
}
