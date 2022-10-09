@extends('app')

@section('title', '')

@section('content')

<div class="page-type2">
    @include('common-parts.header-logo')
    <div class="page-type2__inner mt30">
        <p class="page-type2__title">お問い合わせ</p>
        @include('common-parts.error_card_list')
        <form method="POST" action="{{ route('contact.complete') }}">
            @csrf
            <p class="page-type2__item-name">お名前</p>
            <input class="page-type2__input" type="text" id="name" name="contact_name" value="{{ old('contact_name') ??  ( Auth::user()->name ?? '') }}">
            <p class="page-type2__item-name">メールアドレス</p>
            <input class="page-type2__input" type="text" name="email" value="{{ old('email') ??  ( Auth::user()->email ?? '') }}">
            <p class="page-type2__item-name">メールアドレス（確認用）</p>
            <input class="page-type2__input" type="text" name="email_confirmatio    n" value="{{ old('email_confirmation') ??  ( Auth::user()->email ?? '') }}">
            <p class="page-type2__item-name">お問い合わせ内容</p>
            <textarea class="page-type2__textarea" name="contact_body" rows="5">{{ old('contact_body') ??  ( $targetInfo ?? '') }}</textarea>
            <div class="page-type2__item-name page-type2__rule-privacy-box">
                <input class="page-type2__checkbox" type="checkbox" name="privacy">
                <p><a href="" class="fw-b underline" target="_blank">プライバシーポリシー</a> に同意する</p>
            </div>
            <div class="page-type2_btn-box">
                <a class="page-type2__cancel-btn" href="/">キャンセル</a>
                <input class="page-type2__enter-btn" type="submit" value="送信">
            </div>
        </form>
    </div>
</div>



@endsection