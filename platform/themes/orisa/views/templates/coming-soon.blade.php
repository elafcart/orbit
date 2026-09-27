@php
    Theme::set('breadcrumbEnabled', false);
@endphp

<div class="at-page-content">
    <div class="sec-1-coming-soon overflow-hidden pt-150">
        <div class="container pb-60">
            <div class="row g-4 align-items-end">
                <div class="col-xxl-6 col-lg-8">
                    @if ($subtitle = $page->getMetaData('coming_soon_subtitle', true))
                        <span class="at-btn common-black text-uppercase bg-transparent mb-10 rounded-0 p-0">
                            <span class="text-uppercase">
                                <span class="text-1">{{ $subtitle }}</span>
                                <span class="text-2">{{ $subtitle }}</span>
                            </span>
                            <i>
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                            </i>
                        </span>
                    @endif
                    <h1 class="reveal-text mb-40 fz-ds-1 fw-500 lh-1">{{ $page->name }}</h1>
                    @if ($page->content)
                        <p class="fw-400 fz-font-3xl neutral-900 mb-40 w-75 lh-sm">{!! BaseHelper::clean($page->content) !!}</p>
                    @endif
                    @php
                        $phone = theme_option('phone');
                        $email = theme_option('email');
                    @endphp
                    @if ($phone || $email)
                        <div class="d-flex flex-wrap align-items-center gap-5">
                            @if ($phone)
                                <a href="tel:{{ $phone }}" class="fz-font-lg neutral-500 fw-500">[ {{ $phone }} ]</a>
                            @endif
                            @if ($email)
                                <a href="mailto:{{ $email }}" class="fz-font-lg neutral-500 fw-500">[ {{ $email }} ]</a>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-xxl-6 pt-xxl-0 pt-100">
                    @if ($countdownTime = $page->getMetaData('countdown_time', true))
                        <div class="box-count box-count-square mb-50">
                            <div class="deals-countdown justify-content-end" data-countdown="{{ $countdownTime }}"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if ($bannerImage = $page->getMetaData('banner_image', true))
            <div class="at-banner-thumb overflow-hidden scale-up-img pt-md-0 pt-20">
                <img class="img-cover scale-up" data-speed=".8" src="{{ RvMedia::getImageUrl($bannerImage) }}" alt="{{ $page->name }}">
            </div>
        @endif
    </div>

    {{-- Section 2: throwable client-logo capsules (physics-animated) --}}
    @php
        // Build a logo list. Order/repetition mirrors the reference (10 unique + 4
        // repeats for visual density). The 1st, 5th, 11th use `bg-neutral-500`.
        $logoOrder = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 2, 5, 7, 3];
        $darkSlots = [0, 4, 10];
    @endphp
    <div class="sec-2-coming-soon pb-20 p-relative z-n1">
        <div class="container">
            <div class="client-capsule-wrapper-box" data-t-throwable-scene="true">
                <div class="client-capsule-wrapper">
                    @foreach ($logoOrder as $index => $logoNum)
                        @php
                            $logoPath = sprintf('brands/logo-brand-%02d.webp', $logoNum);
                            $logoUrl = RvMedia::getImageUrl($logoPath);
                            $isDark = in_array($index, $darkSlots, true);
                        @endphp
                        <p data-t-throwable-el>
                            <span @class(['client-box', 'bg-neutral-500' => $isDark])>
                                <img class="invert-1" src="{{ $logoUrl }}" alt="{{ Theme::getSiteName() }}" loading="lazy">
                            </span>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {!! apply_filters(
        PAGE_FILTER_FRONT_PAGE_CONTENT,
        '',
        $page,
    ) !!}
</div>
