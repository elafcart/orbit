{{-- About Us Style 4: from index.html `at-sec7-area` --}}
{{-- "Why choose us" section with title, 2 stacked images left, stats cards right --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<div {!! $shortcode->htmlAttributes() !!}>
    <div class="container-2200">
        <div class="at-sec7-area pt-120 pb-120 bg-neutral-50 rounded-5 mx-lg-3 mx-2 mt-10">
            <div class="container">
                {{-- Top row: title + decorative SVG --}}
                <div class="row align-items-end">
                    <div class="col-xxl-8 col-xl-12">
                        <div class="at-about-title-wrap mb-30">
                            @if($shortcode->subtitle)
                                <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
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
                                <{{ $titleTag }} class="at-section-title reveal-text mb-80 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 align-self-end ms-auto d-none d-md-block">
                        <div class="at-about-svg-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="57" height="91" viewBox="0 0 57 91" fill="none"><path opacity="0.1" d="M0 0L56.4024 33.572V90.336L0 56.46V0Z" fill="#515151"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="113" height="68" viewBox="0 0 113 68" fill="none"><path opacity="0.3" d="M0 33.876L56.4024 0L112.805 33.876V34.1294L56.4024 68.0054L0 34.1294V33.876Z" fill="#515151"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="57" height="91" viewBox="0 0 57 91" fill="none"><path opacity="0.2" d="M56.4009 0L8.7738e-05 33.5367V90.2413L56.4009 56.4008V0Z" fill="#515151"/></svg>
                        </div>
                    </div>
                </div>

                {{-- Bottom row: images left + description & stats right --}}
                <div class="row align-items-end g-4">
                    {{-- Left: stacked images --}}
                    <div class="col-lg-4 col-md-9 col-12">
                        <div class="d-flex flex-column gap-2">
                            @if($styleImage1)
                                <div class="at-image-hover p-relative rounded-4 overflow-hidden">
                                    <div class="anim-zoomin">
                                        <img class="zoom-blur-image img-cover" src="{{ RvMedia::getImageUrl($styleImage1) }}" alt="{{ $shortcode->title }}">
                                    </div>
                                    @if($styleImage3)
                                        <img class="p-absolute bottom-0 start-0 m-4" src="{{ RvMedia::getImageUrl($styleImage3) }}" alt="{{ $shortcode->title }}">
                                    @endif
                                </div>
                            @endif
                            @if($styleImage2)
                                <div class="at-image-hover p-relative rounded-4 overflow-hidden">
                                    <div class="anim-zoomin">
                                        <img class="zoom-blur-image img-cover" src="{{ RvMedia::getImageUrl($styleImage2) }}" alt="{{ $shortcode->title }}">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Right: description + stats grid --}}
                    <div class="col-xxl-6 col-lg-8 ms-auto">
                        <div class="row g-2">
                            @if($shortcode->description)
                                <div class="col-lg-7 col-md-8 col-12">
                                    <h4 class="h6 reveal-text neutral-800 mb-60">{!! BaseHelper::clean($shortcode->description) !!}</h4>
                                </div>
                            @endif

                            @php
                                // Decorative SVG icons matching the HTML template
                                $tabIcons = [
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M30 20H20V30L20 40H10L0 30L10 20H0V0H10L20 10V1.90735e-06L30 0L40 10L30 20ZM20 10V20H10L20 10Z" fill="currentColor"/><path d="M30 20H40V40H30L20 30L30 20Z" fill="currentColor"/></svg>',
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none"><path d="M38 12L31 19L19 7L26 0H38V12Z" fill="currentColor"/><path d="M7 19L19 7L12 0H0V12L7 19Z" fill="currentColor"/><path d="M19 31L12 38H0V26L7 19V31H19Z" fill="currentColor"/><path d="M19 31H31V19L38 26V38H26L19 31Z" fill="currentColor"/></svg>',
                                ];
                            @endphp
                            @foreach($tabs as $index => $tab)
                                <div class="col-md-6 col-12">
                                    <div class="hover-unborder">
                                        @if($index % 2 === 0)
                                            {{-- Even tabs: counter on top, content below --}}
                                            @if(!empty($tab['title']))
                                                <div class="bg-neutral-0 rounded-4 px-5 py-3">
                                                    <h4 class="d-flex justify-content-between align-items-center mb-0">
                                                        <span>{{ $tab['title'] }}</span>
                                                        <span>+</span>
                                                    </h4>
                                                </div>
                                            @endif
                                            <div class="bg-neutral-0 rounded-4 p-5 mt-2">
                                                @if(!empty($tab['description']))
                                                    <h5 class="h6 text-end mb-0">{!! nl2br(e($tab['description'])) !!}</h5>
                                                @endif
                                                <div class="pt-150">
                                                    {!! $tabIcons[$index] ?? '' !!}
                                                    @if(!empty($tab['content']))
                                                        <p class="fz-font-lg mt-3 mb-0">{{ $tab['content'] }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            {{-- Odd tabs: content on top, counter below --}}
                                            <div class="bg-neutral-0 rounded-4 p-5 mb-2">
                                                @if(!empty($tab['description']))
                                                    <h5 class="h6 text-end mb-0">{!! nl2br(e($tab['description'])) !!}</h5>
                                                @endif
                                                <div class="pt-150">
                                                    {!! $tabIcons[$index] ?? '' !!}
                                                    @if(!empty($tab['content']))
                                                        <p class="fz-font-lg mt-3 mb-0">{{ $tab['content'] }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            @if(!empty($tab['title']))
                                                <div class="bg-neutral-0 rounded-4 px-5 py-3">
                                                    <h4 class="d-flex justify-content-between align-items-center mb-0">
                                                        <span>{{ $tab['title'] }}</span>
                                                        <span>+</span>
                                                    </h4>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
