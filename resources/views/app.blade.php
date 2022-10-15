<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
    @yield('title')
  </title>
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
  <script src="/js/typogra.js"></script>
</body>


</html>