{{-- Video Showreel: from index-2.html `home-2-section-11` --}}
{{-- Single full-width video thumbnail with center popup-video play button --}}
<div {!! $shortcode->htmlAttributes() !!} class="container-2200">
    <div class="home-2-section-11 postbox-scroll-zoom mx-lg-3 mx-2 mt-50 align-items-center justify-content-center">
        <div class="postbox-item-wrap">
            <div class="postbox-item">
                <div class="postbox-thumb p-relative rounded-5">
                    @if($shortcode->image)
                        <a href="{{ $shortcode->video_url ?: '#' }}">
                            <img class="postbox-scroll-zoom-img img-cover" src="{{ RvMedia::getImageUrl($shortcode->image) }}" alt="{{ $shortcode->title ?: 'Showreel' }}">
                        </a>
                    @endif
                    <div class="postbox-play-btn postbox-scroll-zoom-play z-index-1 d-flex align-items-center justify-content-center gap-3">
                        @if($shortcode->left_label)
                            {{-- Use <p class="h1"> rather than a real <h1> so each page only emits one semantic H1 (the page-content one). The h1 class preserves the visual size; matches the footer pattern. --}}
                            <p class="h1 text-white d-none d-md-flex mb-0">{{ $shortcode->left_label }}</p>
                        @endif
                        @if($shortcode->video_url)
                            <a class="popup-video" href="{{ $shortcode->video_url }}">
                                <span class="text-white">
                                    <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 9L0 17.6603L0 0.339746L15 9Z" fill="currentColor"/>
                                    </svg>
                                </span>
                            </a>
                        @endif
                        @if($shortcode->right_label)
                            <p class="h1 text-white d-none d-md-flex mb-0">{{ $shortcode->right_label }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
