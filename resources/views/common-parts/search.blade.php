<div class="search-box">
    <form class="search-box__form" action="{{ route('posts.theme.{theme}',['theme' => 'search']) }}" method="GET">
        <input class="search-box__input" autocomplete="off" list="theme-list" type="text" name="keyword" placeholder="テーマ検索">
        <label class="search-box__label" for="search-submit"><img src="/img/icon/icon-search-gray.png"></label>
        <button class="search-box__button" type="submit" id="search-submit"></button>
        <datalist id="theme-list">
            @foreach($themeList as $theme)
            <option value="{{ $theme->title }}"></option>
            @endforeach
        </datalist>
    </form>
</div>
