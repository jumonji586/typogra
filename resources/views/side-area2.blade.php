<aside class="sub-area2">
    <div class="user-rank-box">
        <h2 class="user-rank-title">User Ranking</h2>
        @foreach($rankUsers as $key => $rankUser)
        <a class="user-rank-item">
            <span class="user-rank-num">{{ $key + 1 }}</span>
            <div>
                <img class="user-rank-icon icon" src="{{ $rankUser->prof_image_path }}" alt="">
            </div>
            <p class="user-rank-name">{{ mb_strimwidth($rankUser->name, 0, 12, '…', 'UTF-8') }}</p>
            <p class="user-rank-point">{{ $rankUser->likes_of_user_count }} pt</p>
        <a/>
        @endforeach
    </div>
</aside>