@props([
    'for' => null,
    'icon' => null,
    'label' => null,
    'required' => false,
    'class' => '',
    'atts' => [],
])

@php
    $isLabel = !empty($label) || !empty($icon) || !$slot->isEmpty();
@endphp

@if ($isLabel)
    <label {!! $attributes->merge(
        array_merge(
            [
                'for' => $for,
                'class' => css_classes([
                    'form-label flex-space-1',
                    'error' => $errors->has($for),
                    'flex items-center' => $icon,
                ]),
            ],
            $atts,
        ),
    ) !!}>
        @icon($icon)

        @if ($slot->isEmpty())
            <span>
                {{ $label }}
            </span>
        @else
            {{ $slot }}
        @endif

        @if ($required)
            <span class="text-sm text-red">*</span>
        @endif
    </label>
@endif
