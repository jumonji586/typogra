@extends('app')

@if ($followPageFlag === 'followers')
    @section('フォロワー', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')
@elseif($followPageFlag === 'followings')
    @section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')
@endif


@section('content')
    <main class="layout-box">
        @include('common-parts.sub-area1-1')
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
                <h2 class="theme-name mt30">フォロワー</h2>
            @elseif($followPageFlag === 'followings')
                <h2 class="theme-name mt30">フォロー</h2>
            @endif
                @forelse($followList as $person)
                    @include('users.follow-card')
                @empty
                    <p class="common-empty-message">該当するユーザーが存在しません。</p>
                @endforelse
            </div>
            {{ $followList->links('vendor.pagination.original') }}
        </div>
        

        @include('common-parts.sub-area2-1')
    </main>

@endsection
