<div class="upper-nav1">
    @guest
        <a class="upper-nav1-text-btn" href="{{ route('register') }}">
            <img class="upper-nav1-text-btn__img" src="/img/icon/icon-register-gray.png">
            新規登録
        </a>
        <a class="upper-nav1-text-btn" href="{{ route('login') }}">
            <img class="upper-nav1-text-btn__img" src="/img/icon/icon-login-gray.png">
            ログイン
        </a>
    @endguest

    @auth
        <a class="upper-nav1-icon" href='{{ route("users.show", ["display_id" => Auth::user()->display_id]) }}'>
            <img class="upper-nav1-icon__img" src="{{ Auth::user()->prof_image_path }}" alt="">
            <p class="upper-nav1-icon__text">MY PAGE</p>
        </a>
        <a class="upper-nav1-icon" href="">
            <img class="upper-nav1-icon__img" src="/img/icon/icon-info.png" alt="">
            <p class="upper-nav1-icon__text">INFO</p>
        </a>
        <a class="upper-nav1-icon" href="{{ route('posts.create') }}">
            <img class="upper-nav1-icon__img" src="/img/icon/icon-post.png" alt="">
            <p class="upper-nav1-icon__text">SEARCH</p>
        </a>
        <a class="upper-nav1-icon" href="{{ route('posts.create') }}">
            <img class="upper-nav1-icon__img" src="/img/icon/icon-search.png" alt="">
            <p class="upper-nav1-icon__text">POST</p>
        </a>
    @endauth
</div>

<h2 class="sub-area-title mb10">Menu</h2>
<div class="side-menu">
    <a class="side-menu-item" href="">
        <div class="side-menu-item__inner">
            <p class="side-menu-item__main-text">MY PAGE</p>
            <p class="side-menu-item__sub-text">マイページ</p>
        </div>
    </a>
    <a class="side-menu-item" href="{{ route('posts.theme.{theme}', ['theme' => 'all']) }}">
        <div class="side-menu-item__inner">
            <p class="side-menu-item__main-text">ALL</p>
            <p class="side-menu-item__sub-text">全ての投稿</p>
        </div>
    </a>
    <a class="side-menu-item" href="{{ route('posts.theme.{theme}', ['theme' => 'recommend']) }}">
        <div class="side-menu-item__inner">
            <p class="side-menu-item__main-text">RECOMMEND</p>
            <p class="side-menu-item__sub-text">おすすめの投稿</p>
        </div>
    </a>
    <a class="side-menu-item" href="">
        <div class="side-menu-item__inner">
            <p class="side-menu-item__main-text">FOLLOWEE'S</p>
            <p class="side-menu-item__sub-text">フォローユーザーの投稿</p>
        </div>
    </a>

    <a class="side-menu-item mt20" href="">
        <div class="side-menu-item__inner">
            <p class="side-menu-item__main-text">MY PAGE</p>
            <p class="side-menu-item__sub-text">マイページ</p>
        </div>
    </a>
    <a class="side-menu-item" href="">
        <div class="side-menu-item__inner">
            <p class="side-menu-item__main-text">ALL</p>
            <p class="side-menu-item__sub-text">全ての投稿</p>
        </div>
    </a>
    @auth
        <form class="side-menu-item" method="POST" action="{{ route('logout') }}">
            <div class="side-menu-item__inner">
                <p class="side-menu-item__main-text">LOG OUT</p>
                <p class="side-menu-item__sub-text">ログアウト</p>
            </div>
            @csrf
            <button class="side-menu-logout-btn"></button>
        </form>
    @endauth
    
    <a class="side-menu-sub-item mt20" href="">利用規約</a>
    <a class="side-menu-sub-item" href="">プライバシーポリシー</a>
    <a class="side-menu-sub-item" href="">お問い合わせ</a>
    @auth
    <a class="side-menu-sub-item" href="{{ route('users.leave',['display_id' => Auth::user()->display_id]) }}">アカウント削除</a>
    @endauth
</div>
