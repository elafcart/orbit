@php
    $title = $shortcode->title ?? 'Hi, I\'m Rakib';
    $subtitle = $shortcode->subtitle ?? 'Full Stack Developer';
    $description = $shortcode->description ?? 'I craft exceptional digital experiences with clean code and thoughtful design.';
    $image = $shortcode->image;
    $btn1Text = $shortcode->button_text_1 ?? 'View My Work';
    $btn1Link = $shortcode->button_link_1 ?? '#projects';
    $btn2Text = $shortcode->button_text_2 ?? 'Download CV';
    $btn2Link = $shortcode->button_link_2 ?? '#';
@endphp

<section class="hero-section" id="home">
    <div class="container">
        <div class="row align-items-center min-vh-85">
            <div class="col-lg-7">
                <div class="hero-content" data-aos="fade-up">
                    <div class="hero-badge">
                        <span class="badge-dot"></span>
                        Available for new projects
                    </div>
                    <h1 class="hero-title">
                        {!! BaseHelper::clean($title) !!}<br>
                        <span class="typed-wrapper"><span id="typed-text">{{ $subtitle }}</span></span>
                    </h1>
                    <p class="hero-desc">{{ $description }}</p>
                    <div class="hero-actions">
                        <a href="{{ $btn1Link }}" class="btn btn-primary btn-lg rounded-pill">{{ $btn1Text }} <i class="bi bi-arrow-right ms-2"></i></a>
                        @if($btn2Text)
                            <a href="{{ $btn2Link }}" class="btn btn-outline-dark btn-lg rounded-pill ms-3">{{ $btn2Text }} <i class="bi bi-download ms-2"></i></a>
                        @endif
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3>50+</h3>
                            <p>Projects</p>
                        </div>
                        <div class="stat-item">
                            <h3>5+</h3>
                            <p>Years Exp</p>
                        </div>
                        <div class="stat-item">
                            <h3>30+</h3>
                            <p>Clients</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero-image-wrapper" data-aos="fade-left" data-aos-delay="200">
                    <div class="hero-image">
                        @if($image)
                            <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $title }}" class="img-fluid">
                        @else
                            <div class="hero-placeholder">
                                <div class="placeholder-icon"><i class="bi bi-code-square"></i></div>
                                <p>Upload your photo from shortcode settings</p>
                            </div>
                        @endif
                    </div>
                    <div class="floating-card card-1">
                        <i class="bi bi-code-slash"></i>
                        <div><strong>Clean Code</strong><span>Maintainable</span></div>
                    </div>
                    <div class="floating-card card-2">
                        <i class="bi bi-palette"></i>
                        <div><strong>UI/UX</strong><span>Pixel Perfect</span></div>
                    </div>
                    <div class="floating-card card-3">
                        <i class="bi bi-rocket"></i>
                        <div><strong>Fast</strong><span>Optimized</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-scroll">
        <a href="#about"><i class="bi bi-chevron-down"></i></a>
    </div>
</section>
