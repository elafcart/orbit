<section class="pt-200 pb-120">
    <div class="container">
        <div class="setup-guide">
            <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                <span class="text-uppercase">
                    <span class="text-1">{{ __('Setup Required') }}</span>
                    <span class="text-2">{{ __('Setup Required') }}</span>
                </span>
            </span>

            <h2 class="at-section-title mb-30">
                {{ __('You need to setup your homepage first!') }}
            </h2>

            <div class="setup-steps">
                <div class="setup-step mb-4">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <p class="fz-font-md mb-0">{{ __('Go to Admin -> Plugins then activate all plugins.') }}</p>
                    </div>
                </div>

                <div class="setup-step mb-4">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <p class="fz-font-md mb-3">{{ __('Go to Admin -> Pages and create a page:') }}</p>

                        <div class="step-details">
                            <p class="fz-font-sm neutral-500 mb-2">{{ __('Content:') }}</p>
                            <pre class="code-block"><code>[hero-banner style="1" title="We Create Digital Experiences" subtitle="B2B Marketing Agency" description="We help brands grow through creative strategy, bold design, and digital innovation." primary_action_label="Explore All Work" primary_action_url="/portfolio" secondary_action_label="How We Work" secondary_action_url="/about-1"][/hero-banner]
[about-us-information style="1" title="We shape animated stories that inspire and engage" subtitle="About Us"][/about-us-information]
[partners style="1"][/partners]
[services style="1" subtitle="OUR SOLUTIONS"][/services]
[projects style="1" title="Selected work we're proud of" subtitle="Portfolio"][/projects]
[testimonials style="1" title="Trusted by Clients"][/testimonials]
[about-us-information style="4" subtitle="Why choose us"][/about-us-information]
[site-statistics style="1"][/site-statistics]
[teams style="2" subtitle="Why choose us"][/teams]
[skills-carousel][/skills-carousel]
[faqs title="Answered questions" subtitle="FAQ"][/faqs]
[call-to-action style="1" title="Let's Create Meaning Together"][/call-to-action]
[blog-posts subtitle="FROM BLOG" title="Our Latest Articles"][/blog-posts]</code></pre>

                            <p class="fz-font-sm neutral-500 mt-3 mb-0">
                                {{ __('Template:') }} <strong class="neutral-900">{{ __('Full Width') }}</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="setup-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <p class="fz-font-md mb-0">{{ __('Then go to Admin -> Appearance -> Theme options -> Page to set your homepage.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .setup-guide {
        max-width: 900px;
        margin: 0 auto;
    }

    .setup-steps {
        margin-top: 2rem;
    }

    .setup-step {
        display: flex;
        gap: 1.25rem;
    }

    .step-number {
        flex-shrink: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--primary-color, #F0460E);
        color: #fff;
        font-weight: 600;
        font-size: 14px;
        border-radius: 50%;
    }

    .step-content {
        flex: 1;
        padding-top: 4px;
    }

    .step-details {
        background: #f8f8f8;
        border-radius: 12px;
        padding: 1.25rem;
        margin-top: 0.75rem;
    }

    .code-block {
        background: #f0f0f0;
        padding: 1rem;
        border-radius: 8px;
        font-size: 12px;
        line-height: 1.6;
        overflow-x: auto;
        margin: 0;
        white-space: pre-wrap;
        word-break: break-word;
    }

    .code-block code {
        font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
    }
</style>
