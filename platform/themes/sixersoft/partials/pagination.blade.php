@if ($paginator->hasPages())
    <nav class="mt-12 flex justify-center" aria-label="{{ __('Pagination') }}">
        <ul class="flex flex-wrap items-center gap-2">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true">
                    <span class="flex size-10 cursor-not-allowed items-center justify-center rounded-full border border-slate-200 text-slate-300 dark:border-slate-800 dark:text-slate-700">&laquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" aria-label="{{ __('Previous page') }}" class="flex size-10 items-center justify-center rounded-full border border-slate-300 text-slate-600 transition hover:border-brand-600 hover:text-brand-600 dark:border-slate-700 dark:text-slate-300">&laquo;</a>
                </li>
            @endif

            {{-- Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li aria-disabled="true">
                        <span class="flex size-10 items-center justify-center text-slate-400">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page">
                                <span class="flex size-10 items-center justify-center rounded-full bg-brand-600 font-semibold text-white">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="flex size-10 items-center justify-center rounded-full border border-slate-300 text-slate-600 transition hover:border-brand-600 hover:text-brand-600 dark:border-slate-700 dark:text-slate-300">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" aria-label="{{ __('Next page') }}" class="flex size-10 items-center justify-center rounded-full border border-slate-300 text-slate-600 transition hover:border-brand-600 hover:text-brand-600 dark:border-slate-700 dark:text-slate-300">&raquo;</a>
                </li>
            @else
                <li aria-disabled="true">
                    <span class="flex size-10 cursor-not-allowed items-center justify-center rounded-full border border-slate-200 text-slate-300 dark:border-slate-800 dark:text-slate-700">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
