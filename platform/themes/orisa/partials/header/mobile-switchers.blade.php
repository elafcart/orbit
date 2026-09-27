{{-- Mobile offcanvas: flat language + currency switchers (carento-style) --}}
<div class="at-mobile-switchers mt-40">
    @if (is_plugin_active('ecommerce'))
        @php $currencies = get_all_currencies(); @endphp
        @if ($currencies->count() > 1)
            @php $currentCurrency = get_application_currency(); @endphp
            <div class="at-mobile-switcher-label">{{ __('Currency') }}</div>
            <div class="currency-list-mobile">
                @foreach ($currencies as $currency)
                    <a class="currency-item {{ $currency->getKey() === $currentCurrency->getKey() ? 'active' : '' }}"
                       href="{{ route('public.change-currency', $currency->title) }}">
                        <span class="currency-symbol">{{ $currency->symbol }}</span>
                        {{ $currency->title }}
                    </a>
                @endforeach
            </div>
        @endif
    @endif

    @if (is_plugin_active('language') && ! (bool) theme_option('hide_header_language_switcher', false))
        @php
            $supportedLocales = Language::getSupportedLocales();
            $languageDisplay = setting('language_display', 'all');
            $showRelated = setting('language_show_default_item_if_current_version_not_existed', true);
            $currentLocale = Language::getCurrentLocale();
        @endphp

        @if ($supportedLocales && count($supportedLocales) > 1)
            <div class="at-mobile-switcher-label mt-3">{{ __('Language') }}</div>
            <div class="language-list-mobile">
                @foreach ($supportedLocales as $localeCode => $properties)
                    <a class="language-item {{ $localeCode === $currentLocale ? 'active' : '' }}"
                       href="{{ $showRelated ? Language::getLocalizedURL($localeCode) : url($localeCode) }}">
                        @if ($languageDisplay == 'all' || $languageDisplay == 'flag')
                            <span class="language-flag">{!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}</span>
                        @endif
                        @if ($languageDisplay == 'all' || $languageDisplay == 'name')
                            <span class="language-name">{{ $properties['lang_name'] }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    @endif
</div>
