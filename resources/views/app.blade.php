<!DOCTYPE html>
<html lang="ja">

<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P7NGRHZ7MY"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-P7NGRHZ7MY');
  </script>
  <meta charset="utf-8">
  <meta name="robots" content="noindex">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon" href="/img/favicon.ico">
  <title>
    @yield('title')
  </title>
  <meta name="description" content="TYPOGRA（タイポグラ）は、作字・タイポグラフィ専用の投稿サイトです。">
  <link href="/css/style.css" rel="stylesheet">
  @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<style>
  [v-cloak] {
      display: none;
    }
</style>
<body>
  <div id="app" class="wrapperAll" v-cloak>
    @guest
    @if(isset($_GET['user']) && $_GET['user'] === 'guest')
    <section class="guest-area page-type2">
      @include('common-parts.header-logo')
      <form class="page-type2__inner mt30" method="POST" action="{{ route('register') }}">
        @csrf
        @php
        $guestValue = dechex(str_pad(random_int(0,999999999),9,0, STR_PAD_LEFT));
        @endphp
          <input class="disp-none" type="text" name="name" value="{{'guest'.$guestValue}}">
          <input class="disp-none" type="text" name="email" value="{{'guest'.$guestValue.'@'.'co.jp'}}">
          <input class="disp-none" type="password" value="{{'guest'.$guestValue}}" name="password">
          <input class="disp-none" type="password" value="{{'guest'.$guestValue}}" name="password_confirmation">
          <input class="disp-none" type="checkbox" name="rule-privacy" checked>
          <p class="guest-area__lead fw-b">OKボタンを押すと、ゲストアカウントが新規作成されます。</p>
            <p class="mt5">
            ※当サイトは現在まだ一般公開していません（検索避けをしてあります）ので、投稿やコメントなど自由にご利用ください。</p>
            <p class="mt5"> ※ゲストアカウント及びゲストアカウントで投稿いただいた画像・コメント等は、後日全て削除させて頂きます。予めご了承をお願いします。</p>
          <div class="guest-area__list-box mt20">
            <p class="guest-area__list-title">主な機能</p>
            <ul class="guest-area__list-box-inner mt20">
              <li>・画像投稿・削除</li>
              <li>・コメント投稿・返信・削除</li>
              <li>・いいね</li>
              <li>・フォロー</li>
              <li>・プロフィール編集</li>
              <li>・通知</li>
              <li>・違反申告</li>
              <li>・お問い合わせ</li>
              <li>・検索</li>
              <li>・SNS認証</li>
              <li>・ユーザーランキング</li>
            </ul>
          </div>
          <div class="page-type2-btn-box mt30">
              <input class="page-type2-btn-box__btn m0auto"  type="submit" value="OK">
          </div>
      </form>
    </section>
    @endif
    @endguest
    <div class="smp-message">
      <img class="smp-message__logo" src="/img/logo.png" alt="">
      <p>
        スマートフォン・タブレットには現在対応していません。
      </p>
    </div>
    @if (session('message'))
    <div id="flash-message">
      <div class="flash-message__icon-box">
        <img class="flash-message__icon" src="/img/icon/icon-check.png">
      </div>
      <p class="flash-message__text">
          {{session('message')}}
      </p>
    </div>
    @endif
    <a href="#app" class="totop-btn-box">
      <div class="totop-btn">
        <img class="totop-btn__img totop-btn__img--1" src="/img/arrow-dots.png" alt="">
        <img class="totop-btn__img totop-btn__img--2" src="/img/arrow-dots.png" alt="">
      </div>
    </a>
    <p class="body-side-text">#TYPOGR #タイポグラ #作字 #TYPOGRAPHY #タイポグラフィ</p>
    <p class="body-side-text body-side-text--2">#TYPOGR #タイポグラ #作字 #TYPOGRAPHY #タイポグラフィ</p>
    {{-- @include('common-parts.header') --}}
    @yield('content')
    @include('common-parts.footer')
  </div>
  <script>
  // ブラウザの戻るボタンを押した際にフラッシュメッセージが再表示されるのを防ぐための処理
  if( "{{session('message')}}" ){
    const messageIdValue = "{{ uniqid() }}";
    if (sessionStorage) {
      if (sessionStorage.getItem('messageId') === messageIdValue) {
        document.getElementById('flash-message').style.display = "none";
      }else{
        sessionStorage.setItem('messageId', messageIdValue);
      }
    }
  }
  </script>
  <script src="/js/typogra.js"></script>
</body>


</html>