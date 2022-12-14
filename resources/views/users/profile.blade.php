<div class="profile">
    <div class="profile__inner">
        <div class="profile-data-box">
            <div class="profile-user-icon">
                <img  src="{{ $user->prof_image_path }}" alt="">
                <common-modal>
                    <img class="profile-user-icon__modal-img" src="{{ $user->prof_image_path }}" alt="">
                </common-modal>
            </div>
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
                <follow-button :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['user' => $user]) }}">
                </follow-button>
                @endif
                @auth
                    @if( Auth::id() === $user->id )
                    <a class="common-btn1" href="{{ route('users.edit') }}">プロフ・設定変更</a>
                    @endif
                    @if( Auth::user()->role === "admin" && Auth::id() !== $user->id)
                    <a class="common-btn1" href="{{ route('users.leave', ['display_id' => $user->display_id]) }}">管理者権限でID削除</a>
                    @endif
                @endauth
            </div>
        </div>
        <div class="profile-img-box">
            <img class="profile-img-box__img" src="/img/mypage-bg.jpg" alt="">
        </div>
    </div>
</div>