<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// TOPページ
Route::get('/', 'MainController@index');
// 投稿詳細ページのルート
Route::get('/post_detail', 'PostDetailController@index');
Route::post('/post_detail', 'PostDetailController@post');
// カメラ投稿詳細ページのルート
Route::get('/camera_post_detail', 'CameraPostDetailController@index');
Route::post('/camera_post_detail', 'CameraPostDetailController@post');
// 投稿作成のルート
Route::get('/post', 'PostController@index');
Route::post('/post', 'PostController@post');
// カメラ投稿作成のルート
Route::get('/camera_post', 'CameraPostController@index');
Route::post('/camera_post', 'CameraPostController@post');
// ユーザーページのルート
Route::get('/userpage', 'UserpageController@index');
// プロフィール編集画面のルート
Route::get('/edit_profile', 'EditProfileController@index');
Route::post('/edit_profile', 'EditProfileController@post');
//いいね詳細ページへのルート
Route::get('/like_detail', 'LikeDetailController@index');
// Authのルート
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
