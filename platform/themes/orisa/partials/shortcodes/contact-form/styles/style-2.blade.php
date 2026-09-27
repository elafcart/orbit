@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="sec-1-contact overflow-hidden pt-120">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-xxl-6 col-lg-7">
                <div class="at-about-title-wrap mb-30">
                    @if($shortcode->subtitle)
                        <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
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
                        <{{ $titleTag }} class="at-section-title reveal-text mb-lg-0 mb-4 {{ $titleSizeClass }}">
                            {!! BaseHelper::clean($shortcode->title) !!}
                        </{{ $titleTag }}>
                    @endif

                    @if($shortcode->address || $shortcode->phone || $shortcode->email)
                        <div class="at-about-content d-flex flex-md-row flex-column justify-content-between gap-4 pt-40">
                            @if($shortcode->address || $shortcode->phone || $shortcode->email)
                                <div class="d-flex gap-4 w-lg-50">
                                    <div class="icon flex-shrink-0">
                                        @if($shortcode->address_icon)
                                            <x-core::icon :name="$shortcode->address_icon" style="width:40px;height:40px;" />
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none" aria-hidden="true">
                                                <path d="M20 40V20H0L20 0L40 20V40H20Z" fill="currentColor"/>
                                                <path d="M0 20L20 40H0V20Z" fill="currentColor"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="h6 fw-600">{{ $shortcode->address_label ?: __('Office') }}</h3>
                                        <span class="fz-font-md neutral-500">
                                            @if($shortcode->address)
                                                {!! BaseHelper::clean(nl2br($shortcode->address)) !!}<br class="d-block">
                                            @endif
                                            @if($shortcode->phone)
                                                {{ __('Phone') }}: <span class="neutral-900"><a href="tel:{{ $shortcode->phone }}">{{ $shortcode->phone }}</a></span><br class="d-block">
                                            @endif
                                            @if($shortcode->email)
                                                {{ __('Email') }}: <span class="neutral-900"><a href="mailto:{{ $shortcode->email }}">{{ $shortcode->email }}</a></span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endif

                            @if($shortcode->address_2 || $shortcode->phone_2 || $shortcode->email_2)
                                <div class="d-flex gap-4 w-lg-50">
                                    <div class="icon flex-shrink-0">
                                        @if($shortcode->address_icon_2)
                                            <x-core::icon :name="$shortcode->address_icon_2" style="width:40px;height:40px;" />
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none" aria-hidden="true">
                                                <path d="M20 20V10L30 0H40V10L30 20H20Z" fill="currentColor"/>
                                                <path d="M20 30V20H10L20 10L10 0H0V20H10L0 30V40H10L20 30Z" fill="currentColor"/>
                                                <path d="M20 30L30 40H40V20H30L20 30Z" fill="currentColor"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="h6 fw-600">{{ $shortcode->address_label_2 ?: __('Studio') }}</h3>
                                        <span class="fz-font-md neutral-500">
                                            @if($shortcode->address_2)
                                                {!! BaseHelper::clean(nl2br($shortcode->address_2)) !!}<br class="d-block">
                                            @endif
                                            @if($shortcode->phone_2)
                                                {{ __('Phone') }}: <span class="neutral-900"><a href="tel:{{ $shortcode->phone_2 }}">{{ $shortcode->phone_2 }}</a></span><br class="d-block">
                                            @endif
                                            @if($shortcode->email_2)
                                                {{ __('Email') }}: <span class="neutral-900"><a href="mailto:{{ $shortcode->email_2 }}">{{ $shortcode->email_2 }}</a></span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            @if($shortcode->description)
                <div class="col-xxl-4 col-lg-5 col-md-8 ms-xxl-auto">
                    <h4 class="h6 mb-4 fz-font-lg">{!! BaseHelper::clean($shortcode->description) !!}</h4>
                </div>
            @endif
        </div>

        {{-- Form row --}}
        <div class="row g-5 pt-120 align-items-end">
            <div class="col-xxl-6 col-lg-7">
                <h4>{{ __('Drop us a line') }}</h4>
                {!!
                    /** @var \Botble\Contact\Forms\Fronts\ContactForm $form */
                    $form
                        ->setFormOption('class', 'contact-form sec-4-about-form')
                        ->setFormLabelClass('d-none')
                        ->setFormInputWrapperClass('sec-4-about-form__field')
                        ->setFormInputClass('sec-4-about-form__input')
                        ->modify('content', 'textarea', \Botble\Base\Forms\FieldOptions\TextareaFieldOption::make()
                            ->cssClass('sec-4-about-form__input sec-4-about-form__textarea')
                            ->attributes(['rows' => 5]))
                        ->modify(
                            'submit',
                            'submit',
                            \Botble\Base\Forms\FieldOptions\ButtonFieldOption::make()
                                ->cssClass('sec-4-about-form__btn at-btn')
                                ->label(
                                    '<span><span class="text-1">' . __('Send Message') . '</span><span class="text-2">' . __('Send Message') . '</span></span>'
                                    . '<i><svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg></i>'
                                )
                        )
                        ->renderForm()
                !!}
            </div>

            @if($shortcode->map_url)
                <div class="col-xxl-5 col-lg-5 ms-auto">
                    <div class="ratio ratio-4x3 rounded-3 overflow-hidden">
                        <iframe
                            src="{{ $shortcode->map_url }}"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                            title="{{ __('Map') }}"
                        ></iframe>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
