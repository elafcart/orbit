@php
    $title = $shortcode->title ?? 'My Skills';
    $subtitle = $shortcode->subtitle ?? 'Expertise';
    $skills = [
        ['name' => 'Laravel / PHP', 'percent' => 95, 'icon' => 'bi-code-slash'],
        ['name' => 'React / Next.js', 'percent' => 90, 'icon' => 'bi-braces'],
        ['name' => 'JavaScript / TypeScript', 'percent' => 88, 'icon' => 'bi-filetype-js'],
        ['name' => 'UI/UX Design', 'percent' => 85, 'icon' => 'bi-palette'],
        ['name' => 'MySQL / PostgreSQL', 'percent' => 90, 'icon' => 'bi-database'],
        ['name' => 'DevOps / AWS', 'percent' => 80, 'icon' => 'bi-cloud'],
    ];
@endphp

<section class="skills-section section-padding bg-dark text-white" id="skills">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5" data-aos="fade-right">
                <span class="section-subtitle text-primary">{{ $subtitle }}</span>
                <h2 class="section-title text-white">{{ $title }}</h2>
                <p class="text-white-50 mt-3">I specialize in building modern web applications with a focus on performance, scalability, and user experience. Here are the technologies I work with daily.</p>
                
                <div class="skills-highlight mt-4">
                    <div class="highlight-item">
                        <i class="bi bi-check-circle-fill text-primary"></i>
                        <span>Clean & Maintainable Code</span>
                    </div>
                    <div class="highlight-item">
                        <i class="bi bi-check-circle-fill text-primary"></i>
                        <span>Responsive & Accessible</span>
                    </div>
                    <div class="highlight-item">
                        <i class="bi bi-check-circle-fill text-primary"></i>
                        <span>Performance Optimized</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 mt-5 mt-lg-0">
                <div class="skills-grid">
                    @foreach($skills as $index => $skill)
                        <div class="skill-item" data-aos="fade-up" data-aos-delay="{{ $index * 80 }}">
                            <div class="skill-header">
                                <div class="skill-icon"><i class="bi {{ $skill['icon'] }}"></i></div>
                                <div class="skill-info">
                                    <h5>{{ $skill['name'] }}</h5>
                                    <span>{{ $skill['percent'] }}%</span>
                                </div>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress" data-width="{{ $skill['percent'] }}%" style="width: 0%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
