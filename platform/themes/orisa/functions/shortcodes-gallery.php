<?php

use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Gallery\Facades\Gallery;
use Botble\Gallery\Models\Gallery as GalleryModel;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\ShortcodeField;
use Botble\Theme\Facades\Theme;
use Theme\Orisa\Forms\ShortcodeForm;
use Theme\Orisa\Support\ThemeHelper;

app()->booted(function (): void {
    if (! is_plugin_active('gallery')) {
        return;
    }

    Shortcode::register('galleries', __('Galleries'), __('Galleries'), function (ShortcodeCompiler $shortcode): ?string {
        ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $galleryIds = Shortcode::fields()->getIds('gallery_ids', $shortcode);

        $query = GalleryModel::query()
            ->wherePublished()
            ->with(['slugable', 'user']);

        if (! empty($galleryIds)) {
            $query->whereIn('id', $galleryIds);
        }

        if ($shortcode->limit) {
            $query->limit((int) $shortcode->limit);
        }

        $galleries = $query->orderBy('order')->latest()->get();

        if ($galleries->isEmpty()) {
            return null;
        }

        Gallery::registerAssets();

        return Theme::partial('shortcodes.galleries.index', compact('shortcode', 'galleries'));
    });

    Shortcode::setPreviewImage('galleries', Theme::asset()->url('images/ui-blocks/galleries.png'));

    Shortcode::setAdminConfig('galleries', function (array $attributes): ShortcodeForm {
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
                        collect(range(1, 2))->mapWithKeys(fn ($i) => [
                            $i => [
                                'label' => __('Style :i', ['i' => $i]),
                                'image' => Theme::asset()->url("images/shortcodes/galleries/style-$i.png"),
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
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle')))
            ->add(
                'gallery_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Galleries'))
                    ->searchable()
                    ->multiple()
                    ->selected(ShortcodeField::parseIds($attributes['gallery_ids'] ?? ''))
                    ->choices(
                        GalleryModel::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all()
                    )
            )
            ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Limit'))->defaultValue(6));
    });
});
