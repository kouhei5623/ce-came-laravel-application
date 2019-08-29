@extends('layouts.common')
@if($user->id == $auth_user->id)
@section('title', 'マイページ - Ce:Came')
@elseif($user->id != $auth_user->id)
@section('title', 'ユーザーページ - Ce:Came')
@endif
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
                            <li><a href="/userpage?user_id={{ $auth_user->id }}">マイページ</a></li>
                            <li><a href="/edit_profile?user_id={{ $auth_user->id }}">プロフィール編集</a></li>
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
            <!-- マイページ ----------------------------------------------------->
            <section class="userpage">
                <div class="headline">
                    @if($user->id == $auth_user->id)
                    <h2 class="ttl3">マイページ</h2>
                    @elseif($user->id != $auth_user->id)
                    <h2 class="ttl3">{{ $user->name }}さんのページ</h2>
                    @endif
                </div><!-- /.headline-->
                <div class="userpage_inner">
                    <div class="userpage_unit">
                        <div class="userpage_img">
                            @if($user->picture === '0')
                            <img src="../img/user.png" alt="">
                            @else
                            <img src="../storage/user_img/{{ $user->picture }}" alt="">
                            @endif
                        </div><!-- /.userpage_img -->
                        <div class="userpage_area">
                            <p class="userpage_name">{{ $user->name }}</p>
                            @if($user->id == $auth_user->id)
                            <div class="follow_area">
                                <dl class="follow_unit">
                                    <div class="follow_box">
                                        <dt>フォロー</dt>
                                        <dd>{{ $followUserCount }}</dd>
                                    </div>
                                    <div class="follow_box">
                                        <dt>フォロワー</dt>
                                        <dd>{{ $followerCount }}</dd>
                                    </div>
                                </dl>
                                <div class="edit_btn">
                                    <a href="/edit_profile?user_id={{ $auth_user->id }}">プロフィール編集</a>
                                </div><!-- /.profile_edit -->
                            </div>
                            @elseif($user->id != $auth_user->id)
                            <div id="app">
                                <follow
                                :follow="{{ json_encode($auth_user->id )}}"
                                :follower="{{ json_encode($user->id) }}"
                                :default-followed="{{ json_encode($defaultFollowed) }}"
                                :follow-count="{{ json_encode($followCount) }}"
                                :follower-count="{{ json_encode($followerCount) }}"
                                :follow-user-count="{{ json_encode($followUserCount) }}"></follow>
                            </div>
                            @endif
                        </div><!-- /.userpage_area -->
                    </div><!-- /.userpage_unit -->
                    <div class="userpage_profile">
                        <p class="text">{!! nl2br(e($user -> profile)) !!}</p>
                    </div><!-- /.userpage_profile -->
                </div><!-- /.userpage_inner -->
            </section><!-- /.userpage -->
            <!-- 自分の投稿 ----------------------------------------------------->
            <section class="my_post">
                <div class="my_post_btn">
                    <div class="my_picture">
                        <p>投稿写真</p>
                    </div>
                    <div class="my_camera">
                        <p>使用カメラ</p>
                    </div>
                </div><!-- /.my_post_btn -->
                <div class="my_post_area">
                    <div class="my_post_flex">
                        @foreach($posts as $post)
                        <dl class="my_post_col">
                            <dt><a href="/post_detail?post_id={{ $post->id }}"><img src="../storage/post_img/{{ $post->picture }}" alt=""></a></dt>
                            <dd>
                                <a href="/post_detail?post_id={{ $post->id }}">
                                    <h2>{{ $post->title }}</h2>
                                </a>
                            </dd>
                        </dl><!-- /.my_post_col -->
                        @endforeach
                    </div><!-- /.my_post_flex -->
                </div><!-- /.my_post_area -->
                <div class="my_post_area2">
                    <div class="my_post_flex2">
                        @foreach($camera_posts as $camera_post)
                        <dl class="my_post_col2">
                            <dt><a href="/camera_post_detail?camera_id={{ $camera_post->id }}"><img src="../storage/camera_img/{{ $camera_post->picture }}" alt=""></a></dt>
                            <dd>
                                <a href="/camera_post_detail?camera_id={{ $camera_post->id }}">
                                    <h2>{{ $camera_post->camera_name }}</h2>
                                </a>
                            </dd>
                        </dl><!-- /.my_post_col2 -->
                        @endforeach
                    </div><!-- /.my_post_flex2 -->
                </div><!-- /.my_post_area2 -->
            </section><!-- /.my_post2 -->
            <!--ブログ --------------------------------------------------------->
            <section class="blog">
                <div class="headline">
                    <h2 class="ttl4">おすすめ記事</h2>
                </div>
                <div class="blog_unit">
                    @for($i = 0; $i < 5; $i++)
                    <dl class="blog_col">
                        <dt>
                            <a href="https://koublog.site/" target="_blank"><img src="{{ $images[$i] }}" alt=""></a>
                        </dt>
                        <dd>
                            <p class="blog_ttl"><a href="https://koublog.site/" target="_blank">{{ str_limit($texts[$i], $limit=30, $end = '...') }}</a></p>
                        </dd>
                    </dl>
                    @endfor
                </div>
            </section>
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
