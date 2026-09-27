{{-- Content Block Style 9: FAQ page hero from faqs.html `sec-1-faqs` --}}
{{-- Subtitle + title + description left, search input right, bg-neutral-50 --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="sec-1-faqs overflow-hidden pt-150 pb-120 bg-neutral-50">
    <div class="container">
        <div class="row g-4 align-items-end">
            <div class="col-xxl-5 col-lg-6 pt-lg-0 pt-100">
                @if ($shortcode->subtitle)
                    <span class="at-btn common-black text-uppercase bg-transparent mb-10 rounded-0 p-0">
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
                @if ($shortcode->title)
                    <{{ $titleTag }} class="section-title d-flex fw-600 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
                @if ($shortcode->description)
                    <p class="neutral-600 fz-font-xl">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif
            </div>
            @if ($shortcode->primary_action_label)
                <div class="col-xxl-5 col-lg-6 ms-auto">
                    <div
                        class="input-subscribe p-relative changeless"
                        data-faq-search-form
                        role="search"
                        aria-label="{{ __('Search FAQs') }}"
                    >
                        <input
                            placeholder="{{ $shortcode->primary_action_label }}"
                            type="search"
                            class="bg-neutral-0"
                            data-faq-search-input
                            aria-label="{{ $shortcode->primary_action_label }}"
                        >
                        <button type="button" class="at-btn p-absolute end-0 top-50 bg-neutral-900 rounded-3 translate-middle-y me-4" data-faq-search-submit>
                            <i class="icon-arrow-right">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none" aria-hidden="true"><path d="M8.33333 1L13 5.66667M13 5.66667L8.33333 10.3333M13 5.66667H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none" aria-hidden="true"><path d="M8.33333 1L13 5.66667M13 5.66667L8.33333 10.3333M13 5.66667H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </i>
                            @if ($shortcode->secondary_action_label)
                                <span>
                                    <span class="text-1">{{ $shortcode->secondary_action_label }}</span>
                                    <span class="text-2">{{ $shortcode->secondary_action_label }}</span>
                                </span>
                            @endif
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    (function () {
        function init() {
            document.querySelectorAll('[data-faq-search-form]').forEach(function (wrapper) {
                if (wrapper.dataset.searchBound === '1') return;
                wrapper.dataset.searchBound = '1';

                var input = wrapper.querySelector('[data-faq-search-input]');
                if (!input) return;

                var apply = function (scrollOnMatch) {
                    var query = (input.value || '').trim().toLowerCase();
                    var items = document.querySelectorAll('.at-faq-item');
                    if (!items.length) return;

                    var firstHit = null;
                    items.forEach(function (item) {
                        if (!query) {
                            item.style.display = '';
                            return;
                        }
                        var hit = (item.textContent || '').toLowerCase().indexOf(query) !== -1;
                        item.style.display = hit ? '' : 'none';
                        if (hit && !firstHit) firstHit = item;
                    });

                    if (scrollOnMatch && firstHit) {
                        firstHit.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                };

                // Live filter (debounced)
                var debounceTimer = null;
                input.addEventListener('input', function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function () { apply(false); }, 150);
                });

                // Enter key submits + scrolls to first match
                input.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        apply(true);
                    }
                });

                // Button click submits + scrolls
                var submit = wrapper.querySelector('[data-faq-search-submit]');
                if (submit) {
                    submit.addEventListener('click', function (event) {
                        event.preventDefault();
                        apply(true);
                    });
                }
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
</script>
