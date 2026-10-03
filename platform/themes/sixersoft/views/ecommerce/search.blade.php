@php
    $query = $query ?? (string) request()->input('q', '');
    $listingHeading = $query !== '' ? __('Search results for ":query"', ['query' => $query]) : __('Search');
@endphp

@include(Theme::getThemeNamespace('views.ecommerce.products'))
