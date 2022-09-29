@extends('app')

@section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')

@section('content')
    <main class="layout-box">
        <aside class="sub-area1">
            <div class="sub-area-inner">
                @include('common-parts.side-menu')
                {{-- <h2 class="sub-area-title mb10">TYPOGRA</h2>
                <p class="sub-area1__text">
                    TYPOGRAはタイポグラフィを投稿するためのサイトです。私たちはタイポグラフィの新たな可能性を模索しWEBの限界を越えるべく日夜努力しています。TYPOGRAはタイポグラフィを投稿するためのサイトです。私たちはタイポグラフィの新たな可能性を模索しWEBの限界を越えるべく日夜努力していく所存です。
                </p>
                <h2 class="sub-area-title mt30 mb10">Recommend</h2>
                @include('common-parts.sub-area-post', ['Posts' => $recommendPosts4]) --}}
            </div>
        </aside>
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
                    <p class="post-empty-message">まだ投稿はありません。</p>
                @endif
                <div class="post-list-btn-box mt30 mb70">
                    <a class="post-list-btn-box__btn" href="{{ route('posts.create.{theme_id}', ['theme_id' => $key]) }}">
                        <div class="post-list-btn-box__btn-inner">
                            <p class="post-list-btn-box__main-text">POST</p>
                            <p class="post-list-btn-box__sub-text">このテーマに投稿する</p>
                        </div>
                    </a>
                    <a class="post-list-btn-box__btn" href="">
                        <div class="post-list-btn-box__btn-inner">
                            <p class="post-list-btn-box__main-text">MORE</p>
                            <p class="post-list-btn-box__sub-text">このテーマをもっと見る</p>
                        </div>
                    </a>
                </div>
            @endforeach
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
