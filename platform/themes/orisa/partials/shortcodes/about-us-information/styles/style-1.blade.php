{{-- About Us Style 1: from index.html `at-about-area` --}}
{{-- Large title with inline CTA button + two feature image cards below --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="at-about-area pt-100">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-xxl-10">
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
                        <div class="d-flex align-items-end flex-wrap">
                            <{{ $titleTag }} class="at-section-title mb-0 {{ $titleSizeClass }}">
                                <span>{!! BaseHelper::clean($shortcode->title) !!}</span>
                            </{{ $titleTag }}>
                            @if($shortcode->primary_action_label)
                                <span class="at-about-btn-transform ml-20">
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
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="at-about-border mt-20 pt-55">
            <div class="row">
                {{-- Left column: description + team avatars odometer --}}
                <div class="col-xxl-2 col-lg-3 col-md-7 mb-md-5">
                    @if($shortcode->description)
                        <div class="at-about-subtitle-wrap mb-30">
                            <span class="at-about-subtitle">
                                @if($shortcode->decoration_icon)
                                    <x-core::icon :name="$shortcode->decoration_icon" class="fill-primary mb-10" style="width:40px;height:40px;" />
                                @else
                                    <svg class="fill-primary mb-10" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M40 20V0H20H0V20V40H20L40 20ZM40 20H20V40L0 20L20 0L40 20Z" fill="currentColor"/>
                                    </svg>
                                @endif
                                <br class="d-block">
                                {!! BaseHelper::clean($shortcode->description) !!}
                            </span>
                        </div>
                    @endif

                    @if($shortcode->experience_years || !empty($avatars))
                        <div class="d-flex align-items-center">
                            @if(!empty($avatars))
                                <div class="block-author d-flex align-items-center position-relative">
                                    @foreach($avatars as $index => $avatar)
                                        @if(!empty($avatar['image']))
                                            <div class="avatar overflow-hidden z-index-{{ $index + 2 }}">
                                                {{ RvMedia::image($avatar['image'], __('Avatar'), lazy: false) }}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            @if($shortcode->experience_years)
                                <div class="fz-font-md fw-600 text-nowrap">
                                    <span class="odometer" data-count="{{ (int) $shortcode->experience_years }}"></span>+
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Decorative SVG shapes --}}
                <div class="col-lg-1 col-md-3 col-5 align-self-end ms-auto">
                    <div class="at-about-svg-wrap move-up">
                        <svg xmlns="http://www.w3.org/2000/svg" width="57" height="91" viewBox="0 0 57 91" fill="none"><path opacity="0.1" d="M0 0L56.4024 33.572V90.336L0 56.46V0Z" fill="#515151"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="113" height="68" viewBox="0 0 113 68" fill="none"><path opacity="0.3" d="M0 33.876L56.4024 0L112.805 33.876V34.1294L56.4024 68.0054L0 34.1294V33.876Z" fill="#515151"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="57" height="91" viewBox="0 0 57 91" fill="none"><path opacity="0.2" d="M56.4009 0L8.7738e-05 33.5367V90.2413L56.4009 56.4008V0Z" fill="#515151"/></svg>
                    </div>
                </div>

                {{-- Right column: feature cards from tabs --}}
                <div class="col-lg-8 ms-auto">
                    <div class="at-about-thumb-wrap ml-75">
                        <div class="row gx-80">
                            @forelse($tabs as $index => $tab)
                                <div class="col-lg-6 col-md-6">
                                    @if($index % 2 === 0)
                                        {{-- Even: image on top, content below --}}
                                        <div class="at-about-item anim-zoomin-wrap mb-40">
                                            @if(!empty($tab['image']))
                                                <div class="mb-35">
                                                    <div class="at-about-thumb fix anim-zoomin">
                                                        <img data-speed=".8" src="{{ RvMedia::getImageUrl($tab['image']) }}" alt="{{ $tab['title'] ?? '' }}">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="at-about-content">
                                                @if(!empty($tab['title']))
                                                    @php($itemTitleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($tab['title_tag'] ?? null, 'h3'))
                                                    <{{ $itemTitleTag }} class="at-about-title mb-10 at-char-animation">{{ $tab['title'] }}</{{ $itemTitleTag }}>
                                                @endif
                                                @if(!empty($tab['description']))
                                                    <p class="at-about-dec at_fade_anim">{!! BaseHelper::clean($tab['description']) !!}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        {{-- Odd: content on top, image below --}}
                                        <div class="at-about-item mb-40 d-flex flex-column gap-4">
                                            <div class="at-about-content order-2 order-md-1">
                                                @if(!empty($tab['title']))
                                                    @php($itemTitleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($tab['title_tag'] ?? null, 'h3'))
                                                    <{{ $itemTitleTag }} class="at-about-title mb-10 at-char-animation">{{ $tab['title'] }}</{{ $itemTitleTag }}>
                                                @endif
                                                @if(!empty($tab['description']))
                                                    <p class="at-about-dec at_fade_anim">{!! BaseHelper::clean($tab['description']) !!}</p>
                                                @endif
                                            </div>
                                            @if(!empty($tab['image']))
                                                <div class="anim-zoomin-wrap order-1 order-md-2">
                                                    <div class="at-about-thumb fix anim-zoomin">
                                                        <img data-speed=".8" src="{{ RvMedia::getImageUrl($tab['image']) }}" alt="{{ $tab['title'] ?? '' }}">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @empty
                                {{-- Fallback: show image fields if no tabs configured --}}
                                @if($styleImage1 || $styleImage2)
                                    @if($styleImage1)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="at-about-item anim-zoomin-wrap mb-40">
                                                <div class="at-about-thumb fix anim-zoomin">
                                                    <img data-speed=".8" src="{{ RvMedia::getImageUrl($styleImage1) }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($styleImage2)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="at-about-item mb-40">
                                                <div class="at-about-thumb fix anim-zoomin">
                                                    <img data-speed=".8" src="{{ RvMedia::getImageUrl($styleImage2) }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
