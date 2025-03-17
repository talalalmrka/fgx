@props([
    'id' => uniqid('input-'),
    'type' => 'text',
    'name' => null,
    'icon' => null,
    'label' => $slot ?? null,
    'value' => null,
    'placeholder' => null,
    'autofocus' => false,
    'autocomplete' => null,
    'required' => false,
    'error' => null,
    'disabled' => false,
    'rounded' => 'lg',
    'atts' => [],
    'info' => null,
    'currency' => 'USD',
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'startIcon' => null,
    'endIcon' => null,
])
@php
    //$label = $label ?? $slot;
@endphp
<div class="mbb-3">
    @switch($type)
        @case('text')
        @case('password')

        @case('email')
        @case('url')

        @case('search')
        @case('number')
            @component('components.form.input', get_defined_vars())
            @endcomponent
        @break

        @case('tel')
            @component('components.form.input', get_defined_vars())
            @endcomponent
        @break

        @case('price')
            @component('components.form.price', get_defined_vars())
            @endcomponent
        @break

        @case('textarea')
            @component('components.form.textarea', get_defined_vars())
            @endcomponent
        @break

        @case('checkbox')
            @component('components.form.checkbox', get_defined_vars())
            @endcomponent
        @break

        @case('select')
            @component('components.form.select', get_defined_vars())
            @endcomponent
        @break

        @case('switch')
            @component('components.form.switch', get_defined_vars())
            @endcomponent
        @break

        @case('switch_group')
            @component('components.form.switch-group', get_defined_vars())
            @endcomponent
        @break

        @case('file')
            @component('components.form.file', get_defined_vars())
            @endcomponent
        @break

        @case('cover')
            @component('components.cover.cover-input', get_defined_vars())
            @endcomponent
        @break

        @case('select_categories')
            @component('components.form.select-categories', get_defined_vars())
            @endcomponent
        @break

        @case('editor')
            @component('components.form.editor', get_defined_vars())
            @endcomponent
        @break

        @default
            @dump(get_defined_vars())
    @endswitch
</div>
