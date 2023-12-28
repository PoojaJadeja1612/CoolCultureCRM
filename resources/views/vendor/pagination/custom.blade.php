<style scoped>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .pagination,
    .page-numbers {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
    }

    .btn-nav,
    .btn-page {
        border-radius: 50%;
        background-color: #fff;
        cursor: pointer;
        color: #000;
    }

    .btn-page {
        display: flex;
        justify-content: center;
        line-height: 1.8;
    }

    .btn-nav {
        padding: 8px;
    }

    .btn-nav {
        width: 33px;
        height: 33px;
        color: #000000;
    }

    .btn-nav:hover,
    .btn-page:hover {
        background-color: #222222;
        color: #fff;
    }

    .btn-page {
        border: none;
        width: 30px;
        height: 30px;
        font-size: 16px;
    }

    .btn-selected {
        background-color: #000000;
        color: #fff;
    }

    .left-icon {
        vertical-align: top;
    }

    .right-icon {
        vertical-align: top;
    }
</style>

<div class="pagination">
    <a href="{{ $paginator->previousPageUrl() }}"
        class="btn-nav left-btn{{ $paginator->onFirstPage() ? ' disabled' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="left-icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
    </a>
    <div class="page-numbers">
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="dots">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <a href="{{ $url }}"
                        class="btn-page{{ $page == $paginator->currentPage() ? ' btn-selected' : '' }}">{{ $page }}</a>
                @endforeach
            @endif
        @endforeach
    </div>
    <a href="{{ $paginator->nextPageUrl() }}"
        class="btn-nav right-btn{{ $paginator->hasMorePages() ? '' : ' disabled' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="right-icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
        </svg>
    </a>
</div>
