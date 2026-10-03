@php
    $listingHeading = isset($tag) && $tag ? __('Tag') . ': ' . $tag->name : __('All Products');
@endphp

@include(Theme::getThemeNamespace('views.ecommerce.products'))
