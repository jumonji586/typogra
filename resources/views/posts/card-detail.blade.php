<div class="post-detail">
    <div class="post-detail-img-box {{ $imgClass }} ">
        <img class="post-detail-img-box__img" src="{{ $post->image_path }}" alt="">
    </div>
    <div class="post-detail-data-box">
        <h2>
            <a class="post-detail-data-box__theme" href="">Theme: {{$post->theme->title}}</a>
        </h2>
        <p class="post-detail-data-box__description">{{$post->description}}</p>
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
        </div>
        
    </div>
</div>
