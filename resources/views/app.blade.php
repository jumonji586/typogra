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