@props([
    'class' => null,
    'atts' => [],
])
<div
    {{ $attributes->merge(
        array_merge(
            [
                'class' => css_classes(['alert alert-info', $class => $class]),
            ],
            $atts,
        ),
    ) }}>
    {{ $slot }}
</div>
