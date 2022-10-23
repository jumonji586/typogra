@extends('app')

@section('title', 'パスワード再設定 | TYPOGRA タイポグラ | 作字・タイポグラフィ投稿サイト')

@section('content')
<div class="page-type2">
  @include('common-parts.header-logo')
  <div class="page-type2__inner mt30">
    <p class="page-type2__title">パスワード再設定</p>
    <p class="page-type2__item-name">※ご入力頂いたメールアドレスに、パスワード再設定のためのメールを送信します。</p>
    @include('common-parts.error_card_list')

    @if (session('status'))
    <p class="succes-message">
      {{ session('status') }}
    </p>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <p class="page-type2__item-name">メールアドレス</p>
      @guest
      <input class="page-type2__input" type="text" id="email" name="email">
      @endguest
      @auth
      <input class="page-type2__input"" type="text" id="email" name="email" value="{{Auth::user()->email}}">
      @endauth
      <div class="page-type2-btn-box">
        <a class="page-type2-btn-box__btn" href="/">キャンセル</a>
        <input class="page-type2-btn-box__btn" type="submit" value="メール送信">
      </div>
    </form>
  </div>
</div>
@endsection