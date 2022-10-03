@extends('app')

@section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')

@section('content')
    <main class="layout-box">
        <aside class="sub-area1">
            <div class="sub-area-inner">
                @include('common-parts.side-menu')
            </div>
        </aside>
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
        <aside class="sub-area2">
            <div class="sub-area-inner sub-area-inner--2">
                <h2 class="sub-area-title mb5">User Ranking</h2>
                <div class="user-rank-box">
                    @include('common-parts.user-ranking')
                </div>
            </div>
        </aside>
    </main>

@endsection
