@extends('app')

@section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')

@section('content')
<main class="layout-box">
    @include('side-area1')
    <div class="center-area">
        @include('posts.card-detail')
    </div>
    @include('side-area2')
</main>
@endsection
