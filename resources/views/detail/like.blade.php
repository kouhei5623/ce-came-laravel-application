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
            <!-- いいね詳細 ----------------------------------------------------->
            <section class="like">
                <div class="headline">
                    <h2 class="ttl3">いいねしたユーザー</h2>
                </div><!-- /.menubar -->
                @foreach($likes as $like)
                <div class="like_user">
                    <a href="#">
                        <div class="like_unit">
                            <div class="like_img">
                                @if($like[0]->picture === '0')
                                  <img src="../img/user.png" alt="">
                                @else
                                  <img src="../storage/user_img/{{ $like[0]->picture }}" alt="">
                                @endif
                            </div>
                            <div class="like_name">
                                <p>{{ $like[0]->name }}</p>
                            </div>
                        </div>
                        @if($like[0]->profile !='')
                        <div class="like_profile">
                            <p>{{ $like[0]->profile }}</p>
                        </div>
                        @endif
                    </a>
                </div>
                @endforeach
            </section><!--/.like-->
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
