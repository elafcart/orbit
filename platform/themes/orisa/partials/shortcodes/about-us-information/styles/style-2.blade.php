{{-- About Us Style 2: from index-2.html `sec-2-home-2` --}}
{{-- Dark background with video/image, title left + card right layout --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="sec-2-home-2 container-2200">
    <div class="mx-4 pt-20 pb-20">
        <div class="d-flex align-items-center justify-content-between">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M20 0C20.3015 10.9184 29.0816 19.6985 40 20C29.0816 20.3015 20.3015 29.0816 20 40C19.6985 29.0816 10.9184 20.3015 0 20C10.9184 19.6985 19.6985 10.9184 20 0Z" fill="#B7B7B7"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M20 0C20.3015 10.9184 29.0816 19.6985 40 20C29.0816 20.3015 20.3015 29.0816 20 40C19.6985 29.0816 10.9184 20.3015 0 20C10.9184 19.6985 19.6985 10.9184 20 0Z" fill="#B7B7B7"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M20 0C20.3015 10.9184 29.0816 19.6985 40 20C29.0816 20.3015 20.3015 29.0816 20 40C19.6985 29.0816 10.9184 20.3015 0 20C10.9184 19.6985 19.6985 10.9184 20 0Z" fill="#B7B7B7"/></svg>
        </div>
    </div>

    <div class="bg-coating rounded-5 overflow-hidden mx-lg-3 mx-2 bg-cover"
        @if($styleImage1) data-background="{{ RvMedia::getImageUrl($styleImage1) }}" @endif
    >
        {{-- Feature tabs as horizontal service buttons --}}
        @if(!empty($tabs))
            <div class="container pb-100 p-relative z-index-2">
                <div class="row">
                    @foreach($tabs as $tab)
                        <div class="col-lg-3 col-md-6 col-12 text-center">
                            <div class="at-btn at-btn-border-white ps-2 pt-20 pb-20 pe-2 text-white bg-transparent rounded-0 border-top-0 border-start-0 border-end-0 w-100">
                                <span>
                                    <span class="text-1">{{ $tab['title'] ?? '' }}</span>
                                    <span class="text-2">{{ $tab['title'] ?? '' }}</span>
                                </span>
                                <i>
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                                </i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Main about content: title left + image card right --}}
        <div class="container pb-100 p-relative z-index-2">
            <div class="row g-4 justify-content-lg-between justify-content-center align-items-end">
                <div class="col-lg-5 col-12">
                    <div class="at-about-title-wrap">
                        @if($shortcode->subtitle)
                            <span class="at-btn text-white bg-transparent mb-10 rounded-0 p-0">
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

                        @if($shortcode->title)
                            <{{ $titleTag }} class="at-section-title reveal-text text-white lh-1 mb-40 mt-20 {{ $titleSizeClass }}">
                                {!! BaseHelper::clean($shortcode->title) !!}
                            </{{ $titleTag }}>
                        @endif

                        @if($shortcode->description)
                            <p class="text-white mb-0">{!! BaseHelper::clean($shortcode->description) !!}</p>
                        @endif
                    </div>
                </div>

                {{-- Floating image card --}}
                @if($styleImage2)
                    <div class="col-xxl-3 col-lg-4 col-md-7 tp_fade-anim">
                        <div class="card-item p-relative at_fade_anim" data-fade-from="bottom" data-duration="1" data-delay="0.5">
                            <div class="card-item__bg">
                                <img src="{{ RvMedia::getImageUrl($styleImage2) }}" alt="{{ $shortcode->title }}" class="home-2-card-item__bg-img img-cover">
                            </div>
                            <div class="card-item-content p-absolute bottom-0 start-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M40 20V0H20H0V20V40H20L40 20ZM40 20H20V40L0 20L20 0L40 20Z" fill="#FEFEFE"/>
                                </svg>
                                @if($shortcode->primary_action_label)
                                    <h3 class="h6 card-item-text mb-0 text-white">
                                        {!! BaseHelper::clean($shortcode->primary_action_label) !!}
                                    </h3>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
