# Botble CMS - থিম ও প্লাগিন তৈরির সম্পূর্ণ গাইড (বাংলা)

আপনার রিপোজিটরিতে Botble CMS (Laravel 13) ইন্সটল করা আছে। `platform/themes/orisa` হলো বর্তমান থিম, `platform/plugins/` এ 29 টা প্লাগিন আছে।

আমি আপনার জন্য ২ টা উদাহরণ তৈরি করে দিয়েছি:

- **Theme:** `platform/themes/elafcart/` 
- **Plugin:** `platform/plugins/elafcart/`

---

## ১. থিম তৈরি (Theme Development)

### Botble থিমের জন্য ৩ টা জিনিস বাধ্যতামূলক:

1.  `theme.json` - থিমের পরিচয়
2.  `config.php` - asset, event register
3.  `layouts/` এবং `views/` - Blade template

### ফোল্ডার স্ট্রাকচার (Standard)

```
platform/themes/your-theme-name/
├── theme.json              # [Required] id, name, namespace, version
├── config.php              # [Required] inherit, events, asset register
├── vite.build.mjs          # Vite build config
├── assets/
│   ├── sass/style.scss
│   └── js/main.js
├── public/
│   ├── css/style.css       # compiled css
│   └── js/main.js
├── layouts/
│   ├── base.blade.php      # Master layout (header+footer)
│   ├── default.blade.php   # extends base
│   ├── full-width.blade.php
│   └── homepage.blade.php
├── views/
│   ├── index.blade.php     # Default homepage when no page set
│   ├── page.blade.php      # Single page
│   ├── post.blade.php      # Single blog post
│   └── loop.blade.php      # Blog listing
├── partials/
│   ├── header.blade.php
│   ├── footer.blade.php
│   ├── breadcrumb.blade.php
│   └── shortcodes/
├── functions/
│   ├── functions.php       # register_page_template, sidebar, ThemeSupport
│   └── theme-options.php
├── widgets/                # Optional custom widgets
├── src/                    # Optional Forms, Controllers for theme options
└── lang/                   # Translation
```

### Step 1: theme.json তৈরি

```json
{
    "id": "botble/elafcart",
    "name": "Elafcart",
    "namespace": "Theme\\Elafcart\\",
    "author": "Elafcart Team",
    "url": "https://elafcart.com",
    "version": "1.0.0",
    "description": "Custom theme",
    "required_plugins": ["blog", "page", "contact"]
}
```
> `id` সবসময় `botble/xxx` ফরম্যাটে, `namespace` শেষে `\\` থাকবে।

### Step 2: config.php - Asset Register

Botble এ asset `Theme::asset()` দিয়ে register করতে হয়।

```php
<?php
use Botble\Theme\Theme;
return [
    'inherit' => null, // অন্য থিম inherit করতে চাইলে নাম দিন
    'events' => [
        'beforeRenderTheme' => function (Theme $theme) {
            $theme->asset()->usePath()->add('bootstrap', 'css/vendors/bootstrap.min.css');
            $theme->asset()->usePath()->add('theme-style', 'css/style.css', version: '1.0.0');
            $theme->asset()->container('footer')->usePath()->add('main', 'js/main.js', version: '1.0.0');
            
            if (function_exists('shortcode')) {
                $theme->composer(['page', 'post'], function ($view) {
                    $view->withShortcodes();
                });
            }
        }
    ]
];
```

### Step 3: layouts/base.blade.php (Master)

```blade
<!DOCTYPE html>
<html {!! Theme::htmlAttributes() !!}>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! Theme::header() !!} {{-- SEO, CSS auto inject --}}
</head>
<body {!! Theme::bodyAttributes() !!}>
    @include(Theme::getThemeNamespace('partials.header'))
    <main>@yield('content')</main>
    @include(Theme::getThemeNamespace('partials.footer'))
    {!! Theme::footer() !!} {{-- JS auto inject --}}
</body>
</html>
```

