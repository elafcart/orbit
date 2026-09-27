@php
    // Breadcrumb is disabled by default in Orisa theme — the HTML reference has no breadcrumb on any page.
    // All pages use their own top padding (pt-100) to clear the absolutely positioned header.
    // Pages can opt-in via page meta 'breadcrumb_enabled' = '1' if needed.
    $breadcrumbEnabled = \Theme\Orisa\Support\ThemeHelper::isBreadcrumbEnabled();

    // Header style 1 overlays the page as an absolutely positioned transparent bar, so it
    // takes no vertical space. This block is the first child of <main>, which means without
    // its own top padding the title and crumbs render underneath the header and collide with
    // the logo. Carry the same pt-100 clearance the page content would otherwise apply.
    $needsHeaderClearance = (int) theme_option('header_style', 1) === 1
        && theme_option('header_transparent', true);
@endphp

@if ($breadcrumbEnabled)
    <section class="at-breadcrumb-area section-page-header {{ $needsHeaderClearance ? 'pt-100 pb-8' : 'py-8' }} fix position-relative"
        @if (($bgColor = theme_option('breadcrumb_background_color')) && $bgColor !== 'transparent')
            style="background-color: {{ $bgColor }} !important;"
        @endif
    >
        <div class="container position-relative z-1">
            <div class="text-start">
                <h3>{{ SeoHelper::getTitleOnly() }}</h3>
                <ol class="ps-0 d-flex list-unstyled align-items-center flex-wrap gap-1" aria-label="{{ __('Breadcrumb') }}">
                    @foreach (Theme::breadcrumb()->getCrumbs() as $crumb)
                        @if ($loop->last)
                            <li class="d-flex align-items-center" aria-current="page">
                                @if (! $loop->first)
                                    <svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="6" height="10" viewBox="0 0 8 13" fill="none" aria-hidden="true">
                                        <path d="M1 1.5L6.5 6.75L1 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                @endif
                                <span class="mb-0">{{ $crumb['label'] }}</span>
                            </li>
                        @else
                            <li class="d-flex align-items-center">
                                @if (! $loop->first)
                                    <svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="6" height="10" viewBox="0 0 8 13" fill="none" aria-hidden="true">
                                        <path d="M1 1.5L6.5 6.75L1 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                @endif
                                <a href="{{ $crumb['url'] }}" class="text-primary">{{ $crumb['label'] }}</a>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>

        @if ($bgImage = \Theme\Orisa\Support\ThemeHelper::sanitizeCommaCorruptedImage(theme_option('breadcrumb_background_image')))
            {{ RvMedia::image($bgImage, __('Background image'), attributes: ['class' => 'position-absolute bottom-0 start-0 end-0 top-0 z-0 h-100 w-100 object-fit-cover']) }}
        @endif
    </section>
@endif
