@extends('app')

@section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')

@section('content')
    <main class="layout-box">
        @include('common-parts.sub-area1-1')
        <div class="center-area">
            @include('common-parts.header')
            <div>
                <a href="/">TOP</a>
                <span> > </span>
                <span>「{{$user->name}}」のマイページ</span>
            </div>
            @include('users.profile')
            <h2 class="theme-name mt40">投稿一覧</h2>
            <div class="post-box2 mt10 mb50">
                @forelse($userPosts as $post)
                @include('posts.card')
                @empty
                <p class="common-empty-message">まだ投稿はありません。</p>
                @endforelse
            </div>

        </div>
        @include('common-parts.sub-area2-1')
    </main>

@endsection
