<?php

namespace Database\Seeders\Themes\Home2;

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

        // Seed Home2-specific curated services matching sec-4-home-2 in index-2.html.
        // Each has rich `skills` metadata (two pipe-separated sub-lists) rendered by services/style-2.blade.php.
        $serviceIds = $this->seedHome2Services();

        $homepage = Page::query()->where('name', 'Homepage')->firstOrFail();

        // Tabs payload for sec-5 (avatar slider + quote slider) and sec-10 (testimonial cards scroll).
        // Each tab provides: name/role/company/quote/rating/avatar — same shape as testimonials shortcode.
        $testimonialTabs = collect([
            ['name' => 'Amelia Wright', 'role' => 'Head of Marketing', 'company' => 'London, United Kingdom', 'quote' => 'They delivered not just a design, but a complete brand experience. Strategic, creative, and incredibly detail-oriented.', 'avatar' => 'testimonials/avatar-15.webp', 'rating' => 5],
            ['name' => 'Steven Jobs', 'role' => 'CEO of Krim Co', 'company' => 'California, USA', 'quote' => 'The collaboration was seamless from start to finish. Their UX decisions significantly improved our product engagement.', 'avatar' => 'testimonials/avatar-16.webp', 'rating' => 5],
            ['name' => 'Hannah Lee', 'role' => 'Creative Director', 'company' => 'Studio Kinetic', 'quote' => 'A rare combination of technical expertise and artistic vision. The final result felt premium and purposeful.', 'avatar' => 'testimonials/avatar-17.webp', 'rating' => 5],
            ['name' => 'Lucas Moreno', 'role' => 'Product Manager', 'company' => 'Barcelona, Spain', 'quote' => 'They translated our vision into a polished interface that our customers love. Highly recommended.', 'avatar' => 'testimonials/avatar-18.webp', 'rating' => 5],
            ['name' => 'Sofia Martinez', 'role' => 'Brand Director', 'company' => 'Lumina Agency', 'quote' => 'Every deliverable exceeded our expectations and resonated with our audience. A partner you can trust.', 'avatar' => 'testimonials/avatar-19.webp', 'rating' => 5],
        ])->mapWithKeys(function ($t, $i) {
            $i++;

            return [
                "name_$i" => $t['name'],
                "role_$i" => $t['role'],
                "company_$i" => $t['company'],
                "quote_$i" => $t['quote'],
                "rating_$i" => $t['rating'],
                "avatar_$i" => $this->filePath($t['avatar']),
            ];
        })->all();

        $homepage->update([
            'content' => $this->generateShortcodeContent([
                // Sec-1 + Sec-2: hero-banner style-2 already renders the hero AND the dark "Who We Are" strip.
                [
                    'name' => 'hero-banner',
                    'attributes' => [
                        'style' => '2',
                        'title' => 'Orisa Studio<sup class="fz-80 fw-400">&reg;</sup>',
                        'subtitle' => '(+01) 555-7398',
                        'description' => "We collaborate with the world's leading platforms and partners to deliver results that redefine industry standards.",
                        'image' => $this->filePath('general/home2-hero-avatar.webp'),
                        'noise_overlay' => $this->filePath('backgrounds/noise.gif'),
                        'background_video' => '/themes/orisa/videos/video-1.mp4',
                        'social_links_quantity' => '4',
                        'social_links_name_1' => 'Twitter',
                        'social_links_url_1' => '#',
                        'social_links_name_2' => 'Facebook',
                        'social_links_url_2' => '#',
                        'social_links_name_3' => 'Instagram',
                        'social_links_url_3' => '#',
                        'social_links_name_4' => 'Dribbble',
                        'social_links_url_4' => '#',
                        'services_quantity' => '4',
                        'services_name_1' => 'Web Development',
                        'services_name_2' => 'Motion Graphics',
                        'services_name_3' => 'Brand Strategy',
                        'services_name_4' => 'Product Design',
                        'bottom_subtitle' => 'Who We Are',
                        'bottom_title' => 'We build digital experiences that drive real growth.',
                        'bottom_description' => 'Strategy, design, and technology aligned to deliver measurable business results for ambitious brands.',
                        'card_image' => $this->filePath('general/home2-card-bg.webp'),
                        'card_avatar' => $this->filePath('general/home2-card-avatar.webp'),
                        'card_text' => 'Trusted by fast-growing startups and global companies worldwide',
                    ],
                ],
                // Sec-3: partners carousel with headline + Let's Talk
                [
                    'name' => 'partners',
                    'attributes' => [
                        'style' => '2',
                        'subtitle' => 'Our Partners',
                        'title' => 'Collaborating with progressive brands to shape meaningful, long-term impact.',
                        'description' => 'Empowering ambitious brands to <br class="d-block"> define their presence with focus <br class="d-block"> and precision.',
                        'primary_action_label' => "Let's Talk",
                        'primary_action_url' => 'mailto:hello@orisa.com',
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
                // Sec-4: "Things we offer" vertical scroll panels (matches sec-4-home-2)
                [
                    'name' => 'services',
                    'attributes' => [
                        'style' => '2',
                        'subtitle' => 'Things we offer',
                        'description' => '© Since 2012',
                        'service_ids' => implode(',', $serviceIds),
                        'per_page' => 4,
                    ],
                ],
                // Sec-5: testimonial avatar slider + quote swiper + Get in touch CTA
                [
                    'name' => 'testimonials',
                    'attributes' => [
                        'style' => '5',
                        'action_label' => 'Get in touch',
                        'action_url' => '/contact-1',
                        'quantity' => 5,
                        ...$testimonialTabs,
                    ],
                ],
                // Sec-6: Selected Work portfolio grid
                [
                    'name' => 'projects',
                    'attributes' => [
                        'style' => '1',
                        'subtitle' => 'Selected Work',
                        'title' => 'Projects we are proud of',
                        'description' => 'A curated selection of work where strategy meets craft.',
                        'primary_action_label' => 'View All Work',
                        'primary_action_url' => '/portfolio',
                    ],
                ],
                // Sec-7: Awards list with hover-zoom cards
                [
                    'name' => 'awards',
                    'attributes' => [
                        'title' => 'Awards.',
                        'description' => 'Orisa is a digital agency creating impactful digital experiences. We think like strategists and execute with clarity, creativity, and performance.',
                        'action_label' => 'View All Awards',
                        'action_url' => '/portfolio',
                        'quantity' => 5,
                        ...collect([
                            ['date' => '19 Oct 2024', 'title' => 'Best Web Design Agency', 'organization' => 'Web Excellence Awards', 'url' => 'https://csswinner.com', 'url_label' => 'csswinner.com', 'image' => 'pages/img-40.webp', 'image_lg' => 'pages/img-40-lg.webp'],
                            ['date' => '12 Feb 2026', 'title' => 'Digital Agency of the Year', 'organization' => 'Global Digital Excellence Awards', 'url' => 'https://globaldigitalawards.com', 'url_label' => 'globaldigitalawards.com', 'image' => 'pages/img-41.webp', 'image_lg' => 'pages/img-41-lg.webp'],
                            ['date' => '08 Aug 2025', 'title' => 'Innovation in Digital Experience', 'organization' => 'International Digital Awards', 'url' => 'https://digital-awards.org', 'url_label' => 'digital-awards.org', 'image' => 'pages/img-42.webp', 'image_lg' => 'pages/img-42-lg.webp'],
                            ['date' => '19 Oct 2024', 'title' => 'Best Integrated Digital Campaign', 'organization' => 'Drum Awards', 'url' => 'https://thedrum.com', 'url_label' => 'thedrum.com', 'image' => 'pages/img-43.webp', 'image_lg' => 'pages/img-43-lg.webp'],
                            ['date' => '03 Apr 2026', 'title' => 'Growth-Driven Digital Agency', 'organization' => 'Clutch Leaders Awards', 'url' => 'https://clutch.co', 'url_label' => 'clutch.co', 'image' => 'pages/img-44.webp', 'image_lg' => 'pages/img-44-lg.webp'],
                        ])->mapWithKeys(function ($a, $i) {
                            $i++;

                            return [
                                "date_$i" => $a['date'],
                                "title_$i" => $a['title'],
                                "organization_$i" => $a['organization'],
                                "url_$i" => $a['url'],
                                "url_label_$i" => $a['url_label'],
                                "image_$i" => $this->filePath($a['image']),
                                "image_lg_$i" => $this->filePath($a['image_lg']),
                            ];
                        })->all(),
                    ],
                ],
                // Sec-8: full-width image gallery swiper
                [
                    'name' => 'image-gallery',
                    'attributes' => [
                        'quantity' => 5,
                        ...collect(['img-48.webp', 'img-45.webp', 'img-46.webp', 'img-47.webp', 'img-49.webp'])
                            ->mapWithKeys(function ($file, $i) {
                                $i++;

                                return [
                                    "image_$i" => $this->filePath("pages/$file"),
                                    "alt_$i" => "Orisa work $i",
                                ];
                            })->all(),
                    ],
                ],
                // Sec-9: statistics counters
                [
                    'name' => 'site-statistics',
                    'attributes' => [
                        'style' => '1',
                        'quantity' => 3,
                        'prefix_1' => '$', 'value_1' => '28', 'suffix_1' => 'M+', 'label_1' => 'Revenue driven through digital strategy',
                        'value_2' => '64', 'suffix_2' => 'K+', 'label_2' => 'Qualified leads generated',
                        'value_3' => '190', 'suffix_3' => '+', 'label_3' => 'Brands scaled with Orisa',
                    ],
                ],
                // Sec-10: pinned-column "What our clients are saying" + scroll testimonial cards
                [
                    'name' => 'testimonials',
                    'attributes' => [
                        'style' => '6',
                        'subtitle' => 'Why choose us',
                        'title' => 'What our <br> clients are <br> saying',
                        'action_label' => 'View latest projects',
                        'action_url' => '/portfolio',
                        'quantity' => 5,
                        ...$testimonialTabs,
                    ],
                ],
                // Sec-11: video showreel (single image + popup-video play)
                [
                    'name' => 'video-showreel',
                    'attributes' => [
                        'image' => $this->filePath('pages/bg-img-2.webp'),
                        'video_url' => 'https://www.youtube.com/watch?v=VCPGMjCW0is',
                        'left_label' => 'Play',
                        'right_label' => 'showreel',
                    ],
                ],
                // Sec-12: pricing plans toggle
                [
                    'name' => 'pricing-plans',
                    'attributes' => [
                        'style' => '1',
                        'subtitle' => 'Price & Plans',
                        'title' => 'Flexible plans for every team',
                        'description' => 'Choose a plan that fits your project and budget.',
                        ...$this->pricingPlanTabs(),
                    ],
                ],
                // Sec-13: blog "Inside" articles
                [
                    'name' => 'blog-posts',
                    'attributes' => [
                        'subtitle' => 'Article & blogs',
                        'title' => 'Inside',
                        'description' => 'Insights, trends, and stories from the Orisa team.',
                        'paginate' => 4,
                        'action_label' => 'All Articles',
                        'action_url' => '/blog',
                    ],
                ],
            ]),
        ]);
    }

    /**
     * Creates 4 Home2 curated services for the vertical scroll panel section
     * (sec-4-home-2): Brand Strategy, UI/UX Design, Marketing, Optimization.
     * Each stores two pipe-separated skills sub-lists via MetaBox, split by `||`
     * and rendered as dual `<ul>` columns by services/style-2.blade.php.
     *
     * @return array<int> ids of the newly-created services
     */
    protected function seedHome2Services(): array
    {
        $items = [
            [
                'name' => 'Brand Strategy',
                'description' => 'Branding is more than a visual identity—it\'s the strategic backbone of your business. We help brands define who they are, what they stand for, and how they connect with their audience.',
                'image' => 'pages/img-30.webp',
                'skills' => 'Research & Insights|Purpose, Mission & Vision|Value Proposition||Brand Architecture|Messaging Framework|Identity Systems',
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Great design feels effortless—but it\'s driven by deep understanding and careful intention. We create user-centered digital experiences that balance aesthetics with usability.',
                'image' => 'pages/img-31.webp',
                'skills' => 'UX Research & User Journeys|Information Architecture|Wireframing & Prototyping||Interface Design (UI)|Design Systems',
            ],
            [
                'name' => 'Marketing',
                'description' => 'Digital marketing is where strategy meets execution. We help brands reach the right audience with the right message at the right moment—using data, creativity, and continuous optimization.',
                'image' => 'pages/img-32.webp',
                'skills' => 'Digital Strategy|Content Marketing|Social Media Marketing||Paid Advertising (PPC)|Email Marketing',
            ],
            [
                'name' => 'Optimization',
                'description' => 'Optimization is an ongoing commitment to improvement. We analyze real user behavior, identify friction points, and refine digital experiences through testing and iteration—turning insights into growth.',
                'image' => 'pages/img-33.webp',
                'skills' => 'Conversion Rate Optimization (CRO)|A/B Testing|User Behavior Analysis||SEO Optimization|Performance Audits',
            ],
        ];

        $defaultCategoryId = ServiceCategory::query()->value('id');

        $ids = [];
        foreach ($items as $item) {
            $service = Service::query()->create([
                'name' => $item['name'],
                'description' => $item['description'],
                'image' => $this->filePath($item['image']),
                'category_id' => $defaultCategoryId,
                'content' => '',
                'is_featured' => true,
                'views' => 0,
            ]);

            MetaBox::saveMetaBoxData($service, 'skills', $item['skills']);

            SlugHelper::createSlug($service);

            $ids[] = $service->id;
        }

        return $ids;
    }
}
