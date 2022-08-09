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
    @include('header')
    @yield('content')
    @include('footer')
  </div>
  <script src="/js/typogra.js"></script>
</body>


</html>