@props([
    'name' => uniqid('accordion-item-'),
    'icon' => null,
    'title' => null,
])
<div {{ $attributes->merge([
    'data-name' => $name,
    'class' => 'accordion-item',
]) }}
    :class="{ 'active': isOpen(@js($name)) }">
    <div class="accordion-header" x-on:click="toggle(@js($name))">
        <div class="accordion-title">
            @icon($icon)
            <span>{!! $title ?? '' !!}</span>
        </div>
        <i class="icon bi-chevron-down accordion-icon"></i>
    </div>
    <div class="accordion-body" x-collapse x-show="isOpen(@js($name))">
        {!! $slot !!}
    </div>
</div>
