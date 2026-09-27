{{-- Service card variant 1: full-bleed background image with overlay content --}}
@php
    $bgUrl = $image ? RvMedia::getImageUrl($image) : '';
@endphp
<div class="at-service-card card-1 rounded-4 overflow-hidden p-relative bg-cover" @if ($bgUrl) data-background="{{ $bgUrl }}" @endif>
    <a href="{{ $url ?: '#' }}" class="p-absolute top-0 left-0 w-100 h-100"></a>
    <div class="at-service-card-content text-white p-absolute bottom-0 start-0 end-0 m-xxl-5 m-4">
        <div class="at-service-card-icon">
            {!! BaseHelper::clean($iconSvg) !!}
        </div>
        @if ($title)
            <h3 class="h6 text-white mt-3"><a href="{{ $url ?: '#' }}">{!! BaseHelper::clean($title) !!}</a></h3>
        @endif
        @if ($description)
            <div class="at-service-card-description">
                <p class="text-white mb-0">{!! BaseHelper::clean($description) !!}</p>
            </div>
        @endif
    </div>
</div>
