@extends('app')

@section('title', 'ログイン')

@section('content')
<div class="page-type2">
  <div class="form-box">
    <p class="form-title">SNSアカウントでログイン</p>
    <a class="sns-btn" href="{{ route('login.{provider}', ['provider' => 'google']) }}" class=""><img src="/img/icon/icon-google.png" alt="">Googleでログイン
    </a>
    <a class="sns-btn sns-btn2" href="{{ route('login.{provider}', ['provider' => 'twitter']) }}"><img src="/img/icon/icon-twitter.png" alt="">Twitterでログイン
    </a>
    <p class="form-title">メールアドレスでログイン</p>
    @include('error_card_list')
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <p class="koumoku">メールアドレス</p>
      <input type="text" id="email" name="email"  value="{{ old('email') }}">
      <p class="koumoku">パスワード</p>
      <input type="password" id="password" name="password" >
      <input type="hidden" name="remember" id="remember" value="on">
      <a href="{{ route('password.request') }}">＞ パスワードを忘れた方はこちら</a>
      <div class="btn-box">
        <a href="/" class="cancel-btn" href="">キャンセル</a>
        <input class="enter-btn" type="submit" value="ログイン">
      </div>
    </form>
  </div>
</div>
@endsection