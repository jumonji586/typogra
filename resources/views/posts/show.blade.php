@extends('app')

@section('title', '「'.$post->theme->title.'」posted by '.$post->user->name.' | TYPOGRA タイポグラ | 作字・タイポグラフィ投稿サイト')

@section('content')
<main class="layout-box">
    @include('common-parts.sub-area1-1')
    <div class="center-area">
        @include('common-parts.header')
        @include('posts.card-detail')
    </div>
    @include('common-parts.sub-area2-2')
</main>
@endsection
