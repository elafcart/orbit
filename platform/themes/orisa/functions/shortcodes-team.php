<?php

use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\ShortcodeField;
use Botble\Team\Models\Team;
use Botble\Theme\Facades\Theme;
use Theme\Orisa\Forms\ShortcodeForm;
use Theme\Orisa\Support\ThemeHelper;

app()->booted(function (): void {
    if (! is_plugin_active('team')) {
        return;
    }

    Shortcode::register('teams', __('Teams'), __('Teams'), function (ShortcodeCompiler $shortcode): ?string {
        ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $teamIds = Shortcode::fields()->getIds('team_ids', $shortcode);

        if (empty($teamIds)) {
            return null;
        }

        $teams = Team::query()
            ->whereIn('id', $teamIds)
            ->wherePublished()
            ->with('slugable')
            ->get();

        if ($teams->isEmpty()) {
            return null;
        }

        return Theme::partial('shortcodes.teams.index', compact('shortcode', 'teams'));
    });

    Shortcode::setPreviewImage('teams', Theme::asset()->url('images/ui-blocks/teams.png'));

    Shortcode::setAdminConfig('teams', function (array $attributes): ShortcodeForm {
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
                                'image' => Theme::asset()->url("images/shortcodes/teams/style-$i.png"),
                            ],
                        ])->all()
                    )
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
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description / Contact info (HTML)'))
                    ->rows(4)
                    ->collapsible('style', [2, 3, 4], $attributes['style'] ?? 1)
            )
            ->add(
                'experience_years',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Stats counter (style 4)'))
                    ->collapsible('style', 4, $attributes['style'] ?? 1)
            )
            ->add(
                'bottom_description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Bottom description (style 3)'))
                    ->rows(3)
                    ->collapsible('style', 3, $attributes['style'] ?? 1)
            )
            ->addButtonActions(['primary' => __('Primary')], [], [2, 3, 4], $attributes['style'] ?? 1)
            ->add(
                'team_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Teams'))
                    ->searchable()
                    ->multiple()
                    ->selected(ShortcodeField::parseIds($attributes['team_ids'] ?? ''))
                    ->choices(
                        Team::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all()
                    )
            );
    });
});
