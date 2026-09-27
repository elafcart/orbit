{{-- Service card variant 2: light bg-neutral-50 with bottom image and top icon/title --}}
<div class="at-service-card card-2 rounded-4 overflow-hidden p-relative bg-neutral-50">
    @if ($image)
        <a href="{{ $url ?: '#' }}" class="p-absolute bottom-0 start-0 end-0">
            {{ RvMedia::image($image, $title ?? 'Orisa', attributes: ['class' => 'img-cover']) }}
        </a>
    @endif
    <div class="at-service-card-content p-absolute top-0 left-0 m-xxl-5 m-4">
        <div class="at-service-card-icon">
            {!! BaseHelper::clean($iconSvg) !!}
        </div>
        @if ($title)
            <h3 class="h6 mt-3"><a href="{{ $url ?: '#' }}">{!! BaseHelper::clean($title) !!}</a></h3>
        @endif
        @if ($description)
            <div class="at-service-card-description">
                <p class="mb-0">{!! BaseHelper::clean($description) !!}</p>
            </div>
        @endif
    </div>
</div>
