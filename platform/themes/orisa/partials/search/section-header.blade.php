{{-- Section label + heading for one content type on the search results page.
     Vars: $label, $heading, and optionally $ctaUrl + $ctaLabel for a trailing button. --}}
@php
    $arrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 0 9.9375 0L3.1875 0C2.77329 0 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $ctaUrl ??= null;
@endphp

<div class="row align-items-center pb-50">
    <div class="col-lg-8 mb-lg-0 mb-3">
        <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
            <span class="text-uppercase">
                <span class="text-1">{{ $label }}</span>
                <span class="text-2">{{ $label }}</span>
            </span>
            <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
        </span>
        <h2 class="h3 fw-500 mb-0">{{ $heading }}</h2>
    </div>
    @if ($ctaUrl)
        <div class="col-lg-4">
            <div class="d-flex justify-content-lg-end">
                <a href="{{ $ctaUrl }}" class="at-btn">
                    <span>
                        <span class="text-1">{{ $ctaLabel }}</span>
                        <span class="text-2">{{ $ctaLabel }}</span>
                    </span>
                    <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                </a>
            </div>
        </div>
    @endif
</div>
