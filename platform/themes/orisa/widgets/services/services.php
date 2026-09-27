<?php

use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Portfolio\Models\Service;
use Botble\Widget\AbstractWidget;
use Botble\Widget\Forms\WidgetForm;
use Illuminate\Support\Collection;

class ServicesWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Services'),
            'description' => __('Display services list in the sidebar.'),
            'title' => null,
            'limit' => 5,
        ]);
    }

    protected function data(): array|Collection
    {
        $config = $this->getConfig();
        $limit = (int) ($config['limit'] ?? 5);

        $services = collect();

        if (is_plugin_active('portfolio')) {
            $services = Service::query()
                ->with(['slugable'])
                ->wherePublished()
                ->limit($limit)
                ->get();
        }

        return compact('services');
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
                    ->label(__('Number of services'))
                    ->defaultValue(5)
            );
    }

    protected function requiredPlugins(): array
    {
        return ['portfolio'];
    }
}
