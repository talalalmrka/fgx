@props([
    'verified' => true,
    'class' => null,
    'iconClass' => '',
    'labelClass' => '',
    'showLabel' => null,
    'atts' => [],
])
@if ($verified)
    <span {!! $attributes->merge(
        array_merge($atts, [
            'class' => css_classes([
                'verified-mark',
                $class => $class,
                'flex items-center space-x-2 rtl:space-x-reverse' => $showLabel,
            ]),
        ]),
    ) !!}>
        @icon('bi-patch-check-fill', "verified-mark-icon $iconClass")
        @if ($showLabel)
            <span class="verified-mark-label {{ $labelClass }}">{{ __('Verified') }}</span>
        @endif
    </span>
@endif
