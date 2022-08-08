<div class="post-detail">
    <div class="post-detail-img-box {{ $imgClass }} ">
        <img class="post-detail-img-box__img" src="{{ $post->image_path }}" alt="">
        <common-modal>
            <img src="{{ $post->image_path }}" alt="">
        </common-modal>
    </div>
    <div class="post-detail-data-box">
        <h2>
            <a class="post-detail-data-box__theme" href="">Theme: {{ $post->theme->title }}</a>
        </h2>
        <p class="post-detail-data-box__description">{{ $post->description }}</p>
        <div class="post-detail-data-box__inner">
            <a href="">
                <img class="post-detail-data-box__user-icon" src="{{ $post->user->prof_image_path }}" alt="">
            </a>
            <div class="post-detail-data-box__text">
                <p class="post-detail-data-box__date">
                    {{ $post->created_at->format('Y/m/d h:m') }}
                </p>
                <a class="post-detail-data-box__user-name" href="">
                    {{ $post->user->name }}
                </a>
            </div>
            <post-like :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))'
                :initial-count-likes='@json($post->count_likes)' :authorized='@json(Auth::check())'
                endpoint="{{ route('posts.like', ['post' => $post]) }}">
            </post-like>
            <post-edit-menu 
            endpoint-delete="{{ route('posts.destroy', ['post' => $post]) }}" 
            endpoint-recommend="{{ route('posts.recommendOn', ['post' => $post]) }}" 
            endpoint-violation="" 
            btntype="illust" :role="@if(Auth::check()) @json(Auth::user()->role === 'admin') @else @json(false) @endif" :userflag="@json(Auth::id() === $post->user_id)" :initial-recommendflag="@json($post->status === 'recommend')">
                @csrf
                @method('DELETE')
              </post-edit-menu>
        </div>

    </div>
</div>
