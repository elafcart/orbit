<article class="service-single">
    <section class="service-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <a href="{{ url('/#services') }}" class="back-link"><i class="bi bi-arrow-left"></i> Back to Services</a>
                    <h1 class="service-title">{{ $service->name }}</h1>
                    <p class="service-desc">{{ $service->description }}</p>
                    <a href="#contact" class="btn btn-primary rounded-pill mt-3">Get Started <i class="bi bi-arrow-right ms-2"></i></a>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    @if($service->image)
                        <img src="{{ RvMedia::getImageUrl($service->image) }}" alt="{{ $service->name }}" class="img-fluid rounded-4">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="service-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="ck-content">
                        {!! BaseHelper::clean($service->content) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>
