@extends('layouts.common')
@section('title', '写真投稿 - Ce:Came')
@extends('layouts.header')
@section('main')
<div class="wrap">
    <div class="all">
        <!-- メインカラム ------------------------------------------------------>
        <div class="main">
            <!-- モーダルウィンドウ --------------------------------------------->
            <div id="modal-content">
                <p class="l-alert">注意事項</p>
            	<ul class="alert_list">
                    <li>個人情報や秘密情報を投稿したり、知的財産などの他者の権利を侵害したりする行為は、禁止されています。</li>
                    <li>不正な、誤解を招くおそれのある、または詐欺的な行為を行うことや、違法または不正な目的で何らかの行為を行うことは禁止されています。</li>
                    <li>他人へのなりすましや不正確な情報の提供は禁止されています。</li>
                </ul>
                <div class="detail_btn">
                    <a href="#">詳しくはこちら</a>
                </div>
            	<div class="btn"><a id="modal-close" class="button-link">閉じる</a></div>
            </div><!-- /.modal-content -->
            <div id="modal-overlay"></div>
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
            <!-- 投稿作成 ------------------------------------------------------>
            <section class="post">
                <div class="headline">
                    <h2 class="ttl3">写真投稿</h2>
                    <div class="btn2">
                        <p class="text">※使用上の注意</p>
                    </div>
                </div>
                <form action="/post" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <dl class="post_form">
                        <div class="post_box">
                            <dt>タイトル&nbsp;</dt>
                            <dd><input placeholder="最高傑作の一枚(255文字以内)" type="text" name="title" value="{{ old('title') }}"></dd>
                            @if($errors->has('title'))
                                <p class="error">{{ $errors->first('title') }}</p>
                            @endif
                        </div><!-- /.post_box -->
                        <div class="post_box">
                            <dt>詳細&nbsp;</dt>
                            <dd><textarea placeholder="沖縄での写真です。(500文字以内)" name="message">{{ old('message') }}</textarea></dd>
                            @if($errors->has('message'))
                                <p class="error">{{ $errors->first('message') }}</p>
                            @endif
                        </div><!-- /.post_box -->
                        <div class="post_box">
                            <dt>使用カメラ&nbsp;</dt>
                            <dd><input placeholder="キヤノン EOS 6D MarkII ボディ(255文字以内)" type="text" name="camera_name" value="{{ old('camera_name') }}"></dd>
                            @if($errors->has('camera_name'))
                                <p class="error">{{ $errors->first('camera_name') }}</p>
                            @endif
                        </div><!-- /.post_box -->
                        <div class="post_box">
                            <dt>写真&nbsp;</dt>
                            <dd><input type="file" name="picture" value=""></dd>
                            @if($errors->has('picture'))
                                <p class="error">{{ $errors->first('picture') }}</p>
                            @endif
                        </div><!-- /.post_box -->
                    </dl>
                    <div class="btn3">
                        <input type="submit" name="" value="投稿">
                    </div>
                </form>
            </section><!-- /.post -->
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
