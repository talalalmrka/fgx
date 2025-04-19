<div {{ $attributes }}>
    @if ($title || $icon)
        <fgx:accordion-header :title="$title" :icon="$icon" />
    @endif
    <fgx:accordion-body>
        {{ $slot }}
    </fgx:accordion-body>
</div>
