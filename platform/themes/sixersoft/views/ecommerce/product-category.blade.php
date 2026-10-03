@php
    $listingHeading = isset($category) && $category ? $category->name : __('All Products');
@endphp

@include(Theme::getThemeNamespace('views.ecommerce.products'))
