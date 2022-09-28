@extends('app')

@section('title', 'ログイン')

@section('content')
<div class="page-type2">
<h2 class="page-type2__title">LOGIN</h2>
  <div class="page-type2__inner mt30">
    <p class="page-type2__second-title">SNSアカウントでログイン</p>
    <a class="sns-btn" href="{{ route('login.{provider}', ['provider' => 'google']) }}" class=""><img src="/img/icon/icon-google.png" alt="">Googleでログイン
    </a>
    <a class="sns-btn sns-btn2" href="{{ route('login.{provider}', ['provider' => 'twitter']) }}"><img src="/img/icon/icon-twitter.png" alt="">Twitterでログイン
    </a>
    <p class="page-type2__second-title">メールアドレスでログイン</p>
    @include('common-parts.error_card_list')
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <p class="page-type2__item-name">メールアドレス</p>
      <input class="page-type2__input" type="text" id="email" name="email"  value="{{ old('email') }}">
      <p class="page-type2__item-name">パスワード</p>
      <input class="page-type2__input" type="password" id="password" name="password" >
      <input type="hidden" name="remember" id="remember" value="on">
      <a href="{{ route('password.request') }}">＞ パスワードを忘れた方はこちら</a>
      <div class="page-type2_btn-box">
        <a href="/" class="page-type2__cancel-btn" href="">キャンセル</a>
        <input class="page-type2__enter-btn" type="submit" value="ログイン">
      </div>
    </form>
  </div>
</div>
@endsection