@extends('app')

@section('title', 'パスワード再設定')

@section('content')
<div class="page-type2">
  <div class="page-type2__inner">
    <p class="page-type2__second-title">パスワード再設定</p>
    @include('error_card_list')
    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="email" value="{{ $email }}">
      <input type="hidden" name="token" value="{{ $token }}">
      <p class="page-type2__item-name">新しいパスワード（※半角英数8文字以上）</p>
      <input class="form-control" type="password" id="password" name="password">
      <p class="page-type2__item-name">新しいパスワード（再入力）</p>
      <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
      <div class="page-type2_btn-box">
        <a class="page-type2__cancel-btn" href="/">キャンセル</a>
        <input class="page-type2__enter-btn" type="submit" value="送信">
      </div>
    </form>
  </div>
</div>
@endsection