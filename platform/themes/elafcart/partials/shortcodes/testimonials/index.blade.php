@php
    $title = $shortcode->title ?? 'What Clients Say';
    $subtitle = $shortcode->subtitle ?? 'Testimonials';
    $testimonials = collect();
    if (is_plugin_active('testimonial')) {
        $testimonials = \Botble\Testimonial\Models\Testimonial::wherePublished()->latest()->limit($shortcode->limit ?? 3)->get();
    }
    if ($testimonials->isEmpty()) {
        $testimonials = collect([
            (object)['name' => 'Sarah Johnson', 'company' => 'CEO, Fashion Store', 'content' => 'Rakib delivered an exceptional e-commerce platform. The site is fast, beautiful, and our sales increased by 150%. Highly recommended!', 'image' => null, 'star' => 5],
            (object)['name' => 'Michael Chen', 'company' => 'Founder, Tech Startup', 'content' => 'Working with Rakib was a great experience. He understood our requirements perfectly and delivered beyond expectations. Clean code, great communication.', 'image' => null, 'star' => 5],
            (object)['name' => 'Emily Davis', 'company' => 'Marketing Director', 'content' => 'The portfolio CMS he built for us is amazing. Easy to use, fast, and exactly what we needed. Will definitely work with him again.', 'image' => null, 'star' => 5],
        ]);
    }
@endphp

<section class="testimonials-section section-padding bg-light" id="testimonials">
    <div class="container">
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="section-subtitle">{{ $subtitle }}</span>
            <h2 class="section-title">{{ $title }}</h2>
        </div>

        <div class="row g-4">
            @foreach($testimonials as $index => $testimonial)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">
                            @for($i=0; $i<($testimonial->star ?? 5); $i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                        </div>
                        <p class="testimonial-content">"{{ $testimonial->content ?? $testimonial->description }}"</p>
                        <div class="testimonial-author">
                            @if($testimonial->image)
                                <img src="{{ RvMedia::getImageUrl($testimonial->image) }}" alt="{{ $testimonial->name }}" class="author-image">
                            @else
                                <div class="author-placeholder">{{ substr($testimonial->name,0,1) }}</div>
                            @endif
                            <div class="author-info">
                                <h5>{{ $testimonial->name }}</h5>
                                <span>{{ $testimonial->company ?? $testimonial->company_name ?? 'Client' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