### Step 4: layouts/default.blade.php

```blade
@extends(Theme::getThemeNamespace('layouts.base'))
@section('content')
    {!! Theme::content() !!} {{-- page/post content inject হবে --}}
@endsection
```

### Step 5: functions/functions.php

এখানে সব logic:

```php
<?php
register_page_template([
    'default' => __('Default'),
    'full-width' => __('Full Width'),
    'homepage' => __('Homepage'),
]);

app()->booted(function() {
    ThemeSupport::registerSocialLinks();
    ThemeSupport::registerSiteCopyright();
    
    register_sidebar([
        'id' => 'main_sidebar',
        'name' => __('Main Sidebar'),
        'description' => __('Blog sidebar'),
    ]);
});
```

### Step 6: থিম Activate

```bash
php artisan cms:theme:activate elafcart
php artisan cms:theme:assets:publish elafcart
# অথবা Admin Panel > Appearance > Themes > Activate
```

> আমি `platform/themes/elafcart/` এ সম্পূর্ণ working theme বানিয়ে দিয়েছি। আপনি সরাসরি activate করতে পারবেন।

---

## ২. প্লাগিন তৈরি (Plugin Development)

Botble প্লাগিন হলো Laravel package + Botble এর `plugin.json` ও `ServiceProvider`।

### ফোল্ডার স্ট্রাকচার (Standard)

```
platform/plugins/your-plugin/
├── plugin.json                 # [Required] id, namespace, provider
├── vite.build.mjs
├── src/
│   ├── Plugin.php              # remove() - uninstall logic
│   ├── Providers/
│   │   └── YourServiceProvider.php
│   ├── Models/
│   │   └── YourModel.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── YourController.php (Admin)
│   │   │   └── PublicController.php (Frontend)
│   │   └── Requests/
│   ├── Forms/
│   ├── Tables/                 # DataTable for admin listing
│   └── Database/ or database/
├── routes/
│   └── web.php
├── resources/
│   ├── views/
│   └── lang/en/
├── config/
│   └── permissions.php
├── database/
│   └── migrations/
└── public/
```

### Step 1: plugin.json

```json
{
    "id": "botble/elafcart",
    "name": "Elafcart Core",
    "namespace": "Botble\\Elafcart\\",
    "provider": "Botble\\Elafcart\\Providers\\ElafcartServiceProvider",
    "author": "Elafcart Team",
    "version": "1.0.0",
    "description": "Custom features",
    "minimum_core_version": "7.4.0"
}
```

### Step 2: ServiceProvider - সবচেয়ে গুরুত্বপূর্ণ

`src/Providers/ElafcartServiceProvider.php` এ আপনি যা করবেন:

- `loadRoutes()`, `loadMigrations()`, `loadAndPublishViews()`
- `DashboardMenu` register - Admin menu
- `SlugHelper::registerModule()` - SEO friendly URL
- `SeoHelper::registerModule()` - SEO
- `add_shortcode()` - Shortcode register
- Language support

উদাহরণ (আমি তৈরি করে দিয়েছি দেখুন):
- Menu, Slug, SEO, Shortcode, Translation সব আছে।

### Step 3: Model

```php
class ElafcartItem extends BaseModel {
    protected $table = 'elafcart_items';
    protected $fillable = ['name','description','content','image','status'];
    protected $casts = ['status' => BaseStatusEnum::class];
}
```

### Step 4: Migration

`database/migrations/2024_01_01_000000_create_elafcart_items_table.php`

### Step 5: Form, Table, Controller, Request

Botble এ Form = `Botble\Base\Forms\FormAbstract` extend করে।
Table = `TableAbstract` extend করে DataTable।

আমি `ElafcartForm`, `ElafcartTable`, `ElafcartController`, `ElafcartRequest` বানিয়ে দিয়েছি।

### Step 6: Routes - web.php

