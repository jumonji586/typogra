
<div class="post-item">
    <a class="post-item__img-box">
        <img class="post-item__img" src="{{ $post->thumb_image_path }}" alt="{{ $post->title }}">
    </a>
    <div class="post-item__data-box">
        <p class="post-item__text">
            <span class="post-item__date">
                {{ $post->created_at->format('Y/m/d') }}
            </span>
            <a class="post-item__user-name" href="">
                by {{ mb_strimwidth( $post->user->name, 0, 12, '…', 'UTF-8' ) }}
            </a>
        </p>
        <div>
            <img src="/img/icon/icon-heart-red.png" alt="">
        </div>
    </div>
</div>
