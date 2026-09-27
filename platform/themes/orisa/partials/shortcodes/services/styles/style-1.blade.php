{{-- Services Style 1: from index.html `at-service-area` --}}
{{-- Pinned hover-image panel left + numbered service list right --}}
@php
    // Section heading sits between the page H1 and the H3 service item titles. Rendered only when
    // the title field is filled, so blocks that leave it empty keep their original markup.
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
    $titleClass = 'reveal-text mb-50' . ($titleTag === 'div' ? ' h2' : '');
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="at-service-area at-panel-pin-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="at-service-subtitle-wrap at-about-border d-flex justify-content-between gap-3 mb-50">
                    @if($shortcode->subtitle)
                        <span class="at-btn common-black text-uppercase bg-transparent mb-10 rounded-0 p-0">
                            <span class="text-uppercase">
                                <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            </span>
                            <i>
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                            </i>
                        </span>
                    @endif
                    @if($shortcode->description)
                        <span class="fs-font-md fw-500 text-decoration-underline">{!! BaseHelper::clean($shortcode->description) !!}</span>
                    @endif
                </div>
                @if($shortcode->title)
                    <{{ $titleTag }} class="{{ $titleClass }} {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
            </div>

            {{-- Left: pinned image panel with hover images + counter --}}
            <div class="col-xxl-4 col-lg-4 col-xl-4 mb-40">
                <div class="at-service-content mr-60 mt-20">
                    <div class="at-service-sales-wrap at-panel-pin fix p-relative">
                        <div class="at-service-img-wrapper image-container">
                            @foreach($services as $service)
                                @php $image = $service->image ?: $service->getMetaData('image', true); @endphp
                                @if($image)
                                    <div class="hover-image">
                                        <img class="thumb" src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $service->name }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @if($shortcode->experience_years ?? false)
                            <h4 class="h5 fw-600 mb-0 mt-10">
                                <span class="odometer" data-count="{{ (int) $shortcode->experience_years }}"></span>+
                            </h4>
                            <span class="fz-font-lg neutral-500 fw-500">{{ __('Completed projects') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right: numbered service list --}}
            <div class="col-xxl-7 ms-auto col-lg-8 col-xl-8 mb-40">
                <div class="at-service-list-wrap">
                    @foreach($services as $index => $service)
                        <a href="{{ $service->url }}">
                            <div class="at-service-item service-item">
                                <div class="count">
                                    <span class="number">[{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}]</span>
                                </div>
                                <div class="content">
                                    {{-- Use <h3> instead of <h1> so each page emits only one semantic H1 (page-content), avoiding duplicate H1 with the service detail page. --}}
                                    <h3 class="title">{{ $service->name }}</h3>
                                    @if($service->description)
                                        <p class="text">{!! BaseHelper::clean($service->description) !!}</p>
                                    @endif
                                </div>
                                @php $thumbImage = $service->getMetaData('icon_image', true) ?: ($service->image ?? null); @endphp
                                @if($thumbImage)
                                    <div class="thumb anim-zoomin">
                                        <img src="{{ RvMedia::getImageUrl($thumbImage) }}" alt="{{ $service->name }}">
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach

                    @if($shortcode->primary_action_label)
                        <div class="at-service-btn pt-30">
                            <a class="at-btn" href="{{ $shortcode->primary_action_url ?: '#' }}">
                                <span>
                                    <span class="text-1">{!! BaseHelper::clean($shortcode->primary_action_label) !!}</span>
                                    <span class="text-2">{!! BaseHelper::clean($shortcode->primary_action_label) !!}</span>
                                </span>
                                <i>
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                                </i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
