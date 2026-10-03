@php
    $listingHeading = isset($brand) && $brand ? $brand->name : __('All Products');
@endphp

@include(Theme::getThemeNamespace('views.ecommerce.products'))
