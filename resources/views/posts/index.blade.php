@extends('app')

@section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')

@section('content')

@foreach($allPosts as $key => $posts)
<p class="mt50">{{$themes[$key]->title}}</p>
<div class="post-box1">
    @foreach($posts as $post)
        @include('posts.card')
    @endforeach

    @if(count($posts) > 0)
        @for($i = count($posts); $i < 4; $i++) 
            @include('posts.card-empty') 
        @endfor 
    @endif
         </div>
         <a href="{{ route('posts.create.{theme_id}', ['theme_id' => $key]) }}">投稿する</a>

</div>

@endforeach
@endsection