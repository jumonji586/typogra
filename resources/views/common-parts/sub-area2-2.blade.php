<aside class="sub-area2">
    <div class="sub-area-inner">
        @include('common-parts.search')
        <h2 class="sub-area-title mb10">Recommend</h2>
        @include('common-parts.sub-area-post',['Posts' => $recommendPosts ])
        {{-- <div class="sub-area-post-more-link-box">
            @if(isset($recommendPosts))
            <a href="" class="sub-area-post-more-link">MORE</a>
            @endif
        </div> --}}
    </div>
</aside>