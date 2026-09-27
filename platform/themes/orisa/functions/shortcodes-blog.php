<?php

use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Blog\Models\Category;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\ShortcodeField;
use Botble\Theme\Facades\Theme;
use Theme\Orisa\Forms\ShortcodeForm;
use Theme\Orisa\Support\ThemeHelper;

app()->booted(function (): void {
    if (! is_plugin_active('blog')) {
        return;
    }

    Shortcode::register(
        'blog-posts',
        __('Blog Posts'),
        __('Blog Posts'),
        function (ShortcodeCompiler $shortcode): ?string {
        ThemeHelper::sanitizeShortcodeAllImages($shortcode);
            $perPage = max(1, (int) ($shortcode->per_page ?: 3));
            $categoryIds = Shortcode::fields()->getIds('category_ids', $shortcode);

            $query = app(PostInterface::class)->getModel()->query()
                ->wherePublished()
                ->with(['slugable', 'categories', 'categories.slugable', 'author'])
                ->latest()
                ->limit($perPage);

            if (! empty($categoryIds)) {
                $query->whereHas('categories', fn ($q) => $q->whereIn('category_id', $categoryIds));
            }

            $posts = $query->get();

            if ($posts->isEmpty()) {
                return null;
            }

            return Theme::partial('shortcodes.blog-posts.index', compact('shortcode', 'posts'));
        }
    );

    Shortcode::setPreviewImage('blog-posts', Theme::asset()->url('images/ui-blocks/blog-posts.png'));

    Shortcode::setAdminConfig('blog-posts', function (array $attributes): ShortcodeForm {
        return ShortcodeForm::createFromArray($attributes)
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
                                'label' => __('Style :number', ['number' => $i]),
                                'image' => Theme::asset()->url("images/shortcodes/blog-posts/style-$i.png"),
                            ],
                        ])->toArray()
                    )
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()->label(__('Title'))
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
                TextFieldOption::make()->label(__('Subtitle'))
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()->label(__('Description'))
            )
            ->add(
                'category_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Filter by categories'))
                    ->searchable()
                    ->multiple()
                    ->selected(ShortcodeField::parseIds($attributes['category_ids'] ?? ''))
                    ->choices(
                        Category::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all()
                    )
            )
            ->add(
                'per_page',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(__('Number of posts'))
                    ->defaultValue(3)
            )
            ->add(
                'action_label',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button label'))
                    ->collapsible('style', 1, $attributes['style'] ?? 1)
            )
            ->add(
                'action_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button URL'))
                    ->collapsible('style', 1, $attributes['style'] ?? 1)
            );
    });
});
