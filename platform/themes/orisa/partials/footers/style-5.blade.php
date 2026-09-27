@php
    $siteName        = theme_option('site_title', config('app.name'));
    $phone           = theme_option('footer_phone');
    $email           = theme_option('footer_email');
    $address         = theme_option('footer_address');
    $copyrightText   = Theme::getSiteCopyright();
    $footerBrandText = theme_option('footer_brand_text', $siteName);
    $connectPrefix   = theme_option('footer_connect_prefix', __("I'm"));
    $brandImageUrl   = Theme::asset()->url('images/pages/img-116.webp');

    $socialLinks = collect(\Botble\Theme\Supports\ThemeSupport::getSocialLinks())->filter(fn ($item) => $item->getUrl());
@endphp

{!! apply_filters('ads_render', null, 'footer_before', ['class' => 'my-2 text-center']) !!}

<footer class="container-2200">
    <div class="at-footer-area at-footer-style-5 mp-footer-style pt-120 pb-20 bg-neutral-0 rounded-5 mx-lg-3 mx-2 p-relative fix">
        <div class="position-absolute w-100 h-100 d-grid top-0 md:grid-cols-7 gap-0 z-0 opacity-10">
            @for ($i = 0; $i < 7; $i++)
                <div class="position-relative h-100 overflow-hidden d-md-block border-dark/01">
                    <div class="absolute bottom-0 left-0 right-0 border-white/10"></div>
                </div>
            @endfor
        </div>
        <div class="container p-relative z-index-1">
            <div class="row g-4">
                {{-- Top row: phone + copyright --}}
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        @if ($phone)
                            <p class="h6 fw-600 mb-0">
                                <a href="tel:{{ preg_replace('/[^+0-9]/', '', $phone) }}" class="text-decoration-none">{{ $phone }}</a>
                            </p>
                        @endif
                        @if ($copyrightText)
                            <span class="at-footer-copyright neutral-900 opacity-100">{!! BaseHelper::clean($copyrightText) !!}</span>
                        @endif
                    </div>
                </div>

                {{-- Email --}}
                @if ($email)
                    <div class="col-xxl-3 col-md-6">
                        <h4 class="mb-0 fw-medium text-decoration-underline">
                            <a href="mailto:{{ $email }}">{{ $email }}</a>
                        </h4>
                    </div>
                @endif

                {{-- Address --}}
                @if ($address)
                    <div class="col-xxl-3 col-lg-5 col-md-6">
                        <p class="h6 fw-600 mb-0">
                            <a href="#" class="text-decoration-none fz-font-lg fw-500">{!! BaseHelper::clean($address) !!}</a>
                        </p>
                    </div>
                @endif

                {{-- Quick links --}}
                <div class="col-xxl-3 col-lg-5 col-md-6 d-flex flex-column justify-content-between p-relative z-3">
                    <div class="at-footer-widget alt-footer-link-item-wrap row">
                        {!! dynamic_sidebar('footer_primary_sidebar') !!}
                    </div>
                </div>

                {{-- Decorative SVG --}}
                <div class="col-lg-1 col-md-6 offset-lg-1 align-self-end z-n1">
                    <div class="at-about-svg-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="57" height="91" viewBox="0 0 57 91" fill="none" aria-hidden="true">
                            <path opacity="0.1" d="M0 0L56.4024 33.572V90.336L0 56.46V0Z" fill="#515151" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="113" height="68" viewBox="0 0 113 68" fill="none" aria-hidden="true">
                            <path opacity="0.3" d="M0 33.876L56.4024 0L112.805 33.876V34.1294L56.4024 68.0054L0 34.1294V33.876Z" fill="#515151" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="57" height="91" viewBox="0 0 57 91" fill="none" aria-hidden="true">
                            <path opacity="0.2" d="M56.4009 0L8.7738e-05 33.5367V90.2413L56.4009 56.4008V0Z" fill="#515151" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Huge "I'm Brand" title + social strip --}}
            <div class="at-footer-copyright-area pt-40">
                <div class="row">
                    @if ($footerBrandText)
                        <div class="col-12">
                            <p class="h1 d-flex align-items-end justify-content-center lh-1 fz-200 mb-0 text-nowrap">
                                {{ $connectPrefix }} <img class="d-none d-md-block" src="{{ $brandImageUrl }}" alt="{{ $footerBrandText }}"> {!! BaseHelper::clean($footerBrandText) !!}<sup class="fz-80 fw-400">&reg;</sup>
                            </p>
                        </div>
                    @endif
                    @if ($socialLinks->isNotEmpty())
                        <div class="col-12">
                            <div class="bg-neutral-50 rounded-3 d-flex flex-wrap align-items-center justify-content-lg-between justify-content-center pt-10 pb-10 gap-md-4 gap-2 pl-30 pr-30" data-fade-from="bottom" data-duration="2">
                                @foreach ($socialLinks as $link)
                                    <p class="neutral-900 mb-0">
                                        <a href="{{ $link->getUrl() }}" target="_blank" rel="noopener noreferrer" class="neutral-900 text-decoration-none">[ {{ $link->getName() }} ]</a>
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="bg-neutral-50 pt-20"></div>
</footer>

{!! apply_filters('ads_render', null, 'footer_after', ['class' => 'my-2 text-center']) !!}
