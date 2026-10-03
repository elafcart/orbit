@php
    $archiveHeading = isset($category) && $category ? $category->name : __('Blog');
@endphp

@include(Theme::getThemeNamespace('views.loop'))
