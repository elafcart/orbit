<section {!! $shortcode->htmlAttributes() !!} class="pt-120 pb-120">
    <div class="container">
        @if($shortcode->title)
            <div class="text-center mb-5">
                @if($shortcode->subtitle)
                    <span class="at-section-subtitle d-inline-block mb-3">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                @endif
                <h2>{!! BaseHelper::clean($shortcode->title) !!}</h2>
            </div>
        @endif

        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-xxl-3 col-lg-4 col-md-6">
                    @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'))
                </div>
            @endforeach
        </div>

        @if($shortcode->primary_action_label)
            <div class="text-center mt-5">
                <a href="{{ $shortcode->primary_action_url }}" class="at-btn">
                    <span>
                        <span class="text-1">{{ $shortcode->primary_action_label }}</span>
                        <span class="text-2">{{ $shortcode->primary_action_label }}</span>
                    </span>
                </a>
            </div>
        @endif
    </div>
</section>
