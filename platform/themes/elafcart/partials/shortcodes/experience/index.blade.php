@php
    $title = $shortcode->title ?? 'Experience';
    $subtitle = $shortcode->subtitle ?? 'Work History';
    $experiences = [
        ['year' => '2022 - Present', 'role' => 'Senior Full Stack Developer', 'company' => 'Elafcart', 'desc' => 'Leading development of e-commerce and SaaS products using Laravel and React. Managing team of 5 developers.', 'current' => true],
        ['year' => '2020 - 2022', 'role' => 'Full Stack Developer', 'company' => 'Tech Solutions Ltd', 'desc' => 'Built 20+ web applications for clients across various industries. Improved performance by 40%.', 'current' => false],
        ['year' => '2019 - 2020', 'role' => 'Frontend Developer', 'company' => 'Creative Agency', 'desc' => 'Developed responsive websites and collaborated with designers to implement pixel-perfect UI.', 'current' => false],
        ['year' => '2018 - 2019', 'role' => 'Junior Developer', 'company' => 'Startup Inc', 'desc' => 'Started career building WordPress and Laravel websites. Learned modern development practices.', 'current' => false],
    ];
@endphp

<section class="experience-section section-padding" id="experience">
    <div class="container">
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="section-subtitle">{{ $subtitle }}</span>
            <h2 class="section-title">{{ $title }}</h2>
        </div>

        <div class="timeline">
            @foreach($experiences as $index => $exp)
                <div class="timeline-item {{ $exp['current'] ? 'current' : '' }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="timeline-year">{{ $exp['year'] }}</div>
                    <div class="timeline-content">
                        <div class="timeline-dot"></div>
                        <h4>{{ $exp['role'] }}</h4>
                        <h5>{{ $exp['company'] }} @if($exp['current'])<span class="badge bg-primary ms-2">Current</span>@endif</h5>
                        <p>{{ $exp['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
