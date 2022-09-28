<div class="sub-area-post-box">
    @foreach ($Posts as $Post)
        <div class="sub-area-post-item">
            <div class="sub-area-post-img-box">
                <img class="sub-area-post-img-box__img" src="{{ $Post->thumb_image_path }}" alt="">
                <a class="sub-area-post-img-box__link" href="{{ route('posts.show', ['display_id' => $Post->display_id]) }}"></a>
            </div>
        </div>
    @endforeach
</div>