@php
    // Rendered via Menu::renderMenuLocation('main-menu', ['view' => 'menu']) —
    // Theme::partial() resolves this file from the theme's partials/ directory.
    // Available data: $menu, $menu_nodes (top-level nodes), $options (HTML attribute string).
    $menu_nodes = $menu_nodes ?? collect();
@endphp

@foreach ($menu_nodes as $row)
    <li @class(['group relative', $row->css_class => $row->css_class])>
        <a
            href="{{ $row->url }}"
            target="{{ $row->target }}"
            @class([
                'flex items-center gap-1 rounded-full px-4 py-2 text-sm font-medium transition',
                'text-brand-600 dark:text-brand-400' => $row->active,
                'text-slate-700 hover:bg-slate-100 hover:text-brand-600 dark:text-slate-200 dark:hover:bg-slate-800/70 dark:hover:text-brand-400' => ! $row->active,
            ])
        >
            {!! BaseHelper::clean($row->icon_html) !!}
            {{ $row->title }}
            @if ($row->has_child)
                <svg class="size-3.5 opacity-60" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            @endif
        </a>

        @if ($row->has_child)
            <ul class="invisible absolute top-full left-0 z-50 min-w-52 translate-y-2 rounded-2xl border border-slate-200 bg-white p-2 opacity-0 shadow-xl transition duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 dark:border-slate-800 dark:bg-slate-900">
                @foreach ($row->child as $child)
                    <li @class([$child->css_class => $child->css_class])>
                        <a
                            href="{{ $child->url }}"
                            target="{{ $child->target }}"
                            @class([
                                'flex items-center gap-1.5 rounded-xl px-4 py-2 text-sm transition',
                                'bg-brand-600/10 font-medium text-brand-600 dark:text-brand-400' => $child->active,
                                'text-slate-600 hover:bg-slate-100 hover:text-brand-600 dark:text-slate-300 dark:hover:bg-slate-800' => ! $child->active,
                            ])
                        >
                            {!! BaseHelper::clean($child->icon_html) !!}
                            {{ $child->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
@endforeach
