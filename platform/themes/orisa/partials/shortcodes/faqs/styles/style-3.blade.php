{{-- FAQ Style 3: from pricing.html `sec-7-about` ~line 884 --}}
{{-- Left subtitle+title, right accordion (2-column simple) --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="sec-7-about py-5 overflow-hidden">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4">
                @if ($shortcode->subtitle)
                    <span class="at-btn common-black text-uppercase bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        </span>
                    </span>
                @endif

                @if ($shortcode->title)
                    <{{ $titleTag }} class="section-title lh-1 reveal-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif

                @if ($shortcode->description)
                    <h4 class="h6 fz-font-lg fw-500 neutral-600 mt-3">
                        {!! BaseHelper::clean($shortcode->description) !!}
                    </h4>
                @endif
            </div>

            <div class="col-lg-7 ms-lg-auto">
                <div class="accordion pt-lg-5" id="faqAccordionStyle3">
                    @foreach ($faqs as $index => $faq)
                        <div class="at-faq-item bg-neutral-0 border-100 scroll-move-up rounded-4">
                            <div class="at-faq-header d-flex gap-2">
                                <div class="box-number">
                                    <span class="at-faq-number">{{ $index + 1 }}</span>
                                </div>
                                <button class="at-faq-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq3-{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">{{ $faq->question }}</button>
                            </div>
                            <div id="faq3-{{ $faq->id }}" class="at-faq-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordionStyle3">
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
</section>
