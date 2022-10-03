<div class="mypage-list-item">
        <a class="mypage-list-item__icon" href="{{ route('users.show', ['display_id' => $person->display_id]) }}">
            <img src="{{ $person->prof_image_path }}" alt="">
        </a>
        <div class="mypage-list-item__data-box">
        <a class="mypage-list-item__name"
            href="{{ route('users.show', ['display_id' => $person->display_id]) }}">{{ $person->name }}</a>
        @if (isset($person->prof_text))
            <p class="mypage-list-item__text">{{ $person->prof_text }}</p>
        @endif
        </div>
        @if (Auth::id() !== $person->id)
            <follow-button :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
                :authorized='@json(Auth::check())'
                endpoint="{{ route('users.follow', ['user' => $person->id]) }}">
            </follow-button>
        @endif
</div>
