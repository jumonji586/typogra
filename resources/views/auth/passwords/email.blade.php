@extends('app')

@section('title', 'パスワード再設定')

@section('content')
<div class="page-type2">
  <div class="form-box">
    <p class="form-title">パスワード再設定</p>
    <p class="koumoku">※ご入力頂いたメールアドレスに、パスワード再設定のためのメールを送信します。</p>
    @include('error_card_list')

    @if (session('status'))
    <p class="succes-message">
      {{ session('status') }}
    </p>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <p class="koumoku">メールアドレス</p>
      @guest
      <input class="form-control" type="text" id="email" name="email">
      @endguest
      @auth
      <input class="form-control" type="text" id="email" name="email" value="{{Auth::user()->email}}">
      @endauth
      <div class="btn-box">
        <a class="cancel-btn" href="/">キャンセル</a>
        <input class="enter-btn" type="submit" value="メール送信">
      </div>
    </form>
  </div>
</div>
@endsection