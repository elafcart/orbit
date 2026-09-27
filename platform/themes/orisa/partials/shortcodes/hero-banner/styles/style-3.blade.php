{{-- Hero Banner Style 3 — light bg, testimonial card left, main title center, image right --}}
@php
    $arrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $arrowBtnSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/></svg>';

    // Client avatar stack (up to 5) for the badge on the right hero image.
    $clientAvatars = collect(range(1, 5))
        ->map(fn ($i) => $shortcode->{"client_avatar_$i"})
        ->filter();

    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!}
    class="shortcode-hero-banner shortcode-hero-banner-style-3 sec-1-home-3 pt-110 p-relative">

    <div class="container pt-xxl-0 pt-110">
        <div class="row g-xxl-5 g-4 align-items-center">

            {{-- Left testimonial card --}}
            <div class="col-lg-3 col-md-6 order-2 order-lg-1 mb-100">
                <div class="testimonial-cart pe-xxl-5">
                    @if($shortcode->image)
                        <div class="ripple-image ripples rounded-4 overflow-hidden">
                            {{ RvMedia::image($shortcode->image, $shortcode->title, attributes: ['class' => 'img-cover']) }}
                        </div>
                    @endif

                    @if($shortcode->card_text || $shortcode->card_author)
                        <div class="testimonial-content p-3">
                            @if($shortcode->card_text)
                                <p class="h6 fw-400 reveal-text py-3 mb-0">
                                    &ldquo; {!! BaseHelper::clean($shortcode->card_text) !!} &ldquo;
                                </p>
                            @endif

                            @if($shortcode->card_author)
                                <div class="testimonial-author d-flex align-items-start mb-0 gap-2">
                                    @if($shortcode->card_avatar)
                                        <div class="testimonial-left-img size-30 rounded-2 overflow-hidden">
                                            {{ RvMedia::image($shortcode->card_avatar, $shortcode->card_author, attributes: ['class' => 'img-cover']) }}
                                        </div>
                                    @endif
                                    <div class="testimonial-content">
                                        <p class="h6 testimonial-content-author-name fw-600 mb-0 fz-font-md">{{ $shortcode->card_author }}</p>
                                        @if($shortcode->card_author_role)
                                            <p class="testimonial-content-author-position m-0 fz-font-label">{{ $shortcode->card_author_role }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- Center: subtitle tag, title, description, CTAs --}}
            <div class="col-xxl-4 col-lg-5 align-self-center order-1 order-lg-2">
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
                    <{{ $titleTag }} class="fw-900 lh-1 mt-10 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif

                @if($shortcode->description)
                    <p class="fz-font-lg neutral-500 mb-65 mt-25">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif

                <div class="d-flex flex-wrap align-items-center gap-4">
                    {{-- Primary CTA button group --}}
                    @if($shortcode->primary_action_label)
                        <div class="at-btn-group at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                            <a class="at-btn-circle" href="{{ $shortcode->primary_action_url }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $arrowBtnSvg !!}</a>
                            <a class="at-btn z-index-1" href="{{ $shortcode->primary_action_url }}">{{ $shortcode->primary_action_label }}</a>
                            <a class="at-btn-circle" href="{{ $shortcode->primary_action_url }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $arrowBtnSvg !!}</a>
                        </div>
                    @endif

                    {{-- Secondary CTA underline link --}}
                    @if($shortcode->secondary_action_label)
                        <a href="{{ $shortcode->secondary_action_url }}"
                            class="at-btn common-black border-bottom-900 text-uppercase bg-transparent rounded-0 p-0 pb-2">
                            <span class="text-uppercase">
                                <span class="text-1">{{ $shortcode->secondary_action_label }}</span>
                                <span class="text-2">{{ $shortcode->secondary_action_label }}</span>
                            </span>
                            <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Decorative rotating star --}}
            <div class="col-xxl-1 mt-150 order-lg-3 order-5 d-none d-xxl-block align-self-start">
                <svg class="rotate-infinite" xmlns="http://www.w3.org/2000/svg" width="57" height="57" viewBox="0 0 57 57" fill="none">
                    <path d="M4.4275 53.66C16.0138 44.9195 21.807 40.5492 28.5001 40.5492C35.1932 40.5492 40.9863 44.9195 52.5727 53.66L56.9999 56.9999L53.6601 52.5727C44.9195 40.9863 40.5492 35.1932 40.5492 28.5001C40.5492 21.807 44.9195 16.0138 53.66 4.42751L57 0.000133148L52.5727 3.34004C40.9863 12.0806 35.1932 16.4509 28.5001 16.4509C21.807 16.4509 16.0138 12.0806 4.4275 3.34004L0 0L3.34004 4.42749C12.0806 16.0138 16.4509 21.807 16.4509 28.5001C16.4509 35.1932 12.0806 40.9863 3.34005 52.5726L0.000112182 57L4.4275 53.66Z" fill="#CACACA"/>
                </svg>
            </div>

            {{-- Right: hero image with client-count badge.
                 NOTE: Uses `right_image` (not `background_image`) because the base Shortcode
                 compiler auto-applies `background_image` as an inline CSS background on the
                 block wrapper — which would paint the entire hero area with this image. --}}
            @if($shortcode->right_image)
                <div class="col-lg-4 col-md-6 order-3">
                    <div class="p-relative rounded-4 fix cilent-word-wide changeless">
                        {{ RvMedia::image($shortcode->right_image, $shortcode->title, attributes: ['class' => 'img-cover']) }}

                        @if($shortcode->client_count || $shortcode->client_count_label)
                            <div class="cilent-word-wide-content p-absolute bottom-0 end-0 m-lg-5 m-md-4 m-4">
                                @if($shortcode->client_count)
                                    <span class="fw-800 fz-font-3xl neutral-900">
                                        <span class="odometer text-nowrap" data-count="{{ $shortcode->client_count }}"></span>{{ $shortcode->client_count_suffix ?: '' }}
                                    </span>
                                @endif
                                @if($shortcode->client_count_label)
                                    <p class="h6 fz-font-md mb-0">{{ $shortcode->client_count_label }}</p>
                                @endif
                                @if($clientAvatars->isNotEmpty())
                                    <div class="position-relative d-flex align-items-center gap-2">
                                        @foreach($clientAvatars as $index => $avatar)
                                            <div class="avatar z-index-{{ $index + 1 }}">
                                                {{ RvMedia::image($avatar, 'client', attributes: ['class' => 'img-cover']) }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Bottom tag bar --}}
            @if(count($services) > 0)
                <div class="col-12 order-5">
                    <div class="d-flex flex-wrap align-items-center justify-content-lg-between justify-content-center pb-50 gap-md-5 gap-2 at_fade_anim"
                        data-fade-from="bottom" data-duration="2">
                        @foreach($services as $service)
                            <p class="neutral-900 mb-0">[ {{ $service['name'] }} ]</p>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
