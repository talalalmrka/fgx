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
    'atts' => [],
    'required' => false,
    'class' => null,
    //'joditId' => uniqid('jodit-'),
])
@php
    $joditId = "jodit-$id";
@endphp
<x-form.label for="{{ $joditId }}" :icon="$icon" :required="$required" :error="$errors->has($id)">
    {!! $label ?? $slot !!}
</x-form.label>
<div wire:ignore>
    <textarea x-data="jodit" {!! $attributes->merge(
        array_merge($atts, [
            'id' => $joditId,
            'rows' => $rows,
            'placeholder' => $placeholder,
            'autofocus' => $autofocus ? '' : null,
            'required' => $required ? '' : null,
            'disabled' => $disabled ? '' : null,
            'aria-describedby' => $info ? $id . '-help' : null,
            'class' => css_classes([
                'form-control',
                'error' => $errors->has($id) || $errors->has("$id.*"),
                $class => $class,
            ]),
        ]),
    ) !!}>{{ $value }}</textarea>
</div>
<x-form.info :id="$id" :info="$info" />
<x-form.error :id="$id" />
@pushOnce('styles')
    <link rel="stylesheet" href="//unpkg.com/jodit@4.1.16/es2021/jodit.min.css">
@endPushOnce
@pushOnce('scripts')
    <script src="//unpkg.com/jodit@4.1.16/es2021/jodit.min.js"></script>
@endPushOnce
@script
    <script>
        Alpine.data('jodit', () => ({
            init() {
                this.$nextTick(() => {
                    console.log('jodit');
                    const editor = Jodit.make('#' + @js($joditId), {
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
                        //"buttons": buttons
                    });
                    document.getElementById(@js($joditId)).addEventListener('change', function() {
                        @this.set(@js($id), this.value);
                    });

                    window.addEventListener('update-jodit-content', (event) => {
                        editor.value = event.detail[0];
                    });
                });
            },
        }));
    </script>
@endscript
