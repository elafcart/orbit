@php
    $displayBlogTopSidebar = false;
    // Category archives render their own H1 (the category name, or an "archive_h1" meta value
    // when the site stores one), so the listing is never left without a top-level heading.
    $archiveHeading = \Theme\Orisa\Support\ThemeHelper::archiveHeading($category ?? null);
@endphp

@include(Theme::getThemeNamespace('views.loop'))
