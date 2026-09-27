{{-- FAQ Style 4: from services-2.html `sec-3-services` --}}
{{-- Single-column centered numbered accordion (FAQ for services pages) --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="sec-3-services pt-120">
    <div class="container pb-150">
        <div class="row">
            <div class="col-lg-7 mx-lg-auto">
                @if ($shortcode->title)
                    <{{ $titleTag }} class="reveal-text mb-0 text-center {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
                <div class="accordion pt-40 p-relative z-index-3" id="faqAccordionStyle4">
                    @foreach ($faqs as $index => $faq)
                        @php
                            $isFirst = $index === 0;
                            $collapseId = 'faq4-' . $faq->id;
                        @endphp
                        <div class="at-faq-item bg-neutral-0 border-100 rounded-4">
                            <div class="at-faq-header d-flex gap-2">
                                <div class="box-number">
                                    <span class="at-faq-number">{{ $index + 1 }}</span>
                                </div>
                                <button class="at-faq-button {{ $isFirst ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="{{ $isFirst ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">{{ $faq->question }}</button>
                            </div>
                            <div id="{{ $collapseId }}" class="at-faq-collapse collapse {{ $isFirst ? 'show' : '' }}" data-bs-parent="#faqAccordionStyle4">
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
