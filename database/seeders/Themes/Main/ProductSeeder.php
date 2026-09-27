<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\Ecommerce\Models\Order;
use Botble\Ecommerce\Models\OrderAddress;
use Botble\Ecommerce\Models\OrderHistory;
use Botble\Ecommerce\Models\OrderProduct;
use Botble\Ecommerce\Models\Product;
use Botble\Ecommerce\Models\ProductFile;
use Botble\Ecommerce\Models\ProductVariation;
use Botble\Ecommerce\Models\ProductVariationItem;
use Botble\Ecommerce\Models\Shipment;
use Botble\Ecommerce\Models\ShipmentHistory;
use Botble\Ecommerce\Models\Wishlist;
use Botble\Slug\Facades\SlugHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('products');

        $faker = $this->fake();

        $products = [
            [
                'name' => 'Elegant Check Blazer',
                'price' => 142.5,
                'brand_id' => 1, // KOMONO
                'is_featured' => true,
            ],
            [
                'name' => 'Classic Oversized Brown Hoodie',
                'price' => 72,
                'brand_id' => 2, // BRAVEN
                'is_featured' => true,
            ],
            [
                'name' => 'Heritage Patterned Knit Sweater',
                'price' => 88,
                'brand_id' => 3, // HALSTON & CO.
                'is_featured' => true,
            ],
            [
                'name' => 'Long Trench Coat',
                'price' => 189,
                'brand_id' => 4, // LORCAN STUDIO
                'is_featured' => true,
            ],
            [
                'name' => 'Belted Trench Jacket',
                'price' => 156,
                'brand_id' => 5, // ETIQUE
                'is_featured' => true,
            ],
            [
                'name' => 'Olive Sweatshirt',
                'price' => 65,
                'brand_id' => 6, // MIRETTI
                'is_featured' => true,
            ],
            [
                'name' => 'Pocket Overshirt',
                'price' => 98,
                'brand_id' => 7, // SOLENE
                'is_featured' => true,
            ],
            [
                'name' => 'Wool Blend Blazer',
                'price' => 175,
                'brand_id' => 8, // RIDGEWAY
                'is_featured' => true,
            ],
            [
                'name' => 'Cropped Cardigan',
                'price' => 72,
                'sale_price' => 59,
                'brand_id' => 1,
                'is_featured' => true,
            ],
            [
                'name' => 'Silk Scarf & Overcoat',
                'price' => 210,
                'brand_id' => 4,
                'is_featured' => true,
            ],
            [
                'name' => 'Ribbed Knit Dress',
                'price' => 124,
                'brand_id' => 5,
                'is_featured' => true,
            ],
            [
                'name' => 'Crewneck Sweater',
                'price' => 89,
                'brand_id' => 3,
                'is_featured' => true,
            ],
        ];

        Product::query()->truncate();
        DB::table('ec_product_with_attribute_set')->truncate();
        DB::table('ec_product_variations')->truncate();
        DB::table('ec_product_variation_items')->truncate();
        DB::table('ec_product_collection_products')->truncate();
        DB::table('ec_product_label_products')->truncate();
        DB::table('ec_product_category_product')->truncate();
        DB::table('ec_product_related_relations')->truncate();
        Wishlist::query()->truncate();
        Order::query()->truncate();
        OrderAddress::query()->truncate();
        OrderProduct::query()->truncate();
        OrderHistory::query()->truncate();
        Shipment::query()->truncate();
        ShipmentHistory::query()->truncate();

        ProductFile::query()->truncate();
        File::deleteDirectory(config('filesystems.disks.public.root') . '/product-files');

        $totalProducts = count($products);

        foreach ($products as $key => $item) {
            $item['description'] = 'A timeless essential with a clean silhouette, delivering everyday comfort with effortless style. Crafted from soft, breathable fabric with a relaxed yet structured fit.';
            $item['content'] = '<p>Designed for modern wardrobes, this piece combines simplicity, versatility, and premium comfort in one refined silhouette. Crafted from soft, breathable fabric, it features a relaxed yet structured fit that makes it perfect for layering or wearing on its own.</p>
                                <p>The classic silhouette and subtle detailing create a polished look suitable for casual outings, work-from-anywhere days, or weekend downtime. Durable stitching and carefully finished seams ensure long-lasting wear, while the neutral tone allows easy pairing with denim, tailored trousers, or outerwear.</p>
                                <p>Whether you\'re building a capsule wardrobe or looking for a dependable everyday staple, this piece is made to keep your style understated, confident, and effortlessly cool.</p>';
            $item['status'] = BaseStatusEnum::PUBLISHED;
            $item['sku'] = 'OR-' . ($key + 1) . '-' . $faker->numberBetween(100, 999);
            $item['views'] = $faker->numberBetween(1000, 200000);
            $item['quantity'] = $faker->numberBetween(10, 50);
            $item['length'] = $faker->numberBetween(10, 20);
            $item['wide'] = $faker->numberBetween(10, 20);
            $item['height'] = $faker->numberBetween(2, 10);
            $item['weight'] = $faker->numberBetween(200, 800);
            $item['with_storehouse_management'] = true;

            $images = [
                'products/product-' . ($key + 1) . '.webp',
            ];

            // Add product-details images for the 6-image grid on detail page
            for ($i = 1; $i <= 6; $i++) {
                if (File::exists(database_path('seeders/files/products/product-details-' . $i . '.webp'))) {
                    $images[] = 'products/product-details-' . $i . '.webp';
                }
            }

            $item['images'] = json_encode($images);

            $product = Product::query()->create($item);

            $product->productCollections()->sync([$faker->numberBetween(1, 3)]);

            if (is_int($product->id) && $product->id % 3 == 0) {
                $product->productLabels()->sync([$faker->numberBetween(1, 3)]);
            }

            $product->categories()->sync(array_unique([
                $faker->numberBetween(1, 12),
                $faker->numberBetween(1, 12),
            ]));

            $product->tags()->sync(array_unique([
                $faker->numberBetween(1, 6),
                $faker->numberBetween(1, 6),
            ]));

            $product->taxes()->sync([1]);

            SlugHelper::createSlug($product);

            MetaBox::saveMetaBoxData(
                $product,
                'faq_schema_config',
                json_decode(
                    '[[{"key":"question","value":"What Shipping Methods Are Available?"},{"key":"answer","value":"We offer standard and express shipping worldwide. Free shipping on orders over $150."}],[{"key":"question","value":"What is your Return Policy?"},{"key":"answer","value":"We accept returns within 30 days of purchase. Items must be unworn with tags attached."}],[{"key":"question","value":"How do I find my size?"},{"key":"answer","value":"Please refer to our size guide on the product page. If you are between sizes, we recommend sizing up for a relaxed fit."}]]',
                    true
                )
            );
        }

        foreach ($products as $key => $item) {
            $product = Product::query()->skip($key)->first();
            $product->productAttributeSets()->sync([1, 2]);

            $product->crossSales()->sync([
                $this->random(1, $totalProducts, [$product->id]),
                $this->random(1, $totalProducts, [$product->id]),
                $this->random(1, $totalProducts, [$product->id]),
                $this->random(1, $totalProducts, [$product->id]),
            ]);

            for ($j = 0; $j < $faker->numberBetween(1, 4); $j++) {
                $variation = Product::query()->create([
                    'name' => $product->name,
                    'status' => BaseStatusEnum::PUBLISHED,
                    'sku' => $product->sku . '-V' . $j,
                    'quantity' => $product->quantity,
                    'weight' => $product->weight,
                    'height' => $product->height,
                    'wide' => $product->wide,
                    'length' => $product->length,
                    'price' => $product->price,
                    'sale_price' => is_int(
                        $product->id
                    ) && $product->id % 4 == 0 ? ($product->price - $product->price * $faker->numberBetween(
                        10,
                        30
                    ) / 100) : null,
                    'brand_id' => $product->brand_id,
                    'with_storehouse_management' => $product->with_storehouse_management,
                    'is_variation' => true,
                    'images' => json_encode([$product->images[$j] ?? Arr::first($product->images)]),
                    'product_type' => $product->product_type,
                ]);

                $productVariation = ProductVariation::query()->create([
                    'product_id' => $variation->id,
                    'configurable_product_id' => $product->id,
                    'is_default' => $j == 0,
                ]);

                if ($productVariation->is_default) {
                    $product->update([
                        'sku' => $variation->sku,
                        'sale_price' => $variation->sale_price,
                    ]);
                }

                ProductVariationItem::query()->create([
                    'attribute_id' => $faker->numberBetween(1, 5),
                    'variation_id' => $productVariation->id,
                ]);

                ProductVariationItem::query()->create([
                    'attribute_id' => $faker->numberBetween(6, 10),
                    'variation_id' => $productVariation->id,
                ]);
            }
        }
    }
}
