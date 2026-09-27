@php
    $displayBlogTopSidebar = false;
    // Tag archives render their own H1 for the same reason category archives do.
    $archiveHeading = \Theme\Orisa\Support\ThemeHelper::archiveHeading($tag ?? null);
@endphp

@include(Theme::getThemeNamespace('views.loop'))
