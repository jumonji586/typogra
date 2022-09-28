@extends('app')

@section('title', 'ユーザー登録')

@section('content')
    <div class="page-type2">
        <h2 class="page-type2__title">REGISTER</h2>
        <div class="page-type2__inner mt30">
            <p class="page-type2__second-title">SNSアカウントで登録</p>
            <a class="sns-btn" href="{{ route('login.{provider}', ['provider' => 'google']) }}" class=""><img
                    src="/img/icon/icon-google.png" alt="">Googleで登録
            </a>
            <a class="sns-btn sns-btn2" href="{{ route('login.{provider}', ['provider' => 'twitter']) }}"><img
                    src="/img/icon/icon-twitter.png" alt="">Twitterで登録
            </a>
            <p class="page-type2__second-title">メールアドレスで登録</p>
            @include('common-parts.error_card_list')
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <p class="page-type2__item-name">ユーザー名（※全角12・半角24文字以内）</p>
                <input class="page-type2__input" type="text" id="name" name="name" value="{{ old('name') }}">
                <p class="page-type2__item-name">メールアドレス</p>
                <input class="page-type2__input" type="text" id="email" name="email" value="{{ old('email') }}">
                <p class="page-type2__item-name">パスワード（※半角英数8文字以上）</p>
                <input class="page-type2__input" type="password" id="password" name="password">
                <p class="page-type2__item-name">パスワード再入力</p>
                <input class="page-type2__input" type="password" id="password_confirmation" name="password_confirmation">
                <div class="page-type2__item-name rule-privacy-box">
                    <input class="page-type2__checkbox" type="checkbox" name="rule-privacy">
                    <p><a href="" class="fw-b underline" target="_blank">利用規約</a> および <a href=""
                            class="fw-b underline" target="_blank">プライバシーポリシー</a> に同意する</p>
                </div>
                <div class="page-type2_btn-box">
                    <a class="page-type2__cancel-btn" href="/">キャンセル</a>
                    <input class="page-type2__enter-btn" type="submit" value="登録">
                </div>
            </form>
        </div>
    </div>
@endsection
