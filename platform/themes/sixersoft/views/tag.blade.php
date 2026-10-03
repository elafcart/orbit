@php
    $archiveHeading = isset($tag) && $tag ? __('Tag') . ': ' . $tag->name : __('Blog');
@endphp

@include(Theme::getThemeNamespace('views.loop'))
