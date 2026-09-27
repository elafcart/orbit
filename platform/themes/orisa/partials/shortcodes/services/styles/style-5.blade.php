{{-- Services Style 5: from index-5.html `sec-4-home-5` --}}
{{-- Section title with circle-arrow button, then 2-column grid of case-study cards with metric overlays + tags --}}
@php
    $arrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $btnArrowSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/></svg>';
    $plusSvg = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 1v10M1 6h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
    // The non-semantic "div" option needs the h2 utility class to keep the original visual size.
    $titleClass = 'reveal-text mb-0' . ($titleTag === 'div' ? ' h2' : '');
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="container-2200">
    <div class="sec-4-home-5 pt-100 pb-100 rounded-5 mx-lg-3 mx-2 fix p-relative bg-neutral-0">
        <div class="container">
            <div class="row g-4 align-items-end">
                <div class="col-lg-7">
                    @if($shortcode->subtitle)
                        <span class="at-btn common-black text-uppercase bg-transparent mb-10 rounded-0 p-0">
                            <span class="text-uppercase">
                                <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            </span>
                            <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                        </span>
                    @endif
                    @if($shortcode->title)
                        <{{ $titleTag }} class="{{ $titleClass }} {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    @endif
                </div>
                @if($shortcode->primary_action_label)
                    <div class="col-lg-3 ms-auto d-flex justify-content-lg-end">
                        <div class="at-btn-group at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                            <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $btnArrowSvg !!}</a>
                            <a class="at-btn z-index-1" href="{{ $shortcode->primary_action_url ?: '#' }}">
                                {!! BaseHelper::clean($shortcode->primary_action_label) !!}
                            </a>
                            <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $btnArrowSvg !!}</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Case study cards grid (2 columns) --}}
        <div class="container pt-70">
            <div class="row g-4">
                @foreach($services as $index => $service)
                    @php
                        $image = $service->image ?: $service->getMetaData('image', true);
                        $metricValue = $service->getMetaData('metric_value', true);
                        $metricLabel = $service->getMetaData('metric_label', true);
                        $linkLabel = $service->getMetaData('link_label', true) ?: __('VIEW CASE STUDY');
                        $tags = $service->getMetaData('tags', true);
                        if (is_string($tags)) {
                            $tags = array_filter(array_map('trim', explode(',', $tags)));
                        }
                    @endphp
                    <div class="col-lg-6">
                        <div class="card_case__studies-list card_case__studies-list--row">
                            <div class="card_case__studies-card card_case__studies-card--overlay bg-neutral-100">
                                <div class="card_case__studies-visual anim-zoomin">
                                    <a href="{{ $service->url }}">
                                        @if($image)
                                            <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $service->name }}">
                                        @endif
                                    </a>
                                    @if($metricValue)
                                        <div class="card_case__studies-metric-overlay">
                                            <h3 class="h4 card_case__studies-metric-value">{{ $metricValue }}</h3>
                                            @if($metricLabel)
                                                <span class="card_case__studies-metric-label">{{ $metricLabel }}</span>
                                            @endif
                                        </div>
                                    @endif
                                    @if(!empty($tags))
                                        <div class="card_case__studies-tags-overlay">
                                            @foreach($tags as $tag)
                                                <a href="{{ $service->url }}" class="card_case__studies-tag">{{ $tag }}</a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="card_case__studies-footer mt-10 bg-neutral-0">
                                    <h4 class="h5 card_case__studies-footer-title neutral-900">
                                        <a href="{{ $service->url }}">{{ $service->name }}</a>
                                    </h4>
                                    <a href="{{ $service->url }}" class="card_case__studies-link neutral-900">
                                        <span class="neutral-900">{{ $linkLabel }}</span>
                                        {!! $plusSvg !!}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($shortcode->description)
                <div class="row pt-100">
                    <div class="col-12 order-5">
                        <div class="d-flex flex-wrap align-items-center justify-content-lg-between justify-content-center pb-30 gap-md-4 gap-2 at_fade_anim" data-fade-from="bottom" data-duration="2">
                            @foreach(array_filter(array_map('trim', explode('|', $shortcode->description))) as $item)
                                <p class="neutral-900 mb-0">[ {{ $item }} ]</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
