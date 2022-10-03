<div class="profile">
    <div class="profile__inner">
        <div class="profile-data-box">
            <a href="">
                <img class="profile-user-icon" src="{{ $user->prof_image_path }}" alt="">
            </a>
            <p class="profile-user-name">{{$user->name}}</p>
            <p class="profile-user-text">{{$user->prof_text}}
            </p>
            <div class="profile-follow-number-box">
                <a class="profile-follow-number" href="{{ route('users.followings', ['display_id' => $user->display_id]) }}">
                    {{ $user->count_followings }} フォロー
                </a>
                <a class="profile-follow-number" href="{{ route('users.followers', ['display_id' => $user->display_id]) }}">
                    {{ $user->count_followers }} フォロワー
                </a>
            </div>
            <div class="profile-btn-box">
                @if( Auth::id() !== $user->id )
                {{-- <a class="profile-btn-box__btn" href="">フォロー済</a> --}}
                <follow-button :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['user' => $user]) }}">
                </follow-button>
                @endif
                @if( Auth::id() === $user->id )
                <a class="common-btn1" href="{{ route('users.edit') }}">プロフ・設定変更</a>
                @endif
            </div>
        </div>
        <div class="profile-img-box">
            <img class="profile-img-box__img" src="/img/mypage-bg.jpg" alt="">
        </div>
    </div>
</div>