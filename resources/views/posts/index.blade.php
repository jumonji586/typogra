@extends('app')

@section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')

@section('content')
    <main class="layout-box">
        @include('common-parts.sub-area1-1')
        <div class="center-area">
            @include('common-parts.header')
            @foreach ($allPosts as $key => $posts)
                <h2 class="theme-name">─ {{ $themes[$key]->title }}</h2>

                <div class="post-box1">
                    @foreach ($posts as $post)
                        @include('posts.card')
                    @endforeach

                    @if (count($posts) > 0)
                        @for ($i = count($posts); $i < 5; $i++)
                            @include('posts.card-empty')
                        @endfor
                    @endif
                </div>
                @if(count($posts) === 0)
                    <p class="common-empty-message">まだ投稿はありません。</p>
                @endif
                <div class="post-list-btn-box mt30 mb70">
                    <a class="post-list-btn-box__btn" href="{{ route('posts.create.{theme_id}', ['theme_id' => $key]) }}">
                        <div class="post-list-btn-box__btn-inner">
                            <p class="post-list-btn-box__main-text">POST</p>
                            <p class="post-list-btn-box__sub-text">このテーマに投稿する</p>
                        </div>
                    </a>
                    <a class="post-list-btn-box__btn" href="{{ route('posts.theme.{theme}', ['theme' => $key]) }}">
                        <div class="post-list-btn-box__btn-inner">
                            <p class="post-list-btn-box__main-text">MORE</p>
                            <p class="post-list-btn-box__sub-text">このテーマをもっと見る</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        @include('common-parts.sub-area2-1')
    </main>

@endsection
