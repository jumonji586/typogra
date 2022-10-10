<div>
    <a href="/">TOP</a>
    <span> > </span>
    <span>「{{$post->theme->title}}」posted by {{$post->user->name}}</span>
</div>

<div class="post-detail">
    <div class="post-detail-img-box {{ $imgClass }} ">
        <img class="post-detail-img-box__img" src="{{ $post->image_path }}" alt="">
        <common-modal>
            <img class="post-detail-modal-img" src="{{ $post->image_path }}" alt="">
        </common-modal>
    </div>
    <div class="post-detail-data-box">
        <h2>
            <a class="post-detail-data-box__theme" href="">{{ $post->theme->title }}</a>
        </h2>
        <p class="post-detail-data-box__description">{{ $post->description }}</p>
        <div class="post-detail-data-box__inner">
            <a href="{{ route("users.show", ["display_id" => $post->user->display_id]) }}">
                <img class="post-detail-data-box__user-icon" src="{{ $post->user->prof_image_path }}" alt="">
            </a>
            <div class="post-detail-data-box__text">
                <p class="post-detail-data-box__date">
                    {{ $post->created_at->format('Y/m/d h:m') }}
                </p>
                <a class="post-detail-data-box__user-name" href="{{ route("users.show", ["display_id" => $post->user->display_id]) }}">
                    {{ mb_strimwidth($post->user->name, 0, 16, '…', 'UTF-8') }}
                </a>
            </div>
            <post-like :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))'
                :initial-count-likes='@json($post->count_likes)' :authorized='@json(Auth::check())'
                endpoint="{{ route('posts.like', ['post' => $post]) }}">
            </post-like>
            <post-edit-menu 
            endpoint-delete="{{ route('posts.destroy', ['post' => $post]) }}" 
            endpoint-recommend="{{ route('posts.recommendOn', ['post' => $post]) }}" 
            endpoint-violation="{{ route('posts.violation', ['post' => $post]) }}" 
            btntype="illust" :role="@if(Auth::check()) @json(Auth::user()->role === 'admin') @else @json(false) @endif" :userflag="@json(Auth::id() === $post->user_id)" :initial-recommendflag="@json($post->status === 'recommend')">
                @csrf
                @method('DELETE')
              </post-edit-menu>
        </div>
        <div class="post-detail-btn-box">
            <a href="" class="common-btn1 common-btn1--tweet"><img class="common-btn1__icon" src="/img/icon/icon-twitter-white.png" alt="">
                Tweetする</a>
            @if( Auth::id() !== $post->user->id )
            <follow-button :initial-is-followed-by='@json($post->user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['user' => $post->user]) }}">
            </follow-button>
            @endif
        </div>
        <a href="{{ route('posts.theme.{theme}', ['theme' => $post->theme_id ]) }}" class="post-detail-more-btn">
            <span class="post-detail-more-btn__inner">
                このテーマをもっと見る
            </span>
        </a>

    </div>
    
</div>
<comment :user-id="@json(Auth::id())" :post-id="{{$post->id}}" :authorized='@json(Auth::check())' :role="@if(Auth::check()) @json(Auth::user()->role === 'admin') @else @json(false) @endif" endpoint-violation="{{ route('posts.violation', ['post' => $post]) }}">
    @csrf
    @method('DELETE')
  </comment>
