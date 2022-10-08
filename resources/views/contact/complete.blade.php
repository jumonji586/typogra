@extends('app')

@section('title', '')

@section('content')

<div class="page-type2">
    @include('common-parts.header-logo')
    <div class="page-type2__inner mt30">
        <p class="page-type2__second-title">お問い合わせ</p>
        <br><br>
        <p>
            送信が完了しました。<br>ご入力頂いたメールアドレスに受付完了メールを送信しましたので、ご確認をお願いします。
        </p>
        <div class="page-type2_btn-box"><a href="/" class="page-type2__enter-btn wid100">TOPページへ戻る</a></div>
    </div>
</div>

@endsection