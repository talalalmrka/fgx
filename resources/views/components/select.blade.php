@props([
    'id' => uniqid('select-'),
    'name' => null,
    'icon' => null,
    'label' => null,
    'value' => null,
    'required' => false,
    'error' => null,
    'disabled' => false,
    'atts' => [],
    'startIcon' => null,
    'endIcon' => null,
    'info' => null,
    'options' => [],
    'class' => null,
    'multiple' => false,
])
@php
    $error = $error ?? $errors->has($id);
    $selectId = uniqid('select-');
    if ($multiple) {
        $atts['multiple'] = 'multiple';
    }

@endphp
<x-fgx::label for="{{ $id }}" :icon="$icon" :required="$required" :label="$label" />
<select {!! $attributes->merge(
    array_merge(
        [
            'id' => $id,
            'required' => $required ? '' : null,
            'disabled' => $disabled ? '' : null,
            'aria-describedby' => $info ? "$id-help" : null,
            'class' => css_classes(['form-select', $class => $class, 'error' => $error]),
        ],
        $atts,
    ),
) !!}>
    @foreach ($options as $option)
        <option value="{{ data_get($option, 'value') }}">{!! data_get($option, 'label') !!}</option>
    @endforeach
</select>
<x-fgx::info :id="$id" :info="$info" />
<x-fgx::error :id="$id" />
