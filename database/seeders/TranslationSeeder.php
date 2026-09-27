<?php

namespace Database\Seeders;

use ArchiElite\Career\Models\Career;
use Botble\Language\Models\Language;
use Botble\Language\Models\LanguageMeta;
use Botble\LanguageAdvanced\Database\Seeders\BaseTranslationSeeder;
use Botble\LanguageAdvanced\Database\Seeders\Traits\HasLanguageSeeder;
use Botble\LanguageAdvanced\Database\Seeders\Traits\HasMenuTranslationSeeder;
use Botble\LanguageAdvanced\Database\Seeders\Traits\HasPageTranslation;
use Botble\LanguageAdvanced\Database\Seeders\Traits\HasThemeOptionSeeder;
use Botble\LanguageAdvanced\Database\Seeders\Traits\HasWidgetSeeder;
use Botble\LanguageAdvanced\Supports\LanguageAdvancedManager;
use Botble\Menu\Database\Traits\HasMenuSeeder;
use Botble\Menu\Facades\Menu as MenuFacade;
use Botble\Menu\Models\Menu;
use Botble\Menu\Models\MenuLocation;
use Botble\Page\Models\Page;
use Botble\Portfolio\Models\Project;
use Botble\Portfolio\Models\Service;
use Botble\Setting\Facades\Setting;
use Botble\Team\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TranslationSeeder extends BaseTranslationSeeder
{
    use HasLanguageSeeder;
    use HasMenuSeeder;
    use HasMenuTranslationSeeder;
    use HasPageTranslation;
    use HasThemeOptionSeeder;
    use HasWidgetSeeder;

    public function run(): void
    {
        if (! is_plugin_active('language')) {
            return;
        }

        // Setup languages: truncate Language rows + translation tables only.
        // Do NOT truncate LanguageMeta — MenuSeeder already set meta for the
        // default English menu/location, and we need those entries preserved.
        Language::query()->truncate();

        if (is_plugin_active('language-advanced')) {
            foreach (LanguageAdvancedManager::supportedModels() as $model) {
                if (! class_exists($model)) {
                    continue;
                }

                $table = (new $model())->getModel()->getTable() . '_translations';

                if (Schema::hasTable($table)) {
                    DB::table($table)->truncate();
                }
            }
        }

        // Create English as default language first
        Language::query()->create([
            'lang_name' => 'English',
            'lang_locale' => 'en',
            'lang_is_default' => true,
            'lang_code' => 'en_US',
            'lang_is_rtl' => false,
            'lang_flag' => 'us',
            'lang_order' => 0,
        ]);

        Setting::set([
            'language_hide_default' => '1',
            'language_switcher_display' => 'dropdown',
            'language_display' => 'all',
            'language_hide_languages' => '[]',
        ])->save();

        // Create additional languages (vi, fr, ar, tr, id)
        $this->createLanguages();

        $locales = $this->locales();

        $this->seedThemeOptions($locales);
        $this->seedMenus($locales);
        $this->seedWidgets($locales);

        if (is_plugin_active('language-advanced')) {
            $this->seedPageTranslations($locales);
            $this->seedAllTranslatableModelsFromJson($locales);
            $this->seedSlugTranslations($this->getSlugTranslatableModels(), $locales);
        }
    }

    protected function locales(): array
    {
        return ['vi', 'fr', 'ar', 'tr', 'id'];
    }

    protected function seedMenus(array $locales): void
    {
        $menus = Menu::query()->whereIn('slug', ['main-menu'])->get()->keyBy('slug');

        if ($menus->isEmpty()) {
            return;
        }

        $menuOrigins = [];
        foreach ($menus as $slug => $menu) {
            $menuOrigins[$slug] = $this->getLanguageMetaOrigin($menu);
        }

        $mainMenuLocation = MenuLocation::query()
            ->where('menu_id', $menus->get('main-menu')?->getKey())
            ->where('location', 'main-menu')
            ->first();

        $locationOrigin = $mainMenuLocation ? $this->getLanguageMetaOrigin($mainMenuLocation) : null;

        $pageIds = Page::query()->pluck('id', 'name')->all();

        foreach ($locales as $locale) {
            $translations = $this->loadMenuTranslations($locale);

            if (empty($translations) || ! isset($translations['main-menu'])) {
                continue;
            }

            $labels = $translations['main-menu'];

            $this->createMenuTranslation(
                $locale,
                'main-menu',
                $labels['name'],
                $this->buildMainMenuItems($labels, $pageIds),
                $menuOrigins['main-menu'] ?? null,
                $locationOrigin
            );
        }

        MenuFacade::clearCacheMenuItems();
    }

    protected function buildMainMenuItems(array $labels, array $pageIds): array
    {
        return [
            [
                'title' => $labels['home'],
                'url' => '#',
                'children' => [
                    [
                        'title' => $labels['home_v1'],
                        'url' => 'https://orisa.botble.com',
                        'target' => '_blank',
                    ],
                    [
                        'title' => $labels['home_v2'],
                        'url' => 'https://orisa-home-2.botble.com',
                        'target' => '_blank',
                    ],
                    [
                        'title' => $labels['home_v3'],
                        'url' => 'https://orisa-home-3.botble.com',
                        'target' => '_blank',
                    ],
                    [
                        'title' => $labels['home_v4'],
                        'url' => 'https://orisa-home-4.botble.com',
                        'target' => '_blank',
                    ],
                    [
                        'title' => $labels['home_v5'],
                        'url' => 'https://orisa-home-5.botble.com',
                        'target' => '_blank',
                    ],
                ],
            ],
            [
                'title' => $labels['page'],
                'url' => '#',
                'children' => [
                    [
                        'title' => $labels['about_01'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['About 1'] ?? null,
                    ],
                    [
                        'title' => $labels['about_02'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['About 2'] ?? null,
                    ],
                    [
                        'title' => $labels['about_03'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['About 3'] ?? null,
                    ],
                    [
                        'title' => $labels['service_01'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['Services 1'] ?? null,
                    ],
                    [
                        'title' => $labels['service_02'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['Services 2'] ?? null,
                    ],
                    [
                        'title' => $labels['service_03'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['Services 3'] ?? null,
                    ],
                    [
                        'title' => $labels['our_team'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['Our Team'] ?? null,
                    ],
                    [
                        'title' => $labels['pricing'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['Pricing'] ?? null,
                    ],
                    [
                        'title' => $labels['coming_soon'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['Coming Soon'] ?? null,
                    ],
                    [
                        'title' => $labels['faqs'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['FAQ'] ?? null,
                    ],
                ],
            ],
            [
                'title' => $labels['portfolio'],
                'url' => '#',
                'children' => [
                    [
                        'title' => $labels['portfolio_01'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['Portfolio'] ?? null,
                    ],
                    [
                        'title' => $labels['lumina_brand_identity'],
                        'reference_type' => Project::class,
                        'reference_id' => 1,
                    ],
                    [
                        'title' => $labels['nomad_travel_app'],
                        'reference_type' => Project::class,
                        'reference_id' => 2,
                    ],
                ],
            ],
            [
                'title' => $labels['shop'],
                'url' => '#',
                'children' => [
                    [
                        'title' => $labels['products_listing'],
                        'url' => '/products',
                    ],
                    [
                        'title' => $labels['product_detail'],
                        'url' => '/products/elegant-check-blazer',
                    ],
                    [
                        'title' => $labels['cart'],
                        'url' => '/cart',
                    ],
                ],
            ],
            [
                'title' => $labels['news'],
                'url' => '#',
                'children' => [
                    [
                        'title' => $labels['blog_01'],
                        'url' => '/blog',
                    ],
                    [
                        'title' => $labels['blog_02'],
                        'url' => '/blog?style=style-2',
                    ],
                    [
                        'title' => $labels['blog_03'],
                        'url' => '/blog?style=style-3',
                    ],
                    [
                        'title' => $labels['blog_04'],
                        'url' => '/blog?style=style-4',
                    ],
                    [
                        'title' => $labels['post_details'],
                        'url' => '/adapting-to-the-new-web-development-trends-in-2024',
                    ],
                ],
            ],
            [
                'title' => $labels['contact'],
                'url' => '#',
                'children' => [
                    [
                        'title' => $labels['contact_01'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['Contact 1'] ?? null,
                    ],
                    [
                        'title' => $labels['contact_02'],
                        'reference_type' => Page::class,
                        'reference_id' => $pageIds['Contact 2'] ?? null,
                    ],
                ],
            ],
        ];
    }

    protected function getSlugTranslatableModels(): array
    {
        return [
            Page::class,
            Service::class,
            Project::class,
            Team::class,
            Career::class,
        ];
    }

    /**
     * Build per-locale translation maps for ALL pages.
     *
     * Resolution order per page:
     *   1. translations/{locale}/page-contents/{slug}.html  → full HTML replacement (long-form pages like Privacy Policy)
     *   2. translations/{locale}/page-contents/{slug}.json  → flat English→translated dict, literal strtr-replaced
     *   3. method convention get{PageName}Translations()    → legacy fallback (kept for Homepage backward compat)
     *
     * Caches pages + embedded HTML maps to avoid N+1 disk/DB reads.
     */
    protected function pageTranslations(): array
    {
        $translations = [];
        $pages = Page::query()->get(['id', 'name', 'content'])->keyBy('name');

        foreach ($this->locales() as $locale) {
            $jsonNames = $this->loadPageTranslationsFromJson($locale);
            $embeddedMap = $this->loadEmbeddedContentMap($locale);

            foreach ($pages as $pageName => $page) {
                $entry = [];
                if (isset($jsonNames[$pageName]['name'])) {
                    $entry['name'] = $jsonNames[$pageName]['name'];
                }

                // 1) Full HTML replacement (long-form pages)
                $htmlContent = $this->loadPageContentHtml($pageName, $locale);
                if ($htmlContent !== null) {
                    $entry['content'] = $htmlContent;
                } else {
                    // 2) Pre-pass: swap embedded long-form HTML files (e.g.
                    //    term-and-privacy.html). MUST happen before per-key
                    //    string replacement, otherwise per-key substitutions
                    //    inside the embedded body break the exact-match swap.
                    $rawContent = $page->content ?? '';
                    if ($embeddedMap) {
                        $rawContent = strtr($rawContent, $embeddedMap);
                    }

                    // 3) Per-key string replacement against the (post-swap) content.
                    $content = $this->applyPageStringTranslations($pageName, $locale, $rawContent);
                    if ($content !== '') {
                        $entry['content'] = $content;
                    }
                }

                $translations[$locale][$pageName] = $entry;
            }
        }

        return $translations;
    }

    /**
     * Apply per-key JSON translation map to a content string via a single
     * strtr() call. strtr is single-pass and always prefers the longest key,
     * so it avoids the substring re-match corruption that looped str_replace
     * can cause when a translated value contains a shorter English key as a
     * substring (e.g. "Save" translated after "Save more on every purchase").
     */
    protected function applyPageStringTranslations(string $pageName, string $locale, string $content): string
    {
        if ($content === '') {
            return $content;
        }

        $translations = $this->getPageTranslations($pageName, $locale);
        if (empty($translations)) {
            return $content;
        }

        $map = [];
        foreach ($translations as $english => $translated) {
            if ($english === '' || $english === $translated) {
                continue;
            }
            foreach ($this->encodingVariants($english) as $variant) {
                if ($variant === '') {
                    continue;
                }
                $map[$variant] = $translated;
            }
        }

        return $map ? strtr($content, $map) : $content;
    }

    /**
     * Generate all encoding variants of a source string that may appear in
     * stored shortcode content. Botble's Shortcode::generateShortcode() does:
     *   - newlines → {{NEWLINE}}
     *   - `\\` → `\\\\` and `"` → `\\"` (backslash escape inside attribute values)
     * Then content is HTML-entity-encoded via htmlspecialchars when rendered.
     * We emit every plausible variant so strtr can match the stored form.
     */
    protected function encodingVariants(string $source): array
    {
        $newlineMapped = str_replace(["\r\n", "\n", "\r"], '{{NEWLINE}}', $source);
        $escaped = str_replace(['\\', '"'], ['\\\\', '\\"'], $source);
        $escapedNl = str_replace(['\\', '"'], ['\\\\', '\\"'], $newlineMapped);

        return array_values(array_unique([
            $source,
            $newlineMapped,
            htmlspecialchars($source, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($newlineMapped, ENT_QUOTES, 'UTF-8'),
            $escaped,
            $escapedNl,
        ]));
    }

    /**
     * Resolve page-level translation map.
     * Overrides HasPageTranslation::getPageTranslations() to load from JSON
     * file at translations/{locale}/page-contents/{slug}.json before falling
     * back to the legacy get{PageName}Translations() method convention.
     *
     * Logs a warning when a JSON file exists but fails to decode (so broken
     * translator output doesn't vanish silently).
     */
    protected function getPageTranslations(string $pageName, string $locale): array
    {
        $slug = Str::slug($pageName);
        $jsonPath = database_path("seeders/translations/{$locale}/page-contents/{$slug}.json");

        if (File::exists($jsonPath)) {
            $data = json_decode(File::get($jsonPath), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->command?->warn(sprintf(
                    'TranslationSeeder: invalid JSON in %s (%s)',
                    $jsonPath,
                    json_last_error_msg()
                ));
            } elseif (is_array($data) && ! empty($data)) {
                return $data;
            }
        }

        // Legacy fallback: getHomepageTranslations() etc.
        $methodName = 'get' . str_replace(' ', '', ucwords($pageName)) . 'Translations';
        if (method_exists($this, $methodName)) {
            $translations = $this->$methodName();

            return $translations[$locale] ?? [];
        }

        return [];
    }

    /**
     * Load full translated HTML body for long-form pages (e.g., Privacy Policy).
     * Returns null if no HTML file exists for this page/locale.
     */
    protected function loadPageContentHtml(string $pageName, string $locale): ?string
    {
        $slug = Str::slug($pageName);
        $path = database_path("seeders/translations/{$locale}/page-contents/{$slug}.html");

        return File::exists($path) ? File::get($path) : null;
    }

    /**
     * Build a [englishHtml => translatedHtml] map for all embedded content
     * files (database/seeders/contents/*) that have a matching locale variant
     * under translations/{locale}/contents/. Used by pageTranslations() to
     * swap embedded long-form HTML (e.g., term-and-privacy.html) before
     * per-key string replacement. Hoisted out of the page loop so files are
     * read once per locale instead of once per (page × file).
     */
    protected function loadEmbeddedContentMap(string $locale): array
    {
        $sourceDir = database_path('seeders/contents');
        $localeDir = database_path("seeders/translations/{$locale}/contents");

        if (! File::isDirectory($sourceDir) || ! File::isDirectory($localeDir)) {
            return [];
        }

        $map = [];
        foreach (File::files($sourceDir) as $sourceFile) {
            $localePath = $localeDir . DIRECTORY_SEPARATOR . $sourceFile->getFilename();
            if (! File::exists($localePath)) {
                continue;
            }

            $english = File::get($sourceFile->getPathname());
            $translated = File::get($localePath);
            if ($english === '' || $english === $translated) {
                continue;
            }

            $map[$english] = $translated;
        }

        return $map;
    }

    protected function getHomepageTranslations(): array
    {
        return [
            'ar' => $this->homepageTranslationsAr(),
            'vi' => $this->homepageTranslationsVi(),
            'fr' => $this->homepageTranslationsFr(),
            'tr' => $this->homepageTranslationsTr(),
            'id' => $this->homepageTranslationsId(),
        ];
    }

    protected function homepageTranslationsAr(): array
    {
        return [
            'We Create Digital Experiences' => 'نصنع تجارب رقمية',
            'B2B Marketing Agency' => 'وكالة تسويق B2B',
            'We help brands grow through creative strategy, bold design, and digital innovation.' => 'نساعد العلامات التجارية على النمو من خلال الاستراتيجية الإبداعية والتصميم الجريء والابتكار الرقمي.',
            'Explore All Work' => 'استعرض جميع الأعمال',
            'How We Work' => 'كيف نعمل',
            'About Us' => 'من نحن',
            'We shape animated stories that inspire and engage, uniting thoughtful design, fluid motion, and digital craftsmanship.' => 'نصوغ قصصًا متحركة تُلهم وتجذب، تجمع بين التصميم المدروس والحركة السلسة والحرفية الرقمية.',
            'We build <b>bold</b>, resilient brands designed to leave a lasting mark on the world.' => 'نبني علامات تجارية <b>جريئة</b> وقوية مصممة لترك بصمة دائمة في العالم.',
            'GET IN TOUCH' => 'تواصل معنا',
            'Creative Expertise' => 'الخبرة الإبداعية',
            'With over a decade of design expertise, we create tailored solutions that engage audiences, build meaningful connections, and elevate brands with creativity and intent.' => 'بخبرة تزيد عن عقد في التصميم، نبتكر حلولًا مخصصة تجذب الجمهور وتبني روابط ذات معنى وترتقي بالعلامات التجارية بإبداع وهدف.',
            'Experience & Innovation' => 'الخبرة والابتكار',
            'Backed by a decade of creative experience, we craft visual experiences that bring together strategy, design, and technology to grow brands, inspire audiences, and create meaningful impact.' => 'مدعومين بعقد من الخبرة الإبداعية، نصمم تجارب بصرية تجمع بين الاستراتيجية والتصميم والتكنولوجيا لتنمية العلامات التجارية وإلهام الجمهور وخلق تأثير حقيقي.',
            'OUR SOLUTIONS' => 'حلولنا',
            'Since 2012' => 'منذ 2012',
            "Selected work we're proud of" => 'أعمال مختارة نفخر بها',
            'Portfolio' => 'معرض الأعمال',
            'A curated selection of projects where strategy, creativity, and craftsmanship come together to build meaningful and enduring brand experiences.' => 'مجموعة منتقاة من المشاريع حيث تتلاقى الاستراتيجية والإبداع والحرفية لبناء تجارب علامات تجارية ذات معنى ودائمة.',
            'View latest projects' => 'عرض أحدث المشاريع',
            'Trusted by Clients' => 'موثوق من العملاء',
            'Real client experiences that speak to the strength of our work.' => 'تجارب حقيقية للعملاء تشهد على قوة عملنا.',
            'Why choose us' => 'لماذا تختارنا',
            'Delivering measurable results through a strong balance of design excellence and functional performance.' => 'تقديم نتائج قابلة للقياس من خلال توازن قوي بين التميز في التصميم والأداء الوظيفي.',
            'Orisa™ goes beyond aesthetics—bringing clarity through motion, flexible structure, and practical tools that help you move faster without defining your identity.' => 'Orisa™ تتجاوز الجماليات — تجلب الوضوح من خلال الحركة والبنية المرنة والأدوات العملية التي تساعدك على التقدم بسرعة.',
            "Active\nlive cases" => "حالات\nنشطة",
            'We always provide people a complete solution upon focused of any business' => 'نقدم دائمًا للعملاء حلولًا متكاملة تركز على أي مجال عمل',
            "Trusted\nPartners" => "شركاء\nموثوقون",
            "Because sometimes the best design is the one you don't have to think about." => 'لأن أفضل تصميم أحيانًا هو الذي لا تحتاج للتفكير فيه.',
            'Years of Creative Practice' => 'سنوات من الممارسة الإبداعية',
            'Projects Carefully Crafted' => 'مشاريع صُنعت بعناية',
            'Brands Collaborated With' => 'علامات تجارية تعاونّا معها',
            'Total Funding Supported' => 'إجمالي التمويل المدعوم',
            'Client satisfaction rate' => 'معدل رضا العملاء',
            'Meet the minds behind Orisa Studio. Rely on our experienced professionals to find solutions tailored just for you.' => 'تعرّف على العقول وراء Orisa Studio. اعتمد على محترفينا ذوي الخبرة لإيجاد حلول مصممة خصيصًا لك.',
            'Join our Team' => 'انضم لفريقنا',
            'We are here' => 'نحن هنا',
            'Art Direction' => 'الإخراج الفني',
            'Motion Design' => 'تصميم الحركة',
            'Branding' => 'بناء العلامة التجارية',
            'Concept Design' => 'تصميم المفاهيم',
            'Presentations' => 'العروض التقديمية',
            'Web & Mobile Apps' => 'تطبيقات الويب والهاتف',
            'SaaS Platforms' => 'منصات SaaS',
            'Answered questions. Everything you might want to know—up front.' => 'أسئلة مجابة. كل ما قد ترغب في معرفته — بوضوح.',
            'FAQ' => 'الأسئلة الشائعة',
            'Still no luck? We can help!' => 'لم تجد إجابتك؟ يمكننا المساعدة!',
            'Let us Know how we can assist' => 'أخبرنا كيف يمكننا مساعدتك',
            'Support Center' => 'مركز الدعم',
            "Let's Create <br> Meaning Together" => 'لنصنع معًا <br> معنىً حقيقيًا',
            'A creative studio crafting bold, user-focused digital experiences. At Orisa, we blend strategy, design, and innovation to help brands stand out and grow.' => 'استوديو إبداعي يصنع تجارب رقمية جريئة تركز على المستخدم. في Orisa، نمزج بين الاستراتيجية والتصميم والابتكار لمساعدة العلامات التجارية على التميز والنمو.',
            'Book A Call Now' => 'احجز مكالمة الآن',
            'INSIDE COMPANY' => 'داخل الشركة',
            'Latest Posts From Our <br> blog and Event Fan page' => 'أحدث المقالات من <br> مدونتنا وصفحة الفعاليات',
            'Insights, trends, and stories from the Orisa team.' => 'رؤى واتجاهات وقصص من فريق Orisa.',
            'ALL ARTICLES' => 'جميع المقالات',
        ];
    }

    protected function homepageTranslationsVi(): array
    {
        return [
            'We Create Digital Experiences' => 'Chúng tôi tạo ra trải nghiệm số',
            'B2B Marketing Agency' => 'Công ty tiếp thị B2B',
            'We help brands grow through creative strategy, bold design, and digital innovation.' => 'Chúng tôi giúp thương hiệu phát triển thông qua chiến lược sáng tạo, thiết kế táo bạo và đổi mới kỹ thuật số.',
            'Explore All Work' => 'Khám phá tất cả',
            'How We Work' => 'Cách chúng tôi làm việc',
            'About Us' => 'Về chúng tôi',
            'We shape animated stories that inspire and engage, uniting thoughtful design, fluid motion, and digital craftsmanship.' => 'Chúng tôi tạo nên những câu chuyện sinh động truyền cảm hứng, kết hợp thiết kế tinh tế, chuyển động mượt mà và sự khéo léo kỹ thuật số.',
            'We build <b>bold</b>, resilient brands designed to leave a lasting mark on the world.' => 'Chúng tôi xây dựng thương hiệu <b>táo bạo</b>, bền vững để lại dấu ấn lâu dài trên thế giới.',
            'GET IN TOUCH' => 'LIÊN HỆ NGAY',
            'Creative Expertise' => 'Chuyên môn sáng tạo',
            'With over a decade of design expertise, we create tailored solutions that engage audiences, build meaningful connections, and elevate brands with creativity and intent.' => 'Với hơn một thập kỷ kinh nghiệm thiết kế, chúng tôi tạo ra giải pháp phù hợp để thu hút khách hàng, xây dựng kết nối ý nghĩa và nâng tầm thương hiệu.',
            'Experience & Innovation' => 'Kinh nghiệm & Đổi mới',
            'Backed by a decade of creative experience, we craft visual experiences that bring together strategy, design, and technology to grow brands, inspire audiences, and create meaningful impact.' => 'Với một thập kỷ kinh nghiệm sáng tạo, chúng tôi tạo ra trải nghiệm thị giác kết hợp chiến lược, thiết kế và công nghệ để phát triển thương hiệu và tạo tác động thực sự.',
            'OUR SOLUTIONS' => 'GIẢI PHÁP CỦA CHÚNG TÔI',
            'Since 2012' => 'Từ năm 2012',
            "Selected work we're proud of" => 'Những dự án chúng tôi tự hào',
            'Portfolio' => 'Dự án',
            'A curated selection of projects where strategy, creativity, and craftsmanship come together to build meaningful and enduring brand experiences.' => 'Tuyển chọn các dự án nơi chiến lược, sáng tạo và sự khéo léo kết hợp để xây dựng trải nghiệm thương hiệu bền vững.',
            'View latest projects' => 'Xem dự án mới nhất',
            'Trusted by Clients' => 'Được khách hàng tin tưởng',
            'Real client experiences that speak to the strength of our work.' => 'Trải nghiệm thực tế từ khách hàng minh chứng cho chất lượng công việc.',
            'Why choose us' => 'Tại sao chọn chúng tôi',
            'Delivering measurable results through a strong balance of design excellence and functional performance.' => 'Mang lại kết quả đo lường được thông qua sự cân bằng giữa thiết kế xuất sắc và hiệu suất chức năng.',
            'Orisa™ goes beyond aesthetics—bringing clarity through motion, flexible structure, and practical tools that help you move faster without defining your identity.' => 'Orisa™ vượt xa thẩm mỹ — mang lại sự rõ ràng qua chuyển động, cấu trúc linh hoạt và công cụ thực tiễn giúp bạn tiến nhanh hơn.',
            "Active\nlive cases" => "Dự án\nđang hoạt động",
            'We always provide people a complete solution upon focused of any business' => 'Chúng tôi luôn cung cấp giải pháp toàn diện cho mọi lĩnh vực kinh doanh',
            "Trusted\nPartners" => "Đối tác\ntin cậy",
            "Because sometimes the best design is the one you don't have to think about." => 'Vì đôi khi thiết kế tốt nhất là thiết kế bạn không cần phải suy nghĩ về nó.',
            'Years of Creative Practice' => 'Năm kinh nghiệm sáng tạo',
            'Projects Carefully Crafted' => 'Dự án được chăm chút kỹ lưỡng',
            'Brands Collaborated With' => 'Thương hiệu đã hợp tác',
            'Total Funding Supported' => 'Tổng vốn hỗ trợ',
            'Client satisfaction rate' => 'Tỷ lệ hài lòng khách hàng',
            'Meet the minds behind Orisa Studio. Rely on our experienced professionals to find solutions tailored just for you.' => 'Gặp gỡ những bộ óc đằng sau Orisa Studio. Hãy tin tưởng đội ngũ chuyên gia giàu kinh nghiệm để tìm giải pháp phù hợp cho bạn.',
            'Join our Team' => 'Gia nhập đội ngũ',
            'We are here' => 'Chúng tôi ở đây',
            'Art Direction' => 'Chỉ đạo nghệ thuật',
            'Motion Design' => 'Thiết kế chuyển động',
            'Branding' => 'Xây dựng thương hiệu',
            'Concept Design' => 'Thiết kế ý tưởng',
            'Presentations' => 'Thuyết trình',
            'Web & Mobile Apps' => 'Ứng dụng Web & Di động',
            'SaaS Platforms' => 'Nền tảng SaaS',
            'Answered questions. Everything you might want to know—up front.' => 'Giải đáp thắc mắc. Mọi thứ bạn cần biết — ngay từ đầu.',
            'FAQ' => 'Câu hỏi thường gặp',
            'Still no luck? We can help!' => 'Vẫn chưa tìm được? Chúng tôi có thể giúp!',
            'Let us Know how we can assist' => 'Hãy cho chúng tôi biết cách hỗ trợ bạn',
            'Support Center' => 'Trung tâm hỗ trợ',
            "Let's Create <br> Meaning Together" => 'Hãy cùng nhau <br> tạo nên ý nghĩa',
            'A creative studio crafting bold, user-focused digital experiences. At Orisa, we blend strategy, design, and innovation to help brands stand out and grow.' => 'Studio sáng tạo chuyên xây dựng trải nghiệm số táo bạo, lấy người dùng làm trung tâm. Tại Orisa, chúng tôi kết hợp chiến lược, thiết kế và đổi mới để giúp thương hiệu nổi bật và phát triển.',
            'Book A Call Now' => 'Đặt lịch gọi ngay',
            'INSIDE COMPANY' => 'BÊN TRONG CÔNG TY',
            'Latest Posts From Our <br> blog and Event Fan page' => 'Bài viết mới nhất từ <br> blog và trang sự kiện',
            'Insights, trends, and stories from the Orisa team.' => 'Góc nhìn, xu hướng và câu chuyện từ đội ngũ Orisa.',
            'ALL ARTICLES' => 'TẤT CẢ BÀI VIẾT',
        ];
    }

    protected function homepageTranslationsFr(): array
    {
        return [
            'We Create Digital Experiences' => 'Nous créons des expériences numériques',
            'B2B Marketing Agency' => 'Agence marketing B2B',
            'We help brands grow through creative strategy, bold design, and digital innovation.' => 'Nous aidons les marques à se développer grâce à une stratégie créative, un design audacieux et l\'innovation numérique.',
            'Explore All Work' => 'Découvrir nos travaux',
            'How We Work' => 'Notre méthode',
            'About Us' => 'À propos',
            'We shape animated stories that inspire and engage, uniting thoughtful design, fluid motion, and digital craftsmanship.' => 'Nous façonnons des histoires animées qui inspirent et engagent, alliant design réfléchi, mouvement fluide et savoir-faire numérique.',
            'We build <b>bold</b>, resilient brands designed to leave a lasting mark on the world.' => 'Nous construisons des marques <b>audacieuses</b> et résilientes conçues pour laisser une empreinte durable.',
            'GET IN TOUCH' => 'NOUS CONTACTER',
            'Creative Expertise' => 'Expertise créative',
            'With over a decade of design expertise, we create tailored solutions that engage audiences, build meaningful connections, and elevate brands with creativity and intent.' => 'Avec plus d\'une décennie d\'expertise en design, nous créons des solutions sur mesure qui engagent le public et élèvent les marques avec créativité.',
            'Experience & Innovation' => 'Expérience et innovation',
            'Backed by a decade of creative experience, we craft visual experiences that bring together strategy, design, and technology to grow brands, inspire audiences, and create meaningful impact.' => 'Forts d\'une décennie d\'expérience créative, nous concevons des expériences visuelles alliant stratégie, design et technologie pour développer les marques et créer un impact réel.',
            'OUR SOLUTIONS' => 'NOS SOLUTIONS',
            'Since 2012' => 'Depuis 2012',
            "Selected work we're proud of" => 'Des réalisations dont nous sommes fiers',
            'Portfolio' => 'Portfolio',
            'A curated selection of projects where strategy, creativity, and craftsmanship come together to build meaningful and enduring brand experiences.' => 'Une sélection de projets où stratégie, créativité et savoir-faire se conjuguent pour créer des expériences de marque durables.',
            'View latest projects' => 'Voir les derniers projets',
            'Trusted by Clients' => 'La confiance de nos clients',
            'Real client experiences that speak to the strength of our work.' => 'Des témoignages clients qui attestent de la qualité de notre travail.',
            'Why choose us' => 'Pourquoi nous choisir',
            'Delivering measurable results through a strong balance of design excellence and functional performance.' => 'Des résultats mesurables grâce à un équilibre entre excellence du design et performance fonctionnelle.',
            'Orisa™ goes beyond aesthetics—bringing clarity through motion, flexible structure, and practical tools that help you move faster without defining your identity.' => 'Orisa™ va au-delà de l\'esthétique — apportant clarté par le mouvement, structure flexible et outils pratiques pour avancer plus vite.',
            "Active\nlive cases" => "Projets\nen cours",
            'We always provide people a complete solution upon focused of any business' => 'Nous fournissons toujours des solutions complètes adaptées à chaque secteur d\'activité',
            "Trusted\nPartners" => "Partenaires\nde confiance",
            "Because sometimes the best design is the one you don't have to think about." => 'Parce que parfois le meilleur design est celui auquel on n\'a pas besoin de penser.',
            'Years of Creative Practice' => 'Années de pratique créative',
            'Projects Carefully Crafted' => 'Projets soigneusement réalisés',
            'Brands Collaborated With' => 'Marques accompagnées',
            'Total Funding Supported' => 'Financement total soutenu',
            'Client satisfaction rate' => 'Taux de satisfaction client',
            'Meet the minds behind Orisa Studio. Rely on our experienced professionals to find solutions tailored just for you.' => 'Découvrez les esprits derrière Orisa Studio. Comptez sur nos professionnels expérimentés pour des solutions sur mesure.',
            'Join our Team' => 'Rejoindre notre équipe',
            'We are here' => 'Nous sommes ici',
            'Art Direction' => 'Direction artistique',
            'Motion Design' => 'Motion design',
            'Branding' => 'Image de marque',
            'Concept Design' => 'Design conceptuel',
            'Presentations' => 'Présentations',
            'Web & Mobile Apps' => 'Applications web et mobile',
            'SaaS Platforms' => 'Plateformes SaaS',
            'Answered questions. Everything you might want to know—up front.' => 'Questions répondues. Tout ce que vous devez savoir — d\'emblée.',
            'FAQ' => 'FAQ',
            'Still no luck? We can help!' => 'Toujours pas de réponse ? Nous pouvons vous aider !',
            'Let us Know how we can assist' => 'Dites-nous comment nous pouvons vous aider',
            'Support Center' => 'Centre d\'assistance',
            "Let's Create <br> Meaning Together" => 'Créons ensemble <br> du sens',
            'A creative studio crafting bold, user-focused digital experiences. At Orisa, we blend strategy, design, and innovation to help brands stand out and grow.' => 'Un studio créatif qui conçoit des expériences numériques audacieuses centrées sur l\'utilisateur. Chez Orisa, nous allions stratégie, design et innovation pour aider les marques à se démarquer.',
            'Book A Call Now' => 'Réserver un appel',
            'INSIDE COMPANY' => 'VIE D\'ENTREPRISE',
            'Latest Posts From Our <br> blog and Event Fan page' => 'Derniers articles de <br> notre blog et page événements',
            'Insights, trends, and stories from the Orisa team.' => 'Perspectives, tendances et histoires de l\'équipe Orisa.',
            'ALL ARTICLES' => 'TOUS LES ARTICLES',
        ];
    }

    protected function homepageTranslationsTr(): array
    {
        return [
            'We Create Digital Experiences' => 'Dijital deneyimler yaratıyoruz',
            'B2B Marketing Agency' => 'B2B Pazarlama Ajansı',
            'We help brands grow through creative strategy, bold design, and digital innovation.' => 'Yaratıcı strateji, cesur tasarım ve dijital inovasyonla markaların büyümesine yardımcı oluyoruz.',
            'Explore All Work' => 'Tüm çalışmaları keşfet',
            'How We Work' => 'Nasıl çalışıyoruz',
            'About Us' => 'Hakkımızda',
            'We shape animated stories that inspire and engage, uniting thoughtful design, fluid motion, and digital craftsmanship.' => 'Düşünceli tasarım, akıcı hareket ve dijital ustalığı birleştirerek ilham veren ve etkileşim yaratan hikayeler şekillendiriyoruz.',
            'We build <b>bold</b>, resilient brands designed to leave a lasting mark on the world.' => 'Dünyada kalıcı iz bırakmak için tasarlanmış <b>cesur</b> ve dayanıklı markalar inşa ediyoruz.',
            'GET IN TOUCH' => 'İLETİŞİME GEÇ',
            'Creative Expertise' => 'Yaratıcı uzmanlık',
            'With over a decade of design expertise, we create tailored solutions that engage audiences, build meaningful connections, and elevate brands with creativity and intent.' => 'On yılı aşkın tasarım deneyimiyle, kitleleri çeken, anlamlı bağlantılar kuran ve markaları yaratıcılıkla yükselten çözümler üretiyoruz.',
            'Experience & Innovation' => 'Deneyim ve inovasyon',
            'Backed by a decade of creative experience, we craft visual experiences that bring together strategy, design, and technology to grow brands, inspire audiences, and create meaningful impact.' => 'On yıllık yaratıcı deneyimle desteklenen görsel deneyimler tasarlayarak strateji, tasarım ve teknolojiyi bir araya getirip markaları büyütüyoruz.',
            'OUR SOLUTIONS' => 'ÇÖZÜMLERİMİZ',
            'Since 2012' => '2012\'den beri',
            "Selected work we're proud of" => 'Gurur duyduğumuz seçkin çalışmalar',
            'Portfolio' => 'Portföy',
            'A curated selection of projects where strategy, creativity, and craftsmanship come together to build meaningful and enduring brand experiences.' => 'Strateji, yaratıcılık ve ustalığın bir araya gelerek kalıcı marka deneyimleri oluşturduğu seçilmiş projeler.',
            'View latest projects' => 'Son projeleri görüntüle',
            'Trusted by Clients' => 'Müşteriler tarafından güveniliyor',
            'Real client experiences that speak to the strength of our work.' => 'Çalışmalarımızın gücünü yansıtan gerçek müşteri deneyimleri.',
            'Why choose us' => 'Neden bizi seçmelisiniz',
            'Delivering measurable results through a strong balance of design excellence and functional performance.' => 'Tasarım mükemmelliği ve işlevsel performans arasındaki güçlü dengeyle ölçülebilir sonuçlar sunuyoruz.',
            'Orisa™ goes beyond aesthetics—bringing clarity through motion, flexible structure, and practical tools that help you move faster without defining your identity.' => 'Orisa™ estetiğin ötesine geçer — hareket, esnek yapı ve pratik araçlarla netlik sağlayarak daha hızlı ilerlemenize yardımcı olur.',
            "Active\nlive cases" => "Aktif\nprojeler",
            'We always provide people a complete solution upon focused of any business' => 'Her iş alanına odaklı eksiksiz çözümler sunuyoruz',
            "Trusted\nPartners" => "Güvenilir\northaklar",
            "Because sometimes the best design is the one you don't have to think about." => 'Çünkü bazen en iyi tasarım, düşünmenize gerek olmayan tasarımdır.',
            'Years of Creative Practice' => 'Yıllık yaratıcı deneyim',
            'Projects Carefully Crafted' => 'Özenle hazırlanan projeler',
            'Brands Collaborated With' => 'İş birliği yapılan markalar',
            'Total Funding Supported' => 'Desteklenen toplam fon',
            'Client satisfaction rate' => 'Müşteri memnuniyet oranı',
            'Meet the minds behind Orisa Studio. Rely on our experienced professionals to find solutions tailored just for you.' => 'Orisa Studio\'nun arkasındaki beyinlerle tanışın. Size özel çözümler için deneyimli profesyonellerimize güvenin.',
            'Join our Team' => 'Ekibimize katılın',
            'We are here' => 'Buradayız',
            'Art Direction' => 'Sanat yönetimi',
            'Motion Design' => 'Hareket tasarımı',
            'Branding' => 'Marka oluşturma',
            'Concept Design' => 'Konsept tasarım',
            'Presentations' => 'Sunumlar',
            'Web & Mobile Apps' => 'Web ve mobil uygulamalar',
            'SaaS Platforms' => 'SaaS platformları',
            'Answered questions. Everything you might want to know—up front.' => 'Yanıtlanmış sorular. Bilmeniz gereken her şey — önceden.',
            'FAQ' => 'SSS',
            'Still no luck? We can help!' => 'Hâlâ bulamadınız mı? Yardımcı olabiliriz!',
            'Let us Know how we can assist' => 'Size nasıl yardımcı olabileceğimizi bildirin',
            'Support Center' => 'Destek merkezi',
            "Let's Create <br> Meaning Together" => 'Birlikte <br> anlam yaratalım',
            'A creative studio crafting bold, user-focused digital experiences. At Orisa, we blend strategy, design, and innovation to help brands stand out and grow.' => 'Cesur, kullanıcı odaklı dijital deneyimler üreten yaratıcı bir stüdyo. Orisa\'da strateji, tasarım ve inovasyonu harmanlayarak markaların öne çıkmasına yardımcı oluyoruz.',
            'Book A Call Now' => 'Şimdi arayın',
            'INSIDE COMPANY' => 'ŞİRKET İÇİ',
            'Latest Posts From Our <br> blog and Event Fan page' => 'Blog ve etkinlik <br> sayfamızdan son yazılar',
            'Insights, trends, and stories from the Orisa team.' => 'Orisa ekibinden içgörüler, trendler ve hikayeler.',
            'ALL ARTICLES' => 'TÜM MAKALELER',
        ];
    }

    protected function homepageTranslationsId(): array
    {
        return [
            'We Create Digital Experiences' => 'Kami menciptakan pengalaman digital',
            'B2B Marketing Agency' => 'Agensi pemasaran B2B',
            'We help brands grow through creative strategy, bold design, and digital innovation.' => 'Kami membantu merek berkembang melalui strategi kreatif, desain berani, dan inovasi digital.',
            'Explore All Work' => 'Jelajahi semua karya',
            'How We Work' => 'Cara kami bekerja',
            'About Us' => 'Tentang kami',
            'We shape animated stories that inspire and engage, uniting thoughtful design, fluid motion, and digital craftsmanship.' => 'Kami membentuk cerita animasi yang menginspirasi dan menarik, menggabungkan desain cermat, gerakan halus, dan keahlian digital.',
            'We build <b>bold</b>, resilient brands designed to leave a lasting mark on the world.' => 'Kami membangun merek yang <b>berani</b> dan tangguh yang dirancang untuk meninggalkan jejak abadi di dunia.',
            'GET IN TOUCH' => 'HUBUNGI KAMI',
            'Creative Expertise' => 'Keahlian kreatif',
            'With over a decade of design expertise, we create tailored solutions that engage audiences, build meaningful connections, and elevate brands with creativity and intent.' => 'Dengan lebih dari satu dekade keahlian desain, kami menciptakan solusi khusus yang menarik audiens, membangun koneksi bermakna, dan mengangkat merek dengan kreativitas.',
            'Experience & Innovation' => 'Pengalaman & Inovasi',
            'Backed by a decade of creative experience, we craft visual experiences that bring together strategy, design, and technology to grow brands, inspire audiences, and create meaningful impact.' => 'Didukung pengalaman kreatif satu dekade, kami merancang pengalaman visual yang menggabungkan strategi, desain, dan teknologi untuk mengembangkan merek dan menciptakan dampak nyata.',
            'OUR SOLUTIONS' => 'SOLUSI KAMI',
            'Since 2012' => 'Sejak 2012',
            "Selected work we're proud of" => 'Karya pilihan yang kami banggakan',
            'Portfolio' => 'Portofolio',
            'A curated selection of projects where strategy, creativity, and craftsmanship come together to build meaningful and enduring brand experiences.' => 'Koleksi proyek pilihan di mana strategi, kreativitas, dan keahlian bersatu untuk membangun pengalaman merek yang bermakna dan abadi.',
            'View latest projects' => 'Lihat proyek terbaru',
            'Trusted by Clients' => 'Dipercaya oleh klien',
            'Real client experiences that speak to the strength of our work.' => 'Pengalaman nyata klien yang membuktikan kualitas pekerjaan kami.',
            'Why choose us' => 'Mengapa memilih kami',
            'Delivering measurable results through a strong balance of design excellence and functional performance.' => 'Memberikan hasil terukur melalui keseimbangan antara keunggulan desain dan kinerja fungsional.',
            'Orisa™ goes beyond aesthetics—bringing clarity through motion, flexible structure, and practical tools that help you move faster without defining your identity.' => 'Orisa™ melampaui estetika — menghadirkan kejelasan melalui gerakan, struktur fleksibel, dan alat praktis yang membantu Anda bergerak lebih cepat.',
            "Active\nlive cases" => "Proyek\naktif",
            'We always provide people a complete solution upon focused of any business' => 'Kami selalu memberikan solusi lengkap yang berfokus pada setiap bidang bisnis',
            "Trusted\nPartners" => "Mitra\nterpercaya",
            "Because sometimes the best design is the one you don't have to think about." => 'Karena terkadang desain terbaik adalah yang tidak perlu Anda pikirkan.',
            'Years of Creative Practice' => 'Tahun pengalaman kreatif',
            'Projects Carefully Crafted' => 'Proyek yang dikerjakan dengan teliti',
            'Brands Collaborated With' => 'Merek yang bekerja sama',
            'Total Funding Supported' => 'Total pendanaan yang didukung',
            'Client satisfaction rate' => 'Tingkat kepuasan klien',
            'Meet the minds behind Orisa Studio. Rely on our experienced professionals to find solutions tailored just for you.' => 'Kenali orang-orang di balik Orisa Studio. Andalkan profesional berpengalaman kami untuk solusi yang dirancang khusus untuk Anda.',
            'Join our Team' => 'Bergabung dengan tim kami',
            'We are here' => 'Kami di sini',
            'Art Direction' => 'Arahan seni',
            'Motion Design' => 'Desain gerak',
            'Branding' => 'Branding',
            'Concept Design' => 'Desain konsep',
            'Presentations' => 'Presentasi',
            'Web & Mobile Apps' => 'Aplikasi web & seluler',
            'SaaS Platforms' => 'Platform SaaS',
            'Answered questions. Everything you might want to know—up front.' => 'Pertanyaan terjawab. Semua yang perlu Anda ketahui — langsung.',
            'FAQ' => 'FAQ',
            'Still no luck? We can help!' => 'Belum menemukan jawaban? Kami bisa membantu!',
            'Let us Know how we can assist' => 'Beri tahu kami bagaimana kami bisa membantu',
            'Support Center' => 'Pusat bantuan',
            "Let's Create <br> Meaning Together" => 'Mari bersama <br> ciptakan makna',
            'A creative studio crafting bold, user-focused digital experiences. At Orisa, we blend strategy, design, and innovation to help brands stand out and grow.' => 'Studio kreatif yang merancang pengalaman digital berani dan berpusat pada pengguna. Di Orisa, kami memadukan strategi, desain, dan inovasi untuk membantu merek menonjol dan berkembang.',
            'Book A Call Now' => 'Jadwalkan panggilan',
            'INSIDE COMPANY' => 'DALAM PERUSAHAAN',
            'Latest Posts From Our <br> blog and Event Fan page' => 'Artikel terbaru dari <br> blog dan halaman acara kami',
            'Insights, trends, and stories from the Orisa team.' => 'Wawasan, tren, dan cerita dari tim Orisa.',
            'ALL ARTICLES' => 'SEMUA ARTIKEL',
        ];
    }

    protected function getSkippedTables(): array
    {
        return ['pages'];
    }
}
