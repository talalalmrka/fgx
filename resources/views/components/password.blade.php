@props([
    'id' => uniqid('input-'),
    'type' => 'password',
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
    'atts' => [],
    'startIcon' => null,
    'endIcon' => null,
    'startView' => null,
    'endView' => null,
    'info' => null,
    'container_class' => null,
    'container_atts' => [],
])
@php
    $model = $attributes->get('wire:model.live') ?? ($attributes->get('wire:model') ?? $id);
@endphp
<x-fgx::label :for="$id" :icon="$icon" :required="$required" :label="$label" />
<div x-data="passwordToggle"
    {{ attributes(
        array_merge(
            [
                'class' => css_classes(['form-control-container', $container_class => $container_class]),
            ],
            $container_atts,
        ),
    ) }}>
    @if ($startIcon || $startView)
        <span class="start-icon">
            @if (!empty($startView))
                {!! $startView !!}
            @endif
            @icon($startIcon)
        </span>
    @endif
    <input {!! $attributes->merge(
        array_merge($atts, [
            'id' => $id,
            'x-bind' => 'input',
            'type' => $type,
            'value' => $value,
            'placeholder' => $placeholder,
            'autofocus' => $autofocus ? '' : null,
            'autocomplete' => $autocomplete,
            'required' => $required ? '' : null,
            'disabled' => $disabled ? '' : null,
            'aria-describedby' => $info ? "$id-help" : null,
            'class' => css_classes([
                'form-control',
                'error' => $errors->has($id),
                'has-start-icon' => !empty($startIcon) || !empty($startView),
                'has-end-icon' => !empty($endIcon) || !empty($endView),
                'password-toggle-inited' => $type === 'password',
            ]),
        ]),
    ) !!}>

    @if ($endIcon || $endView || $type == 'password')
        <span class="end-icon">
            @icon($endIcon)
            @if (!empty($endView))
                {!! $endView !!}
            @endif
            @if ($type == 'password')
                <button type="button" class="btn-password-toggle flex items-center" x-bind="toggler"></button>
            @endif
        </span>
    @endif
</div>
<x-fgx::info :id="$id" :info="$info" />
<x-fgx::error :id="$id" />
@script
    <script>
        Alpine.data('passwordToggle', () => ({
            type: 'password',
            input: {
                [':type']() {
                    return this.type;
                }
            },
            toggler: {
                ['x-html']() {
                    return this.type === 'password' ? '<i class="icon bi-eye-fill"></i>' :
                        '<i class="icon bi-eye-slash-fill"></i>';
                },
                ['@click']() {
                    this.toggle();
                }
            },
            toggle() {
                this.type = this.type === 'password' ? 'text' : 'password';
            }
        }));
    </script>
@endscript
