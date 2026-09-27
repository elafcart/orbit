{{-- Service card variant 3: top + bottom images with centered content overlay --}}
<div class="at-service-card card-3 rounded-4 overflow-hidden p-relative">
    @if ($image)
        <a href="{{ $url ?: '#' }}" class="p-absolute top-0 left-0">
            {{ RvMedia::image($image, $title ?? 'Orisa', attributes: ['class' => 'img-cover']) }}
        </a>
        <a href="{{ $url ?: '#' }}" class="p-absolute bottom-0 start-0 end-0">
            {{ RvMedia::image($image, $title ?? 'Orisa', attributes: ['class' => 'img-cover']) }}
        </a>
    @endif
    <div class="at-service-card-content text-white p-absolute top-50 left-0 mx-xxl-5 mx-4 translate-middle-y">
        <div class="at-service-card-icon">
            {!! BaseHelper::clean($iconSvg) !!}
        </div>
        @if ($title)
            <h3 class="h6 text-white mt-3"><a href="{{ $url ?: '#' }}">{!! BaseHelper::clean($title) !!}</a></h3>
        @endif
        @if ($description)
            <div class="at-service-card-description">
                <p class="mb-0 text-white">{!! BaseHelper::clean($description) !!}</p>
            </div>
        @endif
    </div>
</div>
