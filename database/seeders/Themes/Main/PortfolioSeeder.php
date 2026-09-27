<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\Portfolio\Enums\PackageDuration;
use Botble\Portfolio\Models\Package;
use Botble\Portfolio\Models\Project;
use Botble\Portfolio\Models\Service;
use Botble\Portfolio\Models\ServiceCategory;
use Botble\Slug\Facades\SlugHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PortfolioSeeder extends BaseSeeder
{
    public function run(): void
    {
        ServiceCategory::query()->truncate();
        Service::query()->truncate();
        Project::query()->truncate();
        Package::query()->truncate();
        DB::table('pf_service_categories_translations')->truncate();
        DB::table('pf_services_translations')->truncate();
        DB::table('pf_projects_translations')->truncate();
        DB::table('pf_packages_translations')->truncate();

        $this->uploadFiles('projects');
        $this->uploadFiles('services');
        $this->uploadFiles('icons');

        $categories = [
            [
                'name' => 'Branding',
                'description' => 'Brand identity design, logo creation, and visual strategy.',
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'User interface and experience design for web and mobile.',
            ],
            [
                'name' => 'Web Development',
                'description' => 'Custom website and web application development.',
            ],
            [
                'name' => 'Digital Marketing',
                'description' => 'SEO, social media, and performance marketing services.',
            ],
        ];
        // Skills metadata format: two lists separated by "||", items inside each list separated by "|".
        // Template services/style-2.blade.php splits on this convention for the vertical-scroll panels.
        $services = [
            [
                'name' => 'Brand Strategy',
                'description' => "Branding is more than a visual identity—it's the strategic backbone of your business. We help brands define who they are, what they stand for, and how they connect with their audience.",
                'image' => $this->filePath('pages/img-30.webp'),
                'metadata' => [
                    'icon_image' => $this->filePath('services/1-sm.webp'),
                    'image' => $this->filePath('pages/img-30.webp'),
                    'skills' => 'Research & Insights|Purpose, Mission & Vision|Value Proposition||Brand Positioning|Brand Architecture|Brand Personality Trait',
                ],
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Great design feels effortless—but it’s driven by deep understanding and careful intention. We create user-centered digital experiences that balance aesthetics and function.',
                'image' => $this->filePath('pages/img-31.webp'),
                'metadata' => [
                    'icon_image' => $this->filePath('services/2-sm.webp'),
                    'image' => $this->filePath('pages/img-31.webp'),
                    'skills' => 'UX Research & User Journeys|Information Architecture|Wireframing & Prototyping||Interface Design (UI)|Design Systems',
                ],
            ],
            [
                'name' => 'Marketing',
                'description' => 'Digital marketing is where strategy meets execution. We help brands reach the right audience with the right message at the right moment—using data, creativity, and continuous optimization.',
                'image' => $this->filePath('pages/img-32.webp'),
                'metadata' => [
                    'icon_image' => $this->filePath('services/3-sm.webp'),
                    'image' => $this->filePath('pages/img-32.webp'),
                    'skills' => 'Digital Strategy|Content Marketing|Social Media Marketing||Paid Advertising (PPC)|Email Marketing',
                ],
            ],
            [
                'name' => 'Optimization',
                'description' => 'Optimization is an ongoing commitment to improvement. We analyze real user behavior, identify friction points, and refine digital experiences through testing and iteration—turning insights into measurable gains.',
                'image' => $this->filePath('pages/img-33.webp'),
                'metadata' => [
                    'icon_image' => $this->filePath('services/4-sm.webp'),
                    'image' => $this->filePath('pages/img-33.webp'),
                    'skills' => 'Conversion Rate Optimization (CRO)|A/B Testing|User Behavior Analysis||SEO Optimization|Performance Audits',
                ],
            ],
        ];
        $projects = [
            [
                'name' => 'Lumina Brand Identity',
                'description' => 'A complete brand identity system for a luxury skincare brand, including logo, typography, color palette, packaging design, and brand guidelines.',
                'client' => 'Lumina Skincare',
                'start_date' => '2023-08-15',
                'metadata' => [
                    'link' => 'https://example.com/lumina',
                    'category_ids' => [1],
                ],
            ],
            [
                'name' => 'Nomad Travel App',
                'description' => 'UI/UX design for a travel booking mobile app focused on digital nomads, featuring smart itinerary planning and community features.',
                'client' => 'Nomad Co.',
                'start_date' => '2023-05-20',
                'metadata' => [
                    'link' => 'https://example.com/nomad',
                    'category_ids' => [2],
                ],
            ],
            [
                'name' => 'Verde E-Commerce Platform',
                'description' => 'A full-featured e-commerce website for a sustainable fashion brand, with a clean UI, seamless checkout, and integrated CMS.',
                'client' => 'Verde Fashion',
                'start_date' => '2022-11-10',
                'metadata' => [
                    'link' => 'https://example.com/verde',
                    'category_ids' => [1, 3],
                ],
            ],
            [
                'name' => 'Pulse Digital Campaign',
                'description' => 'A multi-channel digital marketing campaign driving brand awareness and 3x lead growth through targeted SEO and paid social.',
                'client' => 'Pulse Fitness',
                'start_date' => '2023-02-05',
                'metadata' => [
                    'link' => 'https://example.com/pulse',
                    'category_ids' => [4],
                ],
            ],
            [
                'name' => 'Bloom Agency Website',
                'description' => 'A creative agency website redesign with custom animations, portfolio showcase, and a bold visual identity.',
                'client' => 'Bloom Studio',
                'start_date' => '2022-09-01',
                'metadata' => [
                    'link' => 'https://example.com/bloom',
                    'category_ids' => [1, 2, 3],
                ],
            ],
            [
                'name' => 'Helio SaaS Dashboard',
                'description' => 'Complex dashboard UI design for a SaaS analytics platform, focusing on data clarity, accessibility, and user workflow efficiency.',
                'client' => 'Helio Analytics',
                'start_date' => '2023-01-10',
                'metadata' => [
                    'link' => 'https://example.com/helio',
                    'category_ids' => [2, 3],
                ],
            ],
            [
                'name' => 'Craft Coffee Branding',
                'description' => 'Brand identity and packaging design for an artisan coffee roastery, capturing the warmth and craftsmanship behind every cup.',
                'client' => 'Craft Coffee Co.',
                'start_date' => '2023-03-25',
                'metadata' => [
                    'link' => 'https://example.com/craft',
                    'category_ids' => [1],
                ],
            ],
            [
                'name' => 'Zora NFT Marketplace',
                'description' => 'Web3 platform UI/UX design and front-end development for an NFT marketplace with artist profiles and auction features.',
                'client' => 'Zora Digital',
                'start_date' => '2022-12-15',
                'metadata' => [
                    'link' => 'https://example.com/zora',
                    'category_ids' => [2, 3],
                ],
            ],
        ];

        foreach ($categories as $category) {
            ServiceCategory::query()->create($category);
        }

        $categories = ServiceCategory::query()->pluck('id');

        foreach ($services as $service) {
            $metadata = Arr::pull($service, 'metadata', []);

            $service = Service::query()->create([
                ...$service,
                // Honor per-service image if provided, otherwise fall back to a random services/*.webp.
                'image' => $service['image'] ?? $this->filePath(sprintf('services/%s.webp', rand(1, 10))),
                'category_id' => $categories->random(),
                'content' => File::get(database_path('seeders/contents/service.html')),
                'is_featured' => (bool) rand(0, 1),
                'views' => rand(0, 10000),
            ]);

            foreach ($metadata as $key => $item) {
                MetaBox::saveMetaBoxData($service, $key, $item);
            }

            SlugHelper::createSlug($service);
        }

        $authorNames = [
            'Michael Anderson',
            'Jennifer Brown',
            'David Clark',
            'Sarah Johnson',
            'Robert Williams',
            'Emily Davis',
            'James Wilson',
            'Amanda Martinez',
        ];

        $cities = [
            'San Francisco',
            'New York',
            'London',
            'Berlin',
            'Singapore',
            'Tokyo',
            'Sydney',
            'Toronto',
        ];

        foreach ($projects as $index => $project) {
            $index++;

            $metadata = Arr::pull($project, 'metadata', []);

            $project = Project::query()->create([
                ...$project,
                'content' => File::get(database_path('seeders/contents/project.html')),
                'image' => $this->filePath("projects/$index.webp"),
                'author' => Arr::random($authorNames),
                'place' => Arr::random($cities),
                'is_featured' => (bool) rand(0, 1),
                'views' => rand(0, 10000),
            ]);

            foreach ($metadata as $key => $item) {
                MetaBox::saveMetaBoxData($project, $key, $item);
            }

            SlugHelper::createSlug($project);
        }

        $packages = [
            [
                'name' => 'Trial Plan',
                'description' => 'Protect for testing',
                'price' => 0,
                'features' => <<<HTML
                +Single Team Member
                +Over 1200 UI Blocks
                +10 GB of Cloud Storage
                -Personal Email Account
                -Priority Support
                HTML,
            ],
            [
                'name' => 'Standard',
                'description' => 'Great for large teams',
                'price' => '$49',
                'annual_price' => '$441',
                'duration' => PackageDuration::MONTHLY,
                'is_popular' => true,
                'features' => <<<HTML
                +05 Team Member
                +All multimedia channels
                +All advanced CRM features
                +Up to 15,000 contacts
                +24/7 Support (Email, Chat)
                HTML,
            ],
            [
                'name' => 'Business',
                'description' => 'Advanced projects',
                'price' => '$69',
                'annual_price' => '$621',
                'duration' => PackageDuration::MONTHLY,
                'features' => <<<HTML
                +50 Team Member
                +Over 1500 UI Blocks
                +100 GB of Cloud Storage
                +Personal Email Account
                +Priority Support
                HTML,
            ],
            [
                'name' => 'Enterprise',
                'description' => 'For big companies',
                'price' => '$99',
                'annual_price' => '$891',
                'duration' => PackageDuration::MONTHLY,
                'features' => <<<HTML
                +Customized features
                +Scalability & security
                +Account manager
                +Unlimited chat history
                +50 Integrations
                HTML,
            ],
        ];

        foreach ($packages as $item) {
            Package::query()->create([
                ...$item,
                'content' => '',
                'action_label' => 'Get Started',
                'action_url' => '/contact',
            ]);
        }
    }
}
