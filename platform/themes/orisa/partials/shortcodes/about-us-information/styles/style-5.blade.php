{{-- About Us Style 5: from index-5.html `sec-5-home-5` --}}
{{-- Headline + contact block + row of stat counters — personal "about me" layout --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="sec-5-home-5 pt-100 pb-100">
    <div class="container">
        <div class="row g-4">
            @if($shortcode->title)
                <div class="col-xxl-8 col-lg-9">
                    <{{ $titleTag }} class="reveal-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                </div>
            @endif

            @if($shortcode->contact_heading || $shortcode->contact_address || $shortcode->contact_phone || $shortcode->contact_email)
                <div class="col-lg-3 ms-auto">
                    <div>
                        @if($shortcode->contact_heading)
                            <h4 class="h6 fw-600">{!! BaseHelper::clean($shortcode->contact_heading) !!}</h4>
                        @endif
                        <div class="d-flex flex-wrap gap-md-5 gap-4">
                            <span class="fz-font-md neutral-500">
                                @if($shortcode->contact_address)
                                    {!! nl2br(e($shortcode->contact_address)) !!}
                                    <br class="d-block">
                                @endif
                                @if($shortcode->contact_phone)
                                    {{ __('Phone:') }} <span class="neutral-900"><a href="tel:{{ preg_replace('/[^0-9+]/', '', $shortcode->contact_phone) }}">{{ $shortcode->contact_phone }}</a></span>
                                    <br class="d-block">
                                @endif
                                @if($shortcode->contact_email)
                                    {{ __('Email:') }} <span class="neutral-900"><a href="mailto:{{ $shortcode->contact_email }}">{{ $shortcode->contact_email }}</a></span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            @if(!empty($tabs))
                <div class="col-12 pt-100">
                    <div class="d-flex flex-wrap align-items-center justify-content-lg-between justify-content-center gap-md-5 gap-3">
                        @foreach($tabs as $tab)
                            @php
                                // Parse counter value: supports "25+", "$15M+", "300%", "500TB", "99.9%"
                                $value = $tab['title'] ?? '';
                                preg_match('/^([^0-9]*)([0-9.]+)(.*)$/', (string) $value, $m);
                                $prefix = $m[1] ?? '';
                                $number = $m[2] ?? $value;
                                $suffix = $m[3] ?? '';
                            @endphp
                            <div class="text-center">
                                <h2 class="h1 fw-600 mb-0">
                                    {{ $prefix }}<span class="odometer" data-count="{{ $number }}"></span>{{ $suffix }}
                                </h2>
                                @if(!empty($tab['description']))
                                    <h3 class="h6 fw-500 fz-font-md neutral-500 mb-0">{{ $tab['description'] }}</h3>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
