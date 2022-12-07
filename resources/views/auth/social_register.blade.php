@extends('app')

@section('title', '新規登録 | TYPOGRA タイポグラ | 作字・タイポグラフィ投稿サイト')

@section('content')
<div class="page-type2">
  @include('common-parts.header-logo')
  <div class="page-type2__inner mt30">
    <form method="POST" action="{{ route('register.{provider}', ['provider' => $provider]) }}">
      <p class="page-type2__title">ユーザー登録</p>
      @include('common-parts.error_card_list')
      @csrf
      <p class="page-type2__item-name">※プロフィール画像はログイン後に変更できます。</p>
      <img class="page-type2__user-icon" src="{{ $prof_image_path }}" alt="">
      <input type="hidden" name="token" value="{{ $token }}">
      <input type="hidden" name="provider_name" value="{{ $provider }}">

      <p class="page-type2__item-name">ユーザー名（※全角12・半角24文字以内）</p>
      <input class="page-type2__input" type="text" id="name" name="name" value="{{ $name }}">
      <p class="page-type2__item-name">メールアドレス</p>
      <input class="page-type2__input" type="text" id="email" name="email" value="{{ $email }}">
      <p><br>※入力した内容は当サイトのみに反映されます。各SNSアカウントの登録情報には影響しません。</p>
      <div class="page-type2__item-name page-type2__rule-privacy-box">
        <input class="page-type2__checkbox" type="checkbox" name="rule-privacy">
        <p><a href="{{ route('rule') }}" class="fw-b underline" target="_blank">利用規約</a> および <a href="{{ route('privacy-policy') }}" class="fw-b underline" target="_blank">プライバシーポリシー</a> に同意する</p>
      </div>
      <div class="page-type2-btn-box">
        <a href="/" class="page-type2-btn-box__btn">キャンセル</a>
        <input class="page-type2-btn-box__btn" type="submit" value="登録">
      </div>
    </form>
  </div>
</div>
@endsection