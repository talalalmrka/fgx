@props([
    'id' => uniqid('collsapse-'),
    'title' => null,
    'icon' => null,
])

<div x-data="{
    collapseId: '{{ $id }}',
    open: false,
    toggle() {
        this.open = !this.open;
        localStorage.setItem(this.collapseId, this.open);
    },
    init() {
        this.open = localStorage.getItem(this.collapseId) === 'true';
    }
}" class="card" x-cloak>
    <div class="card-header flex-space-2" :class="{ 'border-b-0': !open }">
        <div class="card-title grow text-primary flex-space-2 py-1">
            @if ($icon)
                <i class="icon {{ $icon }}"></i>
            @endif
            <span>{{ $title ?? '' }}</span>
        </div>
        <button type="button" class="flex items-center" x-on:click.prevent="toggle">
            <fgx:collapse-icon />
        </button>
    </div>
    <div class="card-body" x-show="open">
        {{ $slot }}
    </div>
    @if (isset($footer))
        <div x-show="open" class="card-footer">
            {!! $footer !!}
        </div>
    @endif
</div>
