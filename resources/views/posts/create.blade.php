@extends('app')

@section('title', 'タイポグラフィ投稿 | TYPOGRA タイポグラ | 作字・タイポグラフィ投稿サイト')


@section('content')
<div class="page-type2">
    @include('common-parts.header-logo')
    <div class="page-type2__inner mt30">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <p class="page-type2__title">タイポグラフィ投稿</p>
            @include('common-parts.error_card_list')
            <label for="post-img-input" class="post-img-label">
                <img src="/img/icon/icon-camera.png" alt="">
            </label>
            <img id="post-img-preview" class="wid100" alt="">
            <input id="post-img-input" type="file" name="image" accept="image/*" onchange="previewImage(this);">
            <p class="page-type2__item-name">テーマ</p>
            <select class="page-type2__select" name="theme_id">
                <option value=""
                @if(!$theme_id) selected @endif
                >選択してください</option>
                @foreach ($themes as $theme)
                <option class="page-type2__option" value="{{ $theme->id }}"
                @if($theme_id === $theme->id) selected @endif
                >{{ $theme->title }}</option>
                @endforeach
            </select>
            <p class="page-type2__item-name">作品の説明（※80文字以内）</p>
            <input class="page-type2__input" type="text" name="description" value="{{ $post->description ?? old('description') }}" placeholder="未入力可">
            <br><br>
            <p>※<a class="underline" href="{{ route('rule') }}" target="_blank">利用規約</a>に違反する投稿は削除対象となります。</p>
            <div class="page-type2-btn-box">
                <a href="/" class="page-type2-btn-box__btn">キャンセル</a>
                <input type="submit" class="page-type2-btn-box__btn" value="投稿する">
            </div>
        </form>
    </div>
</div>
@endsection