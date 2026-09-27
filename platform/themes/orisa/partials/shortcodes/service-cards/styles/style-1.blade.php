{{-- Service Cards Style 1: from services-3.html `sec-2-services` --}}
{{-- 4-column responsive grid; cards rotate through 3 visual variants by index --}}
@php
    $cards = $cards ?? [];
    // Card variant rotation: index 0 → card-1, 1 → card-2, 2 → card-3, 3 → card-2 ...
    $variantMap = [0 => 1, 1 => 2, 2 => 3, 3 => 2];

    $defaultIcons = [
        // Variant 1 — overlapping plus shapes
        '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path d="M7.5 15C11.6421 15 15 11.6421 15 7.5C15 11.6412 18.3563 14.9984 22.4971 15C18.3563 15.0016 15 18.3588 15 22.5C15 18.3579 11.6421 15 7.5 15C3.35786 15 5.08894e-07 18.3579 3.27835e-07 22.5L0 30L7.5 30C11.6421 30 15 26.6421 15 22.5C15 26.6421 18.3579 30 22.5 30L30 30L30 22.5C30 18.3588 26.6437 15.0016 22.5029 15C26.6437 14.9984 30 11.6412 30 7.5L30 6.31805e-06L22.5 6.64589e-06C18.3579 6.82695e-06 15 3.35787 15 7.5C15 3.35787 11.6421 5.21315e-06 7.5 5.39421e-06L2.62268e-06 3.8147e-06L1.63918e-06 7.5C1.096e-06 11.6421 3.35786 15 7.5 15Z" fill="currentColor"/></svg>',
        // Variant 2 — angled blocks
        '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path d="M15 0H30V15L15 0Z" fill="currentColor"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15 15V0H7.5L0 7.5V15V30H15H22.5L30 22.5V15H15ZM15 15V30L0 15H15Z" fill="currentColor"/></svg>',
        // Variant 3 — chevrons
        '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M30 0L20 10L10 0L0 10V30L10 20L20 30L30 20V0ZM10 20V10H20V20H10Z" fill="currentColor"/></svg>',
        // Variant 4 (rotates back to index 1 visual but distinct icon)
        '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path d="M10 10L20 0H30V10L20 20V10H10Z" fill="currentColor"/><path d="M20 20H30V30H20V20Z" fill="currentColor"/><path d="M10 10L0 20V30H10L20 20H10V10Z" fill="currentColor"/><path d="M10 10H0V0H10V10Z" fill="currentColor"/></svg>',
    ];
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="sec-2-services overflow-hidden pt-120 pb-120">
    <div class="container">
        <div class="row g-3">
            @foreach ($cards as $index => $card)
                @php
                    $variant = $variantMap[$index % 4] ?? 1;
                    $title = $card['title'] ?? '';
                    $description = $card['description'] ?? '';
                    $image = $card['image'] ?? '';
                    $url = $card['url'] ?? '#';
                    $iconSvg = $defaultIcons[$index % 4] ?? $defaultIcons[0];
                @endphp
                <div class="col-lg-3 col-md-6">
                    @include(Theme::getThemeNamespace('partials.shortcodes.service-cards.card-' . $variant), [
                        'title' => $title,
                        'description' => $description,
                        'image' => $image,
                        'url' => $url,
                        'iconSvg' => $iconSvg,
                    ])
                </div>
            @endforeach
        </div>
    </div>
</div>
