@props([
    'id' => uniqid('collsapse-'),
    'title' => null,
    'icon' => null,
    'class' => '',
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
}" class="card {{ $class }}" x-cloak>
    @if (isset($header))
        <div class="card-header flex-space-2" :class="{ 'border-b-0': !open }">
            <div class="card-title grow flex-space-2 py-1">
                {!! $header !!}
            </div>
            <button type="button" class="flex items-center" x-on:click.prevent="toggle">
                <fgx:collapse-icon />
            </button>
        </div>
    @endif
    <div class="card-body" x-show="open">
        {{ $slot }}
    </div>
    @if (isset($footer))
        <div x-show="open" class="card-footer">
            {!! $footer !!}
        </div>
    @endif
</div>
