<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CameraPost extends Model
{
    protected $guarded = array('id');

    //カメラ投稿のバリデーション
    public static $rules = array(
        'camera_name' => 'required|between:0,255',
        'url' => 'required|between:0,500',
        'review' => 'required|between:0,500',
        'picture' => 'required|image'
    );
    public static $messages = array(
        'camera_name.required' => 'カメラの名前を入力してください。',
        'camera_name.between' => '255文字以内で入力してください。',
        'url.required' => '購入サイトのURLを入力してください。',
        'url.between' => '500文字以内で入力してください。',
        'review.required' => '評価を入力してください。',
        'review.between' => '500文字以内で入力してください。',
        'picture.required' => '※画像を指定してください。',
        'picture.image' => '※正しく指定してください。'
    );

    // ユーザーとカメラポストのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // カメラポストとコメントのリレーション
    public function camera_comment()
    {
        return $this->hasMany(CameraComment::class)->orderBy('created_at', 'desc');
    }
}
