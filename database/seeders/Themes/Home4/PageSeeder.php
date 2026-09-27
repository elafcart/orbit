<?php

namespace Database\Seeders\Themes\Home4;

use Botble\Base\Facades\MetaBox;
use Botble\Page\Models\Page;
use Botble\Portfolio\Models\Project;
use Botble\Portfolio\Models\Service;
use Botble\Portfolio\Models\ServiceCategory;
use Botble\Slug\Facades\SlugHelper;

class PageSeeder extends \Database\Seeders\Themes\Main\PageSeeder
{
    public function run(): void
    {
        parent::run();

        // Seed Home4-specific case study projects with rich metadata (metrics, tags)
        // so the `projects` shortcode (style 4) can render them like `sec-4-home-4` in index-4.html.
        $caseStudyProjectIds = $this->seedHome4CaseStudyProjects();

        // Seed Home4-specific services (Strategy & Research, Design & Experience, Network Integration, Build & Launch)
        // with per-card images matching `sec-2-home-4`.
        $serviceIds = $this->seedHome4Services();

        $homepage = Page::query()->where('name', 'Homepage')->firstOrFail();

        $homepage->update([
            'content' => $this->generateShortcodeContent([
                // Sec-1: Hero — gradient bg, tagline, headline, CTAs, image cards, tech tags, brand footer
                [
                    'name' => 'hero-banner',
                    'attributes' => [
                        'style' => '4',
                        'subtitle' => 'AI & TECHNOLOGY AGENCY',
                        'title' => 'From strategy to execution, we turn intelligence into real-world impact.',
                        'primary_action_label' => 'EXPLORE SOLUTIONS',
                        'primary_action_url' => '/services-1',
                        'secondary_action_label' => 'VIEW CASE STUDIES',
                        'secondary_action_url' => '/portfolio',
                        'background_image' => $this->filePath('pages/bg-img-4.webp'),
                        'card_image_1' => $this->filePath('pages/img-43-lg.webp'),
                        'card_image_2' => $this->filePath('pages/img-74.webp'),
                        'card_image_3' => $this->filePath('pages/img-75.webp'),
                        'services_quantity' => '5',
                        'services_name_1' => 'LLMs',
                        'services_name_2' => 'Data pipelines',
                        'services_name_3' => 'Data pipelines',
                        'services_name_4' => 'Automation tools',
                        'services_name_5' => 'Cloud & APIs',
                        'description' => 'Orisa AI Solutions<sup>&reg;</sup>',
                        'bottom_service_name_1' => 'Web Development',
                        'bottom_service_name_2' => 'Design & Experience',
                        'bottom_service_name_3' => 'Network Integration',
                        'bottom_service_name_4' => 'Build & Launch',
                    ],
                ],
                // Sec-2: Services grid — "What We Offer" (matches sec-2-home-4)
                [
                    'name' => 'services',
                    'attributes' => [
                        'style' => '4',
                        'subtitle' => 'What We Offer',
                        'title' => 'Turning ideas into digital experiences that perform in the real world.',
                        'description' => 'We design intelligent systems that help businesses think, decide, and scale faster.',
                        'image_1' => $this->filePath('pages/img-gemstone.webp'),
                        'avatar_1' => $this->filePath('testimonials/avatar-10.webp'),
                        'avatar_2' => $this->filePath('testimonials/avatar-11.webp'),
                        'avatar_3' => $this->filePath('testimonials/avatar-12.webp'),
                        'avatar_4' => $this->filePath('testimonials/avatar-13.webp'),
                        'avatar_5' => $this->filePath('testimonials/avatar-14.webp'),
                        'primary_action_label' => 'Explore Services',
                        'primary_action_url' => '/services-1',
                        'service_ids' => implode(',', $serviceIds),
                        'per_page' => 4,
                    ],
                ],
                // Sec-3: Process workflow — "How We Work" + 4 methodology steps
                [
                    'name' => 'content-block',
                    'attributes' => [
                        'style' => '3',
                        'subtitle' => 'How We Work',
                        'title' => 'A structured process built for real-world impact',
                        'description' => 'We combine strategy, design, and technology into a clear, repeatable process — built to reduce risk and maximize results.',
                        'image_1' => $this->filePath('pages/img-85.webp'),
                        'style_image_1' => $this->filePath('pages/img-85.webp'),
                        'primary_action_label' => 'Get a free quote',
                        'primary_action_url' => '/contact-1',
                        'quantity' => 4,
                        'title_1' => 'Discover & Diagnose',
                        'description_1' => 'Deep research, workshops, and audits to uncover opportunities and define a clear strategy.',
                        'title_2' => 'Strategy & Plan',
                        'description_2' => 'Shape a roadmap aligned with your goals, audience, and market reality.',
                        'title_3' => 'Execute & Optimize',
                        'description_3' => 'Build, launch, and continuously optimize every touchpoint for performance.',
                        'title_4' => 'Scale & Sustain',
                        'description_4' => 'Long-term growth through iteration, analytics, and ongoing support.',
                    ],
                ],
                // Sec-4: Case studies — featured hero card + 2 overlay cards (matches sec-4-home-4)
                [
                    'name' => 'projects',
                    'attributes' => [
                        'style' => '4',
                        'subtitle' => 'Case Studies',
                        'title' => 'Real-world AI solutions with measurable impact',
                        'description' => 'A curated selection of AI-driven projects delivering real business outcomes.',
                        'primary_action_label' => 'View All Projects',
                        'primary_action_url' => '/portfolio',
                        'project_ids' => implode(',', $caseStudyProjectIds),
                        'per_page' => 3,
                    ],
                ],
                // Sec-5: Awards & Recognitions
                [
                    'name' => 'awards',
                    'attributes' => [
                        'title' => 'Awards & Recognitions',
                        'description' => 'Recognized for innovation, quality, and impact',
                        'action_label' => 'View All Awards',
                        'action_url' => '/portfolio',
                        'quantity' => 5,
                        ...collect([
                            ['date' => 'March 12, 2025', 'title' => 'Best AI & Technology Agency', 'organization' => 'Global Digital Awards', 'url' => 'https://globaldigitalawards.com', 'url_label' => 'globaldigitalawards.com', 'image' => 'pages/img-89-sm.webp', 'image_lg' => 'pages/img-89.webp'],
                            ['date' => 'October 8, 2024', 'title' => 'Innovation in Intelligent Systems', 'organization' => 'Tech Excellence Forum', 'url' => 'https://techexcellenceforum.org', 'url_label' => 'techexcellenceforum.org', 'image' => 'pages/img-90-sm.webp', 'image_lg' => 'pages/img-90.webp'],
                            ['date' => 'June 21, 2024', 'title' => 'Outstanding Digital Experience Design', 'organization' => 'International UX Awards', 'url' => 'https://internationaluxawards.com', 'url_label' => 'internationaluxawards.com', 'image' => 'pages/img-91-sm.webp', 'image_lg' => 'pages/img-91.webp'],
                            ['date' => 'December 3, 2023', 'title' => 'Trusted Partner of the Year', 'organization' => 'Enterprise Technology Network', 'url' => 'https://enterprisetechnetwork.org', 'url_label' => 'enterprisetechnetwork.org', 'image' => 'pages/img-92-sm.webp', 'image_lg' => 'pages/img-92.webp'],
                            ['date' => 'March 12, 2025', 'title' => 'Best AI & Technology Agency', 'organization' => 'Global Digital Awards', 'url' => 'https://globaldigitalawards.com', 'url_label' => 'globaldigitalawards.com', 'image' => 'pages/img-93-sm.webp', 'image_lg' => 'pages/img-93.webp'],
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
                // Sec-6: Team — "Meet our dedicated and skilled team"
                [
                    'name' => 'teams',
                    'attributes' => [
                        'style' => '1',
                        'subtitle' => 'Our Team',
                        'title' => 'Meet our dedicated <br> and skilled team',
                        'description' => '190+ Projects completed',
                        'team_ids' => '1,2,3,4',
                    ],
                ],
                // Sec-7: Testimonials — "What our clients are saying"
                [
                    'name' => 'testimonials',
                    'attributes' => [
                        'style' => '2',
                        'subtitle' => 'Testimonials',
                        'title' => 'What our clients are saying',
                        'description' => 'Average 4.9 rating point reviews from 968 clients',
                        'quantity' => 5,
                        ...collect([
                            ['name' => 'Michael Turner', 'role' => 'CTO', 'company' => 'Nexora Systems', 'quote' => 'What impressed us most was their ability to translate complex AI concepts into simple, high-impact solutions that actually work in production.', 'rating' => 5, 'avatar' => 'testimonials/avatar-15.webp'],
                            ['name' => 'Amelia Wright', 'role' => 'Head of Marketing', 'company' => 'London, United Kingdom', 'quote' => 'A strategic partner that understands both the technology and the business side. They delivered beyond our expectations.', 'rating' => 5, 'avatar' => 'testimonials/avatar-16.webp'],
                            ['name' => 'Hannah Lee', 'role' => 'Creative Director', 'company' => 'Studio Kinetic', 'quote' => 'Their process is structured but never rigid. The team adapts quickly and ships work that feels both polished and performant.', 'rating' => 5, 'avatar' => 'testimonials/avatar-17.webp'],
                            ['name' => 'David Chen', 'role' => 'Founder', 'company' => 'PixelCraft', 'quote' => 'Orisa combines engineering rigor with design sensibility. A rare find in the AI space.', 'rating' => 5, 'avatar' => 'testimonials/avatar-18.webp'],
                            ['name' => 'Sofia Martinez', 'role' => 'Brand Director', 'company' => 'Lumina Agency', 'quote' => 'Every deliverable exceeded our expectations. Truly a growth partner.', 'rating' => 5, 'avatar' => 'testimonials/avatar-19.webp'],
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
                        })->all(),
                    ],
                ],
                // Sec-8: Blog posts — "Inside the World of AI"
                [
                    'name' => 'blog-posts',
                    'attributes' => [
                        'subtitle' => 'Inside Company',
                        'title' => 'Inside the World of AI',
                        'description' => 'Insights, breakthroughs, and lessons from the AI frontier.',
                        'paginate' => 4,
                        'action_label' => 'All Articles',
                        'action_url' => '/blog',
                    ],
                ],
            ]),
        ]);
    }

    /**
     * Creates 3 Home4 case-study projects matching `sec-4-home-4` in
     * index-4.html: one "Featured case" (with 2 metrics + tags) + two overlay
     * cards (each with 1 metric + tags). Rich data stored via MetaBox and read
     * by `partials/shortcodes/projects/styles/style-4.blade.php`.
     *
     * @return array<int> ids of the newly-created projects
     */
    protected function seedHome4CaseStudyProjects(): array
    {
        $caseStudies = [
            [
                'name' => 'AI-Driven Demand Forecasting System',
                'description' => 'We built an intelligent forecasting platform that helps enterprises predict demand, optimize inventory, and reduce operational risk using real-time data and machine learning models.',
                'image' => 'pages/img-86.webp',
                'metric_1_value' => '+72%',
                'metric_1_label' => 'Planning Efficiency',
                'metric_2_value' => '-18%',
                'metric_2_label' => 'Inventory Cost',
                'tags' => 'AI Application,Data Pipelines,Enterprise Systems,Experimental',
                'is_featured' => true,
            ],
            [
                'name' => 'Smart Automation',
                'description' => 'End-to-end workflow automation combining machine learning models with robust deployment pipelines for operational efficiency.',
                'image' => 'pages/img-87.webp',
                'metric_1_value' => '+30%',
                'metric_1_label' => 'Operational Speed',
                'metric_2_value' => '',
                'metric_2_label' => '',
                'tags' => 'AI Models,Deployment,Scalability,Engineering',
                'is_featured' => false,
            ],
            [
                'name' => 'Data Intelligence',
                'description' => 'Decision-support systems turning raw analytics into actionable insight for product and planning teams.',
                'image' => 'pages/img-88.webp',
                'metric_1_value' => '-20%',
                'metric_1_label' => 'Planning Risk',
                'metric_2_value' => '',
                'metric_2_label' => '',
                'tags' => 'Decision Systems,Analytics,Systems,Engineering',
                'is_featured' => false,
            ],
        ];

        $ids = [];
        foreach ($caseStudies as $study) {
            $metric = [
                'metric_1_value' => $study['metric_1_value'],
                'metric_1_label' => $study['metric_1_label'],
                'metric_2_value' => $study['metric_2_value'],
                'metric_2_label' => $study['metric_2_label'],
                'tags' => $study['tags'],
            ];

            $project = Project::query()->create([
                'name' => $study['name'],
                'description' => $study['description'],
                'image' => $this->filePath($study['image']),
                'content' => '',
                'client' => 'Orisa AI',
                'start_date' => now()->subMonths(rand(2, 18)),
                'is_featured' => $study['is_featured'],
            ]);

            foreach ($metric as $key => $value) {
                MetaBox::saveMetaBoxData($project, $key, $value);
            }

            SlugHelper::createSlug($project);

            $ids[] = $project->id;
        }

        return $ids;
    }

    /**
     * Creates 4 Home4-specific services matching the 4-card grid in
     * `sec-2-home-4`. Card-3 (Network Integration) uses a dual-image layout so
     * a `bottom_image` metadata field is seeded for it.
     *
     * @return array<int> ids of the newly-created services
     */
    protected function seedHome4Services(): array
    {
        $items = [
            [
                'name' => 'Strategy & Research',
                'description' => 'Through research, analysis, and positioning, we build a clear foundation for meaningful digital growth.',
                'image' => 'pages/img-76.webp',
                'bottom_image' => null,
            ],
            [
                'name' => 'Design & Experience',
                'description' => 'Every interaction is crafted to balance beauty, usability, and brand personality.',
                'image' => 'pages/img-77.webp',
                'bottom_image' => null,
            ],
            [
                'name' => 'Network Integration',
                'description' => 'From on-premise to cloud environments, we ensure seamless communication, scalability, and operational stability.',
                'image' => 'pages/img-78.webp',
                'bottom_image' => 'pages/img-79.webp',
            ],
            [
                'name' => 'Build & Launch',
                'description' => 'Bring ideas to life with clean, scalable, and performance-driven builds. From development to launch, we focus on reliability and long-term growth.',
                'image' => 'pages/img-80.webp',
                'bottom_image' => null,
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

            if ($item['bottom_image']) {
                MetaBox::saveMetaBoxData($service, 'bottom_image', $this->filePath($item['bottom_image']));
            }

            SlugHelper::createSlug($service);

            $ids[] = $service->id;
        }

        return $ids;
    }
}
