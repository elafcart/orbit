<section class="flex min-h-[60vh] items-center">
    <div class="container-shell py-20 text-center" data-animate="stagger" data-stagger="0.12">
        <p class="section-eyebrow">404</p>
        <h1 class="mt-4 font-display text-6xl font-bold tracking-tight sm:text-8xl">
            {{ __('Page not found') }}
        </h1>
        <p class="mx-auto mt-5 max-w-md text-lg text-slate-500 dark:text-slate-400">
            {{ __('The page you are looking for does not exist or has been moved.') }}
        </p>
        <div class="mt-9">
            <a href="{{ url('/') }}" class="btn btn-primary">{{ __('Back to Home') }}</a>
        </div>
    </div>
</section>
