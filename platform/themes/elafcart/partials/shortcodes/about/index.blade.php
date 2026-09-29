@php
    $title = $shortcode->title ?? 'About Me';
    $subtitle = $shortcode->subtitle ?? 'Passionate developer from Dhaka';
    $description = $shortcode->description ?? 'I\'m a full-stack developer with 5+ years of experience building digital products. I love solving complex problems with elegant solutions.';
    $image = $shortcode->image;
    $experience = $shortcode->experience ?? '5+ Years';
    $projects = $shortcode->projects ?? '50+ Projects';
@endphp

<section class="about-section section-padding" id="about">
    <div class="container">
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="section-subtitle">{{ $subtitle }}</span>
            <h2 class="section-title">{{ $title }}</h2>
        </div>
        
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="about-image-wrapper">
                    @if($image)
                        <img src="{{ RvMedia::getImageUrl($image) }}" alt="About" class="about-image">
                    @else
                        <div class="about-placeholder">
                            <i class="bi bi-person"></i>
                        </div>
                    @endif
                    <div class="about-exp-card">
                        <h3>{{ $experience }}</h3>
                        <p>Experience</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="about-content">
                    <p class="about-desc">{{ $description }}</p>
                    
                    <div class="about-details">
                        <div class="detail-row">
                            <span class="detail-label">Name:</span>
                            <span class="detail-value">{{ $shortcode->name ?? 'Rakib Hasan' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value">{{ $shortcode->email ?? 'hello@example.com' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Location:</span>
                            <span class="detail-value">{{ $shortcode->location ?? 'Dhaka, Bangladesh' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Availability:</span>
                            <span class="detail-value"><span class="status-dot"></span> Available for freelance</span>
                        </div>
                    </div>

                    <div class="about-actions mt-4">
                        <a href="#contact" class="btn btn-primary rounded-pill">Hire Me</a>
                        <a href="#projects" class="btn btn-outline-dark rounded-pill ms-2">View Projects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
