<?php

namespace Database\Seeders\Themes\Home4;

use Database\Seeders\TranslationSeeder;

class DatabaseSeeder extends \Database\Seeders\Themes\Main\DatabaseSeeder
{
    public function getSeeders(): array
    {
        $parentSeeders = array_filter(
            parent::getSeeders(),
            fn ($s) => $s !== TranslationSeeder::class
        );

        return [
            ...$parentSeeders,
            PageSeeder::class,
            WidgetSeeder::class,
            ThemeOptionSeeder::class,
            TranslationSeeder::class,
        ];
    }
}
