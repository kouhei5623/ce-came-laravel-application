@section('header')
    <div class="header">
        <div class="wrap">
            <h1 class="ttl"><a href="./">Ce:Came</a></h1>
            <p class="description">- 自信の一枚をシェアしよう -</p>
            @if (Auth::check())
            <ul class="system_list">
                <li class="item">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                     ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul><!-- /.system_list -->
            @else
            <ul class="system_list">
                <li><a href="/register">会員登録</a></li>
                <li><a href="/login">ログイン</a></li>
            </ul><!-- /.system_list -->
            @endif
            <!-- snsボタン ---------------------------------------------------->
            <ul class="sns_list">
                <li><a href="#"><img src="../img/line.png" alt=""></a></li>
                <li><a href="#"><img src="../img/twitter.png" alt=""></a></li>
                <li><a href="#"><img src="../img/facebook.png" alt=""></a></li>
            </ul><!-- /.sns -->
        </div><!-- /.wrap -->
    </div><!-- /.header -->
@endsection
