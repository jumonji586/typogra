<div class="sub-area-post-box">
    @foreach ($Posts as $Post)
        <div class="sub-area-post-item">
            <div class="sub-area-post-img-box">
                <picture>
                    <source srcset="{{ $Post->thumb_image_path.'.webp' }}" type="image/webp">
                    <img class="sub-area-post-img-box__img" src="{{ $Post->thumb_image_path.'.jpg' }}">
                </picture>
                <a class="sub-area-post-img-box__link" href="{{ route('posts.show', ['display_id' => $Post->display_id]) }}"></a>
            </div>
        </div>
    @endforeach
</div>