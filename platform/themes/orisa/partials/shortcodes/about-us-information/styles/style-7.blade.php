{{-- About Us Style 7: from services-1.html `sec-1-services` --}}
{{-- Brand title + email + phone in right column + full-width banner image below --}}
@php
    $email = trim((string) ($shortcode->email ?? ''));
    $phone = trim((string) ($shortcode->phone ?? ''));
    $phoneTel = $phone ? preg_replace('/[^0-9+]/', '', $phone) : '';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="sec-1-services pt-150 border-bottom-100 overflow-hidden">
    <div class="container">
        <div class="row align-items-center mb-20">
            @if ($shortcode->title)
                <div class="col-lg-9">
                    <{{ $titleTag }} class="section-title d-flex fw-600 fz-200 reveal-text mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                </div>
            @endif

            @if ($email || $phone)
                <div class="col-lg-3 ms-auto text-lg-end">
                    @if ($email)
                        <p class="h5 mb-0">
                            <a href="mailto:{{ $email }}" class="text-decoration-none">{{ $email }}</a>
                        </p>
                    @endif
                    @if ($phone)
                        <p class="h6 fw-600 mb-0">
                            <a href="tel:{{ $phoneTel }}" class="text-decoration-none">{{ $phone }}</a>
                        </p>
                    @endif
                </div>
            @endif
        </div>
    </div>
    @if ($shortcode->image)
        <div class="at-banner-thumb overflow-hidden scale-up-img">
            {{ RvMedia::image($shortcode->image, $shortcode->title ?? 'Orisa', attributes: ['class' => 'img-cover scale-up', 'data-speed' => '.4']) }}
        </div>
    @endif
</div>
