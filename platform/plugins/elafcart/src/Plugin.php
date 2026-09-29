<?php

namespace Botble\Elafcart;

use Botble\PluginManagement\Abstracts\PluginOperationAbstract;
use Illuminate\Support\Facades\Schema;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('elafcart_items');
        Schema::dropIfExists('elafcart_items_translations');
    }
}
