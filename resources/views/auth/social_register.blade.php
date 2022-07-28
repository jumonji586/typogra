@extends('app')

@section('title', 'ユーザー登録')

@section('content')
<div class="page-type2">
  <div class="form-box">
    

    <form method="POST" action="{{ route('register.{provider}', ['provider' => $provider]) }}">
      <p class="form-title">ユーザー登録</p>
      @include('error_card_list')
      @csrf
      <p class="koumoku">※プロフィール画像はログイン後に変更できます。</p>
      <img class="form-prof-img" src="{{ $prof_image_path }}" alt="">
      <input type="hidden" name="token" value="{{ $token }}">
      <input type="hidden" name="tokenSecret" value="{{ $tokenSecret }}">
      <input type="hidden" name="provider_name" value="{{ $provider }}">
      
      <p class="koumoku">ユーザー名（※全角12・半角24文字以内）</p>
      <input type="text" id="name" name="name" value="{{ $name }}" >
      <p class="koumoku">メールアドレス</p>
      <input type="text" id="email" name="email" value="{{ $email }}" >
      <p><br>※入力した内容は当サイトのみに反映されます。各SNSアカウントの登録情報には影響しません。</p>
      <div class="koumoku rule-privacy-box">
        <input type="checkbox" name="rule-privacy"><p><a href="" class="fw-b underline" target="_blank">利用規約</a> および <a href="" class="fw-b underline" target="_blank">プライバシーポリシー</a> に同意する</p>
      </div>
      <div class="btn-box">
        <a href="/" class="cancel-btn">キャンセル</a>
        <input class="enter-btn" type="submit" value="登録">
      </div>
    </form>
  </div>
</div>
@endsection