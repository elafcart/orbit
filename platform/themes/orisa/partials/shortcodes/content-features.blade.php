<div {!! $shortcode->htmlAttributes() !!} class="content-features py-5">
    @if($shortcode->image)
        <div class="mb-5 rounded-4 overflow-hidden">
            <img src="{{ RvMedia::getImageUrl($shortcode->image) }}" class="w-100" alt="">
        </div>
    @endif
    <div class="row g-4">
        @foreach($items as $item)
            @if(!empty($item['title']))
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex gap-3 align-items-start">
                        @if(!empty($item['icon']))
                            <x-core::icon :name="$item['icon']" class="fs-3 mt-1" />
                        @endif
                        <div>
                            <h5 class="fw-600 mb-2">{{ $item['title'] }}</h5>
                            @if(!empty($item['description']))
                                <p class="fz-font-md neutral-500 mb-0">{!! str_replace('\n', '<br>', BaseHelper::clean($item['description'])) !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
