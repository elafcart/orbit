@php
    // Mobile variant — rendered via Menu::renderMenuLocation('main-menu', ['view' => 'menu-mobile']).
    // Sub-menus stay expanded (indented) since hover is unavailable on touch devices.
    $menu_nodes = $menu_nodes ?? collect();
@endphp

@foreach ($menu_nodes as $row)
    <li @class([$row->css_class => $row->css_class])>
        <a
            href="{{ $row->url }}"
            target="{{ $row->target }}"
            @class([
                'flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-medium transition',
                'bg-brand-600/10 text-brand-600 dark:text-brand-400' => $row->active,
                'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' => ! $row->active,
            ])
        >
            {!! BaseHelper::clean($row->icon_html) !!}
            {{ $row->title }}
        </a>

        @if ($row->has_child)
            <ul class="mt-1 ml-4 space-y-1 border-l border-slate-200 pl-4 dark:border-slate-800">
                @foreach ($row->child as $child)
                    <li @class([$child->css_class => $child->css_class])>
                        <a
                            href="{{ $child->url }}"
                            target="{{ $child->target }}"
                            @class([
                                'flex items-center gap-2 rounded-xl px-3 py-2 text-sm transition',
                                'font-medium text-brand-600 dark:text-brand-400' => $child->active,
                                'text-slate-500 hover:text-brand-600 dark:text-slate-400' => ! $child->active,
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
