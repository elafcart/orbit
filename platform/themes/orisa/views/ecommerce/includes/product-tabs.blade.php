{{-- Description / Reviews tabs, shared between the two product-detail layouts:
     rendered inline inside the right info column in "Grid" mode, and in a
     full-width row below the product in "Gallery" mode. Pass $fullWidth = true
     to add the modifier class that styles the full-width variant. --}}
@if($product->content || EcommerceHelper::isReviewEnabled())
    <div class="content-product-right__tabs {{ ($fullWidth ?? false) ? 'content-product-right__tabs--full' : '' }}" id="product-detail-tabs">
        <ul class="nav nav-tabs content-product-right__tab-nav" role="tablist">
            @if($product->content)
                <li class="nav-item">
                    <button class="nav-link bg-transparent active" data-bs-toggle="tab" data-bs-target="#tab-description" type="button">
                        {{ __('Description') }}
                    </button>
                </li>
            @endif
            @if(EcommerceHelper::isReviewEnabled())
                <li class="nav-item">
                    <button class="nav-link bg-transparent {{ !$product->content ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#tab-reviews" type="button">
                        {{ __('Reviews') }} ({{ $product->reviews_count ?? 0 }})
                    </button>
                </li>
            @endif
        </ul>
        <div class="tab-content content-product-right__tab-content pt-4">
            @if($product->content)
                <div class="tab-pane fade show active" id="tab-description">
                    <div class="ck-content">{!! BaseHelper::clean($product->content) !!}</div>
                </div>
            @endif
            @if(EcommerceHelper::isReviewEnabled())
                <div class="tab-pane fade {{ !$product->content ? 'show active' : '' }}" id="tab-reviews">
                    {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $product) !!}
                </div>
            @endif
        </div>
    </div>
@endif
