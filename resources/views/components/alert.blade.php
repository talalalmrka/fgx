@props([
    'class' => null,
    'atts' => [],
    'type' => 'info',
    'soft' => false,
    'outline' => false,
])
@php
    $types = [
        'info' => 'alert-info',
        'success' => 'alert-success',
        'error' => 'alert-error',
        'warning' => 'alert-warning',
    ];
@endphp
<div
    {{ $attributes->merge(
        array_merge(
            [
                'class' => css_classes([
                    'alert',
                    data_get($types, $type, 'alert-info'),
                    'alert-soft' => $soft,
                    'alert-outline' => $outline,
                    $class => $class,
                ]),
            ],
            $atts,
        ),
    ) }}>
    {{ $slot }}
</div>
