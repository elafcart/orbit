@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section class="sec-4-about bg-neutral-0 pt-120 pb-120" {!! $shortcode->htmlAttributes() !!}>
    <div class="container">
        <div class="row g-4 align-items-end mb-50">
            <div class="col-lg-6">
                @if($shortcode->subtitle)
                    <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        </span>
                        <i>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor" />
                            </svg>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor" />
                            </svg>
                        </i>
                    </span>
                @endif
                @if($shortcode->title)
                    <{{ $titleTag }} class="h1 alt-section-title fz-ds-1 lh-1 fw-500 mb-30 reveal-text mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
            </div>
            @if($shortcode->description)
                <div class="col-xxl-4 col-lg-6 col-md-8 ms-lg-auto text-lg-end">
                    <div class="scroll-rotate d-lg-inline-block d-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M53.5715 0H46.4286V41.3778L17.17 12.1193L12.1193 17.17L41.3778 46.4286H0V53.5715H41.3778L12.1193 82.83L17.17 87.8805L46.4286 58.622V100H53.5715V58.622L82.83 87.8805L87.8805 82.83L58.622 53.5715H100V46.4286H58.622L87.8805 17.17L82.83 12.1193L53.5715 41.3778V0Z" fill="currentColor" />
                        </svg>
                    </div>
                    <p class="fz-font-lg pt-lg-4 mb-0">{!! BaseHelper::clean($shortcode->description) !!}</p>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-xxl-4 col-lg-5">
                @if($shortcode->address || $shortcode->phone || $shortcode->email || $shortcode->address_2 || $shortcode->phone_2 || $shortcode->email_2)
                    <div class="row g-4 mb-4">
                        @if($shortcode->address || $shortcode->phone || $shortcode->email)
                        <div class="col-lg-12 col-md-6">
                            <div class="d-flex gap-4">
                                <div class="icon">
                                    @if($shortcode->address_icon)
                                        <x-core::icon :name="$shortcode->address_icon" style="width:40px;height:40px;" />
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                            <path d="M20 40V20H0L20 0L40 20V40H20Z" fill="currentColor" />
                                            <path d="M0 20L20 40H0V20Z" fill="currentColor" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="h6 fw-600">{{ $shortcode->address_label ?: __('Office') }}</h3>
                                    <div class="d-flex flex-wrap gap-md-5 gap-4">
                                        <span class="fz-font-md neutral-500">
                                            @if($shortcode->address)
                                                {!! BaseHelper::clean(nl2br($shortcode->address)) !!}
                                                <br class="d-block">
                                            @endif
                                            @if($shortcode->phone)
                                                {{ __('Phone') }}: <span class="neutral-900"><a href="tel:{{ $shortcode->phone }}">{{ $shortcode->phone }}</a></span>
                                                <br class="d-block">
                                            @endif
                                            @if($shortcode->email)
                                                {{ __('Email') }}: <span class="neutral-900"><a href="mailto:{{ $shortcode->email }}">{{ $shortcode->email }}</a></span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($shortcode->address_2 || $shortcode->phone_2 || $shortcode->email_2)
                        <div class="col-lg-12 col-md-6">
                            <div class="d-flex gap-4 pt-lg-5">
                                <div class="icon">
                                    @if($shortcode->address_icon_2)
                                        <x-core::icon :name="$shortcode->address_icon_2" style="width:40px;height:40px;" />
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                            <path d="M20 20V10L30 0H40V10L30 20H20Z" fill="currentColor" />
                                            <path d="M20 30V20H10L20 10L10 0H0V20H10L0 30V40H10L20 30Z" fill="currentColor" />
                                            <path d="M20 30L30 40H40V20H30L20 30Z" fill="currentColor" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="h6 fw-600">{{ $shortcode->address_label_2 ?: __('Office') }}</h3>
                                    <div class="d-flex flex-wrap gap-md-5 gap-4">
                                        <span class="fz-font-md neutral-500">
                                            @if($shortcode->address_2)
                                                {!! BaseHelper::clean(nl2br($shortcode->address_2)) !!}
                                                <br class="d-block">
                                            @endif
                                            @if($shortcode->phone_2)
                                                {{ __('Phone') }}: <span class="neutral-900"><a href="tel:{{ $shortcode->phone_2 }}">{{ $shortcode->phone_2 }}</a></span>
                                                <br class="d-block">
                                            @endif
                                            @if($shortcode->email_2)
                                                {{ __('Email') }}: <span class="neutral-900"><a href="mailto:{{ $shortcode->email_2 }}">{{ $shortcode->email_2 }}</a></span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                @endif
                
                @if (($socialLinks = Theme::getSocialLinks()) && count($socialLinks) > 0)
                    <div class="row">
                        <div class="col-xxl-6 col-lg-8 mx-auto">
                            <ul class="at-social-list list-unstyled d-flex flex-wrap gap-md-4 gap-3 pt-50">
                                @foreach($socialLinks as $social)
                                    <li>
                                        <a href="{{ $social->getUrl() }}" class="at-social__link d-flex align-items-center gap-2" aria-label="{{ $social->getName() }}">
                                            {!! $social->getIconHtml() !!}
                                            <span class="fw-500">{{ $social->getName() }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="col-xxl-8 col-lg-7 ms-auto pt-lg-0 pt-30">
                {!! 
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
                                    '<span><span class="text-1 text-capitalize">' . __('Send Message') . '</span><span class="text-2 text-capitalize">' . __('Send Message') . '</span></span>'
                                    . '<i><svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg><svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg></i>'
                                )
                        )
                        ->renderForm() 
                !!}
            </div>
        </div>
    </div>
</section>
