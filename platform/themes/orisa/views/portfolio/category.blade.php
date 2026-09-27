@php
    Theme::set('hideBreadcrumb', true);
    $services = $category->services ?? collect();
@endphp

{!! apply_filters('ads_render', null, 'service_category_before', ['class' => 'my-2 text-center']) !!}

<!-- Service category hero -->
<div class="sec-1-services-details overflow-hidden pt-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
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
                            {!! BaseHelper::clean($category->name) !!}
                        </span>
                    </span>
                </div>

                <h1 class="section-title d-flex fw-600 reveal-text mb-20">{!! BaseHelper::clean($category->name) !!}</h1>

                @if($category->description)
                    <h2 class="h6 fw-600 reveal-text mb-30">{!! BaseHelper::clean($category->description) !!}</h2>
                @endif
            </div>
        </div>
    </div>
</div>

@if($category->image)
    <!-- Category cover -->
    <div class="pt-60 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    {{ RvMedia::image($category->image, $category->name, attributes: ['class' => 'w-100 rounded-4']) }}
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Services in this category -->
<div class="pb-120 @if(! $category->image) pt-60 @endif">
    <div class="container">
        @if($services->isNotEmpty())
            <div class="at-service-list-wrap">
                @foreach($services as $index => $service)
                    <a href="{{ $service->url }}">
                        <div class="at-service-item service-item">
                            <div class="count">
                                <span class="number">[{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}]</span>
                            </div>
                            <div class="content">
                                <h3 class="title">{{ $service->name }}</h3>
                                @if($service->description)
                                    <p class="text">{!! BaseHelper::clean($service->description) !!}</p>
                                @endif
                            </div>
                            @php $thumbImage = $service->getMetaData('icon_image', true) ?: ($service->image ?? null); @endphp
                            @if($thumbImage)
                                <div class="thumb anim-zoomin">
                                    <img src="{{ RvMedia::getImageUrl($thumbImage) }}" alt="{{ $service->name }}">
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <p class="fz-font-md neutral-500 mb-0">{{ __('No services found in this category.') }}</p>
                </div>
            </div>
        @endif
    </div>
</div>

{!! apply_filters('ads_render', null, 'service_category_after', ['class' => 'my-2 text-center']) !!}
