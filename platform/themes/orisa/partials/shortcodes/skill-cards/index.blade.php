{{-- Skill Cards — Tech Stack / Tools grid (matches sec-6-about in about-3.html) --}}
@php
    $linkArrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="shortcode-skill-cards sec-6-about pt-120 pb-80 p-relative bg-neutral-50">
    <div class="container p-relative z-1">
        <div class="row pb-100 align-items-lg-end">
            <div class="col-lg-4">
                @if ($shortcode->subtitle)
                    <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        </span>
                        <i>{!! $linkArrowSvg !!}{!! $linkArrowSvg !!}</i>
                    </span>
                @endif
                @if ($shortcode->title)
                    <h3 class="reveal-text">{!! BaseHelper::clean($shortcode->title) !!}</h3>
                @endif
            </div>
            @if ($shortcode->description)
                <div class="col-xxl-5 col-lg-7 text-lg-end ms-auto">
                    <h4 class="h6 fw-600 fz-font-lg">{!! BaseHelper::clean($shortcode->description) !!}</h4>
                </div>
            @endif
        </div>
    </div>

    @if (! empty($cards))
        <div class="container p-relative z-1">
            <div class="row">
                <div class="col-12">
                    <div class="skill-cards">
                        @foreach ($cards as $card)
                            @php
                                $score = (int) ($card['score'] ?? 0);
                                $score = max(0, min(100, $score));
                                $tagItems = $card['tag_items'] ?? [];
                            @endphp
                            <div class="skill-card scroll-move-up">
                                @if (! empty($card['image']))
                                    <div class="skill-card__thumb">
                                        {{ RvMedia::image($card['image'], $card['title'] ?? 'Skill', attributes: ['class' => 'img-cover']) }}
                                    </div>
                                @endif

                                @if (! empty($card['title']))
                                    <h5 class="h6 skill-card__title">{{ $card['title'] }}</h5>
                                @endif

                                @if (! empty($tagItems))
                                    <div class="skill-card__content">
                                        <div class="skill-card__tags">
                                            @foreach ($tagItems as $tag)
                                                <span class="skill-card__tag">
                                                    @if (! empty($tag['icon']))
                                                        <img src="{{ RvMedia::getImageUrl($tag['icon']) }}" alt="{{ $tag['name'] ?? '' }}" class="skill-card__tag-icon" width="16" height="16" loading="lazy" decoding="async">
                                                    @endif
                                                    {{ $tag['name'] ?? '' }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if ($score > 0)
                                    <div class="skill-card__score">
                                        <span class="skill-card__score-value"><span class="odometer" data-count="{{ $score }}"></span></span>/100
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
