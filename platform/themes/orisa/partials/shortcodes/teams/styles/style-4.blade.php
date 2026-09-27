{{-- Teams Style 4: from about-2.html `team-card-2` ~line 700 --}}
{{-- Header with title + stats, 3-column grid of team-card-2 with hover social overlay --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="pt-120 pb-120">
    <div class="container">
        <div class="row align-items-end pb-60 g-4">
            <div class="col-xxl-1 col-lg-2">
                @if ($shortcode->subtitle)
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
            </div>
            <div class="col-lg-7 col-md-7">
                @if ($shortcode->title)
                    <{{ $titleTag }} class="h3 reveal-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
            </div>
            @if ($shortcode->experience_years)
                <div class="col-lg-3 col-md-5 ms-auto text-center">
                    <h2 class="h1 fz-ds-1 fw-500 mb-0 lh-1"><span class="odometer" data-count="{{ $shortcode->experience_years }}"></span>+</h2>
                    @if ($shortcode->description)
                        <h3 class="h6 fw-500 mb-0">{!! BaseHelper::clean($shortcode->description) !!}</h3>
                    @endif
                </div>
            @elseif ($shortcode->primary_action_label)
                <div class="col-lg-3 col-md-5 ms-auto text-lg-end">
                    <div class="at-btn-group at_fade_anim d-inline-flex" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
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
                </div>
            @endif
        </div>

        <div class="row g-4">
            @foreach ($teams as $team)
                @php
                    $url = $team->website ?: ($team->url ?: '#');
                    $isExternal = $team->website && str_starts_with($team->website, 'http');
                @endphp
                <div class="col-xxl-4 col-lg-6 col-12">
                    <div class="team-card-2">
                        <div class="team-card-2__image">
                            <div class="anim-zoomin">
                                <img src="{{ RvMedia::getImageUrl($team->photo, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $team->name }}" class="img-cover">
                            </div>
                        </div>
                        <div class="team-card-2__content at_fade_anim" data-delay=".2">
                            <a href="{{ $url }}" class="team-card-2__name" @if($isExternal) target="_blank" rel="noopener" @endif>
                                <h4 class="h6 fz-font-2xl fw-600 m-0">{{ $team->name }}</h4>
                            </a>
                            @if ($team->title)
                                <span class="team-card-2__position">{{ $team->title }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
