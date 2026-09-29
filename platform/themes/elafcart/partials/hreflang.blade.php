@if(is_plugin_active('language'))
    @php
        try {
            $supportedLocales = Language::getSupportedLocales();
            $hreflangUrls = [];
            foreach ($supportedLocales as $localeCode => $properties) {
                $hreflangUrls[$localeCode] = Language::getLocalizedURL($localeCode, null, [], true);
            }
            $defaultLocale = Language::getDefaultLocale();
            $xDefaultUrl = collect($hreflangUrls)->first(function ($url, $code) use ($defaultLocale) {
                return str_starts_with($code, $defaultLocale);
            }) ?? rtrim(Language::getLocalizedURL($defaultLocale, url()->current(), [], false), '/');
        } catch (\Exception $e) {
            $hreflangUrls = [];
            $xDefaultUrl = url()->current();
        }
    @endphp

    @if(!empty($hreflangUrls))
        <link href="{{ rtrim($xDefaultUrl, '/') }}" hreflang="x-default" rel="alternate" />
        @foreach($hreflangUrls as $code => $url)
            <link href="{{ $url }}" hreflang="{{ $code }}" rel="alternate" />
        @endforeach
    @endif
@endif
