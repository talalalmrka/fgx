@props([
    'id' => uniqid('checkbox-'),
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
    $error ??= $errors->has($id);
    if ($checked) {
        $atts['checked'] = '';
    }
    if ($disabled) {
        $atts['disabled'] = '';
    }
@endphp
<div {!! attributes($container_atts)->merge([
    'class' => css_classes(['form-check', 'error' => $error, $container_class => $container_class]),
]) !!}>
    <input {!! $attributes->merge(
        array_merge(
            [
                'type' => 'checkbox',
                'id' => $id,
                'name' => $name,
                'value' => $value,
                'class' => css_classes([
                    $class => $class,
                    'error' => $error,
                ]),
            ],
            $atts,
        ),
    ) !!}>
    @if ($label || $icon)
        <label for="{{ $id }}" class="form-check-label flex-space-1">
            @if ($icon)
                @icon($icon)
            @endif
            @if ($label)
                <span>{{ $label }}</span>
            @endif

            @if ($required)
                <span class="text-sm text-red-500">*</span>
            @endif
        </label>
    @endif
</div>
<x-fgx::info :id="$id" :info="$info" />
<x-fgx::error :id="$id" />
