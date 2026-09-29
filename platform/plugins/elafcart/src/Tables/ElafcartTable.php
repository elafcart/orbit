<?php

namespace Botble\Elafcart\Tables;

use Botble\Elafcart\Models\ElafcartItem;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\ImageColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\StatusColumn;

class ElafcartTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(ElafcartItem::class)
            ->addActions([
                EditAction::make()->route('elafcart.edit'),
                DeleteAction::make()->route('elafcart.destroy'),
            ]);
    }

    public function columns(): array
    {
        return [
            IdColumn::make(),
            ImageColumn::make(),
            NameColumn::make()->route('elafcart.edit'),
            Column::make('description')->title(trans('core/base::tables.description')),
            StatusColumn::make(),
            CreatedAtColumn::make(),
        ];
    }

    public function buttons(): array
    {
        return $this->addCreateButton(route('elafcart.create'), 'elafcart.create');
    }

    public function bulkActions(): array
    {
        return [
            DeleteBulkAction::make()->permission('elafcart.destroy'),
        ];
    }

    public function getBulkChanges(): array
    {
        return [
            NameBulkChange::make(),
            StatusBulkChange::make(),
        ];
    }

    public function getFilters(): array
    {
        return $this->getBulkChanges();
    }
}
