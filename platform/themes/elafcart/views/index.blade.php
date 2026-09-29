@php
    // Default homepage when no page is set - show portfolio setup
@endphp

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-80">
            <div class="col-lg-7">
                <div class="hero-content" data-aos="fade-up">
                    <div class="hero-badge">
                        <span class="badge-dot"></span>
                        Available for new projects
                    </div>
                    <h1 class="hero-title">
                        Hi, I'm <span class="text-primary">{{ theme_option('hero_name', 'Rakib') }}</span><br>
                        <span id="typed-text">{{ theme_option('hero_typed', 'Full Stack Developer & Creator') }}</span>
                    </h1>
                    <p class="hero-desc">
                        {{ theme_option('hero_description', 'I craft exceptional digital experiences and sell digital & physical products. Specializing in Laravel, React, templates, and merch.') }}
                    </p>
                    <div class="hero-actions">
                        <a href="#projects" class="btn btn-primary btn-lg rounded-pill">View My Work <i class="bi bi-arrow-right ms-2"></i></a>
                        <a href="#digital-products" class="btn btn-outline-dark btn-lg rounded-pill ms-3"><i class="bi bi-bag"></i> Shop Products</a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3>50+</h3>
                            <p>Projects Done</p>
                        </div>
                        <div class="stat-item">
                            <h3>1000+</h3>
                            <p>Products Sold</p>
                        </div>
                        <div class="stat-item">
                            <h3>30+</h3>
                            <p>Happy Clients</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero-image-wrapper" data-aos="fade-left" data-aos-delay="200">
                    <div class="hero-image">
                        @if(theme_option('hero_image'))
                            <img src="{{ RvMedia::getImageUrl(theme_option('hero_image')) }}" alt="Hero" class="img-fluid">
                        @else
                            <div class="hero-placeholder">
                                <i class="bi bi-person-circle"></i>
                            </div>
                        @endif
                    </div>
                    <div class="floating-card card-1">
                        <i class="bi bi-download"></i>
                        <div>
                            <strong>Digital Products</strong>
                            <span>Instant Download</span>
                        </div>
                    </div>
                    <div class="floating-card card-2">
                        <i class="bi bi-box-seam"></i>
                        <div>
                            <strong>Physical Products</strong>
                            <span>Worldwide Shipping</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="setup-section py-5">
    <div class="container">
        <div class="setup-card">
            <h3>🚀 Portfolio + E-commerce Setup Guide</h3>
            <p>এই ডিফল্ট পেজ দেখছেন কারণ Homepage সেট করা হয়নি। এখন আপনার সাইটে <strong>Digital + Physical Product</strong> অপশন আছে!</p>
            
            <div class="row g-3 my-4">
                <div class="col-md-6">
                    <div class="feature-box">
                        <h5><i class="bi bi-download"></i> Digital Products</h5>
                        <p>Templates, UI Kits, Boilerplates, E-books - Instant download after payment</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-box">
                        <h5><i class="bi bi-box-seam"></i> Physical Products</h5>
                        <p>T-Shirts, Hoodies, Desk Mats, Mugs - Worldwide shipping</p>
                    </div>
                </div>
            </div>

            <ol>
                <li><strong>Admin → Plugins</strong> - সব প্লাগিন Activate করুন (portfolio, blog, ecommerce, testimonial, contact)</li>
                <li><strong>Admin → Ecommerce → Settings</strong> - Enable Digital Products = YES, Guest Checkout = YES</li>
                <li><strong>Admin → Appearance → Theme Options</strong> - Logo, Hero, Social Links সেট করুন</li>
                <li><strong>Admin → Pages → Create New Page</strong>
                    <br>Title: <code>Home</code> | Template: <code>Homepage</code> | Content এ নিচের shortcode বসান:
                </li>
            </ol>
            <pre class="setup-code"><code>[hero title="Hi, I'm Rakib" subtitle="Creator & Developer" description="I build digital products and sell templates + merch"][/hero]
[about title="About Me" subtitle="Passionate creator from Dhaka"][/about]
[services title="What I Do" subtitle="Services"][/services]
[projects title="Selected Works" subtitle="Portfolio" limit="6"][/projects]

[digital-products title="Digital Products" subtitle="Instant Download" description="Templates, UI kits, boilerplates - instant download" limit="8"][/digital-products]

[physical-products title="Physical Products" subtitle="Merch & Accessories" description="T-shirts, hoodies, desk mats - shipped worldwide" limit="4"][/physical-products]

[products title="All Products" subtitle="Shop" product_type="all" limit="8"][/products]

[skills title="My Skills" subtitle="Expertise"][/skills]
[testimonials title="What Clients Say" subtitle="Testimonials"][/testimonials]
[blog-posts title="Latest Articles" subtitle="Blog" limit="3"][/blog-posts]
[contact title="Let's Work Together" subtitle="Contact"][/contact]</code></pre>
            <ol start="5">
                <li><strong>Admin → Ecommerce → Products</strong> - 2-3 টা Digital + 1-2 টা Physical product তৈরি করুন</li>
                <li><strong>Admin → Appearance → Theme Options → Page</strong> - Homepage সিলেক্ট করুন</li>
                <li><strong>Admin → Appearance → Menus</strong> - main-menu তৈরি করুন (Home, About, Projects, Shop, Blog, Contact)</li>
            </ol>

            <div class="alert alert-info mt-4">
                <strong>Digital Product বানাতে:</strong> Ecommerce → Products → Create → Product Type = Digital → Upload ZIP file<br>
                <strong>Physical Product বানাতে:</strong> Product Type = Physical → Quantity, Weight, Variations (Size, Color)
            </div>
        </div>
    </div>
</section>

<style>
.setup-card { background: #f8f9ff; border: 2px dashed #6366f1; border-radius: 16px; padding: 2rem; }
.setup-code { background: #0f0f0f; color: #e5e7eb; padding: 1.5rem; border-radius: 12px; overflow-x: auto; font-size: 13px; margin: 1rem 0; }
.min-vh-80 { min-height: 80vh; }
.feature-box { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 1.2rem; }
.feature-box h5 { font-size: 1rem; margin-bottom: 0.5rem; }
.feature-box p { font-size: 0.9rem; color: #6b7280; margin: 0; }
</style>
