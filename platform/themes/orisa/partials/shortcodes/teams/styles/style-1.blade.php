@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!}>
    <div class="container">
        @if ($shortcode->title || $shortcode->subtitle)
            <div class="row mb-50">
                <div class="col-12">
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
                    @if ($shortcode->title)
                        <{{ $titleTag }} class="reveal-text mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    @endif
                </div>
            </div>
        @endif

        <div class="row g-4">
            @foreach ($teams as $team)
                @php
                    $url = $team->website ?: ($team->url ?: '#');
                    $isExternal = $team->website && str_starts_with($team->website, 'http');
                @endphp
                <div class="col-lg-3 col-md-6 changeless">
                    <div class="team-card">
                        <div class="team-card-image">
                            <div class="anim-zoomin">
                                <img
                                    src="{{ RvMedia::getImageUrl($team->photo, null, false, RvMedia::getDefaultImage()) }}"
                                    alt="{{ $team->name }}"
                                    class="img-cover"
                                >
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
                            @if ($team->title)
                                <p class="team-card-position fz-font-sm m-0 common-white">{{ $team->title }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
