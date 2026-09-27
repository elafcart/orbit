<?php

use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Blog\Models\Post;
use Botble\Widget\AbstractWidget;
use Botble\Widget\Forms\WidgetForm;
use Illuminate\Support\Collection;

class BlogPostsWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Blog Posts'),
            'description' => __('Display recent blog posts.'),
            'title' => null,
            'limit' => 5,
        ]);
    }

    protected function data(): array|Collection
    {
        $config = $this->getConfig();
        $limit = (int) ($config['limit'] ?? 5);

        $posts = collect();

        if (is_plugin_active('blog')) {
            $posts = Post::query()
                ->with(['slugable'])
                ->wherePublished()
                ->orderByDesc('created_at')
                ->limit($limit)
                ->get();
        }

        return compact('posts');
    }

    protected function settingForm(): WidgetForm|string|null
    {
        return WidgetForm::createFromArray($this->getConfig())
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
            )
            ->add(
                'limit',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(__('Number of posts'))
                    ->defaultValue(5)
            );
    }

    protected function requiredPlugins(): array
    {
        return ['blog'];
    }
}
