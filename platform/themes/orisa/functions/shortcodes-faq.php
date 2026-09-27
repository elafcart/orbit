<?php

use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Faq\FaqCollection;
use Botble\Faq\FaqSupport;
use Botble\Faq\Models\Faq;
use Botble\Faq\Models\FaqCategory;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\FieldOptions\ShortcodeTabsFieldOption;
use Botble\Shortcode\Forms\Fields\ShortcodeTabsField;
use Botble\Shortcode\ShortcodeField;
use Botble\Theme\Facades\Theme;
use Theme\Orisa\Forms\ShortcodeForm;
use Theme\Orisa\Support\ThemeHelper;

app()->booted(function (): void {
    if (! is_plugin_active('faq')) {
        return;
    }

    Shortcode::register('faqs', __('FAQs'), __('FAQs'), function (ShortcodeCompiler $shortcode) {
        ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $categoryIds = Shortcode::fields()->getIds('category_ids', $shortcode);

        $query = Faq::query()->wherePublished();

        if (! empty($categoryIds)) {
            $query->whereIn('category_id', $categoryIds);
        }

        if ($shortcode->limit) {
            $query->limit((int) $shortcode->limit);
        }

        $faqs = $query->get();

        if ($faqs->isEmpty()) {
            return null;
        }

        (new FaqSupport())->registerSchema(FaqCollection::make($faqs));

        $features = ThemeHelper::sanitizeTabImages(
            Shortcode::fields()->getTabsData(['title', 'description', 'icon_image'], $shortcode, 'feature'),
            'icon_image'
        );

        return Theme::partial('shortcodes.faqs.index', compact('shortcode', 'faqs', 'features'));
    });

    Shortcode::setPreviewImage('faqs', Theme::asset()->url('images/ui-blocks/faqs.png'));

    Shortcode::setAdminConfig('faqs', function (array $attributes) {
        $attributes = ThemeHelper::sanitizeShortcodeImageAttributes($attributes);

        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue($attributes['style'] ?? 1)
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices(
                        collect(range(1, 4))->mapWithKeys(fn ($i) => [
                            $i => [
                                'label' => __('Style :i', ['i' => $i]),
                                'image' => Theme::asset()->url("images/shortcodes/faqs/style-$i.png"),
                            ],
                        ])->all()
                    )
            )
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title')))
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Choose the semantic heading level for this section title. Use H2 when this block follows the page hero (default). Pick H1 only if this block is the hero on its own page.'))
                    ->choices([
                        'h1' => 'H1',
                        'h2' => __('H2 (default)'),
                        'h3' => 'H3',
                        'h4' => 'H4',
                    ])
                    ->defaultValue('h2')
            )
            ->add(
                'title_font_size',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title font size'))
                    ->helperText(__('Preset steps on the theme type scale, so the title stays responsive. Choose Default to keep this block\'s built-in size.'))
                    ->choices([
                        '' => __('Default'),
                        'sm' => __('Small'),
                        'md' => __('Medium'),
                        'lg' => __('Large'),
                        'xl' => __('Extra large'),
                    ])
                    ->defaultValue('')
            )
            ->add('subtitle', TextField::class, TextFieldOption::make()
                ->label(__('Subtitle'))
                ->collapsible('style', [1, 3], $attributes['style'] ?? 1))
            ->add('image', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Image'))
                ->collapsible('style', [1, 2], $attributes['style'] ?? 1))
            ->add('background_image', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Background image (style 2)'))
                ->collapsible('style', 2, $attributes['style'] ?? 1))
            ->add(
                'features',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Feature cards (style 2)'))
                    ->collapsible('style', 2, $attributes['style'] ?? 1)
                    ->fields([
                        'title' => ['title' => __('Title'), 'required' => true],
                        'description' => ['title' => __('Description'), 'type' => 'textarea'],
                        'icon_image' => ['title' => __('Icon image'), 'type' => 'image'],
                    ], 'feature')
                    ->attrs($attributes)
            )
            ->add('description', TextField::class, TextFieldOption::make()->label(__('Description (below image)')))
            ->add('secondary_description', TextField::class, TextFieldOption::make()
                ->label(__('Secondary description'))
                ->collapsible('style', 1, $attributes['style'] ?? 1))
            ->add(
                'category_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('FAQ categories'))
                    ->choices(FaqCategory::query()->pluck('name', 'id')->all())
                    ->multiple()
                    ->searchable()
                    ->selected(ShortcodeField::parseIds($attributes['category_ids'] ?? null))
            )
            ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Limit'))->defaultValue(6))
            ->addButtonActions(['primary' => __('Primary')], [], 1, $attributes['style'] ?? 1);
    });
});
