@extends('app')

@section('title', '')


@section('content')

    <div class="page-type2">
        @include('common-parts.header-logo')
        <div class="page-type2__inner">
            <p class="page-type2__second-title">プロフ・登録内容変更</p>
            @include('common-parts.error_card_list')
            <form method="POST" action="{{ route('users.update',['user' => $user ])}}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <cropper prof-img-url="{{ $user->prof_image_path }}"></cropper>
                <p class="page-type2__item-name">ユーザー名（※全角12・半角24文字以内）</p>
                <input class="page-type2__input" type="text" id="name" name="name" value="{{ $user->name }}">
                <p class="page-type2__item-name">メールアドレス</p>
                <input class="page-type2__input" type="text" name="email" value="{{ $user->email }}">
                <p class="page-type2__item-name">自己紹介（※60文字以内）</p>
                <textarea class="page-type2__textarea" name="prof_text" rows="2">{{ $user->prof_text }}</textarea>
                @if (Auth::user()->password !== null)
                    <p class="page-type2__item-name">
                        <a href="{{ route('password.request') }}" class="underline">＞ パスワード再設定はこちら</a>
                    </p>
                @endif
                <div class="page-type2_btn-box">
                    <a class="page-type2__cancel-btn"
                        href="{{ route('users.show', ['display_id' => $user->display_id]) }}">キャンセル</a>
                    <input class="page-type2__enter-btn" type="submit" value="保存">
                </div>
            </form>
        </div>
    </div>
@endsection
