@props([
    'id' => uniqid('editor-'),
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
    'class' => null,
    'atts' => [],
])
@php
    $error ??= $errors->has($id);
@endphp

<x-fgx::label :for="$id" :icon="$icon" :required="$required" :error="$error" :label="$label" />
<div wire:ignore>
    <textarea {!! $attributes->merge(
        array_merge($atts, [
            'id' => $id,
            'rows' => $rows,
            'placeholder' => $placeholder,
            'autofocus' => $autofocus ? '' : null,
            'required' => $required ? '' : null,
            'disabled' => $disabled ? '' : null,
            'aria-describedby' => $info ? "$id-help" : null,
            'class' => css_classes(['form-control', 'error' => $error, $class => $class]),
        ]),
    ) !!}>{{ $value }}</textarea>
</div>
<x-fgx::info :id="$id" :info="$info" />
<x-fgx::error :id="$id" />
@if (isset($__livewire))
    @assets
        <script src="{{ asset('assets/lib/jodit/es2021/jodit.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/lib/jodit/es2021/jodit.min.css') }}">
    @endassets
    @script
        <script>
            const textarea = $wire.$el.querySelector('#{{ $id }}');
            const editor = Jodit.make(textarea, {
                "autofocus": true,
                "toolbarSticky": true,
                /*"uploader": {
                    "insertImageAsBase64URI": true
                },*/
                "toolbarButtonSize": "xsmall",
                "showCharsCounter": false,
                "showWordsCounter": false,
                "showXPathInStatusbar": false,
                "defaultActionOnPaste": "insert_clear_html",
                "height": textarea.dataset.height ?? 400,
            });
            textarea.addEventListener('change', function() {
                $wire.set('{{ $id }}', this.value);
            });
        </script>
    @endscript
@else
    @pushOnce('styles')
        <link rel="stylesheet" href="{{ asset('assets/lib/jodit/es2021/jodit.min.css') }}">
    @endPushOnce
    @pushOnce('scripts')
        <script src="{{ asset('assets/lib/jodit/es2021/jodit.min.js') }}"></script>
        <script>
            const textarea = $wire.$el.querySelector('#{{ $id }}');
            const editor = Jodit.make(textarea, {
                "autofocus": true,
                "toolbarSticky": true,
                "uploader": {
                    "insertImageAsBase64URI": true
                },
                "toolbarButtonSize": "xsmall",
                "showCharsCounter": false,
                "showWordsCounter": false,
                "showXPathInStatusbar": false,
                "defaultActionOnPaste": "insert_clear_html",
                "height": textarea.dataset.height ?? 300,
            });
        </script>
    @endPushOnce
@endif
