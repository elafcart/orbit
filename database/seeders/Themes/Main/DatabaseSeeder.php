<?php

namespace Database\Seeders\Themes\Main;

use Botble\ACL\Database\Seeders\UserSeeder;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Supports\BaseSeeder;
use Botble\Contact\Database\Seeders\ContactSeeder;
use Botble\Ecommerce\Database\Seeders\CurrencySeeder;
use Botble\Ecommerce\Database\Seeders\ReviewSeeder;
use Botble\Ecommerce\Database\Seeders\ShippingSeeder;
use Database\Seeders\TranslationSeeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->prepareRun();

        BaseHelper::maximumExecutionTimeAndMemoryLimit();

        $this->uploadFiles('general');
        $this->uploadFiles('backgrounds');

        $seeders = [];

        foreach ($this->getSeeders() as $seeder) {
            $seeders[Str::afterLast($seeder, '\\')] = $seeder;
        }

        $this->call($seeders);

        $this->finished();
    }

    public function getSeeders(): array
    {
        return [
            SettingSeeder::class,
            UserSeeder::class,
            ContactSeeder::class,
            PortfolioSeeder::class,
            FaqSeeder::class,
            TeamSeeder::class,
            TestimonialSeeder::class,
            BlogSeeder::class,
            CurrencySeeder::class,
            PageSeeder::class,
            ThemeOptionSeeder::class,
            WidgetSeeder::class,
            MenuSeeder::class,
            GallerySeeder::class,
            CareerSeeder::class,
            ProductCategorySeeder::class,
            ProductCollectionSeeder::class,
            ProductLabelSeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductAttributeSeeder::class,
            ProductTagSeeder::class,
            ProductOptionSeeder::class,
            ShippingSeeder::class,
            CustomerSeeder::class,
            ReviewSeeder::class,
            TranslationSeeder::class,
        ];
    }
}
