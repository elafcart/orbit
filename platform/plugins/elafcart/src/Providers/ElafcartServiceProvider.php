<?php

namespace Botble\Elafcart\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Elafcart\Models\ElafcartItem;
use Botble\Language\Facades\Language;
use Botble\LanguageAdvanced\Supports\LanguageAdvancedManager;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Slug\Facades\SlugHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Routing\Events\RouteMatched;

class ElafcartServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register(): void
    {
        $this->setNamespace('plugins/elafcart')
            ->loadHelpers();
    }

    public function boot(): void
    {
        $this
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes()
            ->publishAssets();

        // Register slug for custom model
        $this->app['events']->listen(RouteMatched::class, function () {
            SlugHelper::registerModule(ElafcartItem::class, 'Elafcart Items');
            SlugHelper::setPrefix(ElafcartItem::class, 'elafcart', true);
        });

        // Dashboard menu
        DashboardMenu::default()->beforeRetrieving(function () {
            DashboardMenu::make()
                ->registerItem([
                    'id' => 'cms-plugins-elafcart',
                    'priority' => 5,
                    'parent_id' => null,
                    'name' => 'plugins/elafcart::elafcart.menu_name',
                    'icon' => 'ti ti-box',
                    'url' => fn() => route('elafcart.index'),
                    'permissions' => ['elafcart.index'],
                ]);
        });

        // Language support
        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
                LanguageAdvancedManager::registerModule(ElafcartItem::class, ['name', 'description', 'content']);
            } else {
                Language::registerModule([ElafcartItem::class]);
            }
        }

        // SEO support
        $this->app->booted(function () {
            SeoHelper::registerModule([ElafcartItem::class]);
        });

        // Register shortcodes
        if (function_exists('add_shortcode')) {
            add_shortcode('elafcart-items', 'Elafcart Items', 'Show elafcart items', function ($shortcode) {
                $items = ElafcartItem::query()
                    ->wherePublished()
                    ->limit($shortcode->limit ?? 6)
                    ->get();

                return Theme::partial('shortcodes.elafcart-items', compact('shortcode', 'items'));
            });

            shortcode()->setAdminConfig('elafcart-items', function ($attributes) {
                return Theme::partial('shortcodes.elafcart-items-admin-config', compact('attributes'));
            });
        }

        // Register theme shortcode partials path
        if (function_exists('shortcode')) {
            Theme::composer(['page', 'post'], function (\Botble\Shortcode\View\View $view) {
                $view->withShortcodes();
            });
        }
    }
}
