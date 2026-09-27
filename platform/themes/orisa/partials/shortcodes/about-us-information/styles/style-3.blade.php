{{-- About Us Style 3: from index-3.html `sec-4-home-3` --}}
{{-- Large title + numbered nav list left, scrollable feature cards right --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="sec-4-home-3 pt-120 z-n1">
    <div class="container">
        <div class="row g-4 align-items-end">
            <div class="col-xxl-10 col-12">
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

                @if($shortcode->title)
                    <{{ $titleTag }} class="reveal-text mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
            </div>

            @if($shortcode->primary_action_label)
                <div class="col-xxl-2 col-12">
                    <div class="at-btn-group at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                        <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/></svg>
                        </a>
                        <a class="at-btn z-index-1" href="{{ $shortcode->primary_action_url ?: '#' }}">
                            {!! BaseHelper::clean($shortcode->primary_action_label) !!}
                        </a>
                        <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/></svg>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if(!empty($tabs))
        <div class="container section-fix pt-100">
            <div class="row g-4">
                {{-- Left: numbered navigation list --}}
                <div class="col-xxl-3 col-lg-4 h-100">
                    <ul class="list-unstyled navigation-sec4home3 navigation-active-item section-title-pin h-100">
                        @foreach($tabs as $index => $tab)
                            <li>
                                <div class="item">
                                    <div class="content d-flex align-items-center">
                                        <span class="fz-font-md neutral-500">[{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}]</span>
                                        @if(!empty($tab['title']))
                                            @php($itemTitleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($tab['title_tag'] ?? null, 'h4'))
                                            {{-- The item title is a heading here only; the matching title in the
                                                 content panel below stays a span so each item emits one heading. --}}
                                            <{{ $itemTitleTag }} class="h6 mb-0">{{ $tab['title'] }}</{{ $itemTitleTag }}>
                                        @endif
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M12.1716 8.77806L8.55964e-06 8.77806L1.47897e-06 6.77807L12.1716 6.77807L6.80761 1.41412L8.22183 -9.53337e-05L16 7.77806L8.22181 15.5562L6.80759 14.142L12.1716 8.77806Z" fill="currentColor"/></svg>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    {{-- Decorative SVG shapes --}}
                    <div class="row p-relative z-n1 pt-250 d-none d-lg-block">
                        <div class="col-lg-2 offset-lg-7">
                            <div class="at-about-svg-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" width="57" height="91" viewBox="0 0 57 91" fill="none"><path opacity="0.1" d="M0 0L56.4024 33.572V90.336L0 56.46V0Z" fill="#515151"/></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="113" height="68" viewBox="0 0 113 68" fill="none"><path opacity="0.3" d="M0 33.876L56.4024 0L112.805 33.876V34.1294L56.4024 68.0054L0 34.1294V33.876Z" fill="#515151"/></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="57" height="91" viewBox="0 0 57 91" fill="none"><path opacity="0.2" d="M56.4009 0L8.7738e-05 33.5367V90.2413L56.4009 56.4008V0Z" fill="#515151"/></svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: scrollable feature cards --}}
                <div class="col-lg-8 offset-xxl-1 p-relative">
                    <div class="scroll-section vertical-section section">
                        <div class="wrapper">
                            <div role="list" class="list">
                                @foreach($tabs as $tab)
                                    <div class="item">
                                        <div class="container bg-neutral-50 rounded-4">
                                            <div class="row align-items-center py-3">
                                                <div class="col-lg-6 col-md-7 col-12 h-100">
                                                    <div class="d-flex flex-column p-xxl-5 p-4 justify-content-between h-100">
                                                        @if(!empty($tab['title']))
                                                            <span class="fz-font-2xl fw-400 mb-4 text-scale-anim">{{ $tab['title'] }}</span>
                                                        @endif
                                                        @if(!empty($tab['description']))
                                                            <p class="neutral-950 mb-3">
                                                                {!! BaseHelper::clean($tab['description']) !!}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if(!empty($tab['image']))
                                                    <div class="col-xxl-5 col-lg-6 col-md-5 offset-xxl-1 d-none d-md-block">
                                                        <div class="rounded-3 overflow-hidden">
                                                            <img class="img-cover" src="{{ RvMedia::getImageUrl($tab['image']) }}" alt="{{ $tab['title'] ?? '' }}">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
