@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section
    {!! $shortcode->htmlAttributes() !!}
    class="at-newsletter-area pt-120 pb-120 bg-neutral-950 changeless p-relative"
    @if($shortcode->background_image)
        style="background-image: url('{{ RvMedia::getImageUrl($shortcode->background_image) }}'); background-size: cover; background-position: center;"
    @endif
>
    <div class="container p-relative z-1">
        <div class="row align-items-center justify-content-between g-5">
            <div class="col-lg-6">
                @if($shortcode->subtitle)
                    <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0 text-white">
                        <span class="text-uppercase">
                            <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        </span>
                        <i>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/>
                            </svg>
                        </i>
                    </span>
                @endif

                @if($shortcode->title)
                    <{{ $titleTag }} class="text-white mb-4 reveal-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif

                @if($shortcode->description)
                    <p class="text-white opacity-75 mb-0">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif
            </div>

            <div class="col-lg-5">
                {!!
                    /** @var \Botble\Newsletter\Forms\Fronts\NewsletterForm $form */
                    $form
                        ->setFormInputWrapperClass('sec-4-about-form__field')
                        ->setFormInputClass('sec-4-about-form__input')
                        ->setFormLabelClass('d-none')
                        ->modify(
                            'submit',
                            'submit',
                            \Botble\Base\Forms\FieldOptions\ButtonFieldOption::make()
                                ->cssClass('at-btn mt-3 w-100')
                                ->label(
                                    '<span><span class="text-1">' . ($shortcode->button_label ?: __('Subscribe')) . '</span><span class="text-2">' . ($shortcode->button_label ?: __('Subscribe')) . '</span></span>'
                                    . '<i><svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg></i>'
                                )
                        )
                        ->renderForm()
                !!}
            </div>
        </div>
    </div>
</section>
