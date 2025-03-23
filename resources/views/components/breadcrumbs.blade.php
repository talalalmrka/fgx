@props([
    'class' => null,
    'items' => [],
])
<nav
    {{ $attributes->merge([
        'aria-label' => 'breadcrumb',
        'class' => css_classes(['flex', 'overflow-x-auto', $class => $class]),
    ]) }}>
    <ol role="list" class="breadcrumb text-xs inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        @foreach ($items as $i => $item)
            @php
                $item = collect($item);
                $icon = $item->get('icon');
                $label = $item->get('label');
                $url = $item->get('url', '#!');
                $isFirst = $i == 0;
                $isLast = $i + 1 == sizeof($items);
                $active = $item->get('active', $isLast);
                $hasDivider = !$isFirst;
            @endphp
            @if ($active)
                <li class="breadcrumb-item active flex items-center" aria-current="page">
                    @if ($hasDivider)
                        @icon('bi-chevron-right', 'rtl:rotate-180 w-3 h-3 text-gray-400')
                    @endif
                    @icon($icon, 'w-3 h3')
                    <span class="ms-1 text-gray-500 md:ms-2 dark:text-gray-400 whitespace-nowrap">
                        {{ $label }}
                    </span>
                </li>
            @else
                <li class="breadcrumb-item">
                    <a wire:navigate href="{{ $url }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white space-x-1 rtl:space-x-reverse">
                        @if ($hasDivider)
                            @icon('bi-chevron-right', 'rtl:rotate-180 w-3 h-3 text-gray-400')
                        @endif
                        @icon($icon, 'w-3 h-3')
                        <span class="whitespace-nowrap">{{ $label }}</span>
                    </a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
@push('head')
    <script type="application/ld+json">{!! breadcrumbs_json($items) !!}</script>
@endpush
