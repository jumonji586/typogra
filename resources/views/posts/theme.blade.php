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
            <h2 class="theme-name">{{ $firstTitle }}</h2>
            <div class="post-box2 mt10">
            @forelse($posts as $post)
                @include('posts.card')
                @empty
                <p class="common-empty-message mb20">まだ投稿はありません。</p>
            @endforelse
            @if (count($posts) > 0 && count($posts) < 4)
                        @for ($i = count($posts); $i < 4; $i++)
                            @include('posts.card-empty')
                        @endfor
                    @endif
            </div>
            @if( $subRecommendPosts !== null && count($subRecommendPosts) !== 0 )
                <h2 class="theme-name mt20">{{ $secondTitle }}</h2>
                <div class="post-box2 mt10 mb50">
                @foreach($subRecommendPosts as $post)
                    @include('posts.card')
                @endforeach
                </div>
            @endif
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
