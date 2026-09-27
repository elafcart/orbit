@php
    Theme::set('hideBreadcrumb', true);
    $serviceImages = array_filter(array_merge(
        $service->image ? [$service->image] : [],
        is_array($service->images) ? $service->images : []
    ));
    $serviceCategory = $service->category;

    // Content width, mirroring the "Full width" page template Pages already offer.
    // Registered on the service form in functions/functions.php.
    $isFullWidth = $service->getMetaData('content_width', true) === 'full-width';
    $containerClass = $isFullWidth ? 'container-fluid px-lg-5' : 'container';
    $columnClass = $isFullWidth ? 'col-12' : 'col-lg-8 mx-auto';
@endphp

{!! apply_filters('ads_render', null, 'service_before', ['class' => 'my-2 text-center']) !!}

<!-- Services details section 1 -->
<div class="sec-1-services-details overflow-hidden at-header-offset">
    <div class="{{ $containerClass }}">
        <div class="row">
            <div class="{{ $columnClass }}">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="icon-arrow-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M12.1716 8.77815L8.55964e-06 8.77816L1.47897e-06 6.77817L12.1716 6.77816L6.80761 1.41421L8.22183 3.37371e-08L16 7.77815L8.22181 15.5563L6.80759 14.1421L12.1716 8.77815Z" fill="currentColor" />
                        </svg>
                    </i>
                    <span class="text-uppercase neutral-900 fw-600">
                        <span class="text-1">
                            <a href="{{ route('public.index') }}">{{ __('services') }} /</a>
                        </span>
                        <span class="text-1 neutral-500">
                            {!! BaseHelper::clean($service->name) !!}
                        </span>
                    </span>
                </div>

                <h1 class="section-title d-flex fw-600 reveal-text mb-20">{!! BaseHelper::clean($service->name) !!}</h1>

                @if($service->description)
                    <h2 class="h6 fw-600 reveal-text mb-30">{!! BaseHelper::clean($service->description) !!}</h2>
                @endif

                @if($serviceCategory)
                    <div class="at-hero-social style-2 justify-content-start">
                        <a href="#">
                            {!! BaseHelper::clean($serviceCategory->name) !!}
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="10" viewBox="0 0 9 10" fill="none">
                                <path d="M5.62494 9.99994L0.562517 10L0.5625 8.75003L4.49994 8.74996L4.5 2.39273L2.27828 4.86124L1.48278 3.97739L5.0625 0L8.64225 3.97739L7.84676 4.86124L5.625 2.3927L5.62494 9.99994Z" fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($serviceImages)
    <!-- Services details images -->
    <div class="pt-60 pb-80">
        <div class="{{ $containerClass }}">
            <div class="row">
                <div class="{{ $columnClass }}">
                    @if(count($serviceImages) > 1)
                        <div class="swiper about-me-slider-active">
                            <div class="swiper-wrapper">
                                @foreach($serviceImages as $img)
                                    <div class="swiper-slide">
                                        <div class="about-me-slider-thumb">
                                            {{ RvMedia::image($img, $service->name, attributes: ['class' => 'w-100 rounded-4']) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        {{ RvMedia::image($serviceImages[0], $service->name, attributes: ['class' => 'w-100 rounded-4']) }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Services details content -->
<div class="pb-120">
    <div class="{{ $containerClass }}">
        <div class="row">
            <div class="{{ $columnClass }}">
                @if($service->content)
                    <div class="ck-content">
                        {!! BaseHelper::clean($service->content) !!}
                    </div>
                @endif

                <div class="d-flex align-items-center py-3 border-top mt-5">
                    <span class="fw-bold me-2">{{ __('Share:') }}</span>
                    {!! Theme::renderSocialSharing($service->url, SeoHelper::getDescription(), $service->image) !!}
                </div>

                {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $service) !!}
            </div>
        </div>
    </div>
</div>

{!! apply_filters('ads_render', null, 'service_after', ['class' => 'my-2 text-center']) !!}
