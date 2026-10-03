@php
    $crumbs = Theme::breadcrumb()->getCrumbs();
@endphp

@if (Theme::breadcrumb()->enabled() && count($crumbs) > 0)
    <nav aria-label="{{ __('Breadcrumb') }}" class="border-b border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900/40">
        <div class="container-shell flex h-12 items-center overflow-x-auto">
            <ol class="flex items-center gap-2 text-sm whitespace-nowrap">
                @foreach ($crumbs as $crumb)
                    <li class="flex items-center gap-2">
                        @if (! $loop->first)
                            <svg class="size-3.5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        @endif

                        @if ($loop->last)
                            <span class="font-medium text-slate-900 dark:text-white" aria-current="page">{{ $crumb['label'] }}</span>
                        @else
                            <a href="{{ $crumb['url'] }}" class="text-slate-500 transition hover:text-brand-600 dark:text-slate-400 dark:hover:text-brand-400">{{ $crumb['label'] }}</a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </nav>
@endif
