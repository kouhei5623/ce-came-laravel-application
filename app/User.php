<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ユーザーとポストのリレーション
    public function post()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'desc');
    }

    // ユーザーとポストのリレーション
    public function camera_post()
    {
        return $this->hasMany(CameraPost::class)->orderBy('created_at', 'desc');
    }

    //プロフィール編集のバリデーション
    public static $rules = array(
        'name' => 'required|between:0,255',
        'profile' => 'between:0,500',
        'picture' => 'image'
    );
    public static $messages = array(
        'name.required' => '※名前を入力してください。',
        'name.between' => '※255文字以内で入力してください。',
        'profile.between' => '※500文字以内で入力してください。',
        'picture.image' => '※正しく指定してください。',
    );
}
