@extends('layouts.common')
@section('title', '詳細ページ - Ce:Came')
@extends('layouts.header')
@section('main')
<div class="wrap">
    <div class="all">
        <!-- メインカラム ------------------------------------------------------>
        <div class="main">
            <section class="ad">
                <a class="ad_img">
                    <img src="../img/ad2.png" alt="">
                </a>
            </section><!-- /.ad -->
            <!-- メニューバー -------------------------------------------------->
            <section class="menubar">
                @if (Auth::check())
                <ul class="menu_list">
                    <li class="item">
                        MENU
                        <ul class="pull_down">
                            <li><a href="/userpage?user_id={{ $user->id }}">マイページ</a></li>
                            <li><a href="/edit_profile?user_id={{ $user->id }}">プロフィール編集</a></li>
                            <li><a href="#">カメラについて</a></li>
                        </ul>
                    </li><!-- /.item -->
                    <li class="item">
                        投稿作成
                        <ul class="pull_down">
                            <li><a href="/post">写真投稿</a></li>
                            <li><a href="/camera_post">カメラ投稿</a></li>
                        </ul>
                    </li><!-- /.item -->
                </ul><!-- /.menu_list -->
                @else
                <div class="l-alert">
                    <p>会員登録またはログインが完了していません。</p>
                </div>
                @endif
            </section><!-- /.menubar -->
            <section class="post_detail">
                <div class="detail_box">
                    <div class="detail_img">
                        <img src="../storage/post_img/{{ $post->picture }}" alt="">
                    </div>
                    <div class="detail_inner">
                        <!-- ユーザー ------------------------------------------>
                        <div class="user_unit">
                            <div class="user_img">
                                @if($other->picture === '0')
                                <img src="../img/user.png" alt="">
                                @else
                                <img src="../storage/user_img/{{ $other->picture }}" alt="">
                                @endif
                            </div>
                            <div class="user_name">
                                <a href="#">{{ $other->name }}</a>
                            </div>
                        </div><!-- /.user_unit -->
                        <h2 class="headline">{{ $post->title }}</h2>
                        <!-- カメラの種類 --------------------------------------->
                        <p class="camera_type">{{ $post->camera_name }}</p>
                        <!-- いいねボタン --------------------------------------->
                        <div id="app">
                            <like
                            :post-id="{{ json_encode($post->id) }}"
                            :user-id="{{ json_encode($user->id) }}"
                            :default-liked="{{ json_encode($defaultLiked) }}"
                            :count="{{ json_encode($count) }}"></like>
                        </div>
                        <!-- メッセージ ----------------------------------------->
                        <div class="post_message">
                            <p class="text">{{ $post->message }}</p>
                        </div>
                        <!-- コメントフォーム ----------------------------------->
                        <form action="/post_detail?post_id={{ $post->id }}" method="post">
                            {{ csrf_field() }}
                            <div class="comment_form">
                                @if($reply)
                                <textarea name="comment">＠{{ $reply->name }}</textarea>
                                @else
                                <textarea name="comment"></textarea>
                                @endif
                            </div>
                            @if($errors->has('comment'))
                                <p class="error">{{ $errors->first('comment') }}</p>
                            @endif
                            <div class="btn3">
                                <input type="submit" value="コメント">
                            </div>
                        </form>
                        <!-- コメント ------------------------------------------->
                        <div class="comment">
                            @foreach($comments as $comment)
                            <dl>
                                <dt>
                                    <!-- ユーザー ---------------------------------->
                                    <div class="user_unit">
                                        <div class="user_img">
                                            @if($comment->user_picture === '0')
                                            <img src="../img/user.png" alt="">
                                            @else
                                            <img src="../storage/user_img/{{ $comment->user_picture }}" alt="">
                                            @endif
                                        </div>
                                        <div class="user_name">
                                            <a href="#">{{ $comment->user_name }}</a>
                                        </div>
                                    </div><!-- /.user_unit -->
                                </dt>
                                <dd>
                                    <p class="text">{!! nl2br(e($comment -> comment)) !!}&nbsp;&nbsp;<a class="res" href="/post_detail?post_id={{ $comment->post_id }}&res={{ $comment->user_id }}">返信する</a></p>
                                </dd>
                            </dl>
                            @endforeach
                        </div><!-- /.comment -->
                    </div><!-- /.detail_inner -->
                </div><!-- /.detail_box -->
            </section>
            <section class="ad">
                <a class="ad_img">
                    <img src="../img/ad2.png" alt="">
                </a>
            </section><!-- /.ad -->
        </div><!-- /.main -->
        <!-- サブカラム -------------------------------------------------------->
        <div class="sub">
            <section class="user_rank">
                <div class="sub_ttl">
                    <h2>ユーザーランキング</h2>
                </div>
                @if (Auth::check())
                <dl class="user_card">
                    <dt class="user_img">
                        <img src="../img/user.png" alt="">
                    </dt>
                    <dd class="user_name">
                        <p class="text">Kouhei</p>
                    </dd>
                </dl><!-- /.user_card -->
                <dl class="user_card">
                    <dt class="user_img">
                        <img src="../img/user.png" alt="">
                    </dt>
                    <dd class="user_name">
                        <p class="text">Kouhei</p>
                    </dd>
                </dl><!-- /.user_card -->
                <dl class="user_card">
                    <dt class="user_img">
                        <img src="../img/user.png" alt="">
                    </dt>
                    <dd class="user_name">
                        <p class="text">Kouhei</p>
                    </dd>
                </dl><!-- /.user_card -->
                <dl class="user_card">
                    <dt class="user_img">
                        <img src="../img/user.png" alt="">
                    </dt>
                    <dd class="user_name">
                        <p class="text">Kouhei</p>
                    </dd>
                </dl><!-- /.user_card -->
                <dl class="user_card">
                    <dt class="user_img">
                        <img src="../img/user.png" alt="">
                    </dt>
                    <dd class="user_name">
                        <p class="text">Kouhei</p>
                    </dd>
                </dl><!-- /.user_card -->
                @else
                <div class="alert">
                    <p>ランキングを見るためには会員登録が必要です。</p>
                </div>
                <!-- ログインされていないときはぼかし画像を適用 -->
                <img src="../img/rank.png" alt="">
                @endif
            </section><!-- /.user_rank -->
            <section class="post_rank">
                <div class="sub_ttl">
                    <h2>投稿ランキング</h2>
                </div>
                @if (Auth::check())
                <dl class="post_card">
                    <dt><img src="../img/camera.jpg" alt=""></dt>
                    <dd><p class="text">カメラの写真</p></dd>
                </dl><!-- /.post_card -->
                <dl class="post_card">
                    <dt><img src="../img/nature.jpg" alt=""></dt>
                    <dd><p class="text">カメラの写真</p></dd>
                </dl><!-- /.post_card -->
                <dl class="post_card">
                    <dt><img src="../img/camera.jpg" alt=""></dt>
                    <dd><p class="text">カメラの写真</p></dd>
                </dl><!-- /.post_card -->
                <dl class="post_card">
                    <dt><img src="../img/nature.jpg" alt=""></dt>
                    <dd><p class="text">カメラの写真</p></dd>
                </dl><!-- /.post_card -->
                <dl class="post_card">
                    <dt><img src="../img/camera.jpg" alt=""></dt>
                    <dd><p class="text">カメラの写真</p></dd>
                </dl><!-- /.post_card -->
                @else
                <div class="alert">
                    <p>ランキングを見るためには会員登録が必要です。</p>
                </div>
                <img src="../img/rank2.png" alt="">
                @endif
            </section><!-- /.post_rank -->
            <section class="ad">
                <a class="ad_img">
                    <img src="../img/ad.png" alt="">
                </a>
            </section><!-- /.ad -->
        </div><!-- /.sub -->
    </div><!-- /.all -->
</div><!-- /.wrap -->
@endsection
@extends('layouts.footer')
