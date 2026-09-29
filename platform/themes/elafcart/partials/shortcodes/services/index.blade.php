@php
    $title = $shortcode->title ?? 'What I Do';
    $subtitle = $shortcode->subtitle ?? 'Services';
    $services = collect();
    if (is_plugin_active('portfolio')) {
        $services = \Botble\Portfolio\Models\Service::wherePublished()->latest()->limit($shortcode->limit ?? 6)->get();
    }
    // Fallback dummy services if no data
    if ($services->isEmpty()) {
        $services = collect([
            (object)['name' => 'Web Development', 'description' => 'Modern, fast, and scalable web applications using Laravel, React, and Next.js', 'icon' => 'bi-code-slash', 'url' => '#'],
            (object)['name' => 'UI/UX Design', 'description' => 'User-centered design that balances aesthetics with functionality', 'icon' => 'bi-palette', 'url' => '#'],
            (object)['name' => 'E-commerce Solutions', 'description' => 'Complete online store solutions with payment integration', 'icon' => 'bi-bag', 'url' => '#'],
            (object)['name' => 'API Development', 'description' => 'RESTful APIs and microservices for your applications', 'icon' => 'bi-hdd-stack', 'url' => '#'],
            (object)['name' => 'Consulting', 'description' => 'Technical consulting and architecture planning for your projects', 'icon' => 'bi-lightbulb', 'url' => '#'],
            (object)['name' => 'Maintenance', 'description' => 'Ongoing support and optimization for your existing applications', 'icon' => 'bi-gear', 'url' => '#'],
        ]);
    }
@endphp

<section class="services-section section-padding bg-light" id="services">
    <div class="container">
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="section-subtitle">{{ $subtitle }}</span>
            <h2 class="section-title">{{ $title }}</h2>
            @if($shortcode->description)
                <p class="section-desc mx-auto">{{ $shortcode->description }}</p>
            @endif
        </div>

        <div class="row g-4">
            @foreach($services as $index => $service)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="service-card">
                        <div class="service-icon">
                            @if(isset($service->icon) && str_starts_with($service->icon, 'bi-'))
                                <i class="bi {{ $service->icon }}"></i>
                            @elseif(isset($service->image) && $service->image)
                                <img src="{{ RvMedia::getImageUrl($service->image) }}" alt="{{ $service->name }}">
                            @else
                                <i class="bi {{ $service->icon ?? 'bi-code-slash' }}"></i>
                            @endif
                        </div>
                        <h4 class="service-title">{{ $service->name }}</h4>
                        <p class="service-desc">{{ Str::limit($service->description, 100) }}</p>
                        <a href="{{ $service->url ?? '#' }}" class="service-link">Learn More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
