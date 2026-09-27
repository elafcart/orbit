<?php

use ArchiElite\Career\Models\Career;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\ShortcodeField;
use Botble\Theme\Facades\Theme;
use Theme\Orisa\Forms\ShortcodeForm;
use Theme\Orisa\Support\ThemeHelper;

app()->booted(function (): void {
    if (! is_plugin_active('career')) {
        return;
    }

    Shortcode::register('careers', __('Careers'), __('Careers'), function (ShortcodeCompiler $shortcode): ?string {
        ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $careerIds = Shortcode::fields()->getIds('career_ids', $shortcode);

        $query = Career::query()
            ->wherePublished()
            ->with('slugable');

        if (! empty($careerIds)) {
            $query->whereIn('id', $careerIds);
        }

        if ($shortcode->limit) {
            $query->limit((int) $shortcode->limit);
        }

        $careers = $query->latest()->get();

        if ($careers->isEmpty()) {
            return null;
        }

        return Theme::partial('shortcodes.careers.index', compact('shortcode', 'careers'));
    });

    Shortcode::setPreviewImage('careers', Theme::asset()->url('images/ui-blocks/careers.png'));

    Shortcode::setAdminConfig('careers', function (array $attributes): ShortcodeForm {
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
                                'image' => Theme::asset()->url("images/shortcodes/careers/style-$i.png"),
                            ],
                        ])->all()
                    )
            )
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title')))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle')))
            ->add(
                'career_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Careers'))
                    ->searchable()
                    ->multiple()
                    ->selected(ShortcodeField::parseIds($attributes['career_ids'] ?? ''))
                    ->choices(
                        Career::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all()
                    )
            )
            ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Limit'))->defaultValue(6));
    });
});
