<?php

use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Ecommerce\Facades\EcommerceHelper;
use Botble\Ecommerce\Models\ProductCategory;
use Botble\Ecommerce\Repositories\Interfaces\ProductInterface;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\ShortcodeField;
use Botble\Theme\Facades\Theme;
use Theme\Orisa\Forms\ShortcodeForm;
use Theme\Orisa\Support\ThemeHelper;

app()->booted(function (): void {
    if (! is_plugin_active('ecommerce')) {
        return;
    }

    Shortcode::register(
        'ecommerce-products',
        __('Ecommerce Products'),
        __('Ecommerce Products'),
        function (ShortcodeCompiler $shortcode) {
        ThemeHelper::sanitizeShortcodeAllImages($shortcode);
            $categoryIds = Shortcode::fields()->getIds('category_ids', $shortcode);
            $limit = (int) ($shortcode->limit ?: 12);

            $products = app(ProductInterface::class)->getProductsByCategories([
                'categories' => $categoryIds,
                'take' => $limit,
                'order_by' => ['order' => 'ASC', 'created_at' => 'DESC'],
                ...EcommerceHelper::withReviewsParams(),
            ]);

            if ($products->isEmpty()) {
                return null;
            }

            return Theme::partial('shortcodes.ecommerce-products.index', compact('shortcode', 'products'));
        }
    );

    Shortcode::setPreviewImage('ecommerce-products', Theme::asset()->url('images/ui-blocks/ecommerce-products.png'));

    Shortcode::setAdminConfig('ecommerce-products', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title')))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle')))
            ->add(
                'category_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Categories'))
                    ->choices(ProductCategory::query()->pluck('name', 'id')->all())
                    ->multiple()
                    ->searchable()
                    ->selected(ShortcodeField::parseIds($attributes['category_ids'] ?? null))
            )
            ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Limit'))->defaultValue(12))
            ->addButtonActions(['primary' => __('Primary')]);
    });

    // Ecommerce Products Carousel: same data source as Ecommerce Products, rendered as a Swiper carousel.
    Shortcode::register(
        'ecommerce-products-carousel',
        __('Ecommerce Products Carousel'),
        __('Ecommerce Products Carousel'),
        function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
            $categoryIds = Shortcode::fields()->getIds('category_ids', $shortcode);
            $limit = (int) ($shortcode->limit ?: 12);

            $products = app(ProductInterface::class)->getProductsByCategories([
                'categories' => $categoryIds,
                'take' => $limit,
                'order_by' => ['order' => 'ASC', 'created_at' => 'DESC'],
                ...EcommerceHelper::withReviewsParams(),
            ]);

            if ($products->isEmpty()) {
                return null;
            }

            return Theme::partial('shortcodes.ecommerce-products-carousel.index', compact('shortcode', 'products'));
        }
    );

    Shortcode::setPreviewImage('ecommerce-products-carousel', Theme::asset()->url('images/ui-blocks/ecommerce-products-carousel.png'));

    Shortcode::setAdminConfig('ecommerce-products-carousel', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title')))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle')))
            ->add(
                'category_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Categories'))
                    ->choices(ProductCategory::query()->pluck('name', 'id')->all())
                    ->multiple()
                    ->searchable()
                    ->selected(ShortcodeField::parseIds($attributes['category_ids'] ?? null))
            )
            ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Limit'))->defaultValue(12))
            ->add('items_desktop', NumberField::class, NumberFieldOption::make()->label(__('Slides per view (desktop, ≥1400px)'))->defaultValue(4))
            ->add('items_tablet', NumberField::class, NumberFieldOption::make()->label(__('Slides per view (tablet, ≥992px)'))->defaultValue(3))
            ->add('items_mobile', NumberField::class, NumberFieldOption::make()->label(__('Slides per view (mobile, ≥576px)'))->defaultValue(2))
            ->add('space_between', NumberField::class, NumberFieldOption::make()->label(__('Space between slides (px)'))->defaultValue(24))
            ->add('autoplay', OnOffField::class, OnOffFieldOption::make()->label(__('Autoplay'))->defaultValue(true))
            ->add('autoplay_delay', NumberField::class, NumberFieldOption::make()->label(__('Autoplay delay (ms)'))->defaultValue(5000))
            ->add('loop', OnOffField::class, OnOffFieldOption::make()->label(__('Loop'))->defaultValue(true))
            ->add('show_navigation', OnOffField::class, OnOffFieldOption::make()->label(__('Show navigation arrows'))->defaultValue(true))
            ->add('show_pagination', OnOffField::class, OnOffFieldOption::make()->label(__('Show pagination dots'))->defaultValue(false))
            ->addButtonActions(['primary' => __('Primary')]);
    });
});
