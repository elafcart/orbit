<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\Faq\Models\Faq;
use Botble\Faq\Models\FaqCategory;

class FaqSeeder extends BaseSeeder
{
    public function run(): void
    {
        Faq::query()->truncate();
        FaqCategory::query()->truncate();

        $categories = [
            'Services & Process',
            'Pricing & Billing',
            'Support & Delivery',
        ];

        foreach ($categories as $index => $category) {
            FaqCategory::query()->create([
                'name' => $category,
                'order' => $index,
            ]);
        }

        $faqs = [
            [
                'question' => 'What services does Orisa offer?',
                'answer' => 'Orisa is a full-service creative agency offering UI/UX design, brand identity, web development, digital marketing, motion graphics, and content strategy. We work with startups, SMEs, and enterprise brands worldwide.',
            ],
            [
                'question' => 'How do I get started with a project?',
                'answer' => 'Getting started is simple. Reach out via our Contact page or email us at hello@orisa.com. We\'ll schedule a discovery call to understand your goals, timeline, and budget before proposing a tailored solution.',
            ],
            [
                'question' => 'What industries do you work with?',
                'answer' => 'We work with clients across a wide range of industries including technology, fashion, healthcare, fintech, hospitality, e-commerce, and more. Our adaptable creative process means we can deliver results for any sector.',
            ],
            [
                'question' => 'How long does a typical project take?',
                'answer' => 'Project timelines vary depending on scope and complexity. A brand identity project typically takes 3-6 weeks, while a full website design and development can range from 6-12 weeks. We\'ll give you a detailed timeline during the proposal phase.',
            ],
            [
                'question' => 'Do you work with startups or only established brands?',
                'answer' => 'We love working with businesses at all stages. Whether you\'re a startup building your brand from scratch or an established company looking to refresh your identity, we have the right approach and pricing options for you.',
            ],
            [
                'question' => 'How is your pricing structured?',
                'answer' => 'Our pricing is project-based and tailored to the scope of work. We offer fixed-price packages for clearly scoped projects and custom quotes for more complex engagements. All pricing is transparent with no hidden fees.',
            ],
            [
                'question' => 'Do you offer monthly retainer plans?',
                'answer' => 'Yes, we offer ongoing retainer plans for clients who need continuous design, marketing, or development support. Retainer plans are billed monthly and can be scaled up or down based on your needs.',
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept bank transfers, credit/debit cards, and PayPal. For project-based work, we typically require a 50% deposit to begin, with the remaining balance due upon project completion.',
            ],
            [
                'question' => 'What is your revision policy?',
                'answer' => 'Our standard packages include a set number of revision rounds at each stage. We clearly outline this in our project proposal. Additional revisions beyond the agreed scope can be accommodated at our standard hourly rate.',
            ],
            [
                'question' => 'Will I own the final design files and assets?',
                'answer' => 'Yes. Upon final payment, full ownership of all deliverables and source files is transferred to you. You\'ll receive all brand assets, design files, and any relevant source code.',
            ],
            [
                'question' => 'Do you offer post-launch support?',
                'answer' => 'Absolutely. We offer a complimentary 30-day support window after project delivery to address any issues. For ongoing support, we have maintenance and support packages tailored to your needs.',
            ],
            [
                'question' => 'Can you work with our existing team or platform?',
                'answer' => 'Yes. We are experienced collaborating with in-house teams, third-party developers, and existing tools or platforms. We adapt to your workflow and communication style for a seamless partnership.',
            ],
            [
                'question' => 'How do you handle feedback and communication during a project?',
                'answer' => 'We use project management tools like Notion, Figma, and Slack for transparent collaboration. You\'ll receive regular progress updates and have dedicated access to your project lead throughout the engagement.',
            ],
            [
                'question' => 'Do you offer remote design services?',
                'answer' => 'Yes, we work with clients globally and are fully equipped for remote collaboration. Our team spans multiple time zones and we use best-in-class tools to ensure smooth communication and delivery regardless of location.',
            ],
            [
                'question' => 'What makes Orisa different from other agencies?',
                'answer' => 'At Orisa, we combine strategic thinking with creative excellence. We don\'t just make things look beautiful — we ensure every design decision serves your business goals. Our team is passionate, responsive, and genuinely invested in your success.',
            ],
            [
                'question' => 'Can I see examples of your previous work?',
                'answer' => 'Of course! Visit our Portfolio page to explore case studies from a wide range of industries and project types. We\'re happy to share additional work samples relevant to your industry on request.',
            ],
            [
                'question' => 'How do you ensure brand consistency across deliverables?',
                'answer' => 'Every project includes a comprehensive brand style guide that documents your colors, typography, tone of voice, logo usage, and design principles. This ensures consistent application across all touchpoints, whether managed by us or your internal team.',
            ],
            [
                'question' => 'What happens if I need changes after the project is complete?',
                'answer' => 'We\'re here for the long term. After project completion, we offer flexible change request packages. Simply reach out to your dedicated account contact and we\'ll scope any additional work promptly.',
            ],
        ];

        $categoryIds = FaqCategory::query()->pluck('id');

        foreach ($faqs as $faq) {
            Faq::query()->create([
                ...$faq,
                'category_id' => $categoryIds->random(),
            ]);
        }
    }
}
