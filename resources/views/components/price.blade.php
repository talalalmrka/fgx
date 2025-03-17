@props([
    'id' => uniqid('input-'),
    'type' => 'number',
    'name' => null,
    'icon' => null,
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'autofocus' => false,
    'autocomplete' => null,
    'required' => false,
    'error' => null,
    'disabled' => false,
    'rounded' => 'lg',
    'atts' => [
        'step' => 0.01,
    ],
    'startIcon' => null,
    'endIcon' => null,
    'info' => null,
    'size' => 'normal',
    'currency' => 'USD',
])
@php
    $props = array_merge(get_defined_vars(), [
        'endView' => view('components.span', [
            'class' => 'text-sm',
            'label' => currency_symbol($currency),
        ]),
    ]);
@endphp
@component('components.form.input', $props)
@endcomponent
