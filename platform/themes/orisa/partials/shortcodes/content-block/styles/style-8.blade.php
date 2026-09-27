{{-- Content Block Style 8: Inner page hero from services-1.html `sec-1-services` --}}
{{-- Large brand title + contact info right + full-bleed banner image --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="sec-1-services pt-150 border-bottom-100 overflow-hidden">
    <div class="container">
        <div class="row align-items-center mb-20">
            <div class="col-lg-9">
                @if ($shortcode->title)
                    <{{ $titleTag }} class="section-title d-flex fw-600 fz-200 reveal-text mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
            </div>
            @php
                $email = $shortcode->email ?: theme_option('footer_email');
                $phone = $shortcode->phone ?: theme_option('footer_phone');
            @endphp
            @if ($email || $phone)
                <div class="col-lg-3 ms-auto text-lg-end">
                    @if ($email)
                        <p class="h5 mb-0">
                            <a href="mailto:{{ $email }}" class="text-decoration-none">{{ $email }}</a>
                        </p>
                    @endif
                    @if ($phone)
                        <p class="h6 fw-600 mb-0">
                            <a href="tel:{{ $phone }}" class="text-decoration-none">{{ $phone }}</a>
                        </p>
                    @endif
                </div>
            @endif
        </div>
    </div>
    @if ($shortcode->image)
        <div class="at-banner-thumb overflow-hidden scale-up-img">
            <img class="img-cover scale-up" data-speed=".4" src="{{ RvMedia::getImageUrl($shortcode->image) }}" alt="{{ \Theme\Orisa\Support\ThemeHelper::resolveImageAlt($shortcode->image, $shortcode->title) }}">
        </div>
    @endif
</div>
