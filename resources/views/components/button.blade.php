@props([
    'type' => 'button',
    'size' => null,
    'variant' => 'primary',
    'label' => null,
    'startIcon' => null,
    'endIcon' => null,
    'class' => null,
    'atts' => [],
])
@php
    $variants = [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'blue' => 'btn-blue',
        'green' => 'btn-green',
        'red' => 'btn-red',
        'yellow' => 'btn-yellow',
        'orange' => 'btn-orange',
        'cyan' => 'btn-cyan',
        'sky' => 'btn-sky',
        'emerald' => 'btn-emerald',
    ];
@endphp
<button
    {{ $attributes->merge(
        array_merge(
            [
                'type' => $type,
                'class' => css_classes([
                    'btn flex-space-2',
                    data_get($variants, $variant) => $variant,
                    $size => $size,
                    $class => $class,
                ]),
            ],
            $atts,
        ),
    ) }}
    class="btn btn-primary">
    @icon($startIcon)
    <span>{!! $slot ?? $label !!}</span>
    @icon($endIcon)
</button>
