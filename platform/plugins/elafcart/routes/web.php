<?php

use Botble\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Botble\Elafcart\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'elafcart', 'as' => 'elafcart.'], function () {
            Route::resource('', 'ElafcartController')
                ->parameters(['' => 'elafcart']);
        });
    });

    // Public routes
    if (defined('THEME_MODULE_SCREEN_NAME')) {
        Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
            Route::get('elafcart/{slug}', [
                'as' => 'public.elafcart',
                'uses' => 'PublicController@getItem',
            ]);
        });
    }
});
