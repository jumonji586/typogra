@extends('app')

@section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')

@section('content')
    <main class="layout-box">
        @include('common-parts.sub-area1-1')
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
        @include('common-parts.sub-area2-1')
    </main>

@endsection
