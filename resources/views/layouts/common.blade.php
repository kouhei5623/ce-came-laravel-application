<!DOCTYPE html>
<html lang="ja" dir="ltr">
    <head>
        <meta charset="utf-8">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="/css/stylesheet.css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <!-- fontawesome読み込み -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <!-- js -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script type="text/javascript">
             $(function(){
                $('#modal-close').click(function(){
                    $('#modal-content').fadeOut();
                    $('#modal-overlay').fadeOut();
                });
                $('.btn2').click(function(){
                    $('#modal-content').fadeIn();
                    $('#modal-overlay').fadeIn();
                });
                $('.my_picture').click(function(){
                    $('.my_post_area').css('display', 'block');
                    $('.my_post_area2').css('display', 'none');
                    $('.my_picture p').css('background-color', '#a9a9a9');
                    $('.my_camera p').css('background-color', '#f5f5f5');
                    $('.my_picture p').css('box-shadow', '0 8px 24px rgba(0,0,0,0.1)');
                });
                $('.my_camera').click(function(){
                    $('.my_post_area2').css('display', 'block');
                    $('.my_post_area').css('display', 'none');
                    $('.my_camera p').css('background-color', '#a9a9a9');
                    $('.my_picture p').css('background-color', '#f5f5f5');
                    $('.my_camera p').css('box-shadow', '0 8px 24px rgba(0,0,0,0.1)');
                });
            });
        </script>
    </head>
    <body>
        <!-- ヘッダー開始 ------------------------------------------------------>
        <header>
            @yield('header')
            @yield('auth_header')
        </header>
        <!-- メイン開始 -------------------------------------------------------->
        <main>
            @yield('main')
        </main>
        <!-- フッター開始 ------------------------------------------------------>
        <footer>
            @yield('footer')
        </footer>
    </body>
</html>
