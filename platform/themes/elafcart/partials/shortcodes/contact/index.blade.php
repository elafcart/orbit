@php
    $title = $shortcode->title ?? "Let's Work Together";
    $subtitle = $shortcode->subtitle ?? 'Contact';
    $description = $shortcode->description ?? 'Have a project in mind? Let\'s discuss how we can work together to bring your ideas to life.';
@endphp

<section class="contact-section section-padding" id="contact">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="section-subtitle">{{ $subtitle }}</span>
                <h2 class="section-title">{{ $title }}</h2>
                <p class="section-desc mt-3">{{ $description }}</p>

                <div class="contact-info mt-5">
                    <div class="contact-item">
                        <div class="contact-icon"><i class="bi bi-envelope"></i></div>
                        <div class="contact-detail">
                            <span>Email</span>
                            <a href="mailto:{{ theme_option('email', 'hello@example.com') }}">{{ theme_option('email', 'hello@example.com') }}</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="bi bi-telephone"></i></div>
                        <div class="contact-detail">
                            <span>Phone</span>
                            <a href="tel:{{ theme_option('phone', '+8801234567890') }}">{{ theme_option('phone', '+880 1XXX-XXXXXX') }}</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="bi bi-geo-alt"></i></div>
                        <div class="contact-detail">
                            <span>Location</span>
                            <p>{{ theme_option('address', 'Dhaka, Bangladesh') }}</p>
                        </div>
                    </div>
                </div>

                <div class="contact-social mt-4">
                    <a href="#"><i class="bi bi-github"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-dribbble"></i></a>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="contact-form-wrapper">
                    @if(is_plugin_active('contact'))
                        {!! do_shortcode('[contact-form][/contact-form]') !!}
                    @else
                        <form class="contact-form">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="Your name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Your email">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Subject</label>
                                    <input type="text" class="form-control" placeholder="Project subject">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="5" placeholder="Tell me about your project..."></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill w-100">Send Message <i class="bi bi-send ms-2"></i></button>
                                </div>
                            </div>
                        </form>
                    @endif
                    <p class="form-note mt-3 text-center text-muted small">I usually respond within 24 hours</p>
                </div>
            </div>
        </div>
    </div>
</section>
