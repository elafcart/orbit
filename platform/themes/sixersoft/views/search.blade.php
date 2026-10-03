@php
    $query = (string) request()->input('q', '');
    $archiveHeading = $query !== '' ? __('Search results for ":query"', ['query' => $query]) : __('Search');
@endphp

@include(Theme::getThemeNamespace('views.loop'))
