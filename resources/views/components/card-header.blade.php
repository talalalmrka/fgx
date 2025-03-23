@props([
    'icon' => null,
    'title' => null,
])
@php
    $hasHeading = !empty($title) || !empty($icon);
@endphp
<div {!! $attributes->merge([
    'class' => 'card-header',
]) !!}>
    @if (isset($slot) && $slot->isNotEmpty())
        {{ $slot }}
    @else
        @if ($hasHeading)
            <h6 class="card-title flex items-center space-x-2 rtl:space-x-reverse">
                @icon($icon, 'w-4 h-4')
                <span>@content($title)</span>
            </h6>
        @endif
    @endif
</div>
