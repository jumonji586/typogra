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
                <span>「{{ $user->name }}」へのお知らせ</span>
            </div>
            @include('users.profile')

            <div class="mypage-list">
                <h2 class="theme-name mt40">通知</h2>
                @forelse($infolist as $infoitem)
                @if($infoitem->read_at == null)
                    <div class="mypage-list-item mypage-list-item--unread">
                @else
                    <div class="mypage-list-item">
                @endif
                      <a class="mypage-list-item__icon" href="{{ route('users.show', ['display_id' => $infoitem->data['from_user_display_id']])}}">
                        <img src="{{$infoitem->data['from_user_image']}}" onerror="this.src = '/img/prof-image-default/0.png';">
                      </a>
                      <div class="mypage-list-item__data-box">
                        <span class="info-time">{{$infoitem->created_at->format('Y/m/d H:i')}}</span>
                        <p class="mypage-list-item__text">
                        @if($infoitem->data['action'] === 'like')
                        {{$infoitem->data['from_user_name']}}さんがあなたの投稿「<a class="underline" href="{{route('posts.show', ['display_id' => $infoitem->data['target_post_display_id']])}}">{{$infoitem->data['target_post_title']}}</a>」をイイネしました。
                        
                        @elseif($infoitem->data['action'] === 'comment')
                        {{$infoitem->data['from_user_name']}}さんがあなたの投稿「<a class="underline" href="{{route('posts.show', ['display_id' => $infoitem->data['target_post_display_id']])}}">{{$infoitem->data['target_post_title']}}</a>」にコメントしました。
            
                        @elseif($infoitem->data['action'] === 'follow')
                        {{$infoitem->data['from_user_name']}}さんにフォローされました。
            
                        @elseif($infoitem->data['action'] === 'reply-a')
                        {{$infoitem->data['from_user_name']}}さんがあなたのコメント「<a class="underline" href="{{route('posts.show', ['display_id' => $infoitem->data['target_post_display_id']])}}">{{$infoitem->data['to_comment_text']}}</a>」に返信しました。
            
                        @elseif($infoitem->data['action'] === 'reply-b')
                        {{$infoitem->data['from_user_name']}}さんがあなたの返信「<a class="underline" href="{{route('posts.show', ['display_id' => $infoitem->data['target_post_display_id']])}}">{{$infoitem->data['to_comment_text']}}</a>」に返信しました。
                            
                        @endif
                        </p>
                      </div>
                    </div>               
                  @empty
                  <div class="info-item">まだお知らせはありません。</div>
                  @endforelse
                  {{-- {{ $infolist->links('vendor.pagination.original') }} --}}
            
                </div>
            
        </div>

        <aside class="sub-area2">
            <div class="sub-area-inner sub-area-inner--2">
                <h2 class="sub-area-title mb10">New posts</h2>
                @include('common-parts.sub-area-post',['Posts' => $newPosts ])
            </div>
        </aside>
    </main>

@endsection
