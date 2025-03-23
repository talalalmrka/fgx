@props([
    'percent' => 0,
    'strokeWidth' => 8,
    'showPercent' => true,
])
<div @if (!$attributes->has('x-data')) x-data="{ percent: @js($percent) }" @endif
    {{ $attributes->merge([
        'class' => 'circular-progress-bar',
    ]) }}>
    <svg class="w-full h-full relative transform -rotate-90" viewBox="0 0 100 100" preserveAspectRatio="none">
        <circle class="text-gray-300 dark:text-gray-400 stroke-current progress-bg shadow-sm"
            stroke-width="{{ $strokeWidth }}" cx="50" cy="50" r="40" fill="transparent" />
        <circle class="stroke-current progress-circle shadow-sm" stroke-width="{{ $strokeWidth }}" stroke-linecap="round"
            cx="50" cy="50" r="40" fill="transparent" stroke-dasharray="251.2"
            :stroke-dashoffset="(251.2 - (251.2 * percent) / 100)" />
    </svg>

    @if ($showPercent)
        <div class="absolute inset-0 flex items-center justify-center percent font-bold" x-text="percent+'%'"></div>
    @endif
</div>
