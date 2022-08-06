@extends('app')

@section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')

@section('content')
<main class="layout-box">
    @include('side-area1')
    <div class="center-area">
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
            <div class="post-list-btn-box mt40 mb120">
                <a class="post-list-btn-box__btn" href="{{ route('posts.create.{theme_id}', ['theme_id' => $key]) }}">
                    <p class="post-list-btn-box__main-text">POST</p>
                    <p class="post-list-btn-box__sub-text">このテーマに投稿する</p></a>
                <a class="post-list-btn-box__btn" href="">
                    <p class="post-list-btn-box__main-text">MORE</p>
                    <p class="post-list-btn-box__sub-text">このテーマをもっと見る</p>
                </a>
            </div>
        @endforeach
    </div>
    @include('side-area2')
</main>

@endsection
