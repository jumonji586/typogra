<section class="header">
    <h1 class="header__logo">
        <a href="/">
            <img class="contrast" src="/img/logo.png" alt="TYPOGRA/タイポグラ">
        </a>
    </h1>
    <nav class="header__nav-box">
        @guest
        <a class="header__nav-item" href="">
            <img class="header__nav-icon contrast" src="/img/icon/icon-register.png">ゲストユーザー
        </a>
        <a class="header__nav-item" href="{{ route('register') }}">
            <img class="header__nav-icon contrast" src="/img/icon/icon-register.png">ユーザー登録
        </a>
        <a class="header__nav-item" href="{{ route('login') }}">
            <img class="header__nav-icon contrast" src="/img/icon/icon-login.png">ログイン
        </a>
        @endguest
        @auth
        <a href="{{ route('posts.create') }}">投稿する</a>
        @endauth
    </nav>
</section>
<side-menu>
    @auth
    <a>
        <form id="logout-button" method="POST" action="{{ route('logout') }}">
            @csrf
            <img class="icon" src="/img/icon/icon-logout.png">
            <input class="logout-btn" type="submit" value="ログアウト" />
        </form>
    </a>
    @endauth
</side-menu>