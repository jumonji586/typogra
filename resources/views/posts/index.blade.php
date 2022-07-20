@extends('app')

@section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')

@section('content')

@foreach($allPosts as $key => $posts)
    <p>{{$key}}</p>
    @foreach($posts as $post)
        @include('posts.card')
    @endforeach
@endforeach
@endsection