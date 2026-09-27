<?php

namespace Database\Seeders\Themes\Home3;

use Botble\Base\Facades\MetaBox;
use Botble\Page\Models\Page;
use Botble\Portfolio\Models\Service;
use Botble\Portfolio\Models\ServiceCategory;
use Botble\Slug\Facades\SlugHelper;

class PageSeeder extends \Database\Seeders\Themes\Main\PageSeeder
{
    public function run(): void
    {
        parent::run();

        // Seed Home3-specific curated services (performance marketing) for sec-4-home-3.
        // Each has: name (used as the right panel headline), nav_name metadata (short left-nav label),
        // skills metadata (pipe-separated bullet list), and image (img-58..62).
        $home3ServiceIds = $this->seedHome3Services();

        $homepage = Page::query()->where('name', 'Homepage')->firstOrFail();

        // Reusable ticker payloads for sec-2 + sec-5 (both use skills-carousel with dark mode).
        // Sec-2: 7 service keywords scrolling left on dark background.
        $sec2TickerKeywords = collect(['Positioning', 'Value proposition', 'Brand identity', 'Performance', 'Rebranding', 'Omnichannel', 'Social ads'])
            ->mapWithKeys(fn ($name, $i) => ['name_' . ($i + 1) => $name])
            ->all();

        // Sec-5: 5 stats formatted as ticker text (e.g. "120% ROI increase").
        $sec5TickerStats = collect([
            '120% ROI increase',
            '$25M+ Ad spend managed',
            '300+ Campaigns launched',
            '18K+ Audience reached',
            '500K+ Leads generated',
        ])->mapWithKeys(fn ($name, $i) => ['name_' . ($i + 1) => $name])->all();

        $homepage->update([
            'content' => $this->generateShortcodeContent([
                // Sec-1: Hero with testimonial card + title + client count badge
                [
                    'name' => 'hero-banner',
                    'attributes' => [
                        'style' => '3',
                        'subtitle' => 'Performance Marketing Agency',
                        'title' => 'Marketing <br> That Delivers <br> Real <span class="theme-primary">Value</span>',
                        'description' => 'We help ambitious brands acquire customers, increase conversions, and scale revenue through data-driven marketing strategies.',
                        // Left testimonial card
                        'image' => $this->filePath('pages/img-54.webp'),
                        'card_text' => "Real experiences. Real results. Hear from clients who've gained clarity, confidence, and financial growth.",
                        'card_author' => 'Hannah Lee',
                        'card_author_role' => 'Creative Director',
                        'card_avatar' => $this->filePath('testimonials/avatar-6.webp'),
                        // Center CTAs
                        'primary_action_label' => 'View Latest Projects',
                        'primary_action_url' => '/portfolio',
                        'secondary_action_label' => 'View Pricing Plan',
                        'secondary_action_url' => '/pricing',
                        // Right image + client count badge (uses right_image not background_image)
                        'right_image' => $this->filePath('pages/img-55.webp'),
                        'client_count' => '16',
                        'client_count_suffix' => 'K+',
                        'client_count_label' => 'Clients word-wide',
                        'client_avatar_1' => $this->filePath('testimonials/avatar-15.webp'),
                        'client_avatar_2' => $this->filePath('testimonials/avatar-16.webp'),
                        'client_avatar_3' => $this->filePath('testimonials/avatar-17.webp'),
                        'client_avatar_4' => $this->filePath('testimonials/avatar-18.webp'),
                        'client_avatar_5' => $this->filePath('testimonials/avatar-19.webp'),
                        // Bottom service tags (order 5 in HTML)
                        'services_quantity' => '5',
                        'services_name_1' => 'Conversion-focused',
                        'services_name_2' => 'Data-driven',
                        'services_name_3' => 'Built for scale',
                        'services_name_4' => 'User-centric',
                        'services_name_5' => 'Future-proof',
                    ],
                ],
                // Sec-2: Dark marquee ticker of service keywords
                [
                    'name' => 'skills-carousel',
                    'attributes' => [
                        'dark' => '1',
                        'scroll_direction' => 'right',
                        'quantity' => 7,
                        ...$sec2TickerKeywords,
                    ],
                ],
                // Sec-3: Partners grid with "Trusted by fast-growing brands" title + stat badge
                [
                    'name' => 'partners',
                    'attributes' => [
                        'style' => '3',
                        'title' => 'Trusted by fast-growing brands worldwide',
                        'description' => 'in total revenue generated <br> for clients',
                        'image_1' => $this->filePath('pages/img-56.webp'),
                        'style_image_1' => $this->filePath('pages/img-56.webp'),
                        'image_2' => $this->filePath('pages/img-57.webp'),
                        'style_image_2' => $this->filePath('pages/img-57.webp'),
                        'stat_prefix' => '$',
                        'stat_value' => '850',
                        'stat_suffix' => 'M+',
                        'quantity' => 12,
                        ...collect(['Framer', 'Reddit', 'Netflix', 'Microsoft', 'Discover', 'Lemon Squeezy', 'Paypal', 'Youtube', 'Spotify', 'Google', 'Amazon', 'Apple'])
                            ->mapWithKeys(function ($name, $index) {
                                $index++;
                                $imageName = $index > 8 ? rand(1, 8) : $index;

                                return [
                                    "name_$index" => $name,
                                    "image_$index" => $this->filePath("partners/$imageName.webp"),
                                    "url_$index" => 'https://orisa.com',
                                    "open_in_new_tab_$index" => true,
                                ];
                            })
                            ->all(),
                    ],
                ],
                // Sec-4: Services scroll panels — 5 curated performance marketing services (matches sec-4-home-3)
                [
                    'name' => 'services',
                    'attributes' => [
                        'style' => '3',
                        'subtitle' => 'What we do',
                        'title' => 'We turn ideas into high-impact digital solutions that attract customers, boost conversions, and accelerate sustainable growth.',
                        'primary_action_label' => 'View latest projects',
                        'primary_action_url' => '/portfolio',
                        'service_ids' => implode(',', $home3ServiceIds),
                        'per_page' => 5,
                    ],
                ],
                // Sec-5: Dark stats ticker (right scroll)
                [
                    'name' => 'skills-carousel',
                    'attributes' => [
                        'dark' => '1',
                        'scroll_direction' => 'left',
                        'quantity' => 5,
                        ...$sec5TickerStats,
                    ],
                ],
                // Sec-6: Case studies portfolio grid
                [
                    'name' => 'projects',
                    'attributes' => [
                        'style' => '1',
                        'subtitle' => 'Case Studies',
                        'title' => 'Real Results. Proven Impact.',
                        'description' => 'See how our performance marketing strategies help brands grow.',
                        'primary_action_label' => 'View All Case Studies',
                        'primary_action_url' => '/portfolio',
                    ],
                ],
                // Sec-7: Solutions block — using content-block style 1 (image + subtitle + title + features)
                [
                    'name' => 'content-block',
                    'attributes' => [
                        'style' => '1',
                        'subtitle' => 'Our Solutions',
                        'title' => 'Together, we build experiences, relationships, and digital solutions that move brands ahead.',
                        'image_1' => $this->filePath('pages/img-69.webp'),
                        'style_image_1' => $this->filePath('pages/img-69.webp'),
                        'quantity' => 4,
                        'title_1' => 'Strategy-first digital thinking',
                        'title_2' => 'Scalable & future-ready solutions',
                        'title_3' => 'Human-centered design approach',
                        'title_4' => 'Long-term brand partnerships',
                    ],
                ],
                // Sec-8: Dark CTA with right image
                [
                    'name' => 'call-to-action',
                    'attributes' => [
                        'style' => '3',
                        'title' => 'Ready to turn marketing into a growth engine?',
                        'description' => "Let's audit your current marketing and <br> uncover your biggest growth opportunities.",
                        'primary_action_label' => 'View latest projects',
                        'primary_action_url' => '/portfolio',
                        'image_2' => $this->filePath('pages/img-70.webp'),
                    ],
                ],
                // Sec-9: Team members
                [
                    'name' => 'teams',
                    'attributes' => [
                        'style' => '1',
                        'subtitle' => 'Our Team',
                        'title' => 'Behind the Visionaries',
                        'description' => 'Creative experts designing meaningful digital experiences that connect brands and people.',
                        'team_ids' => '1,2,3,4',
                    ],
                ],
                // Sec-10: Growth process — using content-block style 3 as generic fallback
                [
                    'name' => 'content-block',
                    'attributes' => [
                        'style' => '3',
                        'subtitle' => 'Our Growth Process',
                        'title' => 'We push boundaries while following a proven methodology.',
                        'description' => '[ Step-by-step implementation ]',
                        'quantity' => 5,
                        'title_1' => 'Discover & Diagnose',
                        'description_1' => 'We analyze your market, audience, data, and existing performance to uncover real growth opportunities.',
                        'title_2' => 'Strategy & Planning',
                        'description_2' => 'We turn insights into a clear, actionable roadmap tailored to your goals and audience.',
                        'title_3' => 'Launch & Execute',
                        'description_3' => 'We bring the strategy to life with campaigns, creative, and landing pages built to convert.',
                        'title_4' => 'Optimize & Scale',
                        'description_4' => 'Continuous testing and optimization to maximize ROI as you scale.',
                        'title_5' => 'Measure & Evolve',
                        'description_5' => 'Clear reporting and insights to keep improving every step of the way.',
                    ],
                ],
                // Sec-11: Blog journal
                [
                    'name' => 'blog-posts',
                    'attributes' => [
                        'subtitle' => 'Insights & Inspiration',
                        'title' => 'Explore our Latest journal',
                        'description' => 'Marketing insights, campaign breakdowns, and growth strategies.',
                        'paginate' => 6,
                        'action_label' => 'All Articles',
                        'action_url' => '/blog',
                    ],
                ],
                // Sec-12: Newsletter signup — light box layout with inline image (not full-bleed bg)
                [
                    'name' => 'newsletter',
                    'attributes' => [
                        'style' => '2',
                        'subtitle' => 'Newsletter',
                        'title' => 'Stay ahead',
                        'description' => 'Get practical insights, trends, and strategies we use to help brands grow—delivered monthly, no spam.',
                        'button_label' => 'Subscribe',
                        'image' => $this->filePath('pages/img-74.webp'),
                    ],
                ],
            ]),
        ]);
    }

