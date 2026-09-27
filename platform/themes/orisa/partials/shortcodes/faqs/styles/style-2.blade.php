{{-- FAQ Style 2: from faqs.html — image-left accordion-right with numbered feature cards on top --}}
{{-- Features numbered list (title_N/description_N/icon_image_N) + accordion + image --}}
@php
    $features = $features ?? [];
    $bg = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : '';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="alt-faq-area pt-120 pb-120 p-relative overflow-hidden"
    @if ($bg) style="background-image: url('{{ $bg }}'); background-size: cover; background-position: center;" @endif>
    <div class="container p-relative z-1">
        <div class="row g-5">
            {{-- Left: image + title --}}
            <div class="col-lg-5">
                <div class="alt-faq-title-wrap mb-40">
                    @if ($shortcode->title)
                        <{{ $titleTag }} class="at-section-title reveal-text mb-3 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($shortcode->description)
                        <p class="at-faq-dec neutral-600 mb-30">{!! BaseHelper::clean($shortcode->description) !!}</p>
                    @endif

                    @if ($shortcode->image)
                        <div class="rounded-4 overflow-hidden anim-zoomin">
                            <img src="{{ RvMedia::getImageUrl($shortcode->image) }}" data-speed=".8" class="w-100" alt="{{ $shortcode->title }}">
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: accordion + feature cards --}}
            <div class="col-lg-7">
                @if (! empty($features))
                    <div class="row g-3 mb-40">
                        @foreach ($features as $feature)
                            <div class="col-md-{{ count($features) >= 3 ? 4 : 6 }}">
                                <div class="at-service-card bg-neutral-0 border-100 rounded-4 p-4 h-100">
                                    @if (! empty($feature['icon_image']))
                                        <div class="at-service-card-icon mb-3">
                                            <img src="{{ RvMedia::getImageUrl($feature['icon_image']) }}" alt="{{ $feature['title'] }}" style="width: 48px; height: 48px; object-fit: contain;">
                                        </div>
                                    @endif
                                    <h4 class="h6 fw-600 mb-2">{!! BaseHelper::clean($feature['title']) !!}</h4>
                                    @if (! empty($feature['description']))
                                        <p class="fz-font-sm neutral-600 mb-0">{!! BaseHelper::clean($feature['description']) !!}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="at-faq">
                    <div class="accordion" id="faqAccordion{{ $shortcode->style ?? 2 }}">
                        @foreach ($faqs as $index => $faq)
                            <div class="at-faq-item scroll-move-up rounded-4 bg-neutral-0 border-100">
                                <div class="at-faq-header d-flex gap-2">
                                    <div class="box-number">
                                        <span class="at-faq-number">{{ $index + 1 }}</span>
                                    </div>
                                    <button class="at-faq-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">{{ $faq->question }}</button>
                                </div>
                                <div id="faq2-{{ $faq->id }}" class="at-faq-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion{{ $shortcode->style ?? 2 }}">
                                    <div class="at-faq-body">
                                        <p>{!! BaseHelper::clean($faq->answer) !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
