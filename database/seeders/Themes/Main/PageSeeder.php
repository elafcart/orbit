<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\Page\Database\Traits\HasPageSeeder;
use Botble\Portfolio\Models\Service;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Team\Models\Team;
use Botble\Testimonial\Models\Testimonial;

class PageSeeder extends BaseSeeder
{
    use HasPageSeeder;

    public function run(): void
    {
        $this->truncatePages();

        $this->uploadFiles('partners');
        $this->uploadFiles('backgrounds');
        $this->uploadFiles('shapes');
        $this->uploadFiles('general');
        $this->uploadFiles('pages');
        $this->uploadFiles('skill-logos');

        $this->createPages([
            [
                'name' => 'Homepage',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'hero-banner',
                        'attributes' => [
                            'style' => 1,
                            'title' => 'We Create Digital Experiences',
                            'subtitle' => 'B2B Marketing Agency',
                            'description' => 'We help brands grow through creative strategy, bold design, and digital innovation.',
                            'background_image' => $this->filePath('pages/bg-img.webp'),
                            'image' => $this->filePath('pages/img-1.webp'),
                            'background_video' => '/themes/orisa/videos/video-1.mp4',
                            'primary_action_label' => 'Explore All Work',
                            'primary_action_url' => '/portfolio',
                            'primary_action_icon' => 'ti ti-arrow-up-right',
                            'secondary_action_label' => 'How We Work',
                            'secondary_action_url' => '/about-1',
                            'secondary_action_icon' => 'ti ti-phone',
                        ],
                    ],
                    [
                        'name' => 'about-us-information',
                        'attributes' => [
                            'style' => 1,
                            'title' => 'We shape animated stories that inspire and engage, uniting thoughtful design, fluid motion, and digital craftsmanship.',
                            'subtitle' => 'About Us',
                            'description' => 'We build <b>bold</b>, resilient brands designed to leave a lasting mark on the world.',
                            'primary_action_label' => 'GET IN TOUCH',
                            'primary_action_url' => '/contact-1',
                            'avatars_quantity' => 5,
                            'avatars_image_1' => $this->filePath('testimonials/avatar-1.webp'),
                            'avatars_image_2' => $this->filePath('testimonials/avatar-2.webp'),
                            'avatars_image_3' => $this->filePath('testimonials/avatar-3.webp'),
                            'avatars_image_4' => $this->filePath('testimonials/avatar-4.webp'),
                            'avatars_image_5' => $this->filePath('testimonials/avatar-5.webp'),
                            'experience_years' => '15',
                            'quantity' => '2',
                            'title_1' => 'Creative Expertise',
                            'description_1' => 'With over a decade of design expertise, we create tailored solutions that engage audiences, build meaningful connections, and elevate brands with creativity and intent.',
                            'image_1' => $this->filePath('pages/img-3.webp'),
                            'style_image_1' => $this->filePath('pages/img-3.webp'),
                            'title_2' => 'Experience & Innovation',
                            'description_2' => 'Backed by a decade of creative experience, we craft visual experiences that bring together strategy, design, and technology to grow brands, inspire audiences, and create meaningful impact.',
                            'image_2' => $this->filePath('pages/img-4.webp'),
                            'style_image_2' => $this->filePath('pages/img-4.webp'),
                        ],
                    ],
                    [
                        'name' => 'partners',
                        'attributes' => [
                            'style' => 1,
                            'quantity' => 10,
                            ...collect(['Framer', 'Reddit', 'Netflix', 'Microsoft', 'Discover', 'Lemon Squeezy', 'PayPal', 'Mailchimp', 'Shopify', 'Slack'])
                                ->mapWithKeys(function ($name, $index) {
                                    $index++;
                                    $imageName = $index > 8 ? rand(1, 8) : $index;

                                    return [
                                        "name_$index" => $name,
                                        "image_$index" => $this->filePath("partners/$imageName.webp"),
                                        "url_$index" => 'https://google.com',
                                        "open_in_new_tab_$index" => true,
                                    ];
                                })
                                ->all(),
                        ],
                    ],
                    [
                        'name' => 'services',
                        'attributes' => [
                            'style' => 1,
                            'subtitle' => 'OUR SOLUTIONS',
                            'description' => 'Since 2012',
                            'service_ids' => Service::query()->pluck('id')->implode(','),
                            'experience_years' => '38',
                        ],
                    ],
                    [
                        'name' => 'projects',
                        'attributes' => [
                            'style' => 1,
                            'title' => "Selected work we're proud of",
                            'subtitle' => 'Portfolio',
                            'description' => 'A curated selection of projects where strategy, creativity, and craftsmanship come together to build meaningful and enduring brand experiences.',
                            'primary_action_label' => 'View latest projects',
                            'primary_action_url' => '/portfolio',
                        ],
                    ],
                    [
                        'name' => 'testimonials',
                        'attributes' => [
                            'style' => 1,
                            'title' => 'Trusted by Clients',
                            'subtitle' => 'Real client experiences that speak to the strength of our work.',
                            'quantity' => 6,
                            'name_1' => 'Lucas Moreno',
                            'role_1' => 'Product Manager',
                            'company_1' => 'Barcelona, Spain',
                            'quote_1' => 'The collaboration was seamless from start to finish. Their UX decisions significantly improved our product...',
                            'rating_1' => 4,
                            'avatar_1' => 'general/testimonial-avatar-1.webp',
                            'company_logo_1' => 'general/testimonial-logo-architect.webp',
                            'name_2' => 'Hannah Lee',
                            'role_2' => 'Creative Director',
                            'company_2' => 'Studio Kinetic',
                            'quote_2' => 'A rare combination of technical expertise and artistic vision. The final result felt premium and purposeful.',
                            'rating_2' => 5,
                            'avatar_2' => 'general/testimonial-avatar-2.webp',
                            'company_logo_2' => 'general/testimonial-logo-cloudly.webp',
                            'name_3' => 'Amelia Wright',
                            'role_3' => 'Head of Marketing',
                            'company_3' => 'London, United Kingdom',
                            'quote_3' => 'They delivered not just a design, but a complete brand experience. Strategic, creative, and incredibly detail-oriented.',
                            'rating_3' => 5,
                            'avatar_3' => 'general/testimonial-avatar-3.webp',
                            'company_logo_3' => 'general/testimonial-logo-techlify.webp',
                            'name_4' => 'David Chen',
                            'role_4' => 'CTO',
                            'company_4' => 'NovaTech Solutions',
                            'quote_4' => 'Outstanding attention to detail and a deep understanding of user experience. They transformed our platform beyond expectations.',
                            'rating_4' => 5,
                            'avatar_4' => 'general/testimonial-avatar-1.webp',
                            'company_logo_4' => 'general/testimonial-logo-cloudly.webp',
                            'name_5' => 'Sofia Martinez',
                            'role_5' => 'Brand Director',
                            'company_5' => 'Lumina Agency',
                            'quote_5' => 'Their creative process is second to none. Every deliverable exceeded our expectations and resonated with our audience.',
                            'rating_5' => 5,
                            'avatar_5' => 'general/testimonial-avatar-2.webp',
                            'company_logo_5' => 'general/testimonial-logo-architect.webp',
                            'name_6' => 'Oliver Grant',
                            'role_6' => 'Founder',
                            'company_6' => 'PixelCraft Studio',
                            'quote_6' => 'Working with this team felt like having an in-house design department. Fast, reliable, and endlessly creative.',
                            'rating_6' => 4,
                            'avatar_6' => 'general/testimonial-avatar-3.webp',
                            'company_logo_6' => 'general/testimonial-logo-techlify.webp',
                        ],
                    ],
                    [
                        'name' => 'about-us-information',
                        'attributes' => [
                            'style' => 4,
                            'subtitle' => 'Why choose us',
                            'title' => 'Delivering measurable results through a strong balance of design excellence and functional performance.',
                            'description' => 'Orisa™ goes beyond aesthetics—bringing clarity through motion, flexible structure, and practical tools that help you move faster without defining your identity.',
                            'image_1' => $this->filePath('pages/img-15.webp'),
                            'style_image_1' => $this->filePath('pages/img-15.webp'),
                            'image_2' => $this->filePath('pages/img-16.webp'),
                            'style_image_2' => $this->filePath('pages/img-16.webp'),
                            'image_3' => $this->filePath('general/logo-white.png'),
                            'style_image_3' => $this->filePath('general/logo-white.png'),
                            'quantity' => 2,
                            'title_1' => '1.8M',
                            'description_1' => "Active\nlive cases",
                            'content_1' => 'We always provide people a complete solution upon focused of any business',
                            'title_2' => '16K',
                            'description_2' => "Trusted\nPartners",
                            'content_2' => "Because sometimes the best design is the one you don't have to think about.",
                        ],
                    ],
                    [
                        'name' => 'site-statistics',
                        'attributes' => [
                            'style' => 1,
                            'quantity' => 5,
                            'value_1' => '10', 'suffix_1' => 'K+', 'label_1' => 'Years of Creative Practice',
                            'value_2' => '50', 'suffix_2' => 'K+', 'label_2' => 'Projects Carefully Crafted',
                            'value_3' => '16', 'suffix_3' => 'K+', 'label_3' => 'Brands Collaborated With',
                            'value_4' => '20', 'suffix_4' => 'M+', 'label_4' => 'Total Funding Supported',
                            'value_5' => '98', 'suffix_5' => '%', 'label_5' => 'Client satisfaction rate',
                        ],
                    ],
                    [
                        'name' => 'teams',
                        'attributes' => [
                            'style' => 2,
                            'subtitle' => 'Why choose us',
                            'title' => 'Meet the minds behind Orisa Studio. Rely on our experienced professionals to find solutions tailored just for you.',
                            'primary_action_label' => 'Join our Team',
                            'primary_action_url' => '/contact',
                            'description' => '<h3 class="h6 fw-600">We are here</h3><div class="d-flex flex-md-row flex-column gap-md-5 gap-4"><span class="fz-font-md neutral-500">205 North Michigan Avenue, Suite 810<br>Chicago, 60601, USA<br>Phone: <span class="neutral-900"><a href="tel:+1234567890">+1234567890</a></span><br>Email: <span class="neutral-900"><a href="mailto:hello@orisa.com">hello@orisa.com</a></span></span><span class="fz-font-md neutral-500 ps-md-5">245 Fifth Avenue, Suite 1800<br>New York, NY 10016, USA<br>Phone: <span class="neutral-900"><a href="tel:+2125557398">+2125557398</a></span><br>Email: <span class="neutral-900"><a href="mailto:sale@orisa.com">sale@orisa.com</a></span></span></div>',
                            'team_ids' => '1,2,3,4',
                        ],
                    ],
                    [
                        'name' => 'skills-carousel',
                        'attributes' => [
                            'quantity' => 10,
                            'name_1' => 'web3',
                            'name_2' => 'B2B & B2C',
                            'name_3' => 'SaaS Platforms',
                            'name_4' => 'Art Direction',
                            'name_5' => 'Web & Mobile Apps',
                            'name_6' => 'Motion Design',
                            'name_7' => 'UX/UI',
                            'name_8' => 'Branding',
                            'name_9' => 'Concept Design',
                            'name_10' => 'Presentations',
                        ],
                    ],
                    [
                        'name' => 'faqs',
                        'attributes' => [
                            'title' => 'Answered questions. Everything you might want to know—up front.',
                            'subtitle' => 'FAQ',
                            'image' => $this->filePath('pages/img-21.webp'),
                            'description' => 'Still no luck? We can help!',
                            'secondary_description' => 'Let us Know how we can assist',
                            'primary_action_label' => 'Support Center',
                            'primary_action_url' => '/faqs',
                            'category_ids' => '1,2,3',
                            'limit' => '8',
                        ],
                    ],
                    [
                        'name' => 'call-to-action',
                        'attributes' => [
                            'style' => 1,
                            'title' => "Let's Create <br> Meaning Together",
                            'description' => 'A creative studio crafting bold, user-focused digital experiences. At Orisa, we blend strategy, design, and innovation to help brands stand out and grow.',
                            'primary_action_label' => 'Book A Call Now',
                            'primary_action_url' => '/contact-1',
                            'image' => $this->filePath('pages/img-22.webp'),
                        ],
                    ],
                    [
                        'name' => 'blog-posts',
                        'attributes' => [
                            'subtitle' => 'INSIDE COMPANY',
                            'title' => 'Latest Posts From Our <br> blog and Event Fan page',
                            'description' => 'Insights, trends, and stories from the Orisa team.',
                            'paginate' => 4,
                            'action_label' => 'ALL ARTICLES',
                            'action_url' => '/blog',
                        ],
                    ],
                ]),
                'template' => 'homepage',
                'metadata' => [
                    'breadcrumb_enabled' => '0',
                ],
            ],
            [
                'name' => 'Portfolio',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'projects',
                        'attributes' => [
                            'title' => 'Our Work',
                            'subtitle' => 'Portfolio',
                            'description' => 'Explore the projects we are proud of.',
                        ],
                    ],
                ]),
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb_enabled' => '0',
                ],
            ],
            [
                'name' => 'Services 1',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'about-us-information',
                        'attributes' => [
                            'style' => 7,
                            'title' => 'Orisa Studio<sup>®</sup>',
                            'email' => 'hello@orisa.com',
                            'phone' => '(212) 555-7398',
                            'image' => $this->filePath('pages/img-153.webp'),
                        ],
                    ],
                    [
                        'name' => 'services',
                        'attributes' => [
                            'style' => 1,
                            'subtitle' => 'OUR SOLUTIONS',
                            'title' => 'Our Services',
                            'description' => 'Creative solutions built around your brand goals and audience needs.',
                            'service_ids' => Service::query()->pluck('id')->implode(','),
                        ],
                    ],
                    (function () {
                        // 18 images arranged round-robin into 3 columns (parallax mosaic).
                        $mosaicFiles = [140, 142, 143, 141, 140, 139, 147, 144, 145, 146, 148, 149, 126, 146, 147, 5, 150, 151];
                        $items = [];
                        foreach ($mosaicFiles as $n => $id) {
                            $items["image_" . ($n + 1)] = $this->filePath("pages/img-{$id}.webp");
                        }

                        return [
                            'name' => 'image-mosaic',
                            'attributes' => array_merge([
                                'quantity' => (string) count($mosaicFiles),
                                'column_speed_1' => '-0.1',
                                'column_speed_2' => '0.8',
                                'column_speed_3' => '-0.1',
                            ], $items),
                        ];
                    })(),
                    [
                        'name' => 'pricing-plans',
                        'attributes' => [
                            'style' => '3',
                            'title' => 'Strategic pricing plans built to align digital efforts with your business goals',
                            'subtitle' => 'PRICE & PLANS',
                            'description' => 'Choose a plan that fits your project and budget.',
                            ...$this->pricingPlanTabs(),
                        ],
                    ],
                    [
                        'name' => 'contact-form',
                        'attributes' => [
                            'style' => '3',
                            'subtitle' => 'cONTACT US',
                            'title' => 'Get in touch',
                            'description' => 'Start the conversation by sharing your vision. <br>Our team will respond within 1–2 business days.',
                            'address' => "205 North Michigan Avenue, Suite 810\nChicago, 60601, USA",
                            'phone' => '+1234567890',
                            'email' => 'hello@orisa.com',
                            'address_2' => "245 Fifth Avenue, Suite 1800\nNew York, NY 10016, USA",
                            'phone_2' => '+2125557398',
                            'email_2' => 'sale@orisa.com',
                            'display_fields' => 'phone,email',
                            'mandatory_fields' => 'name,email,phone,content',
                            'form_title' => '',
                        ],
                    ],
                ]),
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb_enabled' => '0',
                    'hide_header_spacing' => '1',
                ],
            ],
            [
                'name' => 'Services 2',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'about-us-information',
                        'attributes' => [
                            'style' => 8,
                            'subtitle' => 'Creative - Innovative - Agile',
                            'title' => 'Our Services',
                            'description' => 'We turn ideas into high-impact digital solutions that attract customers, boost conversions, and accelerate sustainable growth.',
                            'image' => $this->filePath('pages/img-154.webp'),
                        ],
                    ],
                    (function () {
                        $keywords = [
                            'Research & Insights',
                            'Purpose, Mission & Vision',
                            'Value Proposition',
                            'Brand Positioning',
                            'Brand Architecture',
                            'Brand Personality Trait',
                            'UX Research & User Journeys',
                            'Information Architecture',
                            'Wireframing & Prototyping',
                            'Design Systems',
                            'Digital Strategy',
                            'Interface Design (UI)',
                        ];
                        $items = ['quantity' => (string) count($keywords)];
                        foreach ($keywords as $i => $name) {
                            $items['name_' . ($i + 1)] = $name;
                        }

                        return [
                            'name' => 'keyword-ticker',
                            'attributes' => array_merge([
                                'scroll_direction' => 'left',
                            ], $items),
                        ];
                    })(),
                    [
                        'name' => 'services',
                        'attributes' => [
                            'style' => 2,
                            'subtitle' => 'Things we offer',
                            'title' => 'Creative Services',
                            'service_ids' => Service::query()->pluck('id')->implode(','),
                        ],
                    ],
                    [
                        'name' => 'testimonials',
                        'attributes' => [
                            'style' => 2,
                            'subtitle' => 'TESTIMONIALS',
                            'title' => 'Hear From My Happy Customers',
                            'testimonial_ids' => Testimonial::query()->take(5)->pluck('id')->implode(','),
                        ],
                    ],
                    [
                        'name' => 'faqs',
                        'attributes' => [
                            'style' => '4',
                            'title' => 'Frequently Asked Questions',
                            'category_ids' => '1,2,3',
                            'limit' => '8',
                        ],
                    ],
                ]),
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb_enabled' => '0',
                    'hide_header_spacing' => '1',
                ],
            ],
            [
                'name' => 'Services 3',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'about-us-information',
                        'attributes' => [
                            'style' => 9,
                            'subtitle' => 'Creative - Innovative - Agile',
                            'title' => 'Services',
                            'description' => 'We turn ideas into high-impact digital solutions that attract customers, boost conversions, and accelerate sustainable growth.',
                            'image' => $this->filePath('pages/img-155.webp'),
                        ],
                    ],
                    [
                        'name' => 'service-cards',
                        'attributes' => [
                            'quantity' => '4',
                            'title_1' => 'Strategy & Research',
                            'description_1' => 'Through research, analysis, and positioning, we build a clear foundation for meaningful digital growth.',
                            'image_1' => $this->filePath('pages/img-76.webp'),
                            'url_1' => '#',
                            'title_2' => 'Design & Experience',
                            'description_2' => 'Every interaction is crafted to balance beauty, usability, and brand personality.',
                            'image_2' => $this->filePath('pages/img-77.webp'),
                            'url_2' => '#',
                            'title_3' => 'Network Integration',
                            'description_3' => 'From on-premise to cloud environments, we ensure seamless communication, scalability, and operational stability.',
                            'image_3' => $this->filePath('pages/img-78.webp'),
                            'url_3' => '#',
                            'title_4' => 'Build & Launch',
                            'description_4' => 'Bring ideas to life with clean, scalable, and performance-driven builds. From development to launch, we focus on reliability and long-term growth.',
                            'image_4' => $this->filePath('pages/img-80.webp'),
                            'url_4' => '#',
                        ],
                    ],
                    [
                        'name' => 'content-block',
                        'attributes' => [
                            'style' => '11',
                            'subtitle' => 'Step by step',
                            'title' => 'My Process',
                            'description' => 'I integrate deep architectural research, rigorous data strategy, and production engineering to build resilient AI systems.',
                            'quantity' => '4',
                            'title_1' => 'System Audit & Discovery',
                            'description_1' => '2-3 Weeks|Mapping the infrastructure|Deep dive into existing infrastructure, data pipelines, and business objectives.',
                            'image_1' => $this->filePath('pages/img-138.webp'),
                            'style_image_1' => $this->filePath('pages/img-138.webp'),
                            'title_2' => 'Architectural Strategy',
                            'description_2' => '3-4 Weeks|Defining the AI logic|Design scalable ML architectures aligned with performance and cost requirements.',
                            'image_2' => $this->filePath('pages/img-139.webp'),
                            'style_image_2' => $this->filePath('pages/img-139.webp'),
                            'title_3' => 'Engineering & Deployment',
                            'description_3' => '8-12 Weeks|Building production-ready models|Build, test, and deploy models with CI/CD pipelines and monitoring.',
                            'image_3' => $this->filePath('pages/img-140.webp'),
                            'style_image_3' => $this->filePath('pages/img-140.webp'),
                            'title_4' => 'MLOps & Evolution',
                            'description_4' => 'Ongoing|Continuous optimization|Continuous model monitoring, retraining, and optimization for production.',
                            'image_4' => $this->filePath('pages/img-141.webp'),
                            'style_image_4' => $this->filePath('pages/img-141.webp'),
                        ],
                    ],
                    [
                        'name' => 'site-statistics',
                        'attributes' => [
                            'style' => '2',
                            'quantity' => '3',
                            'title_1' => 'Revenue driven through <br> digital strategy',
                            'data_1' => '28',
                            'unit_1' => 'M+',
                            'title_2' => 'Qualified leads <br> generated',
                            'data_2' => '64',
                            'unit_2' => 'K+',
                            'title_3' => 'Brands scaled <br> with Orisa',
                            'data_3' => '190',
                            'unit_3' => '+',
                        ],
                    ],
                    [
                        'name' => 'image-gallery',
                        'attributes' => [
                            'quantity' => '5',
                            'image_1' => $this->filePath('pages/img-48.webp'),
                            'alt_1' => 'orisa',
                            'image_2' => $this->filePath('pages/img-45.webp'),
                            'alt_2' => 'orisa',
                            'image_3' => $this->filePath('pages/img-46.webp'),
                            'alt_3' => 'orisa',
                            'image_4' => $this->filePath('pages/img-47.webp'),
                            'alt_4' => 'orisa',
                            'image_5' => $this->filePath('pages/img-49.webp'),
                            'alt_5' => 'orisa',
                        ],
                    ],
                    [
                        'name' => 'faqs',
                        'attributes' => [
                            'style' => '3',
                            'title' => 'Frequently Asked <br> Questions',
                            'subtitle' => 'FAQ',
                            'category_ids' => '1,2,3',
                            'limit' => '4',
                        ],
                    ],
                ]),
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb_enabled' => '0',
                    'hide_header_spacing' => '1',
                ],
            ],
            [
                'name' => 'Our Team',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'content-block',
                        'attributes' => [
                            'style' => 8,
                            'title' => 'Orisa Studio<sup>®</sup>',
                            'image' => $this->filePath('pages/img-153.webp'),
                        ],
                    ],
                    [
                        'name' => 'teams',
                        'attributes' => [
                            'style' => 3,
                            'subtitle' => 'MEET OUR TEAM',
                            'title' => 'Behind the Visionaries',
                            'description' => 'Creative experts designing meaningful digital experiences that help ambitious brands grow faster and lead their markets.',
                            'primary_action_label' => 'Join our Team',
                            'primary_action_url' => '/contact-1',
                            'team_ids' => Team::query()->pluck('id')->implode(','),
                        ],
                    ],
                    [
                        'name' => 'testimonials',
                        'attributes' => [
                            'style' => '7',
                            'title' => 'Insights from Industry Partners',
                            'subtitle' => 'Testimonials',
                            'testimonial_ids' => Testimonial::query()->take(4)->pluck('id')->implode(','),
                        ],
                    ],
                ]),
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb_enabled' => '0',
                    'hide_header_spacing' => '1',
                ],
            ],
            [
                'name' => 'Blog',
                'description' => 'Explore insights and trends from the Orisa creative team.',
                'content' => '',
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb_enabled' => '0',
                ],
            ],
            [
                'name' => 'Contact 1',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'content-block',
                        'attributes' => [
                            'style' => 8,
                            'image' => $this->filePath('pages/img-166.webp'),
                        ],
                    ],
                    [
                        'name' => 'contact-form',
                        'attributes' => [
                            'style' => 1,
                            'title' => 'Have a project in mind? Let\'s talk.',
                            'subtitle' => 'Contact Us',
                            'description' => 'Please let us know if you have a question, want to leave a comment, or would like further information about Orisa Agency.',
                            'address' => '205 North Michigan Avenue, Suite 810<br>Chicago, 60601, USA',
                            'phone' => '+1234567890',
                            'email' => 'hello@orisa.com',
                            'address_2' => '245 Fifth Avenue, Suite 1800<br>New York, NY 10016, USA',
                            'phone_2' => '+2125557398',
                            'email_2' => 'sale@orisa.com',
                            'form_title' => 'Get in touch',
                            'form_description' => 'Do you want to know more or contact our team?',
                            'display_fields' => 'phone,email,subject,address',
                            'mandatory_fields' => 'email',
                            'quantity' => 3,
                            'title_1' => 'Visit our Help Center',
                            'description_1' => 'Browse articles and step-by-step guides for our services.',
                            'icon_1' => 'ti ti-search',
                            'title_2' => 'Watch Our Work',
                            'description_2' => 'Explore our portfolio and see how we bring ideas to life.',
                            'icon_2' => 'ti ti-video',
                            'title_3' => 'Speak to Our Team',
                            'description_3' => 'Let us talk about how we can help grow your brand.',
                            'icon_3' => 'ti ti-headphones',
                        ],
                    ],
                    [
                        'name' => 'google-map',
                        'attributes' => [
                            'height' => 650,
                        ],
                        'content' => 'Level 7/180 Flinders St, Melbourne VIC 3000, Australia',
                    ],
                ]),
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb_enabled' => '0',
                    'hide_header_spacing' => '1',
                ],
            ],
            [
                'name' => 'Contact 2',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'contact-form',
                        'attributes' => [
                            'display_fields' => 'phone,email,subject,address',
                            'mandatory_fields' => 'email',
                            'style' => '2',
                            'form_title' => 'Drop us a line',
                            'title' => 'Reach out to discuss <br> your project requirements',
                            'subtitle' => 'Contact Us',
                            'description' => 'Start the conversation by sharing your vision. <br> Our team will respond within 1–2 business days.',
                            'address' => '205 North Michigan Avenue, Suite 810<br>Chicago, 60601, USA',
                            'phone' => '+1234567890',
                            'email' => 'hello@orisa.com',
                            'address_2' => '245 Fifth Avenue, Suite 1800<br>New York, NY 10016, USA',
                            'phone_2' => '+2125557398',
                            'email_2' => 'sale@orisa.com',
                            'quantity' => '3',
                            'title_1' => 'Chat with us',
                            'description_1' => 'Our support team is always available 24/7',
                            'button_label_1_1' => 'Chat via Whatsapp',
                            'button_url_1_1' => 'https://www.whatsapp.com',
                            'button_icon_1_1' => 'ti ti-brand-whatsapp',
                            'button_label_2_1' => 'Chat via Viber',
                            'button_url_2_1' => 'https://www.viber.com/',
                            'button_icon_2_1' => 'ti ti-phone-call',
                            'button_label_3_1' => 'Chat via Messenger',
                            'button_url_3_1' => 'https://www.facebook.com/',
                            'button_icon_3_1' => 'ti ti-brand-messenger',
                            'title_2' => 'Send us an email',
                            'description_2' => 'Our team will respond promptly to your inquiries',
                            'button_label_1_2' => 'support@orisa.com',
                            'button_url_1_2' => 'mailto:support@orisa.com',
                            'button_icon_1_2' => 'ti ti-mail',
                            'button_label_2_2' => 'sale@orisa.com',
                            'button_url_2_2' => 'mailto:sale@orisa.com',
                            'button_icon_2_2' => 'ti ti-mail',
                            'title_3' => 'For more inquiry',
                            'description_3' => 'Reach out for immediate assistance',
                            'button_label_1_3' => '+01 (24) 568 900',
                            'button_url_1_3' => 'tel:0124568900',
                            'button_icon_1_3' => 'ti ti-phone-call',
                            'address' => "205 North Michigan Avenue, Suite 810\nChicago, 60601, USA",
                            'phone' => '+1234567890',
                            'email' => 'hello@orisa.com',
                        ],
                    ],
                    [
                        'name' => 'google-map',
                        'attributes' => [
                            'height' => 500,
                        ],
                        'content' => 'Level 7/180 Flinders St, Melbourne VIC 3000, Australia',
                    ],
                    [
                        'name' => 'image-gallery',
                        'attributes' => [
                            'quantity' => '7',
                            'image_1' => $this->filePath('pages/img-130.webp'),
                            'alt_1' => 'orisa',
                            'image_2' => $this->filePath('pages/img-131.webp'),
                            'alt_2' => 'orisa',
                            'image_3' => $this->filePath('pages/img-132.webp'),
                            'alt_3' => 'orisa',
                            'image_4' => $this->filePath('pages/img-133.webp'),
                            'alt_4' => 'orisa',
                            'image_5' => $this->filePath('pages/img-134.webp'),
                            'alt_5' => 'orisa',
                            'image_6' => $this->filePath('pages/img-135.webp'),
                            'alt_6' => 'orisa',
                            'image_7' => $this->filePath('pages/img-136.webp'),
                            'alt_7' => 'orisa',
                        ],
                    ],
                ]),
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb_enabled' => '0',
                ],
            ],
            [
                'name' => 'About 1',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'about-us-information',
                        'attributes' => [
                            'style' => 1,
                            'title' => 'We are a creative digital agency shaping meaningful experiences',
                            'subtitle' => 'About Us',
                            'description' => 'We blend strategy, creativity, and technology to help brands grow, connect, and stand out in an ever-evolving digital world.',
                            'primary_action_label' => 'GET IN TOUCH',
                            'primary_action_url' => '/contact-1',
                            'avatars_quantity' => 5,
                            'avatars_image_1' => $this->filePath('testimonials/avatar-1.webp'),
                            'avatars_image_2' => $this->filePath('testimonials/avatar-2.webp'),
                            'avatars_image_3' => $this->filePath('testimonials/avatar-3.webp'),
                            'avatars_image_4' => $this->filePath('testimonials/avatar-4.webp'),
                            'avatars_image_5' => $this->filePath('testimonials/avatar-5.webp'),
                            'experience_years' => '15',
                            'quantity' => '2',
                            'title_1' => 'Creative Expertise',
                            'description_1' => 'With over a decade of design expertise, we create tailored solutions that engage audiences, build meaningful connections, and elevate brands with creativity and intent.',
                            'image_1' => $this->filePath('pages/img-117.webp'),
                            'style_image_1' => $this->filePath('pages/img-117.webp'),
                            'title_2' => 'Experience & Innovation',
                            'description_2' => 'Backed by a decade of creative experience, we craft visual experiences that bring together strategy, design, and technology to grow brands, inspire audiences, and create meaningful impact.',
                            'image_2' => $this->filePath('pages/img-118.webp'),
                            'style_image_2' => $this->filePath('pages/img-118.webp'),
                        ],
                    ],
                    [
                        'name' => 'site-statistics',
                        'attributes' => [
                            'style' => '2',
                            'quantity' => '3',
                            'title_1' => 'Revenue driven through <br> digital strategy',
                            'data_1' => '28',
                            'unit_1' => 'M+',
                            'title_2' => 'Qualified leads <br> generated',
                            'data_2' => '64',
                            'unit_2' => 'K+',
                            'title_3' => 'Brands scaled <br> with Orisa',
                            'data_3' => '190',
                            'unit_3' => '+',
                        ],
                    ],
                    [
                        'name' => 'our-journey',
                        'attributes' => [
                            'subtitle' => 'Who We Are',
                            'title' => 'Our Journey',
                            'description' => 'A timeline of ideas, growth, and meaningful impact. From a simple idea to shaping digital experiences that matter.',
                            'primary_action_label' => 'Start a Project',
                            'primary_action_url' => '/contact-1',
                            'card_image' => $this->filePath('pages/img-121.webp'),
                            'card_badge' => 'Since 2012',
                            'card_title' => 'Artificial intelligence and Big Data expert',
                            'card_description' => 'We always provide people a complete solution upon focused of any business',
                            'card_label' => 'Orisa Nova<sup>&reg;</sup>',
                            'card_url' => '/portfolio-1',
                            'items_quantity' => '4',
                            'items_date_1' => '2021 — Expanding Capabilities',
                            'items_title_1' => 'From Design Studio to Digital Agency',
                            'items_company_1' => '',
                            'items_description_1' => 'As demand grew, so did our expertise. We expanded into UI/UX, web development, and digital strategy — building cross-functional teams to deliver end-to-end solutions.',
                            'items_url_1' => '#',
                            'items_date_2' => '2022 — Trusted by Growing Brands',
                            'items_title_2' => 'ML Infrastructure Engineer',
                            'items_company_2' => 'Building Long-Term Partnerships',
                            'items_description_2' => 'We began working with scaling businesses and established brands, focusing on long-term collaboration instead of one-off projects. Our process matured, and our impact became measurable.',
                            'items_url_2' => '#',
                            'items_date_3' => '2024 — Designing for the Future',
                            'items_title_3' => 'Innovation, Scale, and What\'s Next',
                            'items_company_3' => '',
                            'items_description_3' => 'Today, we continue to evolve — embracing new technologies, smarter workflows, and future-ready design systems. Our journey is ongoing, and we\'re just getting started.',
                            'items_url_3' => '#',
                            'items_date_4' => '2025+ — Beyond Boundaries',
                            'items_title_4' => 'The Next Chapter',
                            'items_company_4' => '',
                            'items_description_4' => 'With a global mindset and a passion for innovation, we\'re shaping what\'s next in digital experiences — together with ambitious partners around the world.',
                            'items_url_4' => '#',
                        ],
                    ],
                    [
                        'name' => 'awards',
                        'attributes' => [
                            'title' => 'Awards.',
                            'action_label' => 'View All Awards',
                            'action_url' => '/portfolio-1',
                            'quantity' => '5',
                            'date_1' => '19 Oct 2024',
                            'title_1' => 'Best Web Design Agency',
                            'organization_1' => 'Web Excellence Awards',
                            'url_1' => 'https://csswinner.com',
                            'url_label_1' => 'csswinner.com',
                            'image_1' => $this->filePath('pages/img-40.webp'),
                            'image_lg_1' => $this->filePath('pages/img-40-lg.webp'),
                            'date_2' => '12 Feb 2026',
                            'title_2' => 'Digital Agency of the Year',
                            'organization_2' => 'Global Digital Excellence Awards',
                            'url_2' => 'https://globaldigitalawards.com',
                            'url_label_2' => 'globaldigitalawards.com',
                            'image_2' => $this->filePath('pages/img-41.webp'),
                            'image_lg_2' => $this->filePath('pages/img-41-lg.webp'),
                            'date_3' => '08 Aug 2025',
                            'title_3' => 'Innovation in Digital Experience',
                            'organization_3' => 'International Digital Awards',
                            'url_3' => 'https://digital-awards.org',
                            'url_label_3' => 'digital-awards.org',
                            'image_3' => $this->filePath('pages/img-42.webp'),
                            'image_lg_3' => $this->filePath('pages/img-42-lg.webp'),
                            'date_4' => '19 Oct 2024',
                            'title_4' => 'Best Integrated Digital Campaign',
                            'organization_4' => 'Drum Awards',
                            'url_4' => 'https://thedrum.com',
                            'url_label_4' => 'thedrum.com',
                            'image_4' => $this->filePath('pages/img-43.webp'),
                            'image_lg_4' => $this->filePath('pages/img-43-lg.webp'),
                            'date_5' => '03 Apr 2026',
                            'title_5' => 'Growth-Driven Digital Agency',
                            'organization_5' => 'Clutch Leaders Awards',
                            'url_5' => 'https://clutch.co',
                            'url_label_5' => 'clutch.co',
                            'image_5' => $this->filePath('pages/img-44.webp'),
                            'image_lg_5' => $this->filePath('pages/img-44-lg.webp'),
                            'description' => 'Orisa is a digital agency creating impactful digital experiences. We think like strategists and execute with clarity, creativity, and performance.',
                        ],
                    ],
                    [
                        'name' => 'teams',
                        'attributes' => [
                            'style' => '3',
                            'subtitle' => 'MEET OUR TEAM',
                            'title' => 'Behind the Visionaries',
                            'description' => 'Creative experts designing meaningful digital experiences that help ambitious brands grow faster and lead their markets.',
                            'primary_action_label' => 'Join our Team',
                            'primary_action_url' => '/our-team',
                            'team_ids' => '1,2,3,4',
                        ],
                    ],
                    [
                        'name' => 'contact-form',
                        'attributes' => [
                            'style' => '3',
                            'subtitle' => 'CONTACT US',
                            'title' => 'Get in touch',
                            'description' => 'Start the conversation by sharing your vision. <br>Our team will respond within 1–2 business days.',
                            'address' => "205 North Michigan Avenue, Suite 810\nChicago, 60601, USA",
                            'phone' => '+1234567890',
                            'email' => 'hello@orisa.com',
                            'address_2' => "245 Fifth Avenue, Suite 1800\nNew York, NY 10016, USA",
                            'phone_2' => '+2125557398',
                            'email_2' => 'sale@orisa.com',
                            'display_fields' => 'phone,email',
                            'mandatory_fields' => 'name,email,phone,content',
                            'form_title' => '',
                        ],
                    ],
                    [
                        'name' => 'blog-posts',
                        'attributes' => [
                            'style' => '2',
                            'title' => 'Explore our Latest journal',
                            'subtitle' => 'Insights & Inspiration',
                            'description' => 'Stay updated with the latest from Orisa.',
                            'paginate' => '4',
                            'action_label' => 'ALL ARTICLES',
                            'action_url' => '/blog',
                        ],
                    ],
                    [
                        'name' => 'partners',
                        'attributes' => [
                            'style' => 1,
                            'quantity' => 10,
                            ...collect(['Framer', 'Reddit', 'Netflix', 'Microsoft', 'Discover', 'Lemon Squeezy', 'Paypal', 'Youtube', 'Spotify', 'Google'])
                                ->mapWithKeys(function ($name, $index) {
                                    $index++;
                                    $imageName = $index > 8 ? rand(1, 8) : $index;

                                    return [
                                        "name_$index" => $name,
                                        "image_$index" => $this->filePath("partners/$imageName.webp"),
                                        "url_$index" => 'https://google.com',
                                        "open_in_new_tab_$index" => true,
                                    ];
                                })
                                ->all(),
                        ],
                    ],
                ]),
                'template' => 'full-width',
            ],
            [
                'name' => 'About 2',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'about-us-information',
                        'attributes' => [
                            'style' => '6',
                            'title' => 'Orisa Studio<sup>&reg;</sup>',
                            'image' => $this->filePath('pages/img-122.webp'),
                        ],
                    ],
                    [
                        'name' => 'partners',
                        'attributes' => [
                            'style' => 1,
                            'quantity' => 12,
                            ...collect(['Framer', 'Reddit', 'Netflix', 'Microsoft', 'Discover', 'Lemon Squeezy', 'PayPal', 'Mailchimp', 'Shopify', 'Slack', 'Spotify', 'Google'])
                                ->mapWithKeys(function ($name, $index) {
                                    $index++;
                                    $imageName = $index > 8 ? rand(1, 8) : $index;

                                    return [
                                        "name_$index" => $name,
                                        "image_$index" => $this->filePath("partners/$imageName.webp"),
                                        "url_$index" => 'https://google.com',
                                        "open_in_new_tab_$index" => true,
                                    ];
                                })
                                ->all(),
                        ],
                    ],
                    [
                        'name' => 'teams',
                        'attributes' => [
                            'style' => '4',
                            'title' => 'Meet our dedicated <br> and skilled team',
                            'subtitle' => 'OUR TEAM',
                            'experience_years' => '190',
                            'description' => 'Projects have been <br> completed.',
                            'team_ids' => '1,2,3,4,5,6',
                        ],
                    ],
                    [
                        'name' => 'awards',
                        'attributes' => [
                            'style' => '2',
                            'subtitle' => 'WHO WE ARE',
                            'title' => 'Our Journey',
                            'action_label' => 'View All Awards',
                            'action_url' => '/portfolio-3',
                            'quantity' => '4',
                            'date_1' => '2021 — Expanding Capabilities',
                            'title_1' => 'From Design Studio to Digital Agency',
                            'organization_1' => 'We evolved from a design-focused studio into a full-service digital agency, combining creative excellence with strategic development and ongoing support.',
                            'image_1' => $this->filePath('pages/img-126.webp'),
                            'url_1' => '#',
                            'date_2' => '2022 — Trusted by Growing Brands',
                            'title_2' => 'Building Long-Term Partnerships',
                            'organization_2' => 'We focused on deepening client relationships and delivering measurable results that drive growth and brand recognition across industries.',
                            'image_2' => $this->filePath('pages/img-127.webp'),
                            'url_2' => '#',
                            'date_3' => '2023 — Innovation & Scale',
                            'title_3' => 'Pushing Boundaries in Digital',
                            'organization_3' => 'We invested in new technologies and methodologies to scale our impact while maintaining the craft and attention to detail that define our work.',
                            'image_3' => $this->filePath('pages/img-128.webp'),
                            'url_3' => '#',
                            'date_4' => '2024 — Leading the Way',
                            'title_4' => 'Award-Winning Excellence',
                            'organization_4' => 'Our work has been recognized by industry leaders and we continue to set the standard for creativity, strategy, and delivery in digital experiences.',
                            'image_4' => $this->filePath('pages/img-129.webp'),
                            'url_4' => '#',
                        ],
                    ],
                    [
                        'name' => 'image-gallery',
                        'attributes' => [
                            'style' => '2',
                            'quantity' => '7',
                            'image_1' => $this->filePath('pages/img-130.webp'),
                            'alt_1' => 'orisa',
                            'image_2' => $this->filePath('pages/img-131.webp'),
                            'alt_2' => 'orisa',
                            'image_3' => $this->filePath('pages/img-132.webp'),
                            'alt_3' => 'orisa',
                            'image_4' => $this->filePath('pages/img-133.webp'),
                            'alt_4' => 'orisa',
                            'image_5' => $this->filePath('pages/img-134.webp'),
                            'alt_5' => 'orisa',
                            'image_6' => $this->filePath('pages/img-135.webp'),
                            'alt_6' => 'orisa',
                            'image_7' => $this->filePath('pages/img-136.webp'),
                            'alt_7' => 'orisa',
                        ],
                    ],
                    [
                        'name' => 'site-statistics',
                        'attributes' => [
                            'style' => '4',
                            'subtitle' => 'Interesting Stats',
                            'title' => 'Figures That Tell a Story',
                            'quantity' => '3',
                            'title_1' => 'ROI increase',
                            'data_1' => '120',
                            'unit_1' => '%',
                            'description_1' => 'Delivered exceptional ROI growth through data-driven optimization.',
                            'title_2' => 'Ad spend managed',
                            'data_2' => '25',
                            'prefix_2' => '$',
                            'unit_2' => 'M+',
                            'description_2' => 'Managed large-scale advertising budgets with measurable performance impact.',
                            'title_3' => 'Campaigns launched',
                            'data_3' => '300',
                            'unit_3' => '+',
                            'description_3' => 'Executed hundreds of high-impact marketing initiatives across platforms.',
                        ],
                    ],
                    [
                        'name' => 'contact-form',
                        'attributes' => [
                            'display_fields' => 'phone,email,subject,address',
                            'mandatory_fields' => 'email',
                            'style' => '3',
                            'form_title' => 'Leave a message',
                            'title' => 'Get in touch',
                            'subtitle' => 'CONTACT US',
                            'description' => 'Start the conversation by sharing your goals. Our team will respond within 1–2 business days.',
                            'address' => "205 North Michigan Avenue, Suite 810\nChicago, 60601, USA",
                            'phone' => '+1234567890',
                            'email' => 'hello@orisa.com',
                            'address_2' => "245 Fifth Avenue, Suite 1800\nNew York, NY 10016, USA",
                            'phone_2' => '+2125557398',
                            'email_2' => 'sale@orisa.com',
                        ],
                    ],
                ]),
                'template' => 'full-width',
            ],
            [
                'name' => 'About 3',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'hero-banner',
                        'attributes' => [
                            'style' => '6',
                            'subtitle' => "Hi, I'm Orisa Nova",
                            'title' => 'About me',
                            'description' => 'I design, train, and deploy AI models that turn data into real-world decisions — from computer vision to large-scale machine learning systems.',
                            'image' => $this->filePath('pages/img-137.webp'),
                            'primary_action_label' => 'See my work',
                            'primary_action_url' => '/portfolio-1',
                            'secondary_action_label' => 'Download CV',
                            'secondary_action_url' => '#',
                        ],
                    ],
                    [
                        'name' => 'content-block',
                        'attributes' => [
                            'style' => '10',
                            'subtitle' => 'My journey',
                            'title' => 'Experience',
                            'description' => 'Building the backbone of modern AI—delivering production-grade systems with mathematical rigor and operational excellence',
                            'quantity' => '5',
                            'title_1' => 'Senior AI Engineer',
                            'description_1' => 'Neural Dynamics|Jan 2022 — Present|Architecting distributed training systems and leading the deployment of production-grade LLM pipelines.',
                            'title_2' => 'ML Infrastructure Engineer',
                            'description_2' => 'DataScale Labs|June 2019 — Dec 2021|Optimized large-scale data ingestion and automated MLOps workflows for high-frequency trading models.',
                            'title_3' => 'Computer Vision Researcher',
                            'description_3' => 'Visionary Tech|Jan 2017 — May 2019|Developed state-of-the-art object detection algorithms for autonomous drone navigation and edge computing.',
                            'title_4' => 'Junior Data Scientist',
                            'description_4' => 'Insight Corp|Jan 2015 — Dec 2016|Built predictive analytics dashboards and performed feature engineering on multi-terabyte datasets.',
                            'title_5' => 'Data Analyst Intern',
                            'description_5' => 'Quantum Analytics|June 2012 — Dec 2014|Assisted in statistical modeling and data cleaning for large-scale consumer behavior studies.',
                        ],
                    ],
                    [
                        'name' => 'content-block',
                        'attributes' => [
                            'style' => '11',
                            'subtitle' => 'Step by step',
                            'title' => 'My Process',
                            'description' => 'I integrate deep architectural research, rigorous data strategy, and production engineering to build resilient AI systems.',
                            'contact_phone' => '+212 - 555-7398',
                            'contact_email' => 'hello@orisa.com',
                            'contact_address' => "205 North Michigan Avenue,\nSuite 810, Chicago, 60601, USA",
                            'quantity' => '4',
                            'title_1' => 'System Audit & Discovery',
                            'description_1' => '2-3 Weeks|Mapping the infrastructure|I begin with an in-depth audit of your data landscape, current infrastructure, and core business objectives. This foundational phase identifies technical constraints and sets the architectural direction for the project.',
                            'image_1' => $this->filePath('pages/img-138.webp'),
                            'style_image_1' => $this->filePath('pages/img-138.webp'),
                            'title_2' => 'Architectural Strategy',
                            'description_2' => '3-4 Weeks|Defining the AI logic|Together, we develop a comprehensive technical roadmap. I design the neural architecture and data flow, establishing clear performance benchmarks—such as latency thresholds and accuracy targets—required for success.',
                            'image_2' => $this->filePath('pages/img-139.webp'),
                            'style_image_2' => $this->filePath('pages/img-139.webp'),
                            'title_3' => 'Engineering & Deployment',
                            'description_3' => '8-12 Weeks|Building production-ready models|The development phase moves through focused sprints of training, fine-tuning, and rigorous testing. I transform theoretical designs into scalable, production-grade AI models integrated into your live environment.',
                            'image_3' => $this->filePath('pages/img-140.webp'),
                            'style_image_3' => $this->filePath('pages/img-140.webp'),
                            'title_4' => 'MLOps & Evolution',
                            'description_4' => 'Ongoing|Continuous optimization|Post-deployment, I implement continuous monitoring and MLOps pipelines to prevent model drift. We constantly measure and refine the system, ensuring the AI remains accurate and scalable as your data demands evolve.',
                            'image_4' => $this->filePath('pages/img-141.webp'),
                            'style_image_4' => $this->filePath('pages/img-141.webp'),
                        ],
                    ],
                    [
                        'name' => 'testimonials',
                        'attributes' => [
                            'style' => '2',
                            'title' => 'What Clients Say',
                            'subtitle' => 'TESTIMONIALS',
                            'description' => 'Hear from the partners who trust my work.',
                            'testimonial_ids' => '1,2,3,4,5',
                        ],
                    ],
                    [
                        'name' => 'site-statistics',
                        'attributes' => [
                            'style' => '3',
                            'title' => 'Years of Practice, Hundreds of Deployments, and Satisfied Partners',
                            'quantity' => '5',
                            'title_1' => 'Models in Production',
                            'data_1' => '25',
                            'unit_1' => '+',
                            'title_2' => 'Daily Inferences',
                            'data_2' => '15',
                            'prefix_2' => '$',
                            'unit_2' => 'M+',
                            'title_3' => 'Latency Optimization',
                            'data_3' => '300',
                            'unit_3' => '%',
                            'title_4' => 'Data Orchestrated',
                            'data_4' => '500',
                            'unit_4' => 'TB',
                            'title_5' => 'System Uptime',
                            'data_5' => '99',
                            'unit_5' => '.9%',
                        ],
                    ],
                    (function () {
                        // 18 images arranged round-robin into 3 columns (matches sec-5-about in about-3.html).
                        $mosaicFiles = [140, 142, 143, 141, 140, 139, 147, 144, 145, 146, 148, 149, 126, 146, 147, 5, 150, 151];
                        $items = [];
                        foreach ($mosaicFiles as $n => $id) {
                            $items["image_" . ($n + 1)] = $this->filePath("pages/img-{$id}.webp");
                        }

                        return [
                            'name' => 'image-mosaic',
                            'attributes' => array_merge([
                                'quantity' => (string) count($mosaicFiles),
                                'column_speed_1' => '-0.1',
                                'column_speed_2' => '0.8',
                                'column_speed_3' => '-0.1',
                            ], $items),
                        ];
                    })(),
                    (function () {
                        // PNG logos uploaded via seeder → admin can replace via media picker.
                        // (SVG uploads are blocked by Botble's media validation.)
                        $logos = [];
                        for ($i = 1; $i <= 15; $i++) {
                            $logos[$i] = $this->filePath("skill-logos/logo-{$i}.png");
                        }

                        return [
                            'name' => 'skill-cards',
                            'attributes' => [
                                'subtitle' => 'my skills',
                                'title' => 'Tech Stack / Tools',
                                'description' => 'I fuse scalable AI architecture, data-driven strategy, and real-world deployment expertise to build reliable intelligent systems.',
                                'quantity' => '5',
                                'title_1' => 'Languages',
                                'image_1' => $this->filePath('pages/img-148.webp'),
                                'score_1' => '98',
                                'tags_1' => "Python|{$logos[1]}\nC++|{$logos[2]}\nJavaScript|{$logos[3]}",
                                'title_2' => 'Frameworks',
                                'image_2' => $this->filePath('pages/img-149.webp'),
                                'score_2' => '96',
                                'tags_2' => "PyTorch|{$logos[4]}\nTensorFlow|{$logos[5]}\nScikit-learn|{$logos[6]}",
                                'title_3' => 'Data',
                                'image_3' => $this->filePath('pages/img-150.webp'),
                                'score_3' => '99',
                                'tags_3' => "Pandas|{$logos[7]}\nNumPy|{$logos[8]}\nSpark|{$logos[9]}",
                                'title_4' => 'MLOps',
                                'image_4' => $this->filePath('pages/img-151.webp'),
                                'score_4' => '82',
                                'tags_4' => "Docker|{$logos[10]}\nKubernetes|{$logos[11]}\nMLflow|{$logos[12]}",
                                'title_5' => 'Cloud',
                                'image_5' => $this->filePath('pages/img-152.webp'),
                                'score_5' => '86',
                                'tags_5' => "AWS|{$logos[13]}\nGCP|{$logos[14]}\nAzure|{$logos[15]}",
                            ],
                        ];
                    })(),
                    [
                        'name' => 'faqs',
                        'attributes' => [
                            'style' => '3',
                            'title' => 'Frequently Asked <br> Questions',
                            'subtitle' => 'FAQ',
                            'description' => 'Common questions about my services and process.',
                            'category_ids' => '1,2,3',
                            'limit' => '4',
                        ],
                    ],
                ]),
                'template' => 'full-width',
            ],
            [
                'name' => 'Pricing',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'pricing-plans',
                        'attributes' => [
                            'style' => '3',
                            'title' => 'Strategic pricing plans built to align digital efforts with your business goals',
                            'subtitle' => 'PRICE & PLANS',
                            'description' => 'Choose a plan that fits your project and budget.',
                            'custom_pricing_title' => 'Need custom pricing?',
                            'custom_pricing_description' => 'Tell us about your goals, challenges, and timeline. We\'ll craft a tailored digital solution that fits your needs and budget.',
                            'primary_action_label' => 'Contact Us',
                            'primary_action_url' => '/contact-1',
                            'contact_email' => 'hello@orisa.com',
                            'contact_phone' => '(212) 555-7398',
                            ...$this->pricingPlanTabs(),
                        ],
                    ],
                    [
                        'name' => 'service-cards',
                        'attributes' => [
                            'style' => '2',
                            'subtitle' => 'OUR APPROACH',
                            'title' => 'How we approach strategy',
                            'description' => 'We combine research, analysis, and strategic thinking into a clear, decision-making framework.',
                            'quantity' => '4',
                            'title_1' => 'Explore',
                            'description_1' => 'Understand context constraints, goals and assumptions',
                            'image_1' => $this->filePath('pages/img-138.webp'),
                            'url_1' => '#',
                            'title_2' => 'Synthesize',
                            'description_2' => 'Turn data into meaningful insights',
                            'image_2' => $this->filePath('pages/img-139.webp'),
                            'url_2' => '#',
                            'title_3' => 'Frame',
                            'description_3' => 'Define problems & opportunities and priorities',
                            'image_3' => $this->filePath('pages/img-140.webp'),
                            'url_3' => '#',
                            'title_4' => 'Guide',
                            'description_4' => 'Translate insight into action',
                            'image_4' => $this->filePath('pages/img-141.webp'),
                            'url_4' => '#',
                        ],
                    ],
                    [
                        'name' => 'faqs',
                        'attributes' => [
                            'style' => '3',
                            'title' => 'Frequently <br> Asked Questions',
                            'subtitle' => 'FAQ',
                            'description' => 'Have any questions? We\'re here to assist you.',
                            'category_ids' => '1,2,3',
                            'limit' => '6',
                        ],
                    ],
                ]),
                'template' => 'full-width',
            ],
            [
                'name' => 'FAQ',
                'content' => $this->generateShortcodeContent([
                    [
                        'name' => 'content-block',
                        'attributes' => [
                            'style' => 9,
                            'subtitle' => 'Frequently Asked Questions',
                            'title' => 'Join the community with more than 12k+ topics already created',
                            'description' => 'Professional support team will solve your problem.',
                            'primary_action_label' => 'Your question...',
                            'secondary_action_label' => 'Find the answer',
                        ],
                    ],
                    [
                        'name' => 'faqs',
                        'attributes' => [
                            'style' => '2',
                            'title' => 'Frequently Asked <br> Questions',
                            'description' => 'Find answers to the most common questions about Orisa and our services.',
                            'image' => $this->filePath('general/faqs-img-2.webp'),
                            'quantity' => '3',
                            'title_1' => 'Live chat support 24/7',
                            'description_1' => 'Our team is always ready to help you.',
                            'icon_image_1' => $this->filePath('icons/icon-1.png'),
                            'title_2' => 'Help desk support',
                            'description_2' => 'Via ticket system. Available 24/7.',
                            'icon_image_2' => $this->filePath('icons/icon-2.png'),
                            'title_3' => 'Book a consultation',
                            'description_3' => 'Live support via video call.',
                            'icon_image_3' => $this->filePath('icons/icon-15.png'),
                            'category_ids' => '1,2,3',
                            'limit' => '12',
                        ],
                    ],
                ]),
                'template' => 'full-width',
                'metadata' => [
                    'hide_header_spacing' => '1',
                ],
            ],
            [
                'name' => 'Coming Soon',
                'content' => "We're crafting something exciting — a special surprise just for our subscribers.",
                'template' => 'coming-soon',
                'metadata' => [
                    'coming_soon_subtitle' => 'We are On the Way',
                    'countdown_time' => $this->now()->addDays(200)->format('Y/m/d H:i:s'),
                    'banner_image' => $this->filePath('pages/img-169.webp'),
                ],
            ],
            [
                'name' => 'Privacy Policy',
                'content' =>
                    '<br><br>' .
                    Shortcode::generateShortcode('content-page', [
                        'title' => 'Orisa Agency Privacy Policy',
                        'subtitle' => 'Privacy Policy',
                        'description' => 'At Orisa Agency, we value your privacy and are committed to protecting your personal information. This Privacy Policy outlines how we collect, use, disclose, and safeguard your data when you use our services.',
                    ]) .
                    file_get_contents(database_path('seeders/contents/term-and-privacy.html')) .
                    Shortcode::generateShortcode('content-page', [
                        'contact_section_title' => 'Contact Us',
                        'contact_section_description' => 'If you have any questions or concerns about this Privacy Policy, please contact us at:',
                        'contact_section_subtitle' => 'Chat with us',
                        'contact_section_sub_description' => 'Our support team is always available 24/7',
                        'quantity' => '5',
                        'action_label_1' => 'Chat via Whatsapp',
                        'action_url_1' => 'https://www.whatsapp.com/',
                        'action_icon_1' => 'ti ti-brand-whatsapp',
                        'action_label_2' => 'Chat via Viber',
                        'action_url_2' => 'https://www.viber.com/',
                        'action_icon_2' => 'ti ti-phone-call',
                        'action_label_3' => 'Chat via Messenger',
                        'action_url_3' => 'https://www.facebook.com/',
                        'action_icon_3' => 'ti ti-brand-messenger',
                        'action_label_4' => 'support@orisa.com',
                        'action_url_4' => 'mailto:support@orisa.com',
                        'action_icon_4' => 'ti ti-mail',
                        'action_label_5' => 'Send us an email',
                        'action_url_5' => 'mailto:sale@orisa.com',
                        'action_icon_5' => 'ti ti-mail',
                    ]) . '<br><br>',
            ],
        ]);
    }

    /**
     * Flat tab attributes for the `pricing-plans` shortcode (3 plans, middle featured).
     * Returns `quantity`, `name_N`, `monthly_price_N`, `yearly_price_N`, `features_N`,
     * `is_featured_N`, `button_label_N`, `button_url_N` — ready to spread into the
     * shortcode attributes array.
     */
    protected function pricingPlanTabs(): array
    {
        $plans = [
            [
                'name' => 'Starter',
                'description' => 'A solid digital foundation focused on clarity, usability, and performance essentials.',
                'monthly_price' => '$1,200',
                'yearly_price' => '$12,000',
                'features' => "Digital strategy setup\nDigital audit & Insights\nPositioning & Messaging\nSEO & Technical setup\nAnalytics tracking",
                'is_featured' => false,
                'button_label' => 'Get Started',
                'button_url' => '/contact-1',
            ],
            [
                'name' => 'Growth',
                'description' => 'A performance-driven plan to accelerate acquisition and conversion.',
                'monthly_price' => '$2,800',
                'yearly_price' => '$28,000',
                'features' => "Growth strategy\nConversion optimization\nSEO & Content performance\nCampaign setup & Reporting\nAdvance analytics tracking",
                'is_featured' => true,
                'button_label' => 'Choose Growth',
                'button_url' => '/contact-1',
            ],
            [
                'name' => 'Scale',
                'description' => 'A long-term digital partnership for sustainable growth at scale.',
                'monthly_price' => '$3,600',
                'yearly_price' => '$36,000',
                'features' => "Full strategy & execution\nDedicated success manager\nAdvanced SEO & content\nMulti-channel campaigns\nCustom reporting & insights",
                'is_featured' => false,
                'button_label' => 'Scale Your Business',
                'button_url' => '/contact-1',
            ],
        ];

        $attributes = ['quantity' => (string) count($plans)];

        foreach ($plans as $index => $plan) {
            $i = $index + 1;
            $attributes["name_$i"] = $plan['name'];
            $attributes["description_$i"] = $plan['description'] ?? '';
            $attributes["monthly_price_$i"] = $plan['monthly_price'];
            $attributes["yearly_price_$i"] = $plan['yearly_price'];
            $attributes["features_$i"] = $plan['features'];
            $attributes["button_label_$i"] = $plan['button_label'];
            $attributes["button_url_$i"] = $plan['button_url'];

            if ($plan['is_featured']) {
                $attributes["is_featured_$i"] = 'yes';
            }
        }

        return $attributes;
    }
}