    /**
     * Creates 5 curated Home3 performance-marketing services matching
     * `sec-4-home-3` in index-3.html. Each service stores:
     *   - `name`         : the right-panel headline (long phrase)
     *   - `nav_name`     : left-nav short label (via MetaBox)
     *   - `skills`       : pipe-separated bullet list (via MetaBox)
     *   - `image`        : per-panel image (img-58 ... img-62)
     *
     * @return array<int> ids of the newly-created services
     */
    protected function seedHome3Services(): array
    {
        $items = [
            [
                'name' => 'Paid ads across Google, Meta, TikTok, LinkedIn',
                'nav_name' => 'Performance Marketing',
                'image' => 'pages/img-58.webp',
                'skills' => 'Campaign strategy & planning|Ad creative & copy testing|Audience targeting & retargeting|Budget optimization & scaling|ROAS & CPA optimization',
            ],
            [
                'name' => 'Search visibility that compounds over time',
                'nav_name' => 'SEO & Content Growth',
                'image' => 'pages/img-59.webp',
                'skills' => 'Keyword research & search intent mapping|On-page SEO optimization|Content strategy & editorial planning|Technical SEO audits|Link building & authority growth',
            ],
            [
                'name' => 'Optimization — turning high-intent traffic into loyal customers',
                'nav_name' => 'Rate Optimization',
                'image' => 'pages/img-60.webp',
                'skills' => 'Funnel analysis & user behavior tracking|Landing page optimization|A/B testing & experimentation|UX & messaging refinement|Conversion tracking setup',
            ],
            [
                'name' => 'Scalable automated workflows that nurture leads at every stage',
                'nav_name' => 'Marketing Automation',
                'image' => 'pages/img-61.webp',
                'skills' => 'CRM integration & data sync|Lifecycle email flows|Segmentation & personalization|Lead scoring & routing|Workflow analytics',
            ],
            [
                'name' => 'Clear attribution and dashboards that drive real decisions',
                'nav_name' => 'Analytics & Attribution',
                'image' => 'pages/img-62.webp',
                'skills' => 'Cross-channel attribution modeling|Custom dashboards & reporting|Server-side tracking setup|Cohort & LTV analysis|KPI alignment with business goals',
            ],
        ];

        $defaultCategoryId = ServiceCategory::query()->value('id');

        $ids = [];
        foreach ($items as $item) {
            $service = Service::query()->create([
                'name' => $item['name'],
                'description' => '',
                'image' => $this->filePath($item['image']),
                'category_id' => $defaultCategoryId,
                'content' => '',
                'is_featured' => true,
                'views' => 0,
            ]);

            MetaBox::saveMetaBoxData($service, 'nav_name', $item['nav_name']);
            MetaBox::saveMetaBoxData($service, 'skills', $item['skills']);

            SlugHelper::createSlug($service);

            $ids[] = $service->id;
        }

        return $ids;
    }
}
