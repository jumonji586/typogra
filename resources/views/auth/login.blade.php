@extends('app')

@section('title', 'ログイン')

@section('content')
<div class="page-type2">
  @include('common-parts.header-logo')
  <div class="page-type2__inner mt30">
    <p class="page-type2__title">SNSアカウントでログイン</p>
    <div class="page-type2-btn-box mt30 mb40">
      <a class="page-type2-btn-box__btn" href="{{ route('login.{provider}', ['provider' => 'google']) }}" class=""><img class="page-type2-btn-box__btn-icon"
          src="/img/icon/icon-google.png" alt="">Googleでログイン
      </a>
      <a class="page-type2-btn-box__btn" href="{{ route('login.{provider}', ['provider' => 'twitter']) }}"><img class="page-type2-btn-box__btn-icon"
      src="/img/icon/icon-twitter.png" alt="">Twitterでログイン
      </a>
    </div>
    <p class="page-type2__title">メールアドレスでログイン</p>
    @include('common-parts.error_card_list')
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <p class="page-type2__item-name">メールアドレス</p>
      <input class="page-type2__input" type="text" id="email" name="email"  value="{{ old('email') }}">
      <p class="page-type2__item-name">パスワード</p>
      <input class="page-type2__input" type="password" id="password" name="password" >
      <input type="hidden" name="remember" id="remember" value="on">
      <a href="{{ route('password.request') }}">＞ パスワードを忘れた方はこちら</a>
      <div class="page-type2-btn-box">
        <a href="/" class="page-type2-btn-box__btn" href="">キャンセル</a>
        <input class="page-type2-btn-box__btn" type="submit" value="ログイン">
      </div>
    </form>
  </div>
</div>
@endsection