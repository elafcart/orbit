@php
    SeoHelper::setTitle(__('404 - Not found'));
    Theme::fireEventGlobalAssets();
@endphp

@extends(Theme::getThemeNamespace('layouts.base'))

@section('content')
    <section class="pt-200 pb-120">
        <div class="container">
            <div class="text-center">
                @if($image = theme_option('404_image'))
                    {{ RvMedia::image($image, Theme::getSiteTitle(), attributes: ['class' => 'mb-5']) }}
                @else
                    <h1 class="fz-200 fw-bold mb-4">404</h1>
                @endif
                <h3 class="mb-3">{{ __("Page Not Found") }}</h3>
                <p class="fz-font-lg mb-5">{{ __("Sorry, the page you're looking for doesn't exist or has been moved.") }}</p>
                <a href="{{ BaseHelper::getHomepageUrl() }}" class="at-btn">
                    <span>
                        <span class="text-1">{{ __('Back to Home') }}</span>
                        <span class="text-2">{{ __('Back to Home') }}</span>
                    </span>
                </a>
            </div>
        </div>
    </section>
@endsection
