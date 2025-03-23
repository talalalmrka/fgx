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
    $label = isset($slot) && $slot->isNotEmpty() ? $slot : $label;
@endphp
<button
    {{ $attributes->merge(
        array_merge(
            [
                'type' => $type,
                'class' => css_classes([
                    'btn',
                    data_get($variants, $variant) => $variant,
                    $size => $size,
                    $class => $class,
                ]),
            ],
            $atts,
        ),
    ) }}>
    @icon($startIcon)
    @if (!empty($label))
        <span>{!! $label !!}</span>
    @endif
    @icon($endIcon)
</button>
