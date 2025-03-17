@props([
    'id' => uniqid('radio-group-'),
    'name' => null,
    'icon' => null,
    'label' => null,
    'value' => null,
    'required' => false,
    'error' => null,
    'disabled' => false,
    'atts' => [],
    'info' => null,
    'class' => null,
    'container_class' => null,
    'container_atts' => [],
    'options' => [],
])
@php
    $model = $attributes->get('wire:model.live');
@endphp
@error($id)
    @php
        $error = $errors->has($id);
    @endphp
@enderror

<x-form.label :required="$required" :error="$errors->has($id)" :label="$label" />
<div {!! attributes(
    array_merge(
        [
            'id' => "$id-container",
            'class' => css_classes(['form-control', $container_class => $container_class]),
        ],
        $container_atts,
    ),
) !!}>
    @foreach ($options as $option)
        @php
            $optionValue = data_get($option, 'value');
            $optionId = "{$id}-{$optionValue}";
            $optionLabel = data_get($option, 'label');
        @endphp

        <label class="form-label flex-space-2 cursor-pointer mb-0 p-2" for="{{ $optionId }}">
            <input {!! $attributes->merge(
                array_merge($atts, [
                    'id' => $optionId,
                    'type' => 'radio',
                    'value' => $optionValue,
                    'class' => 'radio-group-input',
                ]),
            ) !!}>
            <span>{{ $optionLabel }}</span>
        </label>
    @endforeach
</div>
<x-form.error id="{{ $id }}" />
<x-form.info id="{{ $id }}" :info="$info" />
