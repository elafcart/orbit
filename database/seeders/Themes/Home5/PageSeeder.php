<?php

namespace Database\Seeders\Themes\Home5;

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

        // Seed Home5-specific case-study services with rich metadata (metric, tags, link label)
        // so the `services` shortcode (style 5) can render them like `sec-4-home-5` in index-5.html.
        // These are appended to the services already created by Main PortfolioSeeder.
        $caseStudyIds = $this->seedHome5CaseStudies();

        $homepage = Page::query()->where('name', 'Homepage')->firstOrFail();

        $homepage->update([
            'content' => $this->generateShortcodeContent([
                // Sec-1: Hero — 3-column personal portfolio (availability + center image + bio + CTA)
                [
                    'name' => 'hero-banner',
                    'attributes' => [
                        'style' => '5',
                        'subtitle' => 'Available for freelance work',
                        'description' => 'Artificial Intelligence Engineer. Building <br> intelligent systems that scale',
                        'left_image' => $this->filePath('pages/img-102.webp'),
                        'image' => $this->filePath('pages/img-101.webp'),
                        'title' => 'Orisa Nova',
                        'bio' => 'I design, train, and deploy AI models that turn data into real-world decisions — from computer vision to large-scale machine learning systems.',
                        'primary_action_label' => 'View All Projects',
                        'primary_action_url' => '/portfolio-5',
                    ],
                ],
                // Sec-2: Why Orisa + bespoke 3-column expertise grid (content-block style 6, matches sec-2-home-5)
                [
                    'name' => 'content-block',
                    'attributes' => [
                        'style' => '6',
                        'subtitle' => 'Why Orisa',
                        'title' => 'I bridge the gap between complex data and intelligent action through robust, scalable, and production-ready AI.',
                        'description' => 'Conversion-focused|Data-driven|Built for scale|User-centric|Future-proof',
                        'image_1' => $this->filePath('pages/img-103.webp'),
                        'style_image_1' => $this->filePath('pages/img-103.webp'),
                        'image_2' => $this->filePath('pages/img-104.webp'),
                        'style_image_2' => $this->filePath('pages/img-104.webp'),
                        'image_3' => $this->filePath('pages/img-105.webp'),
                        'style_image_3' => $this->filePath('pages/img-105.webp'),
                        'image_4' => $this->filePath('pages/img-106.webp'),
                        'style_image_4' => $this->filePath('pages/img-106.webp'),
                        'hero_title' => 'Intelligent Systems for Modern Problems.',
                        'hero_experience' => '+12 Years <br> of Experience',
                        'primary_action_label' => "Let's build",
                        'primary_action_url' => '/contact-1',
                        'testimonial_avatar' => $this->filePath('testimonials/avatar-10.webp'),
                        'testimonial_name' => 'Hannah Lee',
                        'testimonial_role' => 'Creative Director',
                        'testimonial_rating' => '3',
                        'testimonial_quote' => '"Orisa has a rare ability to bridge the gap between theoretical mathematics and production-grade code. He doesn\'t just build models; he builds engines for real-world growth."',
                        'testimonial_since' => '[Since 2012]',
                        'stat_value' => '5k+',
                        'stat_label' => 'Production-grade <br> models deployed',
                        'skills_list' => 'Python, C++, JavaScript|PyTorch, TensorFlow, Scikit-learn|Pandas, NumPy, Spark|Docker, Kubernetes, MLflow|AWS / GCP / Azure',
                        'quote_small' => '"High performance starts with clean data. I prioritize rigorous preprocessing and feature engineering to ensure model reliability."',
                        'quantity' => 6,
                        'title_1' => 'Computer Vision Specialist',
                        'title_2' => 'End-to-End ML Pipelines',
                        'title_3' => 'Neural Architecture Design',
                        'title_4' => 'Large-Scale System Deployment',
                        'title_5' => 'Data-Driven Decision Logic',
                        'title_6' => 'Generative AI & LLM Solutions',
                    ],
                ],
                // Sec-3: Brand carousel + customer reviews — matches sec-3-home-5
                [
                    'name' => 'partners',
                    'attributes' => [
                        'style' => '4',
                        'subtitle' => 'Trusted by 100+ businesses',
                        'title' => 'Orisa Nova is an AI Engineer architecting scalable, high-impact systems with research-driven precision.',
                        'review_rating' => '3',
                        'review_label' => 'Customer reviews',
                        'review_url' => '/contact-1',
                        'quantity' => 10,
                        ...collect(['Framer', 'Reddit', 'Netflix', 'Microsoft', 'Discover', 'Lemon Squeezy', 'Paypal', 'Youtube', 'Spotify', 'Google'])
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
                // Sec-4: Selected work — "DEPLOYED SYSTEMS" case studies (matches sec-4-home-5)
                [
                    'name' => 'services',
                    'attributes' => [
                        'style' => '5',
                        'subtitle' => 'Deployed Systems',
                        'title' => 'Selected work',
                        'description' => 'Conversion-focused|Data-driven|Built for scale|User-centric|Future-proof',
                        'primary_action_label' => 'Explore Github Repos',
                        'primary_action_url' => '/portfolio-5',
                        'service_ids' => implode(',', $caseStudyIds),
                        'per_page' => 4,
                    ],
                ],
                // Sec-5: Stats + contact — "Years of Practice..."
                [
                    'name' => 'about-us-information',
                    'attributes' => [
                        'style' => '5',
                        'title' => 'Years of Practice, Hundreds of Deployments, and Satisfied Partners',
                        'contact_heading' => "I'm here",
                        'contact_address' => "205 North Michigan Avenue, Suite 810\nChicago, 60601, USA",
                        'contact_phone' => '+1234567890',
                        'contact_email' => 'hello@orisa.com',
                        'quantity' => '5',
                        'title_1' => '25+',
                        'description_1' => 'Models in Production',
                        'title_2' => '$15M+',
                        'description_2' => 'Daily Inferences',
                        'title_3' => '300%',
                        'description_3' => 'Latency Optimization',
                        'title_4' => '500TB',
                        'description_4' => 'Data Orchestrated',
                        'title_5' => '99.9%',
                        'description_5' => 'System Uptime',
                    ],
                ],
                // Sec-6: Career Path & Expertise — "My Journey" timeline (content-block style 7, matches sec-6-home-5)
                [
                    'name' => 'content-block',
                    'attributes' => [
                        'style' => '7',
                        'subtitle' => 'My journey',
                        'title' => 'Career Path & Expertise',
                        'description' => 'Tracking the evolution of intelligent systems through research, <br> architecture, and deployment.',
                        'image_1' => $this->filePath('pages/img-111.webp'),
                        'style_image_1' => $this->filePath('pages/img-111.webp'),
                        'feature_tag' => 'ui design',
                        'feature_title' => 'UI/UX & product design for digital platforms',
                        'feature_description' => 'We always provide people a complete solution upon focused of any business',
                        'feature_label' => 'Orisa Nova',
                        'feature_url' => '/portfolio-5',
                        'primary_action_label' => 'Book A Call Now',
                        'primary_action_url' => '/contact-1',
                        'quantity' => 5,
                        'title_1' => 'Senior AI Engineer',
                        'description_1' => 'Neural Dynamics|Jan 2022 – Present|Architecting distributed training systems and leading the deployment of production-grade LLM pipelines.',
                        'title_2' => 'ML Infrastructure Engineer',
                        'description_2' => 'DataScale Labs|June 2019 – Dec 2021|Optimized large-scale data ingestion and automated MLOps workflows for high-frequency trading models.',
                        'title_3' => 'Computer Vision Researcher',
                        'description_3' => 'Visionary Tech|Jan 2017 – May 2019|Developed state-of-the-art object detection algorithms for autonomous drone navigation and edge computing.',
                        'title_4' => 'Junior Data Scientist',
                        'description_4' => 'Insight Corp|Jan 2015 – Dec 2016|Built predictive analytics dashboards and performed feature engineering on multi-terabyte datasets.',
                        'title_5' => 'Data Analyst Intern',
                        'description_5' => 'Quantum Analytics|June 2012 – Dec 2014|Assisted in statistical modeling and data cleaning for large-scale consumer behavior studies.',
                    ],
                ],
                // Sec-7: Testimonials grid with expandable cards + team card (style 7, matches home-5-section-7)
                [
                    'name' => 'testimonials',
                    'attributes' => [
                        'style' => '7',
                        'subtitle' => 'Testimonials',
                        'title' => 'Insights from Industry Partners',
                        'contact_address' => "245 Fifth Avenue, Suite 1800\nNew York, NY 10016, USA",
                        'contact_phone' => '+212-555-7398',
                        'contact_email' => 'hello@orisa.com',
                        'team_image' => $this->filePath('pages/img-112.webp'),
                        'team_caption' => 'Real-world experience through projects.',
                        'quantity' => 3,
                        ...collect([
                            ['name' => 'Marcus Thorne', 'role' => 'CTO', 'company' => 'NexusTech', 'quote' => "Orisa doesn't just build models; he builds engines for growth. His ability to deploy complex architectures with 99.9% reliability is what sets his work apart.", 'rating' => 3, 'avatar' => 'testimonials/avatar-10.webp'],
                            ['name' => 'Sarah Jenkins', 'role' => 'Lead Architect', 'company' => 'FlowData', 'quote' => 'From start to finish, the transition from raw data to a production-ready API was seamless. The efficiency gains in our pipeline exceeded all expectations.', 'rating' => 3, 'avatar' => 'testimonials/avatar-12.webp'],
                            ['name' => 'Elena Rossi', 'role' => 'Head of AI', 'company' => 'Synthetix Systems', 'quote' => 'Orisa possesses a rare architectural intuition. He successfully optimized our legacy neural networks, reducing latency by 40% without compromising on model accuracy.', 'rating' => 3, 'avatar' => 'testimonials/avatar-14.webp'],
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
                // Sec-8: Blog posts — "Latest news from my blog"
                [
                    'name' => 'blog-posts',
                    'attributes' => [
                        'subtitle' => 'My Blog',
                        'title' => 'Latest news from my blog',
                        'description' => 'Research notes, deployment stories, and lessons from production ML.',
                        'paginate' => 3,
                        'action_label' => 'View all articles',
                        'action_url' => '/blog',
                    ],
                ],
            ]),
        ]);
    }

    /**
     * Creates 4 Home5-specific case study services matching `sec-4-home-5` in
     * index-5.html. Each carries metric / tags / link-label metadata read by
     * `partials/shortcodes/services/styles/style-5.blade.php` via getMetaData.
     *
     * @return array<int> ids of the newly-created case study services
     */
    protected function seedHome5CaseStudies(): array
    {
        $caseStudies = [
            [
                'name' => 'Smart Automation',
                'description' => 'Production-grade AI models deployed across enterprise workflows, automating decisions with rigorous monitoring and observability.',
                'image' => 'pages/img-107.webp',
                'metric_value' => '+30%',
                'metric_label' => 'Operational Speed',
                'tags' => 'AI Models,Deployment,Scalability,Engineering',
                'link_label' => 'VIEW ARCHITECTURE',
            ],
            [
                'name' => 'Data Intelligence',
                'description' => 'Predictive decision systems trained on multi-terabyte datasets, surfacing real-time insights for strategic planning.',
                'image' => 'pages/img-108.webp',
                'metric_value' => '-20%',
                'metric_label' => 'Planning Risk',
                'tags' => 'Decision Systems,Analytics,Systems,Engineering',
                'link_label' => 'VIEW SYSTEM DESIGN',
            ],
            [
                'name' => 'Neural Optimization',
                'description' => 'High-performance neural network tuning across computer vision pipelines, reducing inference latency under production load.',
                'image' => 'pages/img-109.webp',
                'metric_value' => '+45%',
                'metric_label' => 'Inference Speed',
                'tags' => 'Computer Vision,Optimization,Neural Nets,Research',
                'link_label' => 'VIEW CASE STUDY',
            ],
            [
                'name' => 'Distributed ML Pipeline',
                'description' => 'Cloud-native training and serving infrastructure for large-scale machine learning workloads with auto-scaling and fault tolerance.',
                'image' => 'pages/img-110.webp',
                'metric_value' => '-35%',
                'metric_label' => 'Infrastructure Cost',
                'tags' => 'Scalable Architecture,Cloud-Native,Kubernetes,Auto-Scaling',
                'link_label' => 'VIEW INFRASTRUCTURE',
            ],
        ];

        $defaultCategoryId = ServiceCategory::query()->value('id');

        $ids = [];
        foreach ($caseStudies as $study) {
            $metric = ['metric_value' => $study['metric_value'], 'metric_label' => $study['metric_label'], 'tags' => $study['tags'], 'link_label' => $study['link_label']];

            $service = Service::query()->create([
                'name' => $study['name'],
                'description' => $study['description'],
                'image' => $this->filePath($study['image']),
                'category_id' => $defaultCategoryId,
                'content' => '',
                'is_featured' => true,
                'views' => 0,
            ]);

            foreach ($metric as $key => $value) {
                MetaBox::saveMetaBoxData($service, $key, $value);
            }

            SlugHelper::createSlug($service);

            $ids[] = $service->id;
        }

        return $ids;
    }
}
