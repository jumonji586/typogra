<aside class="sub-area2">
    <div class="sub-area-inner">
        @include('common-parts.search')
        <h2 class="sub-area-title mb10">New posts</h2>
        @include('common-parts.sub-area-post',['Posts' => $newPosts ])
    </div>
</aside>