@props([
    'id' => uniqid('switch-'),
    'name' => null,
    'icon' => null,
    'label' => null,
    'value' => 1,
    'checked' => false,
    'required' => false,
    'error' => null,
    'disabled' => false,
    'info' => null,
    'class' => null,
    'atts' => [],
    'container_class' => null,
    'container_atts' => [],
])
@php
    $error = $errors->has($id);
    if ($checked) {
        $atts['checked'] = '';
    }
    if ($disabled) {
        $atts['disabled'] = '';
    }
@endphp
<label {!! attributes($container_atts)->merge([
    'class' => css_classes(['form-switch', 'error' => $error, $container_class => $container_class]),
]) !!}>
    <input {!! $attributes->merge(
        array_merge(
            [
                'type' => 'checkbox',
                'name' => $name,
                'value' => $value,
                'class' => css_classes([
                    $class => $class,
                ]),
            ],
            $atts,
        ),
    ) !!}>
    <span class="toggle-slider"></span>
    <span class="form-switch-label flex-space-1">
        @if ($icon)
            @icon($icon)
        @endif
        @if ($label)
            <span>{{ $label }}</span>
        @endif

        @if ($required)
            <span class="text-sm text-red-500">*</span>
        @endif
    </span>
</label>
<x-fgx::info :id="$id" :info="$info" />
<x-fgx::error :id="$id" />
