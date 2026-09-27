<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\Blog\Database\Traits\HasBlogSeeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class BlogSeeder extends BaseSeeder
{
    use HasBlogSeeder;

    public function run(): void
    {
        $this->uploadFiles('posts');

        $this->createBlogCategories(array_map(fn ($category) => ['name' => $category], [
            'Design Thinking',
            'Branding',
            'UI/UX',
            'Digital Marketing',
            'Web Development',
            'Industry Insights',
            'Agency Life',
            'Case Studies',
            'Creative Process',
        ]));

        $this->createBlogTags(array_map(fn ($tag) => ['name' => $tag], [
            'Brand Identity',
            'UI Design',
            'UX Research',
            'Typography',
            'Color Theory',
            'Motion Design',
            'SEO',
            'Creative Strategy',
        ]));

        $content = File::get(database_path('seeders/contents/post.html'));

        $posts = collect([
            'Top Design Trends Shaping Creative Agencies in 2025' => 'The creative landscape is constantly evolving. From bold typography to immersive 3D experiences, we break down the design trends that forward-thinking agencies are embracing to capture attention and drive results in 2025.',
            'How to Build a Brand Identity That Lasts' => 'A strong brand identity goes far beyond a logo. In this post, we explore the foundational elements of lasting brand design — from visual language and tone of voice to the values that connect with your audience.',
            '5 UX Principles Every Designer Should Know' => 'Great user experience is the difference between a product people love and one they abandon. Here are five core UX principles that guide our design process at Orisa and lead to exceptional digital products.',
            'The Power of Motion Design in Modern Marketing' => 'Animation and motion graphics are no longer optional — they are essential tools in any brand\'s visual arsenal. Discover how motion design captures attention, tells stories, and drives higher engagement across digital channels.',
            'Why Your Brand Needs a Comprehensive Style Guide' => 'Consistency is the cornerstone of a strong brand. A well-crafted style guide ensures that every touchpoint — from social media posts to packaging — reflects a unified, professional identity that builds trust.',
            'Color Psychology: Choosing the Right Palette for Your Brand' => 'Colors evoke emotions and influence decisions. In this deep dive, we explore how to strategically choose a brand color palette that resonates with your target audience and differentiates you from competitors.',
            'From Wireframe to Launch: Our Web Design Process Explained' => 'Ever wondered what happens behind the scenes at a creative agency? We walk you through Orisa\'s end-to-end web design and development process, from initial discovery and wireframing to final launch and post-delivery support.',
            'Designing for Accessibility: Why Inclusive Design Matters' => 'Inclusive design is not just an ethical responsibility — it\'s a business advantage. Learn how designing for accessibility expands your audience, improves usability for everyone, and future-proofs your digital products.',
            'How We Rebranded a Fintech Startup in 6 Weeks' => 'A behind-the-scenes look at how our team helped a fintech startup transform their brand from a generic placeholder into a bold, memorable identity — all in just six weeks and on a startup budget.',
            'The Role of Typography in Brand Communication' => 'Typography is one of the most powerful tools in a designer\'s toolkit. The right typeface communicates personality, establishes hierarchy, and guides users through your content with clarity and purpose.',
            'SEO for Creative Agencies: Getting Found Online' => 'Creative agencies often focus on making clients visible — but what about their own online presence? We share practical SEO strategies tailored for creative businesses looking to grow their organic traffic and attract ideal clients.',
            'What Clients Really Want From a Creative Agency' => 'After working with hundreds of clients across industries, we\'ve learned what truly matters to them. Spoiler: it\'s not just beautiful work. Discover the values and behaviors that build long-lasting client relationships.',
            'Responsive Design Best Practices for 2025' => 'With users accessing the web across an ever-growing variety of devices and screen sizes, responsive design has never been more important. Here are the best practices our front-end team follows to build flawless experiences.',
            'Behind the Scenes: How We Run Our Creative Process' => 'Great creative work doesn\'t happen by accident. It\'s the result of a disciplined, collaborative process built on research, iteration, and honest feedback. Here\'s a transparent look at how Orisa approaches every new project.',
            'Adapting to the New Web Development Trends in 2024' => 'A look at the latest trends in web development for 2024, including new technologies, best practices, and what the future holds for creative agencies and their development teams.',
        ]);

        $this->createBlogPosts($posts->map(function ($description, $title) use ($content) {
            return [
                'name' => $title,
                'description' => $description,
                'content' => $content,
                'image' => $this->filePath(sprintf('posts/%s.webp', rand(1, 20))),
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
            ];
        })->all());
    }
}
