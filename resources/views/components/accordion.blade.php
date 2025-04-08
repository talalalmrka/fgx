@props([
    'id' => uniqid('accordion-'),
    'open' => [],
])

@php
    $multiple = $attributes->has('multiple');
    $remember = $attributes->has('remember');
@endphp
<div x-cloak x-data="{
    accordionId: '{{ $id }}',
    multiple: @js($multiple),
    remember: @js($remember),
    open: @js($open),
    toggle(name) {
        if (this.multiple) {
            if (this.isOpen(name)) {
                this.open = [...this.open, ...name];
            } else {
                this.open = this.open.filter(item => item !== name);
            }
        } else {
            if (this.isOpen(name)) {
                this.open = [];
            } else {
                this.open = [name];
            }
        }
    },
    isOpen(name) {
        return this.open.includes(name);
    },
    init() {
        /*let savedSection = localStorage.getItem(accordionId, null);
        if (savedSection === 'null') {
            savedSection = null;
        }
        if (!this.section) {
            this.section = savedSection;
        }*/
    }
}" {{ $attributes->merge([
    'class' => 'accordion',
]) }}>
    {!! $slot !!}
</div>
