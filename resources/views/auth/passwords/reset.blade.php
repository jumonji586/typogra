@extends('app')

@section('title', 'パスワード再設定')

@section('content')
<div class="page-type2">
  <div class="form-box">
    <p class="form-title">パスワード再設定</p>
    @include('error_card_list')
    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="email" value="{{ $email }}">
      <input type="hidden" name="token" value="{{ $token }}">
      <p class="koumoku">新しいパスワード（※半角英数8文字以上）</p>
      <input class="form-control" type="password" id="password" name="password">
      <p class="koumoku">新しいパスワード（再入力）</p>
      <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
      <div class="btn-box">
        <a class="cancel-btn" href="/">キャンセル</a>
        <input class="enter-btn" type="submit" value="送信">
      </div>
    </form>
  </div>
</div>
@endsection