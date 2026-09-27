<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\Testimonial\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends BaseSeeder
{
    public function run(): void
    {
        Testimonial::query()->truncate();
        DB::table('testimonials_translations')->truncate();

        $this->uploadFiles('testimonials');

        $testimonials = [
            [
                'name' => 'James Dopli',
                'company' => 'CEO of Tech Innovators Inc',
                'content' => "The team's dedication and expertise have transformed our business. Their innovative solutions and outstanding support have significantly boosted our productivity and client satisfaction. Allowing us to streamline our processes and focus on what matters most.",
            ],
            [
                'name' => 'Theodore Handle',
                'company' => 'Software Engineer',
                'content' => 'Our collaboration with the team has been instrumental in optimizing our project management processes. The extensive selection of over 1200 UI blocks has allowed us to customize our project interfaces to meet specific client needs effectively. The generous 10 GB of cloud storage has provided ample space for storing project files securely, enabling seamless collaboration across distributed teams.',
            ],
            [
                'name' => 'Shahnewaz Sakil',
                'company' => 'Marketing Director',
                'content' => "The individual email account feature has improved internal communication clarity and professionalism. Moreover, the premium support team's responsiveness and expertise have ensured minimal disruptions and quick resolutions to any technical challenges we've faced. I highly recommend their services for any enterprise seeking robust SaaS solutions.",
            ],
            [
                'name' => 'Albert Flores',
                'company' => 'Software Engineer',
                'content' => "Our experience with this team has surpassed our expectations on every front. The comprehensive suite of over 1200 UI blocks has enabled us to craft highly functional and aesthetically pleasing user interfaces that resonate with our target audience. Equally impressive is the premium support team's proactive approach.",
            ],
            [
                'name' => 'James Dopli',
                'company' => 'CEO of Tech Innovators Inc',
                'content' => "The team's dedication and expertise have transformed our business. Their innovative solutions and outstanding support have significantly boosted our productivity and client satisfaction. Allowing us to streamline our processes and focus on what matters most.",
            ],
            [
                'name' => 'Theodore Handle',
                'company' => 'Software Engineer',
                'content' => 'Our collaboration with the team has been instrumental in optimizing our project management processes. The extensive selection of over 1200 UI blocks has allowed us to customize our project interfaces to meet specific client needs effectively. The generous 10 GB of cloud storage has provided ample space for storing project files securely, enabling seamless collaboration across distributed teams.',
            ],
            [
                'name' => 'Robert Williams',
                'company' => 'Founder at StartupHub',
                'content' => 'Working with this team has been an absolute pleasure. Their attention to detail and commitment to excellence is evident in every aspect of the project. The solutions provided were innovative and perfectly tailored to our business needs.',
            ],
            [
                'name' => 'Emily Chen',
                'company' => 'CTO at CloudSystems',
                'content' => 'The level of professionalism and expertise demonstrated throughout our project was outstanding. They delivered beyond our expectations and provided exceptional support during the entire implementation phase.',
            ],
            [
                'name' => 'David Martinez',
                'company' => 'Operations Director',
                'content' => 'From initial consultation to final delivery, the team showed remarkable dedication. Their solutions have significantly improved our workflow efficiency and customer satisfaction ratings.',
            ],
            [
                'name' => 'Sarah Thompson',
                'company' => 'VP of Engineering',
                'content' => 'The technical expertise and creative problem-solving skills of this team are truly impressive. They transformed our vision into reality with precision and delivered a product that exceeded all expectations.',
            ],
        ];

        foreach ($testimonials as $item) {
            Testimonial::query()->create([
                ...$item,
                'image' => $this->filePath(sprintf('testimonials/avatar-%d.webp', rand(1, 20))),
            ]);
        }
    }
}
