<?php

namespace App\Http\Controllers;

use App\CameraPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CameraPostController extends Controller
{
    // 普通に開いた場合
    public function index()
    {
        $user = Auth::user();
        $params = [
            'user' => $user,
        ];
        return view('create.camera_post', $params);
    }

    // データが送られてきた場合
    public function post(Request $request)
    {
        // バリデーションの処理
        $this->validate($request, CameraPost::$rules, CameraPost::$messages);
        $camera = new CameraPost;
        // カメラの名前
        $camera->camera_name = $request->camera_name;
        // 評価
        $camera->star = $request->star;
        // URL
        $camera->url = $request->url;
        // レビュー
        $camera->review = $request->review;
        // カメラの写真
        $camera->picture = basename($request->file('picture')->store('public/camera_img'));
        // 投稿者のID
        $camera->user_id = Auth::user()->id;
        // 投稿者の名前
        $camera->user_name = Auth::user()->name;
        // 投稿者の写真
        $camera->user_picture = Auth::user()->picture;
        $camera->save();
        unset($camera['_token']);
        // トップページへリダイレクト
        return redirect('../');
    }
}
