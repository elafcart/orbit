{{-- FAQ Style 1: from index.html `alt-faq-area` --}}
{{-- Image + CTA left, subtitle + title + accordion right --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="alt-faq-area pt-145 pb-80">
    <div class="container">
        @php
            $hasLeftContent = $shortcode->image || $shortcode->description || $shortcode->secondary_description || $shortcode->primary_action_label;
        @endphp
        @if($hasLeftContent)
            <div class="row">
                {{-- Left: image + help text + CTA --}}
                <div class="col-lg-5">
                    <div class="alt-faq-title-wrap mb-40">
                        @if($shortcode->image)
                            <div class="rounded-4 overflow-hidden anim-zoomin">
                                <img src="{{ RvMedia::getImageUrl($shortcode->image) }}" data-speed=".8" class="w-100" alt="{{ $shortcode->title }}">
                            </div>
                        @endif

                        @if($shortcode->description)
                            <h3 class="h6 fw-600 mb-15 pt-50">{!! BaseHelper::clean($shortcode->description) !!}</h3>
                        @endif

                        @if($shortcode->secondary_description)
                            <p class="at-faq-dec mb-35">{!! BaseHelper::clean($shortcode->secondary_description) !!}</p>
                        @endif

                        @if($shortcode->primary_action_label)
                            <div class="at-btn-group at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                                <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                        <path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor" />
                                    </svg>
                                </a>
                                <a class="at-btn z-index-1" href="{{ $shortcode->primary_action_url ?: '#' }}">{{ $shortcode->primary_action_label }}</a>
                                <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                        <path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-7">
        @endif

                <div class="at-faq">
                    @if($shortcode->subtitle)
                        <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                            <span class="text-uppercase">
                                <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            </span>
                            <i>
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                            </i>
                        </span>
                    @endif

                    @if($shortcode->title)
                        <{{ $titleTag }} class="at-section-title reveal-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    @endif

                    <div class="accordion pt-50" id="faqAccordion">
                        @foreach($faqs as $index => $faq)
                            <div class="at-faq-item scroll-move-up rounded-4">
                                <div class="at-faq-header d-flex gap-2">
                                    <div class="box-number">
                                        <span class="at-faq-number">{{ $index + 1 }}</span>
                                    </div>
                                    <button class="at-faq-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq-{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">{{ $faq->question }}</button>
                                </div>
                                <div id="faq-{{ $faq->id }}" class="at-faq-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                    <div class="at-faq-body">
                                        <p>{!! BaseHelper::clean($faq->answer) !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

        @if($hasLeftContent)
                </div>
            </div>
        @endif
    </div>
</div>
