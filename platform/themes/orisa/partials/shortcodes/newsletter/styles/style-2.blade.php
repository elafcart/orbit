{{-- Newsletter Style 2: from index-3.html `home-3-section-12` --}}
{{-- Light box with ripple image left, title+desc center, form right. --}}
{{-- NOTE: Uses `image` attribute (not `background_image`) to avoid the base Shortcode
     compiler auto-painting the image as a CSS background on the block wrapper. --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="home-3-section-12 pb-100">
    <div class="container">
        <div class="box-newsletter bg-neutral-50 pt-80 pb-100 px-md-5 px-4">
            <div class="row g-4">
                @if($shortcode->image)
                    <div class="col-lg-2">
                        <div class="ripple-image ripples rounded-3 overflow-hidden d-inline-flex">
                            {{ RvMedia::image($shortcode->image, $shortcode->title ?? 'Newsletter', attributes: ['class' => 'img-cover']) }}
                        </div>
                    </div>
                @endif

                <div class="col-lg-5">
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
                        <{{ $titleTag }} class="reveal-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    @endif

                    @if($shortcode->description)
                        <p class="fz-font-xl mb-0">{!! BaseHelper::clean($shortcode->description) !!}</p>
                    @endif
                </div>

                <div class="col-lg-4 ms-auto align-self-end">
                    {!!
                        /** @var \Botble\Newsletter\Forms\Fronts\NewsletterForm $form */
                        $form
                            ->setFormInputWrapperClass('input-subscribe p-relative changeless')
                            ->setFormInputClass('bg-neutral-0')
                            ->setFormLabelClass('d-none')
                            ->modify(
                                'submit',
                                'submit',
                                \Botble\Base\Forms\FieldOptions\ButtonFieldOption::make()
                                    // `changeless` pins the neutral palette to its light-mode
                                    // values. The arrow below is a hardcoded white stroke, so
                                    // without it `bg-neutral-900` inverted in dark mode and the
                                    // button turned near-white — a white arrow on a white button
                                    // (ticket 4576446). The field it sits in is `changeless` too,
                                    // so the pair stays dark-on-white in both modes.
                                    ->cssClass('p-absolute end-0 top-50 bg-neutral-900 rounded-3 size-56 translate-middle-y me-3 changeless')
                                    ->label('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M9.33333 3.33301L14 7.99967M14 7.99967L9.33333 12.6663M14 7.99967H2" stroke="#FEFEFE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>')
                            )
                            ->renderForm()
                    !!}
                    <p class="mb-0 pt-20">{{ __('By clicking the button, you are') }} <br> {{ __('agreeing with our') }} <a href="#" class="neutral-900">{{ __('Term & Conditions') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
