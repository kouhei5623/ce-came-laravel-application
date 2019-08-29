@extends('layouts.common')
@section('title', 'カメラ投稿 - Ce:Came')
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
                    <h2 class="ttl3">カメラ投稿</h2>
                    <div class="btn2">
                        <p class="text">※使用上の注意</p>
                    </div>
                </div>
                <form action="/camera_post" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <dl class="post_form">
                        <div class="post_box">
                            <dt>カメラの名前&nbsp;</dt>
                            <dd><input placeholder="Canon デジタル一眼レフカメラ EOS 5D MarkIV ボディー EOS5DMK4(255文字以内)" type="text" name="camera_name" value="{{ old('camera_name') }}"></dd>
                            @if($errors->has('camera_name'))
                                <p class="error">{{ $errors->first('camera_name') }}</p>
                            @endif
                        </div><!-- /.post_box -->
                        <div class="post_box">
                            <dt>評価&nbsp;</dt>
                            <dd>
                                <select class="star" name="star">
                                    <option value="star5">５</option>
                                    <option value="star4">４</option>
                                    <option value="star3">３</option>
                                    <option value="star2">２</option>
                                    <option value="star1">１</option>
                                </select>
                            </dd>
                        </div><!-- /.post_box -->
                        <div class="post_box">
                            <dt>購入サイトのURL&nbsp;</dt>
                            <dd><input placeholder="https://example.com" type="text" name="url" value="{{ old('url') }}"></dd>
                            @if($errors->has('url'))
                                <p class="error">{{ $errors->first('url') }}</p>
                            @endif
                        </div><!-- /.post_box -->
                        <div class="post_box">
                            <dt>レビュー&nbsp;</dt>
                            <dd><textarea placeholder="使いやすいです。(500文字以内)" name="review">{{ old('review') }}</textarea></dd>
                            @if($errors->has('review'))
                                <p class="error">{{ $errors->first('review') }}</p>
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
            <!-- カメラリスト -------------------------------------------------->
            <section class="camera_list">
                <div class="headline">
                    <h2 class="ttl4">みんなが使っているカメラ</h2>
                </div>
                <div class="camera_list_unit">
                    <dl class="camera_list_col">
                        <dt><img src="../img/camera_type.jpg" alt=""></dt>
                        <dd>
                            <!-- ユーザー --------------------------------------->
                            <div class="user_unit">
                                <div class="user_img">
                                    <img src="../img/user.png" alt="">
                                </div>
                                <div class="user_name">
                                    <a href="#">Kouhei</a>
                                </div>
                            </div><!-- /.user_unit -->
                            <h2 class="headline"><a href="#">キヤノン EOS 6D MarkII ボディ</a></h2>
                        </dd>
                    </dl><!-- /.camera_list_col -->
                    <dl class="camera_list_col">
                        <dt><img src="../img/camera_type.jpg" alt=""></dt>
                        <dd>
                            <!-- ユーザー --------------------------------------->
                            <div class="user_unit">
                                <div class="user_img">
                                    <img src="../img/user.png" alt="">
                                </div>
                                <div class="user_name">
                                    <a href="#">Kouhei</a>
                                </div>
                            </div><!-- /.user_unit -->
                            <h2 class="headline"><a href="#">キヤノン EOS 6D MarkII ボディ</a></h2>
                        </dd>
                    </dl><!-- /.camera_list_col --><dl class="camera_list_col">
                        <dt><img src="../img/camera_type.jpg" alt=""></dt>
                        <dd>
                            <!-- ユーザー --------------------------------------->
                            <div class="user_unit">
                                <div class="user_img">
                                    <img src="../img/user.png" alt="">
                                </div>
                                <div class="user_name">
                                    <a href="#">Kouhei</a>
                                </div>
                            </div><!-- /.user_unit -->
                            <h2 class="headline"><a href="#">キヤノン EOS 6D MarkII ボディ</a></h2>
                        </dd>
                    </dl><!-- /.camera_list_col -->
                    <dl class="camera_list_col">
                        <dt><img src="../img/camera_type.jpg" alt=""></dt>
                        <dd>
                            <!-- ユーザー --------------------------------------->
                            <div class="user_unit">
                                <div class="user_img">
                                    <img src="../img/user.png" alt="">
                                </div>
                                <div class="user_name">
                                    <a href="#">Kouhei</a>
                                </div>
                            </div><!-- /.user_unit -->
                            <h2 class="headline"><a href="#">キヤノン EOS 6D MarkII ボディ</a></h2>
                        </dd>
                    </dl><!-- /.camera_list_col -->
                    <dl class="camera_list_col">
                        <dt><img src="../img/camera_type.jpg" alt=""></dt>
                        <dd>
                            <!-- ユーザー --------------------------------------->
                            <div class="user_unit">
                                <div class="user_img">
                                    <img src="../img/user.png" alt="">
                                </div>
                                <div class="user_name">
                                    <a href="#">Kouhei</a>
                                </div>
                            </div><!-- /.user_unit -->
                            <h2 class="headline"><a href="#">キヤノン EOS 6D MarkII ボディ</a></h2>
                        </dd>
                    </dl><!-- /.camera_list_col -->
                </div><!-- /.camera_list_unit -->
            </section><!-- /.camera_list -->
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
