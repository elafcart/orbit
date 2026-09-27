@if ($paginator->hasPages())
    <nav class="w-100">
        <ul class="pagination gap-2 justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="page-item me-auto disabled">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                            <path d="M3.19036 5.64852H13.3333V7.31518H3.19036L7.66033 11.7851L6.48183 12.9636L0 6.48185L6.48183 0L7.66033 1.17851L3.19036 5.64852Z" fill="currentColor" />
                        </svg>
                        <span class="text-uppercase">{{ __('Prev') }}</span>
                    </span>
                </li>
            @else
                @php
                    // When the previous page is the first page, link to the clean base URL (no ?page=1)
                    $previousUrl = $paginator->previousPageUrl();
                    if ($paginator->currentPage() === 2) {
                        $extraQuery = collect(request()->query())->except('page');
                        $previousUrl = $paginator->path() . ($extraQuery->isNotEmpty() ? '?' . http_build_query($extraQuery->all()) : '');
                    }
                @endphp
                <li class="page-item me-auto">
                    <a href="{{ $previousUrl }}" aria-label="Previous">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                            <path d="M3.19036 5.64852H13.3333V7.31518H3.19036L7.66033 11.7851L6.48183 12.9636L0 6.48185L6.48183 0L7.66033 1.17851L3.19036 5.64852Z" fill="currentColor" />
                        </svg>
                        <span class="text-uppercase">{{ __('Prev') }}</span>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item">
                        <span class="mb-0 d-inline-block">
                            <span class="pagination_item">{{ $element }}</span>
                        </span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @php
                            // First page should link to the clean base URL, never ?page=1 (SEO)
                            if ((int) $page === 1) {
                                $extraQuery = collect(request()->query())->except('page');
                                $url = $paginator->path() . ($extraQuery->isNotEmpty() ? '?' . http_build_query($extraQuery->all()) : '');
                            }
                        @endphp
                        <li class="page-item">
                            <span class="mb-0 d-inline-block">
                                @if ($page == $paginator->currentPage())
                                    <span class="pagination_item current">{{ $page }}</span>
                                @else
                                    <a class="pagination_item" href="{{ $url }}">{{ $page }}</a>
                                @endif
                            </span>
                        </li>
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item ms-auto">
                    <a href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                        <span class="text-uppercase">{{ __('Next') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <path d="M12.5 6.5L17.2143 11L12.5 15.5" stroke="currentColor" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16.9999 11H4.78564" stroke="currentColor" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </li>
            @else
                <li class="page-item ms-auto disabled">
                    <span>
                        <span class="text-uppercase">{{ __('Next') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <path d="M12.5 6.5L17.2143 11L12.5 15.5" stroke="currentColor" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16.9999 11H4.78564" stroke="currentColor" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
