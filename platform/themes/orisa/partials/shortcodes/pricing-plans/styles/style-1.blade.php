@if(!empty($plans))
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="pt-120 pb-120">
    <div class="container">
        @if($shortcode->title)
            <div class="text-center mb-5">
                @if($shortcode->subtitle)
                    <span class="at-section-subtitle d-inline-block mb-3">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                @endif
                <{{ $titleTag }}@if($titleSizeClass) class="{{ $titleSizeClass }}"@endif>{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
            </div>
        @endif

        @if(!empty($plans))
            <div class="row g-4 justify-content-center">
                @foreach($plans as $plan)
                    <div class="col-lg-4 col-md-6">
                        <div @class(['at-pricing-card rounded-4 p-4 p-lg-5 h-100 p-relative', 'at-pricing-featured' => ($plan['is_featured'] ?? null) === 'yes'])>
                            @if(($plan['is_featured'] ?? null) === 'yes')
                                <span class="badge bg-primary position-absolute top-0 end-0 mt-3 me-3">{{ __('Most popular') }}</span>
                            @endif
                            <h5 class="mb-2">{{ $plan['name'] }}</h5>
                            @if(!empty($plan['description']))
                                <p class="opacity-75 mb-3">{{ $plan['description'] }}</p>
                            @endif
                            <div class="at-pricing-price mb-4">
                                <h2 class="mb-0 pricing-monthly">{{ $plan['monthly_price'] ?? '' }}</h2>
                                <h2 class="mb-0 pricing-yearly d-none">{{ $plan['yearly_price'] ?? '' }}</h2>
                                <span class="opacity-50 pricing-monthly">{{ __('/month') }}</span>
                                <span class="opacity-50 pricing-yearly d-none">{{ __('/year') }}</span>
                            </div>
                            @if(!empty($plan['features']))
                                <ul class="at-pricing-features list-unstyled mb-4">
                                    @foreach(explode("\n", $plan['features']) as $feature)
                                        @php
                                            $feature = trim($feature);
                                            // A line starting with "-" marks a feature that is NOT included in this plan.
                                            $isExcluded = str_starts_with($feature, '-');
                                            $feature = trim(ltrim($feature, '-'));
                                        @endphp
                                        @if($feature)
                                            <li class="d-flex align-items-center gap-2 mb-2" @if($isExcluded) style="opacity: .45;" @endif>
                                                <span @class(['text-primary' => ! $isExcluded])>{!! BaseHelper::renderIcon($isExcluded ? 'ti ti-x' : 'ti ti-check') !!}</span>
                                                <span>{{ $feature }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                            @if(!empty($plan['button_label']))
                                <a href="{{ $plan['button_url'] ?? '#' }}" class="at-btn w-100 justify-content-center">
                                    <span>
                                        <span class="text-1">{{ $plan['button_label'] }}</span>
                                        <span class="text-2">{{ $plan['button_label'] }}</span>
                                    </span>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endif
