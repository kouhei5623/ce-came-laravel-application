<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CameraComment extends Model
{
    protected $guarded = array('id');

    //コメントのバリデーション
    public static $rules = array(
        'comment' => 'required|between:0,500',
    );
    public static $messages = array(
        'comment.required' => 'コメントを入力してください。',
        'comment.between' => '500文字以内で入力してください。'
    );
}
