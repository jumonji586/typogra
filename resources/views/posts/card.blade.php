<div class="post-item">
    <div class="post-item-img-box">
        @if ($loop->first)
        <picture>
            <source srcset="{{ $post->large_thumb_image_path.'.webp' }}" type="image/webp">
            <img class="post-item-img-box__img" src="{{ $post->large_thumb_image_path.'.jpg' }}">
        </picture>
        @else
        <picture>
            <source srcset="{{ $post->thumb_image_path.'.webp' }}" type="image/webp">
            <img class="post-item-img-box__img" src="{{ $post->thumb_image_path.'.jpg' }}">
        </picture>
        @endif
        <a class="post-item-img-box__link" href="{{ route('posts.show', ['display_id' => $post->display_id]) }}"></a>
    </div>
    <div class="post-item-data-box">
        <p class="post-item-data-box__text">
            <span class="post-item-data-box__date">
                {{ $post->created_at->format('Y/m/d') }}
            </span>
            <a class="post-item-data-box__user-name" href="{{ route("users.show", ["display_id" => $post->user->display_id]) }}">
                {{ mb_strimwidth($post->user->name, 0, 12, '…', 'UTF-8') }}
            </a>
        </p>
        <post-like :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))' :initial-count-likes='@json($post->count_likes)' :authorized='@json(Auth::check())' endpoint="{{ route('posts.like', ['post' => $post]) }}">
        </post-like>
    </div>
</div>
