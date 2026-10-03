@php
    $asLinks = $asLinks ?? false;
@endphp

@if (is_plugin_active('language'))
    @php
        $supportedLocales = Language::getSupportedLocales();
        $currentLocale = Language::getCurrentLocale();
    @endphp

    @if ($supportedLocales && count($supportedLocales) > 1)
        @if ($asLinks)
            <ul class="flex flex-wrap gap-2">
                @foreach ($supportedLocales as $localeCode => $properties)
                    <li>
                        <a
                            href="{{ Language::getLocalizedURL($localeCode) }}"
                            @class([
                                'inline-flex items-center gap-1.5 rounded-full border px-3 py-1.5 text-xs font-medium transition',
                                'border-brand-600 bg-brand-600/10 text-brand-600 dark:border-brand-400 dark:text-brand-400' => $localeCode === $currentLocale,
                                'border-slate-300 text-slate-600 hover:border-brand-600 hover:text-brand-600 dark:border-slate-700 dark:text-slate-300' => $localeCode !== $currentLocale,
                            ])
                        >
                            {{ $properties['lang_name'] ?? $localeCode }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="relative hidden sm:block">
                <select
                    aria-label="{{ __('Language') }}"
                    onchange="if (this.value) window.location.href = this.value;"
                    class="cursor-pointer appearance-none rounded-full border border-slate-300 bg-transparent py-2 pr-8 pl-3 text-xs font-medium text-slate-700 transition focus:border-brand-600 focus:outline-none dark:border-slate-700 dark:text-slate-200 dark:[&>option]:bg-slate-900"
                >
                    @foreach ($supportedLocales as $localeCode => $properties)
                        <option value="{{ Language::getLocalizedURL($localeCode) }}" @selected($localeCode === $currentLocale)>
                            {{ $properties['lang_name'] ?? $localeCode }}
                        </option>
                    @endforeach
                </select>
                <svg class="pointer-events-none absolute top-1/2 right-2.5 -translate-y-1/2 text-slate-400" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </div>
        @endif
    @endif
@endif
