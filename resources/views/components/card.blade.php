@props([
    'class' => null,
    'atts' => [],
])
<div {!! $attributes->merge(
    array_merge(
        [
            'class' => css_classes(['card', $class => $class]),
        ],
        $atts,
    ),
) !!}>{{ $slot }}</div>
