{{-- Teams Style 2: from index.html `at-sec9-area` --}}
{{-- Title + CTA + contact info left, 2x2 team grid right --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="at-sec9-area pt-130 pb-130">
    <div class="container">
        <div class="row g-5">
            {{-- Left: title + CTA + contact info --}}
            <div class="col-xxl-7 col-lg-8">
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
                        <{{ $titleTag }} class="h3 at-section-title reveal-text mb-lg-0 mb-4 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    @endif

                    @if($shortcode->primary_action_label)
                        <div class="at-btn-group at_fade_anim pt-30" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                            <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                    <path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor" />
                                </svg>
                            </a>
                            <a class="at-btn z-index-1" href="{{ $shortcode->primary_action_url ?: '#' }}">{{ $shortcode->primary_action_label }}</a>
                            <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                    <path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    @endif

                    @if($shortcode->description)
                        <div class="at-about-content pt-120">
                            <div class="d-flex gap-4 justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <path d="M20 40V20H0L20 0L40 20V40H20Z" fill="currentColor" />
                                    <path d="M0 20L20 40H0V20Z" fill="currentColor" />
                                </svg>
                                <div>
                                    {!! BaseHelper::clean($shortcode->description) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: 2x2 team grid --}}
            <div class="col-xxl-4 ms-xxl-auto col-lg-8">
                <div class="team-grid-wrap">
                    <div class="row g-2">
                        @foreach($teams as $team)
                            @php
                                $url = $team->website ?: ($team->url ?: '#');
                                $isExternal = $team->website && str_starts_with($team->website, 'http');
                            @endphp
                            <div class="col-lg-6 col-md-6 col-sm-6 changeless">
                                <div class="team-card">
                                    <div class="team-card-image">
                                        <div class="anim-zoomin">
                                            <img src="{{ RvMedia::getImageUrl($team->photo, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $team->name }}" class="img-cover">
                                        </div>
                                    </div>
                                    <a href="{{ $url }}" class="team-card-icon" aria-label="{{ __('View profile') }}" @if($isExternal) target="_blank" rel="noopener" @endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                            <path d="M7.85986 2.43872L1.7123 8.58629L0.702148 7.57614L6.84971 1.42857H1.43131V0H9.28843V7.85714H7.85986V2.43872Z" fill="currentColor" />
                                        </svg>
                                    </a>
                                    <div class="team-card-content">
                                        <a href="{{ $url }}" class="team-card-name" @if($isExternal) target="_blank" rel="noopener" @endif>
                                            <h2 class="h6 fz-font-2xl">{{ $team->name }}</h2>
                                        </a>
                                        @if($team->title)
                                            <p class="team-card-position fz-font-sm m-0 common-white">{{ $team->title }}</p>
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
