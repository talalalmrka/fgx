@props(['icon' => null, 'title' => null])
<div x-accordion-header>
    <div class="flex-space-2">
        @if ($icon)
            <i class="icon {{ $icon }}"></i>
        @endif
        @if ($slot && $slot->isNotEmpty())
            {{ $slot }}
        @else
            @if ($title)
                <span>{!! $title ?? '' !!}</span>
            @endif
        @endif
    </div>
</div>