```php
AdminHelper::registerRoutes(function() {
    Route::group(['prefix' => 'elafcart', 'as' => 'elafcart.'], function() {
        Route::resource('', 'ElafcartController')->parameters(['' => 'elafcart']);
    });
});
```

### Step 7: Plugin Activate

```bash
composer dump-autoload
php artisan cms:plugin:activate elafcart
php artisan migrate
php artisan cms:plugin:assets:publish elafcart
# অথবা Admin > Plugins > Activate
```

---

## ৩. আপনি যা যা পাবেন আমার তৈরি করা থেকে

### Theme `elafcart`:
- ✅ theme.json, config.php, layouts, views, partials
- ✅ header/footer, page, post, loop
- ✅ functions.php with sidebar & page templates
- ✅ assets (scss, js) + compiled public
- ✅ Shortcode support ready

### Plugin `elafcart`:
- ✅ Full CRUD: Model, Migration, Form, Table, Controller, Request
- ✅ Admin menu auto register
- ✅ Permissions config
- ✅ Slug, SEO, Language support
- ✅ Shortcode `[elafcart-items limit=6]` 
- ✅ Public route `/elafcart/{slug}`

---

## ৪. নতুন থিম/প্লাগিন বানাতে চাইলে Shortcut

**নতুন থিম:**

```bash
cp -r platform/themes/elafcart platform/themes/yourname
# তারপর theme.json এ id, name, namespace পরিবর্তন করুন
# views, config কাস্টমাইজ করুন
php artisan cms:theme:activate yourname
```

**নতুন প্লাগিন:**

```bash
cp -r platform/plugins/elafcart platform/plugins/yourplugin
# plugin.json এ id, name, namespace, provider পরিবর্তন করুন
# src/Providers/*, Models/*, etc namespace পরিবর্তন করুন
# migration table name পরিবর্তন করুন
composer dump-autoload
php artisan cms:plugin:activate yourplugin
php artisan migrate
```

---

## ৫. গুরুত্বপূর্ণ Artisan Commands

```bash
# Theme
php artisan cms:theme:activate elafcart
php artisan cms:theme:assets:publish
php artisan cms:theme:assets:publish elafcart
php artisan cms:theme:remove theme-name
php artisan cms:theme:rename old new

# Plugin
php artisan cms:plugin:list
php artisan cms:plugin:activate elafcart
php artisan cms:plugin:deactivate elafcart
php artisan cms:plugin:remove elafcart
php artisan cms:plugin:assets:publish elafcart

# Cache & Assets
php artisan cms:publish:assets
php artisan optimize:clear
composer dump-autoload
```

---

## ৬. Best Practices

1. **Theme** এ business logic লিখবেন না, শুধু UI। Logic প্লাগিনে লিখুন।
2. **Shortcode** ব্যবহার করুন reusable section এর জন্য (hero, services, etc) - দেখুন `orisa/functions/shortcodes.php`
3. **Widget** ব্যবহার করুন sidebar এর জন্য
4. **Theme Option** - `theme_option('key')` দিয়ে admin থেকে control করুন
5. **RvMedia::getImageUrl()** ব্যবহার করুন image এর জন্য
6. **Menu::renderMenuLocation()** ব্যবহার করুন menu এর জন্য

---

## ৭. পরবর্তী ধাপ

1. `.env` setup করে `php artisan migrate` ও `php artisan storage:link` করুন
2. Admin panel এ গিয়ে `elafcart` থিম activate করুন
3. `elafcart` প্লাগিন activate করুন
4. Pages > Create new page > Template = Homepage সিলেক্ট করে shortcode দিন:
```
[elafcart-items limit="6"][/elafcart-items]
```
5. Appearance > Theme Options > Page থেকে homepage সেট করুন

কোনো specific থিম ডিজাইন বা প্লাগিন feature চাইলে বলুন, আমি কোড করে দেব।
