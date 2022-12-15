@extends('app')

@section('title', 'ゲストユーザー | TYPOGRA タイポグラ | 作字・タイポグラフィ投稿サイト')

@section('content')
    <div class="page-type2">
        @include('common-parts.header-logo')
        <form class="page-type2__inner mt30" method="POST" action="{{ route('register') }}">
            @csrf
            @php
                $guestValue = dechex(str_pad(random_int(0, 999999999), 9, 0, STR_PAD_LEFT));
            @endphp
            <input class="disp-none" type="text" name="name" value="{{ 'guest' . $guestValue }}">
            <input class="disp-none" type="text" name="email" value="{{ 'guest' . $guestValue . '@' . 'co.jp' }}">
            <input class="disp-none" type="password" value="{{ 'guest' . $guestValue }}" name="password">
            <input class="disp-none" type="password" value="{{ 'guest' . $guestValue }}" name="password_confirmation">
            <input class="disp-none" type="checkbox" name="rule-privacy" checked>
            <p class="guest-area__lead fw-b">OKボタンを押すと、ゲストアカウントが新規作成されます。</p>
            <p class="mt5">
                ※当サイトは現在まだ一般公開していません（検索避けをしてあります）ので、投稿やコメントなど自由にご利用ください。</p>
            <p class="mt5"> ※ゲストアカウント及びゲストアカウントで投稿いただいた画像・コメント等は、後日全て削除させて頂きます。予めご了承をお願いします。</p>
            <div class="guest-area__list-box mt20">
                <p class="guest-area__list-title">主な機能</p>
                <ul class="guest-area__list-box-inner mt20">
                    <li>・画像投稿・削除</li>
                    <li>・コメント投稿・返信・削除</li>
                    <li>・いいね</li>
                    <li>・フォロー</li>
                    <li>・プロフィール編集</li>
                    <li>・通知</li>
                    <li>・違反申告</li>
                    <li>・お問い合わせ</li>
                    <li>・検索</li>
                    <li>・SNS認証</li>
                    <li>・ユーザーランキング</li>
                </ul>
            </div>
            <div class="page-type2-btn-box mt30">
                <input class="page-type2-btn-box__btn m0auto" type="submit" value="OK">
            </div>
        </form>
    </div>
@endsection
