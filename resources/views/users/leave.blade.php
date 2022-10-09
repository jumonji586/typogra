@extends('app')

@section('title', 'アカウント削除')


@section('content')
<div class="page-type2">
    @include('common-parts.header-logo')
    <div class="page-type2__inner mt30">
        <form method="POST" action="{{ route('users.destroy',['user' => $user]) }}" enctype="multipart/form-data" onsubmit="return beforeSubmit(this)">
            @method('DELETE')
            @csrf
            <p class="page-type2__title">アカウント削除</p>
            @include('common-parts.error_card_list')
            <img class="page-type2__user-icon" src="{{$user->prof_image_path}}" alt="">
            <p class="tx-c">{{ $user->name }}</p>
            <p class="fw-b page-type2__item-name mt30 mt20s">アカウント削除に関する注意事項</p>
            <p class="page-type2__text-frame mt5">アカウントを削除した場合、投稿した画像やコメント、プロフィールなど、アカウントに紐づくデータも全て削除され、元に戻すことはできません。</p>
            <div class="page-type2__item-name page-type2__rule-privacy-box">
                <input class="page-type2__checkbox" type="checkbox" name="delete_accept">
                <p>上記「アカウント削除に関する注意事項」を了承する</p>
            </div>
            <div class="page-type2_btn-box">
                <a class="page-type2__cancel-btn" href="/">キャンセル</a>
                <input class="page-type2__enter-btn" type="submit" value="削除する">
            </div>
        </form>
    </div>
</div>
@endsection