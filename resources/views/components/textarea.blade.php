@props([
    'id' => uniqid('textarea-'),
    'icon' => null,
    'label' => null,
    'value' => '',
    'error' => null,
    'placeholder' => null,
    'autofocus' => false,
    'autocomplete' => null,
    'required' => false,
    'disabled' => false,
    'rounded' => 'lg',
    'info' => null,
    'size' => 'normal',
    'rows' => 5,
    's' => [],
    'class' => null,
    'atts' => [],
])
@php
    $error = $error ?? $errors->has($id);
@endphp

<x-fgx::label :for="$id" :icon="$icon" :required="$required" :error="$error" :label="$label" />
<div id="{{ $id }}-container" x-data="textareaDirection" class="relative">
    <div class="flex-space-2 p-2">
        <button x-bind="ltrButton" type="button" class="btn xs">
            @icon('bi-text-left')
        </button>
        <button x-bind="rtlButton" type="button" class="btn xs">
            @icon('bi-text-right')
        </button>
    </div>
    <textarea x-bind="textarea" {!! $attributes->merge(
        array_merge($atts, [
            'id' => $id,
            'rows' => $rows,
            'placeholder' => $placeholder,
            'autofocus' => $autofocus ? '' : null,
            'required' => $required ? '' : null,
            'disabled' => $disabled ? '' : null,
            'aria-describedby' => $info ? $id . '-help' : null,
            'class' => css_classes(['form-control', 'error' => $error, $class => $class]),
        ]),
    ) !!}>{{ $value }}</textarea>
</div>
<x-fgx::info :id="$id" :info="$info" />
<x-fgx::error :id="$id" />
