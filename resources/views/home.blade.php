@extends('layouts.common')
@section('title', 'ログイン完了 - Ce:Came')
@extends('layouts.header')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card2">
                <div class="card-header">ログイン完了</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="text">ようこそ。{{ $user->name }}さんのログインが完了しました。<br><a class="page_return" href="/">こちらより</a>TOPページへお戻りください。</p>
                </div>
            </div><!-- /.card2 -->
        </div><!-- /.col-md-8 -->
    </div><!-- /.row .justify-content-center -->
</div><!-- /.container -->
@endsection
@extends('layouts.footer')
