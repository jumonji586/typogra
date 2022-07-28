@extends('app')

@section('title', 'ユーザー登録')

@section('content')
<div class="page-type2">
  <div class="form-box">
    <p class="form-title">SNSアカウントで登録</p>
    <a class="sns-btn" href="{{ route('login.{provider}', ['provider' => 'google']) }}" class=""><img src="/img/icon/icon-google.png" alt="">Googleで登録
    </a>
    <a class="sns-btn sns-btn2" href="{{ route('login.{provider}', ['provider' => 'twitter']) }}"><img src="/img/icon/icon-twitter.png" alt="">Twitterで登録
    </a> 
    <p class="form-title">メールアドレスで登録</p>
    @include('error_card_list')
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <p class="koumoku">ユーザー名（※全角12・半角24文字以内）</p>
      <input type="text" id="name" name="name"  value="{{ old('name') }}">
      <p class="koumoku">メールアドレス</p>
      <input type="text" id="email" name="email"  value="{{ old('email') }}">
      <p class="koumoku">パスワード（※半角英数8文字以上）</p>
      <input type="password" id="password" name="password" >
      <p class="koumoku">パスワード再入力</p>
      <input type="password" id="password_confirmation" name="password_confirmation" >
      <div class="koumoku rule-privacy-box">
        <input type="checkbox" name="rule-privacy"><p><a href="" class="fw-b underline" target="_blank">利用規約</a> および <a href="" class="fw-b underline" target="_blank">プライバシーポリシー</a> に同意する</p>
      </div>
      <div class="btn-box">
        <a class="cancel-btn" href="/">キャンセル</a>
        <input class="enter-btn" type="submit" value="登録">
      </div>
    </form>
  </div>
</div>
@endsection