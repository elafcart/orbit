<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\Menu\Database\Traits\HasMenuSeeder;
use Botble\Page\Database\Traits\HasPageSeeder;
use Botble\Page\Models\Page;
use Botble\Portfolio\Models\Project;

class MenuSeeder extends BaseSeeder
{
    use HasMenuSeeder;
    use HasPageSeeder;

    public function run(): void
    {
        $this->createMenus([
            [
                'name' => 'Main Menu',
                'location' => 'main-menu',
                'items' => [
                    [
                        'title' => 'Home',
                        'url' => '#',
                        'children' => [
                            [
                                'title' => 'Home v.1',
                                'url' => 'https://orisa.botble.com',
                                'target' => '_blank',
                            ],
                            [
                                'title' => 'Home v.2',
                                'url' => 'https://orisa-home-2.botble.com',
                                'target' => '_blank',
                            ],
                            [
                                'title' => 'Home v.3',
                                'url' => 'https://orisa-home-3.botble.com',
                                'target' => '_blank',
                            ],
                            [
                                'title' => 'Home v.4',
                                'url' => 'https://orisa-home-4.botble.com',
                                'target' => '_blank',
                            ],
                            [
                                'title' => 'Home v.5',
                                'url' => 'https://orisa-home-5.botble.com',
                                'target' => '_blank',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Page',
                        'url' => '#',
                        'children' => [
                            [
                                'title' => 'About 01',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('About 1'),
                            ],
                            [
                                'title' => 'About 02',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('About 2'),
                            ],
                            [
                                'title' => 'About 03',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('About 3'),
                            ],
                            [
                                'title' => 'Service 01',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Services 1'),
                            ],
                            [
                                'title' => 'Service 02',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Services 2'),
                            ],
                            [
                                'title' => 'Service 03',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Services 3'),
                            ],
                            [
                                'title' => 'Our Team',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Our Team'),
                            ],
                            [
                                'title' => 'Pricing',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Pricing'),
                            ],
                            [
                                'title' => 'Coming Soon',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Coming Soon'),
                            ],
                            [
                                'title' => 'FAQs',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('FAQ'),
                            ],
                        ],
                    ],
                    [
                        'title' => 'Portfolio',
                        'url' => '#',
                        'children' => [
                            [
                                'title' => 'Portfolio 01',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Portfolio'),
                            ],
                            [
                                'title' => 'Lumina Brand Identity',
                                'reference_type' => Project::class,
                                'reference_id' => 1,
                            ],
                            [
                                'title' => 'Nomad Travel App',
                                'reference_type' => Project::class,
                                'reference_id' => 2,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Shop',
                        'url' => '#',
                        'children' => [
                            [
                                'title' => 'Products Listing',
                                'url' => '/products',
                            ],
                            [
                                'title' => 'Product Detail',
                                'url' => '/products/elegant-check-blazer',
                            ],
                            [
                                'title' => 'Cart',
                                'url' => '/cart',
                            ],
                        ],
                    ],
                    [
                        'title' => 'News',
                        'url' => '#',
                        'children' => [
                            [
                                'title' => 'Blog 01',
                                'url' => '/blog',
                            ],
                            [
                                'title' => 'Blog 02',
                                'url' => '/blog?style=style-2',
                            ],
                            [
                                'title' => 'Blog 03',
                                'url' => '/blog?style=style-3',
                            ],
                            [
                                'title' => 'Blog 04',
                                'url' => '/blog?style=style-4',
                            ],
                            [
                                'title' => 'Post Details',
                                'url' => '/adapting-to-the-new-web-development-trends-in-2024',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Contact',
                        'url' => '#',
                        'children' => [
                            [
                                'title' => 'Contact 01',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Contact 1'),
                            ],
                            [
                                'title' => 'Contact 02',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Contact 2'),
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }
}
