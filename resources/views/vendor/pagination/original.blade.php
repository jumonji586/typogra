@if ($paginator->hasPages())
    <?php $pageNum = 5; ?>
    <div class="pagination">
        {{-- First Page View --}}
        <a class="pagination__link {{ $paginator->onFirstPage() ? ' pagination__link--disabled' : '' }}"
            href="{{ $paginator->url(1) }}">&laquo;</a>
        {{-- Previous Page Link --}}

        <a class="pagination__link {{ $paginator->onFirstPage() ? ' pagination__link--disabled' : '' }}"
            href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a>

        {{-- Pagination Elemnts --}}
        {{-- Array Of Links --}}
        {{-- 定数よりもページ数が多い時 --}}
        @if ($paginator->lastPage() > $pageNum)

            {{-- 現在ページが表示するリンクの中心位置よりも左の時 --}}
            @if ($paginator->currentPage() <= floor($pageNum / 2))
                <?php $start_page = 1; //最初のページ ?>
                <?php $end_page = $pageNum; ?> {{-- 現在ページが表示するリンクの中心位置よりも右の時 --}}
            @elseif ($paginator->currentPage() > $paginator->lastPage() - floor($pageNum / 2))
                <?php $start_page = $paginator->lastPage() - ($pageNum - 1); ?>
                <?php $end_page = $paginator->lastPage(); ?>

                {{-- 現在ページが表示するリンクの中心位置の時 --}}
            @else
                <?php $start_page = $paginator->currentPage() - floor(($pageNum % 2 == 0 ? $pageNum - 1 : $pageNum) / 2); ?>
                <?php $end_page = $paginator->currentPage() + floor($pageNum / 2); ?>
            @endif

            {{-- 定数よりもページ数が少ない時 --}}
        @else
            <?php $start_page = 1; ?>
            <?php $end_page = $paginator->lastPage(); ?>
        @endif

        {{-- 処理部分 --}}
        @for ($i = $start_page; $i <= $end_page; $i++)
            @if ($i == $paginator->currentPage())
                <span class="pagination__link pagination__link--active">{{ $i }}</span>
            @else
                <a class="pagination__link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            @endif
        @endfor
        {{-- Next Page Link --}}
        <a class="pagination__link {{ $paginator->currentPage() == $paginator->lastPage() ? ' pagination__link--disabled' : '' }}"
            href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a>

        {{-- Last Page Link --}}
        <a class="pagination__link {{ $paginator->currentPage() == $paginator->lastPage() ? ' pagination__link--disabled' : '' }}"
            href="{{ $paginator->url($paginator->lastPage()) }}">&raquo;</a>
    </div>
@endif
