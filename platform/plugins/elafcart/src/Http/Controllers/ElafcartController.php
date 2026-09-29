<?php

namespace Botble\Elafcart\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Elafcart\Forms\ElafcartForm;
use Botble\Elafcart\Models\ElafcartItem;
use Botble\Elafcart\Tables\ElafcartTable;
use Botble\Base\Http\Actions\DeleteResourceAction;

class ElafcartController extends BaseController
{
    public function index(ElafcartTable $table)
    {
        $this->pageTitle(trans('plugins/elafcart::elafcart.menu_name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/elafcart::elafcart.create'));

        return ElafcartForm::create()->renderForm();
    }

    public function store(ElafcartForm $form)
    {
        return $form->save();
    }

    public function edit(ElafcartItem $elafcart)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $elafcart->name]));

        return ElafcartForm::createFromModel($elafcart)->renderForm();
    }

    public function update(ElafcartItem $elafcart, ElafcartForm $form)
    {
        return $form->save();
    }

    public function destroy(ElafcartItem $elafcart)
    {
        return DeleteResourceAction::make($elafcart);
    }
}
