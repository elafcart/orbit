<?php

namespace Database\Seeders\Themes\Main;

use Botble\Ecommerce\Models\GlobalOption;
use Botble\Ecommerce\Models\GlobalOptionValue;
use Botble\Ecommerce\Option\OptionType\Dropdown;
use Botble\Ecommerce\Option\OptionType\RadioButton;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductOptionSeeder extends Seeder
{
    public function run(): void
    {
        $options = [
            [
                'name' => 'Gift Wrapping',
                'option_type' => RadioButton::class,
                'required' => false,
                'values' => [
                    ['option_value' => 'None', 'affect_price' => 0, 'affect_type' => 0],
                    ['option_value' => 'Standard Gift Box', 'affect_price' => 5, 'affect_type' => 0],
                    ['option_value' => 'Premium Gift Box', 'affect_price' => 12, 'affect_type' => 0],
                ],
            ],
            [
                'name' => 'Fabric Care',
                'option_type' => Dropdown::class,
                'required' => false,
                'values' => [
                    ['option_value' => 'Standard', 'affect_price' => 0, 'affect_type' => 0],
                    ['option_value' => 'Stain Guard Treatment', 'affect_price' => 8, 'affect_type' => 0],
                    ['option_value' => 'Premium Waterproofing', 'affect_price' => 15, 'affect_type' => 0],
                ],
            ],
        ];

        DB::table('ec_global_options')->truncate();
        DB::table('ec_global_option_value')->truncate();
        DB::table('ec_options')->truncate();
        DB::table('ec_option_value')->truncate();

        foreach ($options as $option) {
            $globalOption = new GlobalOption();
            $globalOption->name = $option['name'];
            $globalOption->option_type = $option['option_type'];
            $globalOption->required = $option['required'];
            $globalOption->save();

            $values = [];
            foreach ($option['values'] as $item) {
                $globalOptionValue = new GlobalOptionValue();
                $item['affect_price'] = ! empty($item['affect_price']) ? $item['affect_price'] : 0;
                $globalOptionValue->fill($item);
                $values[] = $globalOptionValue;
            }

            $globalOption->values()->saveMany($values);
        }
    }
}
