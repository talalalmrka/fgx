@props([
    'id' => uniqid('check-group-'),
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
    $error = $error || $errors->has($id) || $errors->has("$id.*");
@endphp

<x-fgx::label :for="$id" :required="$required" :label="$label" />
<div {!! attributes(
    array_merge(
        [
            'id' => "$id-container",
            'class' => css_classes(['form-control', $container_class => $container_class, 'error' => $error]),
        ],
        $container_atts,
    ),
) !!}>
    @foreach ($options as $option)
        @php
            $optionValue = data_get($option, 'value');
            $optionId = data_get($option, 'id', "{$id}-{$optionValue}");
            $optionClass = data_get($option, 'class');
            $optionAtts = data_get($option, 'atts', []);
            $optionLabel = data_get($option, 'label');
            $optionIcon = data_get($option, 'icon');
            $optionContainerId = data_get($option, 'container_id', "$optionId-container");
            $optionContainerClass = data_get($option, 'container_class');
            $optionContainerAtts = data_get($option, 'container_atts', []);
        @endphp

        <div {!! attributes(
            array_merge(
                [
                    'id' => $optionContainerId,
                    'class' => css_classes(['form-check', $optionContainerClass => $optionContainerClass]),
                ],
                $optionContainerAtts,
            ),
        ) !!}>
            <input {!! $attributes->merge(
                array_merge(
                    [
                        'id' => $optionId,
                        'type' => 'checkbox',
                        'class' => css_classes(['form-check-input', $optionClass => $optionAtts]),
                        'value' => $optionValue,
                    ],
                    $optionAtts,
                ),
            ) !!}>
            @if ($optionLabel || $optionIcon)
                <label for="{{ $optionId }}" class="form-check-label">
                    @icon($optionIcon)
                    @if ($optionLabel)
                        <span>{{ $optionLabel }}</span>
                    @endif

                </label>
            @endif
        </div>
    @endforeach
</div>
<x-fgx::info :id="$id" :info="$info" />
<x-fgx::error :id="$id" />
