@props([
    'id' => uniqid('input-'),
    'type' => 'text',
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
    $model = $attributes->get('wire:model.live') ?? $attributes->get('wire:model');
    $type = $type ?? $attributes->get('type');
    if ($type === 'password') {
        $container_atts['x-data'] =
            "{type: 'password', toggle(){this.type = this.type == 'password' ? 'text' : 'password'}}";
        $container_atts['x-cloak'] = '';
        $atts[':type'] = $type;
    } elseif ($type === 'tel') {
        $container_atts['wire:ignore'] = '';
    }
@endphp
<x-fgx::label :for="$id" :icon="$icon" :required="$required" :label="$label" />
<div
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
                <button type="button" class="btn-password-toggle" x-on:click="toggle">
                    <span x-show="type == 'password'">
                        @icon('bi-eye', 'w-5')
                    </span>
                    <span x-show="type !== 'password'">
                        @icon('bi-eye-slash', 'w-5')
                    </span>
                </button>
            @endif
        </span>
    @endif
</div>
<x-fgx::info :id="$id" :info="$info" />
<x-fgx::error :id="$id" />

@if ($type == 'tel')
    @assets
        <script src="{{ asset('assets/lib/intl-tel-input/build/js/intlTelInput.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/lib/intl-tel-input/build/css/intlTelInput.min.css') }}">
        <style>
            .iti {
                display: block;
            }
        </style>
    @endassets
    @script
        <script>
            //const input = $wire.$el.querySelector('#{{ $id }}');
            const input = document.querySelector('#{{ $id }}');
            /*console.log('input', input);
            const container = input.parentNode;
            const model = input.getAttribute('wire:model.live') ?? input.getAttribute('wire:model');
            console.log('model', model);
            const isLivewire = typeof model !== 'undefined' && typeof $wire !== 'undefined';
            console.log('isLivewire', isLivewire);
            input.removeAttribute('wire:model');
            input.removeAttribute('wire:model.live');
            const name = input.name ?? '{{ $model }}' ?? input.id;
            console.log('name', name);
            input.name = `iti-${name}`;

            const iti = intlTelInput(input, {
                loadUtils: () => import("{{ asset('assets/lib/intl-tel-input/build/js/utils.js') }}"),
                initialCountry: "auto",
                geoIpLookup: (success, failure) => {
                    const country_code = localStorage.getItem('country_code', false);
                    if (country_code) {
                        success(country_code);
                    } else {
                        fetch("https://ipapi.co/json")
                            .then((res) => res.json())
                            .then((data) => {
                                localStorage.setItem('country_code', data.country_code);
                                success(data.country_code)
                            })
                            .catch(() => failure());
                    }

                },
                nationalMode: true,
                strictMode: true,
                separateDialCode: true,
                hiddenInput: () => ({
                    phone: name,
                }),
            });
            const hiddenInput = document.querySelector(`input[name="${name}"]`);
            console.log('hiddenInput', hiddenInput);
            const updateNumber = () => {
                const fullNumber = iti.getNumber();
                console.log('fullNumber', fullNumber);
                if (isLivewire) {
                    console.log('updating', model);
                    //$wire.{{ $model }} = fullNumber;
                    $wire.set('{{ $model }}', fullNumber);
                    //$wire.set('{{ $model }}', fullNumber);
                } else {
                    console.warn('Model or $wire is undefined, or $wire.set is not a function.');
                }

            };
            input.addEventListener('input', updateNumber);
            input.addEventListener('countrychange', updateNumber);*/
        </script>
    @endscript
@endif
