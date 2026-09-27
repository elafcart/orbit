{{-- Testimonials Style 7 — shared card body (role/company + avatar + quote + stars) --}}
@if (! empty($tab['role']) || ! empty($tab['company']))
    <p class="h6 fz-font-md fw-500 text-end mb-0">
        {{ $tab['role'] ?? '' }}
        @if (! empty($tab['role']) && ! empty($tab['company']))
            <br>
        @endif
        {{ $tab['company'] ?? '' }}
    </p>
@endif
<div class="pt-30">
    @if (! empty($tab['avatar']))
        <div class="sec-2-home-5__avatar-sm">
            {{ RvMedia::image($tab['avatar'], $tab['name'] ?? '', attributes: ['class' => 'img-cover']) }}
        </div>
    @endif
    @if (! empty($tab['quote']))
        <blockquote class="neutral-500 fz-font-lg fw-500 mb-3 mt-30 text-truncate-5">"{{ $tab['quote'] }}"</blockquote>
    @endif
    <div class="d-flex">
        @for ($i = 1; $i <= 5; $i++)
            <span class="{{ $i <= $rating ? 'star' : '' }}">{!! $starSvg !!}</span>
        @endfor
    </div>
</div>
