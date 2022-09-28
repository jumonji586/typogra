@extends('app')

@section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')

@section('content')
<main class="layout-box">
    <aside class="sub-area1">
        <div class="sub-area-inner">
            {{-- <h2 class="sub-area-title mb10">Recommend</h2>
            @include('common-parts.sub-area-post',['Posts' => $recommendPosts8 ]) --}}
            @include('common-parts.side-menu')
        </div>
    </aside> 
    <div class="center-area">
        @include('common-parts.header')
        @include('posts.card-detail')

        {{-- <div class="post-list-btn-box mt10 mb120">
            <a class="post-list-btn-box__btn" href="{{ route('posts.create.{theme_id}', ['theme_id' => 1]) }}">
                <p class="post-list-btn-box__main-text">POST</p>
                <p class="post-list-btn-box__sub-text">このテーマに投稿する</p></a>
            <a class="post-list-btn-box__btn" href="">
                <p class="post-list-btn-box__main-text">MORE</p>
                <p class="post-list-btn-box__sub-text">このテーマをもっと見る</p>
            </a>
        </div> --}}
        

        {{-- <h2 class="theme-name mt60">Reconmmend</h2>
        <div class="post-box2 mt10 mb50">
            @foreach ($recommendPosts4 as $post)
                @include('posts.card')
            @endforeach
        </div> --}}

    </div>
    <aside class="sub-area2">
        {{-- <div class="sub-area-inner sub-area-inner--2">
            <h2 class="sub-area-title mb5">User Ranking</h2>
            <div class="user-rank-box">
                @include('common-parts.user-ranking')
            </div>
        </div> --}}
        <div class="sub-area-inner sub-area-inner--2">
            <h2 class="sub-area-title mb10">New posts</h2>
            @include('common-parts.sub-area-post',['Posts' => $newPosts ])
        </div>
    </aside>
</main>
@endsection
