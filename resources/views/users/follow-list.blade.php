@extends('app')

@if ($followPageFlag === 'followers')
    @section('フォロワー', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')
@elseif($followPageFlag === 'followings')
    @section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')
@endif


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
                @if ($followPageFlag === 'followers')
                    <span>「{{ $user->name }}」のフォロワー</span>
                @elseif($followPageFlag === 'followings')
                    <span>「{{ $user->name }}」がフォロー中のユーザー</span>
                @endif
            </div>
            @include('users.profile')

            
            <div class="mypage-list">
                @if ($followPageFlag === 'followers')
                <h2 class="theme-name mt40">フォロワー</h2>
            @elseif($followPageFlag === 'followings')
                <h2 class="theme-name mt40">フォロー</h2>
            @endif
                @forelse($followList as $person)
                    @include('users.follow-card')
                @empty
                    <p class="common-empty-message">該当するユーザーが存在しません。</p>
                @endforelse
            </div>
        </div>
        {{-- {{ $followings->links('vendor.pagination.original') }} --}}

        <aside class="sub-area2">
            <div class="sub-area-inner sub-area-inner--2">
                <h2 class="sub-area-title mb10">New posts</h2>
                @include('common-parts.sub-area-post',['Posts' => $newPosts ])
            </div>
        </aside>
    </main>

@endsection
