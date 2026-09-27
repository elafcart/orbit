@if (is_plugin_active('blog') && ! (bool) theme_option('hide_header_search', false))
<div class="at-search-body-overlay"></div>
<div class="at-search-form-toggle">
    <div class="container">
        <div class="row mb-60">
            <div class="col-lg-12">
                <div class="at-search-top d-flex justify-content-between align-items-center">
                    <div class="at-header-logo at-search-logo">
                        <a href="{{ BaseHelper::getHomepageUrl() }}">
                            <img data-width="30" src="{{ theme_option('logo') ? RvMedia::getImageUrl(theme_option('logo')) : Theme::asset()->url('images/logo/favicon.svg') }}" alt="{{ theme_option('site_title', config('app.name')) }}">
                            <p class="h6 fw-700 fz-24 mb-0">{{ theme_option('logo_text', theme_option('site_title', config('app.name'))) }}</p>
                        </a>
                    </div>
                    <button class="at-search-close" aria-label="{{ __('Close search') }}">
                        {!! BaseHelper::renderIcon('ti ti-x') !!}
                    </button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="at-search-form">
                    <form action="{{ route('public.search') }}" method="GET">
                        <div class="at-search-form-input">
                            <input type="text" name="q" placeholder="{{ __('Find what you need…') }}" required>
                            <span class="at-search-focus-border"></span>
                            <button class="at-search-form-btn at-btn" type="submit">
                                <span>
                                    <span class="text-1">{{ __('Search') }}</span>
                                    <span class="text-2">{{ __('Search') }}</span>
                                </span>
                                <i class="icon-arrow-right" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
                                        <path d="M8.33333 1L13 5.66667M13 5.66667L8.33333 10.3333M13 5.66667H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
                                        <path d="M8.33333 1L13 5.66667M13 5.66667L8.33333 10.3333M13 5.66667H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @php
                $suggestKeywords = theme_option('suggest_keywords');
                $suggestKeywords = $suggestKeywords ? array_map('trim', explode(',', $suggestKeywords)) : [];
            @endphp

            @if ($suggestKeywords)
                <div class="col-12">
                    <div class="at-categories">
                        <p class="at-categories-title">{{ __('Popular searches') }}</p>
                        <ul class="at-categories-list">
                            @foreach ($suggestKeywords as $keyword)
                                <li>
                                    <a href="{{ route('public.search') . '?q=' . urlencode($keyword) }}" class="at-categories-item">
                                        {!! BaseHelper::clean($keyword) !!}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endif
