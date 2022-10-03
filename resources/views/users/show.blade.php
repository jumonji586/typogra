@extends('app')

@section('title', 'TYPOGRA タイポグラ | 作字・タイポグラフィ専用サイト')

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
                <span>「{{$user->name}}」のマイページ</span>
            </div>
            <div class="profile">
                <div class="profile__inner">
                    <div class="profile-data-box">
                        <a href="">
                            <img class="profile-user-icon" src="{{ $user->prof_image_path }}" alt="">
                        </a>
                        <p class="profile-user-name">{{$user->name}}</p>
                        <p class="profile-user-text">{{$user->prof_text}}
                            {{-- 自己紹介です。自己紹介です。自己紹介です。自己紹介です。自己紹介です。自己紹介です。自己紹介です。自己紹介です。自己紹介です。 --}}
                        </p>
                        <div class="profile-follow-number-box">
                            <a href="" class="profile-follow-number">フォロワー 0</a>
                            <a href="" class="profile-follow-number">フォロー 0</a>
                        </div>
                        <div class="profile-btn-box">
                            @if( Auth::id() !== $user->id )
                            {{-- <a class="profile-btn-box__btn" href="">フォロー済</a> --}}
                            <follow-button :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['user' => $user]) }}">
                            </follow-button>
                            @endif
                            @if( Auth::id() === $user->id )
                            <a class="common-btn1" href="{{ route('users.edit') }}">プロフ・設定変更</a>
                            @endif
                        </div>
                    </div>
                    <div class="profile-img-box">
                        <img class="profile-img-box__img" src="/img/mypage-bg.jpg" alt="">
                    </div>
                </div>
            </div>
            <h2 class="theme-name mt40">投稿一覧</h2>
            <div class="post-box2 mt10 mb50">
                @forelse($userPosts as $post)
                @include('posts.card')
                @empty
                <p class="post-empty-message">まだ投稿はありません。</p>
                @endforelse
            </div>

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
