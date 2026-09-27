<?php

namespace Botble\Ecommerce\Services\Products;

use Botble\Ecommerce\Models\Product;
use Illuminate\Support\Facades\Pipeline;

class ProductPriceService
{
    protected array $priceHandlers = [
        ProductSalePriceService::class,
        ProductFlashSalePriceService::class,
        ProductDiscountPriceService::class,
        ProductCrossSalePriceService::class,
        ProductUpSalePriceService::class,
    ];

    public function __construct(
        protected float $finalPrice = 0,
        protected ?Product $product = null
    ) {
    }

    public function getPrice(Product $product): float
    {
        $product->setFinalPrice($product->getConvertedPrice());

        $product = $this->applyPriceHandlers($product);

        return (float) apply_filters('ecommerce_product_final_price', $product->getFinalPrice(), $product);
    }

    public function getOriginalPrice(Product $product): float
    {
        $product->setOriginalPrice($product->getConvertedPrice());

        $product = $this->applyPriceHandlers($product);

        return (float) apply_filters('ecommerce_product_original_price', $product->getOriginalPrice(), $product);
    }

    /**
     * The service is a singleton and price accessors are re-entrant: a handler or filter
     * may read another product's price (bundle pricing, cross-sell), which would clobber
     * shared state. Keep the product in a local so nested calls stay isolated.
     *
     * Register additional handlers through the `ecommerce_product_price_handlers` filter.
     * Each handler must extend ProductPriceHandlerService.
     */
    protected function applyPriceHandlers(Product $product): Product
    {
        $handlers = apply_filters('ecommerce_product_price_handlers', $this->priceHandlers, $product);

        return Pipeline::send($product)
            ->through($handlers)
            ->thenReturn();
    }
}
