@php
    $product = $product ?? null;

    if (! $product) {
        return;
    }

    $isConfigurable = $product->has_variation;
@endphp

<div class="card card-hover group flex h-full flex-col overflow-hidden">
    <a href="{{ $product->url }}" class="relative block aspect-square overflow-hidden bg-slate-100 dark:bg-slate-800" aria-hidden="true" tabindex="-1">
        @if ($product->image)
            <img
                src="{{ RvMedia::getImageUrl($product->image, 'medium') }}"
                alt="{{ $product->name }}"
                loading="lazy"
                class="size-full object-cover transition duration-500 group-hover:scale-105"
                decoding="async"
            >
        @endif

        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
            @if ($product->front_sale_price < $product->price)
                <span class="rounded-full bg-rose-600 px-2.5 py-1 text-xs font-semibold text-white">
                    -{{ number_format((($product->price - $product->front_sale_price) / $product->price) * 100) }}%
                </span>
            @endif

            @if ($product->is_featured)
                <span class="rounded-full bg-brand-600 px-2.5 py-1 text-xs font-semibold text-white">{{ __('Featured') }}</span>
            @endif

            @if ($product->isOutOfStock())
                <span class="rounded-full bg-slate-900/80 px-2.5 py-1 text-xs font-semibold text-white">{{ __('Out of Stock') }}</span>
            @endif
        </div>
    </a>

    <div class="flex flex-1 flex-col p-4">
        @if ($product->categories->isNotEmpty())
            <a href="{{ $product->categories->first()->url }}" class="text-xs font-semibold tracking-wide text-brand-600 uppercase dark:text-brand-400">
                {{ $product->categories->first()->name }}
            </a>
        @endif

        <h3 class="mt-1.5 line-clamp-2 text-sm font-semibold">
            <a href="{{ $product->url }}" class="transition group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $product->name }}</a>
        </h3>

        <div class="mt-2">
            @include(EcommerceHelper::viewPath('includes.product-price'), [
                'priceWrapperClassName' => 'bb-product-price flex flex-wrap items-baseline gap-2',
                'priceClassName' => 'bb-product-price-text font-semibold text-slate-900 dark:text-white',
                'priceOriginalClassName' => 'text-xs text-slate-400 line-through',
            ])
        </div>

        @if (EcommerceHelper::isReviewEnabled() && (! EcommerceHelper::hideRatingWhenNoReviews() || $product->reviews_count > 0))
            <div class="mt-1.5">
                @include(EcommerceHelper::viewPath('includes.rating'))
            </div>
        @endif

        <div class="mt-auto pt-4">
            @if (EcommerceHelper::isCartEnabled())
                <button
                    type="button"
                    class="btn btn-primary w-full !py-2.5 text-xs"
                    @if ($isConfigurable)
                        data-url="{{ route('public.ajax.quick-shop', $product->slug) }}"
                        {!! EcommerceHelper::jsAttributes('quick-shop', $product) !!}
                    @else
                        data-url="{{ route('public.cart.add-to-cart') }}"
                        data-id="{{ $product->original_product->id }}"
                        {!! EcommerceHelper::jsAttributes('add-to-cart', $product) !!}
                    @endif
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="8" cy="21" r="1" /><circle cx="19" cy="21" r="1" />
                        <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                    </svg>
                    @if ($isConfigurable)
                        {{ __('Select Options') }}
                    @else
                        {{ __('Add to Cart') }}
                    @endif
                </button>
            @else
                <a href="{{ $product->url }}" class="btn btn-outline w-full !py-2.5 text-xs">{{ __('View Details') }}</a>
            @endif
        </div>
    </div>
</div>
