<?php

use Botble\Base\Forms\FieldOptions\CoreIconFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\CoreIconField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Portfolio\Models\Project;
use Botble\Portfolio\Models\Service;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\ShortcodeField;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Arr;
use Theme\Orisa\Forms\ShortcodeForm;
use Theme\Orisa\Support\ThemeHelper;

app()->booted(function (): void {
    if (! is_plugin_active('portfolio')) {
        return;
    }

    // ─── Services ─────────────────────────────────────────────────────────────

    Shortcode::register(
        'services',
        __('Services'),
        __('Services'),
        function (ShortcodeCompiler $shortcode) {
        ThemeHelper::sanitizeShortcodeAllImages($shortcode);
            $serviceIds = Shortcode::fields()->getIds('service_ids', $shortcode);
            $limit = (int) ($shortcode->per_page ?: 6);

            $services = Service::query()
                ->when($serviceIds, fn ($query) => $query->whereIn('id', $serviceIds))
                ->wherePublished()
                ->with(['slugable', 'metadata'])
                ->limit($limit)
                ->get();

            if ($services->isEmpty()) {
                return null;
            }

            return Theme::partial('shortcodes.services.index', compact('shortcode', 'services'));
        }
    );

    Shortcode::setPreviewImage('services', Theme::asset()->url('images/ui-blocks/services.png'));

    Shortcode::setAdminConfig('services', function (array $attributes) {
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
                        collect(range(1, 5))->mapWithKeys(function ($i) {
                            return [
                                $i => [
                                    'label' => __('Style :i', ['i' => $i]),
                                    'image' => Theme::asset()->url("images/shortcodes/services/style-$i.png"),
                                ],
                            ];
                        })->all()
                    )
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
            )
            // Available on every style: the section title is what keeps the heading outline from
            // jumping straight from the page H1 to the H3 service item titles. Left empty, no
            // heading is rendered at all, so existing blocks are visually unchanged.
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Section title'))
                    ->helperText(__('Introduces the services list. Leave empty to render no heading.'))
            )
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Choose the semantic heading level for this section title. Use H2 when this block follows the page hero (default). Pick H1 only if this block is the hero on its own page. Pick regular text when the page already has its heading outline and you only want the visual title.'))
                    ->choices([
                        'h1' => 'H1',
                        'h2' => __('H2 (default)'),
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'div' => __('Regular text (no heading)'),
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
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->rows(3)
                    ->collapsible('style', [1, 2, 4, 5], $attributes['style'] ?? 1)
            )
            ->add(
                'image_1',
                \Botble\Base\Forms\Fields\MediaImageField::class,
                \Botble\Base\Forms\FieldOptions\MediaImageFieldOption::make()
                    ->label(__('Portfolio image (style 4)'))
                    ->collapsible('style', 4, $attributes['style'] ?? 1)
            )
            ->add(
                'experience_years',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Experience years (style 1 odometer)'))
                    ->collapsible('style', 1, $attributes['style'] ?? 1)
            )
            ->add(
                'service_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Services'))
                    ->choices(
                        Service::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all()
                    )
                    ->multiple()
                    ->searchable()
                    ->selected(ShortcodeField::parseIds(Arr::get($attributes, 'service_ids')))
                    ->helperText(__('Leave empty to show all services'))
            )
            ->add(
                'per_page',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(__('Items per page'))
                    ->defaultValue(6)
            )
            ->addButtonActions(['primary' => __('Primary')], [], [1, 3, 5], $attributes['style'] ?? 1);
    });

    // ─── Projects ─────────────────────────────────────────────────────────────

    Shortcode::register(
        'projects',
        __('Projects'),
        __('Projects'),
        function (ShortcodeCompiler $shortcode) {
        ThemeHelper::sanitizeShortcodeAllImages($shortcode);
            $projectIds = Shortcode::fields()->getIds('project_ids', $shortcode);
            $limit = (int) ($shortcode->per_page ?: 6);

            $projects = Project::query()
                ->when($projectIds, fn ($query) => $query->whereIn('id', $projectIds))
                ->wherePublished()
                ->with(['slugable', 'metadata'])
                ->latest()
                ->limit($limit)
                ->get();

            if ($projects->isEmpty()) {
                return null;
            }

            return Theme::partial('shortcodes.projects.index', compact('shortcode', 'projects'));
        }
    );

    Shortcode::setAdminConfig('projects', function (array $attributes) {
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
                        collect(range(1, 4))->mapWithKeys(function ($i) {
                            return [
                                $i => [
                                    'label' => __('Style :i', ['i' => $i]),
                                    'image' => Theme::asset()->url("images/shortcodes/projects/style-$i.png"),
                                ],
                            ];
                        })->all()
                    )
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->collapsible('style', [2, 3, 4], $attributes['style'] ?? 1)
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
            )
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Use H1 when this shortcode is the page hero (e.g. on the portfolio archive page). Switch to H2/H3 if the page already has another H1.'))
                    ->choices([
                        'h1' => __('H1 (default)'),
                        'h2' => 'H2',
                        'h3' => 'H3',
                    ])
                    ->defaultValue('h1')
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
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->rows(3)
                    ->collapsible('style', 1, $attributes['style'] ?? 1)
            )
            ->add(
                'decoration_icon',
                CoreIconField::class,
                CoreIconFieldOption::make()
                    ->label(__('Decoration icon (style 1)'))
                    ->helperText(__('Tabler icon shown above the title. Leave empty to use the default brand mark.'))
                    ->collapsible('style', 1, $attributes['style'] ?? 1)
            )
            ->add(
                'project_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Projects'))
                    ->choices(
                        Project::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all()
                    )
                    ->multiple()
                    ->searchable()
                    ->selected(ShortcodeField::parseIds(Arr::get($attributes, 'project_ids')))
                    ->helperText(__('Leave empty to show latest projects'))
            )
            ->add(
                'per_page',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(__('Items per page'))
                    ->defaultValue(6)
            )
            ->addButtonActions(['primary' => __('Primary')]);
    });
});
