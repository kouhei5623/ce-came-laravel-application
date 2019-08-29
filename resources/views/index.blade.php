@extends('layouts.common')
@section('title', 'Ce:Came')
@extends('layouts.header')
@section('main')
<div class="wrap">
    <div class="all">
        <!-- メインカラム ------------------------------------------------------>
        <div class="main">
            <!-- タイムライン ----------------------------------------------------------->
            <section class="time_bar">
                <div class="time_text">
                    @for($i = 0; $i < 1; $i++)
                    <p>{{ $posts[$i]->created_at }} {{ $posts[$i]->user_name }}さんが、「{{ $posts[$i]->title }}」と投稿しました。</p>
                    @endfor
                </div>
            </section><!-- /.time_bar -->
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
            <!-- 投稿一覧 ------------------------------------------------------>
            <section class="list">
                <div class="list_unit">
                    @foreach($posts as $post)
                    <dl class="list_col">
                        <dt>
                            <a href="/post_detail?post_id={{ $post->id }}"><img src="../storage/post_img/{{ $post->picture }}" alt=""></a>
                        </dt>
                        <dd>
                            <!-- ユーザー --------------------------------------->
                            <div class="user_unit">
                                <div class="user_img">
                                    @if($post->user_picture === '0')
                                    <img src="../img/user.png" alt="">
                                    @else
                                    <img src="../storage/user_img/{{ $post->user_picture }}" alt="">
                                    @endif
                                </div>
                                <div class="user_name">
                                    <a href="/userpage?user_id={{ $post->user_id }}">{{ $post->user_name }}</a>
                                </div>
                            </div><!-- /.user_unit -->
                            <h2 class="headline"><a href="/post_detail?post_id={{ $post->id }}">{{ $post->title }}</a></h2>
                            <!-- カメラの種類 ----------------------------------->
                            <p class="camera_type">{{ $post->camera_name }}</p>
                            <!-- いいねボタン ----------------------------------->
                            <div class="good_btn">
                                <a href="/like_detail?post_id={{ $post->id }}">
                                    <img src="../img/good.png" alt="">
                                    <p class="text">{{ $post->like }}</p>
                                </a>
                            </div><!-- /.good_btn -->
                        </dd>
                    </dl><!-- /.list_col -->
                    @endforeach
                </div><!-- /.list_unit -->
            </section><!-- /.list -->
            <!-- カメラリスト -------------------------------------------------->
            <section class="camera_list">
                <div class="headline">
                    <h2 class="ttl4">みんなが使っているカメラ</h2>
                </div>
                <div class="camera_list_unit">
                    @foreach($camera_posts as $camera_post)
                    <dl class="camera_list_col">
                        <dt><a href="/camera_post_detail?camera_id={{ $camera_post->id }}"><img src="../storage/camera_img/{{ $camera_post->picture }}" alt=""></a></dt>
                        <dd>
                            <!-- ユーザー --------------------------------------->
                            <div class="user_unit">
                                <div class="user_img">
                                    @if($camera_post->user_picture == '0')
                                    <img src="../img/user.png" alt="">
                                    @else
                                    <img src="../storage/user_img/{{ $camera_post->user_picture }}" alt="">
                                    @endif
                                </div>
                                <div class="user_name">
                                    <a href="/userpage?user_id={{ $camera_post->user_id }}">{{ $camera_post->user_name }}</a>
                                </div>
                            </div><!-- /.user_unit -->
                            <h2 class="headline"><a href="/camera_post_detail?camera_id={{ $camera_post->id }}">{{ $camera_post->camera_name }}</a></h2>
                            <div class="star">
                                @if($camera_post->star === 'star5')
                                <img src="../img/star5.png" alt="">
                                @elseif($camera_post->star === 'star4')
                                <img src="../img/star4.png" alt="">
                                @elseif($camera_post->star === 'star3')
                                <img src="../img/star3.png" alt="">
                                @elseif($camera_post->star === 'star2')
                                <img src="../img/star2.png" alt="">
                                @elseif($camera_post->star === 'star1')
                                <img src="../img/star1.png" alt="">
                                @endif
                            </div><!-- /.star -->
                        </dd>
                    </dl><!-- /.camera_list_col -->
                    @endforeach
                </div><!-- /.camera_list_unit -->
            </section><!-- /.camera_list -->
            <section class="ad">
                <a class="ad_img">
                    <img src="../img/ad2.png" alt="">
                </a>
            </section><!-- /.ad -->
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
            </section><!-- /.blog -->
        </div><!-- /.main -->
        <!-- サブカラム --------------------------------------------------------->
        <div class="sub">
            <!-- ユーザーランキング ---------------------------------------------->
            <section class="user_rank">
                <div class="sub_ttl">
                    <h2>ユーザーランキング</h2>
                </div>
                @if (Auth::check())
                @foreach($user_ranks as $user_rank)
                <dl class="user_card">
                    <dt class="user_img">
                        @if($user_rank->picture == '0')
                        <img src="../img/user.png" alt="">
                        @else
                        <img src="../storage/user_img/{{ $user_rank->picture }}" alt="">
                        @endif
                    </dt>
                    <dd class="user_name">
                        <p class="text">{{ $user_rank->name }}</p>
                    </dd>
                </dl><!-- /.user_card -->
                @endforeach
                @else
                <div class="alert">
                    <p>ランキングを見るためには会員登録が必要です。</p>
                </div>
                <!-- ログインされていないときはぼかし画像を適用 -->
                <img src="../img/rank.png" alt="">
                @endif
            </section><!-- /.user_rank -->
            <!-- 投稿ランキング ------------------------------------------------->
            <section class="post_rank">
                <div class="sub_ttl">
                    <h2>投稿ランキング</h2>
                </div>
                @if (Auth::check())
                @foreach($post_ranks as $post_rank)
                <dl class="post_card">
                    <dt><img src="../storage/post_img/{{ $post_rank->picture }}" alt=""></dt>
                    <dd><p class="text">{{ $post_rank->title }}</p></dd>
                </dl><!-- /.post_card -->
                @endforeach
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
            <!-- 開発者ツイッター ------------------------------------------------>
            <section class="twitter">
                <div class="sub_ttl">
                    <h2>開発者ツイッター</h2>
                </div>
                <a class="twitter-timeline" data-lang="ja" data-height="1000" data-theme="light" data-link-color="#FAB81E" href="https://twitter.com/webkouhei56?ref_src=twsrc%5Etfw">Tweets by webkouhei56</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </section><!-- /.twitter -->
        </div><!-- /.sub -->
    </div><!-- /.all -->
</div><!-- /.wrap -->
@endsection
@extends('layouts.footer')
