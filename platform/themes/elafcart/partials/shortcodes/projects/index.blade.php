@php
    $title = $shortcode->title ?? 'Selected Works';
    $subtitle = $shortcode->subtitle ?? 'Portfolio';
    $limit = $shortcode->limit ?? 6;
    $projects = collect();
    if (is_plugin_active('portfolio')) {
        $projects = \Botble\Portfolio\Models\Project::wherePublished()->latest()->limit($limit)->get();
    }
    if ($projects->isEmpty()) {
        // Dummy projects for demo
        $projects = collect([
            (object)['name' => 'E-commerce Platform', 'description' => 'Modern e-commerce with Laravel & React', 'image' => null, 'url' => '#', 'client' => 'Fashion Store', 'category' => 'Web App'],
            (object)['name' => 'Portfolio CMS', 'description' => 'Custom CMS for creative agencies', 'image' => null, 'url' => '#', 'client' => 'Agency', 'category' => 'CMS'],
            (object)['name' => 'SaaS Dashboard', 'description' => 'Analytics dashboard for SaaS product', 'image' => null, 'url' => '#', 'client' => 'Tech Startup', 'category' => 'Dashboard'],
            (object)['name' => 'Real Estate App', 'description' => 'Property listing and management system', 'image' => null, 'url' => '#', 'client' => 'Real Estate', 'category' => 'Web App'],
            (object)['name' => 'Learning Platform', 'description' => 'Online course platform with video streaming', 'image' => null, 'url' => '#', 'client' => 'Education', 'category' => 'LMS'],
            (object)['name' => 'Restaurant Booking', 'description' => 'Table booking and food ordering system', 'image' => null, 'url' => '#', 'client' => 'Restaurant', 'category' => 'Booking'],
        ]);
    }
@endphp

<section class="projects-section section-padding" id="projects">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-end mb-5" data-aos="fade-up">
            <div>
                <span class="section-subtitle">{{ $subtitle }}</span>
                <h2 class="section-title mb-0">{{ $title }}</h2>
            </div>
            <a href="{{ url('/projects') }}" class="btn btn-outline-dark rounded-pill d-none d-md-inline-flex">View All <i class="bi bi-arrow-up-right ms-2"></i></a>
        </div>

        <div class="row g-4">
            @foreach($projects as $index => $project)
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <a href="{{ $project->url ?? '#' }}" class="project-card-large">
                        <div class="project-image">
                            @if($project->image)
                                <img src="{{ RvMedia::getImageUrl($project->image) }}" alt="{{ $project->name }}">
                            @else
                                <div class="project-placeholder">
                                    <i class="bi bi-image"></i>
                                    <span>{{ $project->category ?? 'Project' }}</span>
                                </div>
                            @endif
                            <div class="project-overlay">
                                <span class="project-arrow"><i class="bi bi-arrow-up-right"></i></span>
                            </div>
                        </div>
                        <div class="project-info">
                            <div class="project-meta">
                                <span class="project-category">{{ $project->category ?? $project->client ?? 'Web Development' }}</span>
                                <span class="project-year">2024</span>
                            </div>
                            <h3 class="project-name">{{ $project->name }}</h3>
                            <p class="project-desc">{{ Str::limit($project->description, 80) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5 d-md-none">
            <a href="#" class="btn btn-outline-dark rounded-pill">View All Projects</a>
        </div>
    </div>
</section>
