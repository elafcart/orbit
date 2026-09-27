<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\Ecommerce\Models\Brand;
use Botble\Slug\Facades\SlugHelper;

class BrandSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('brands');

        $brands = [
            [
                'logo' => 'brands/logo-brand-01.webp',
                'name' => 'KOMONO',
                'description' => 'Premium eyewear and accessories with minimalist design philosophy.',
            ],
            [
                'logo' => 'brands/logo-brand-02.webp',
                'name' => 'BRAVEN',
                'description' => 'Contemporary menswear blending urban edge with refined tailoring.',
            ],
            [
                'logo' => 'brands/logo-brand-03.webp',
                'name' => 'HALSTON & CO.',
                'description' => 'Timeless knitwear and heritage-inspired fashion essentials.',
            ],
            [
                'logo' => 'brands/logo-brand-04.webp',
                'name' => 'LORCAN STUDIO',
                'description' => 'Architectural outerwear crafted with attention to structure and detail.',
            ],
            [
                'logo' => 'brands/logo-brand-05.webp',
                'name' => 'ETIQUE',
                'description' => 'Sophisticated womenswear with an emphasis on modern elegance.',
            ],
            [
                'logo' => 'brands/logo-brand-06.webp',
                'name' => 'MIRETTI',
                'description' => 'Casual luxury wear designed for comfort and understated style.',
            ],
            [
                'logo' => 'brands/logo-brand-07.webp',
                'name' => 'SOLENE',
                'description' => 'French-inspired fashion with effortless chic and clean silhouettes.',
            ],
            [
                'logo' => 'brands/logo-brand-08.webp',
                'name' => 'RIDGEWAY',
                'description' => 'Classic British tailoring reimagined for the modern professional.',
            ],
        ];

        Brand::query()->truncate();

        foreach ($brands as $key => $item) {
            $item['order'] = $key;
            $item['is_featured'] = true;
            $brand = Brand::query()->create($item);

            SlugHelper::createSlug($brand);
        }
    }
}
