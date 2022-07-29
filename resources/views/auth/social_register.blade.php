@extends('app')

@section('title', 'ユーザー登録')

@section('content')
<div class="page-type2">
  <h2 class="page-type2__title">REGISTER</h2>
  <div class="page-type2__inner">
    <form method="POST" action="{{ route('register.{provider}', ['provider' => $provider]) }}">
      <p class="page-type2__second-title">ユーザー登録</p>
      @include('error_card_list')
      @csrf
      <p class="page-type2__item-name">※プロフィール画像はログイン後に変更できます。</p>
      <img class="form-prof-img" src="{{ $prof_image_path }}" alt="">
      <input type="hidden" name="token" value="{{ $token }}">
      <input type="hidden" name="tokenSecret" value="{{ $tokenSecret }}">
      <input type="hidden" name="provider_name" value="{{ $provider }}">

      <p class="page-type2__item-name">ユーザー名（※全角12・半角24文字以内）</p>
      <input class="page-type2__input" type="text" id="name" name="name" value="{{ $name }}">
      <p class="page-type2__item-name">メールアドレス</p>
      <input class="page-type2__input" type="text" id="email" name="email" value="{{ $email }}">
      <p><br>※入力した内容は当サイトのみに反映されます。各SNSアカウントの登録情報には影響しません。</p>
      <div class="page-type2__item-name rule-privacy-box">
        <input type="checkbox" name="rule-privacy">
        <p><a href="" class="fw-b underline" target="_blank">利用規約</a> および <a href="" class="fw-b underline" target="_blank">プライバシーポリシー</a> に同意する</p>
      </div>
      <div class="page-type2_btn-box">
        <a href="/" class="page-type2__cancel-btn">キャンセル</a>
        <input class="page-type2__enter-btn" type="submit" value="登録">
      </div>
    </form>
  </div>
</div>
@endsection