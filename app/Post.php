<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = array('id');

    //投稿のバリデーション
    public static $rules = array(
        'title' => 'required|between:0,255',
        'message' => 'required|between:0,500',
        'camera_name' => 'required|between:0,255',
        'picture' => 'required|image'
    );
    public static $messages = array(
        'title.required' => '※タイトルを入力してください。',
        'title.between' => '※255文字以内で入力してください。',
        'message.required' => '※詳細を入力してください。',
        'message.between' => '※500文字以内で入力してください。',
        'camera_name.required' => '※使用カメラを入力してください。',
        'camera_name.between' => '※255文字以内で入力してください。',
        'picture.required' => '※画像を指定してください。',
        'picture.image' => '※正しく指定してください。',
    );

    // ユーザーとポストのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ポストとコメントのリレーション
    public function comment()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }
}
