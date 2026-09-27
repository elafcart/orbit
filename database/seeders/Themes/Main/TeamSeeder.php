<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\Team\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TeamSeeder extends BaseSeeder
{
    public function run(): void
    {
        Team::query()->truncate();
        DB::table('teams_translations')->truncate();

        $this->uploadFiles('teams');

        $teams = [
            [
                'name' => 'Michael Anderson',
                'title' => 'Creative Director',
                'description' => 'Michael leads Orisa\'s creative vision with over 15 years of experience in brand design and digital strategy. His bold aesthetic and attention to detail set the standard for every project we deliver.',
                'email' => 'michael.anderson@orisa.com',
                'phone' => '+1-555-0101',
                'address' => '123 Creative Drive, San Francisco, CA 94102',
            ],
            [
                'name' => 'Jennifer Brown',
                'title' => 'CEO & Founder',
                'description' => 'As the founder and CEO of Orisa Agency, Jennifer built the company around a simple belief — great design changes businesses. Her leadership and passion for creativity inspire the entire team.',
                'email' => 'jennifer.brown@orisa.com',
                'phone' => '+1-555-0102',
                'address' => '456 Agency Hub, New York, NY 10001',
            ],
            [
                'name' => 'Sarah Brown',
                'title' => 'Head of UX Design',
                'description' => 'Sarah leads our UX practice with a deep understanding of human-centered design. She champions user research and usability testing to ensure every digital experience is intuitive and impactful.',
                'email' => 'sarah.brown@orisa.com',
                'phone' => '+1-555-0103',
                'address' => '789 Design Boulevard, Austin, TX 78701',
            ],
            [
                'name' => 'David Clark',
                'title' => 'Lead UI Designer',
                'description' => 'David creates visually stunning interfaces that blend aesthetics with functionality. His eye for detail and mastery of design systems ensure consistent, beautiful output across every platform.',
                'email' => 'david.clark@orisa.com',
                'phone' => '+1-555-0104',
                'address' => '321 Studio Street, Seattle, WA 98101',
            ],
            [
                'name' => 'Jessica Carter',
                'title' => 'Front-End Developer',
                'description' => 'Jessica brings designs to life with clean, performant code. Her expertise in modern front-end frameworks ensures our digital products are as fast and accessible as they are beautiful.',
                'email' => 'jessica.carter@orisa.com',
                'phone' => '+1-555-0105',
                'address' => '654 Web Avenue, Denver, CO 80202',
            ],
            [
                'name' => 'Lauren Graham',
                'title' => 'Brand Strategist',
                'description' => 'Lauren helps brands discover their authentic voice and visual identity. Her strategic approach to branding ensures every creative decision is rooted in purpose and drives meaningful results.',
                'email' => 'lauren.graham@orisa.com',
                'phone' => '+1-555-0106',
                'address' => '987 Strategy Lane, Boston, MA 02101',
            ],
            [
                'name' => 'James Bennett',
                'title' => 'Digital Marketing Lead',
                'description' => 'James drives growth through data-informed digital marketing strategies. From SEO to paid campaigns, he consistently delivers measurable results that grow our clients\' reach and revenue.',
                'email' => 'james.bennett@orisa.com',
                'phone' => '+1-555-0107',
                'address' => '246 Marketing Center, Chicago, IL 60601',
            ],
            [
                'name' => 'William Foster',
                'title' => 'Motion Designer',
                'description' => 'William specializes in motion graphics and animation that bring brands to life. His work adds energy and storytelling depth to everything from product launches to social media content.',
                'email' => 'william.foster@orisa.com',
                'phone' => '+1-555-0108',
                'address' => '135 Motion Plaza, Los Angeles, CA 90001',
            ],
        ];

        $content = File::get(database_path('seeders/contents/team.html'));

        foreach ($teams as $index => $team) {
            $index++;

            Team::query()->create([
                'name' => $team['name'],
                'title' => $team['title'],
                'photo' => $this->filePath("teams/$index.webp"),
                'description' => $team['description'],
                'email' => $team['email'],
                'phone' => $team['phone'],
                'address' => $team['address'],
                'content' => $content,
                'socials' => [
                    'facebook' => 'https://facebook.com',
                    'twitter' => 'https://twitter.com',
                    'instagram' => 'https://instagram.com',
                ],
            ]);
        }
    }
}
