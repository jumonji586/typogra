<aside class="sub-area1">
    <h2 class="side-area-title mb10">TYPOGRA</h2>
    <p class="sub-area1__text">
        TYPOGRAはタイポグラフィを投稿するためのサイトです。私たちはタイポグラフィの新たな可能性を模索しWEBの限界を越えるべく日夜努力しています。TYPOGRAはタイポグラフィを投稿するためのサイトです。私たちはタイポグラフィの新たな可能性を模索しWEBの限界を越えるべく日夜努力していく所存です。
    </p>
    <h2 class="side-area-title mt30 mb10">Recommend</h2>
    <div class="recommend-post-box">
        @foreach ($recommendPosts as $recommendPost)
            <div class="recommend-post-item">
                <div class="recommend-post-img-box">
                    <img class="recommend-post-img-box__img" src="{{ $recommendPost->thumb_image_path }}" alt="">
                    <a class="recommend-post-img-box__link" href="{{ route('posts.show', ['display_id' => $recommendPost->display_id]) }}"></a>
                </div>
            </div>
        @endforeach

    </div>
</aside>
