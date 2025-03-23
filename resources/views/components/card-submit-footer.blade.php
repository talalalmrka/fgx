@props([
    'id' => 'status',
    'icon' => 'bi-floppy',
    'label' => __('Save'),
    'buttonClass' => 'btn-primary',
    'target' => 'save',
])
<x-fgx::card-footer class="flex items-center justify-between">
    <div class="flex items-center">
        <x-fgx::loader wire:loading wire:target="{{ $target }}" size="4" />
        <x-fgx::status wire:loading.remove wire:target="{{ $target }}" id="{{ $id }}"
            class="xs alert-soft mb-0 p-0 border-0 bg-transparent" />
    </div>
    <x-button type="submit" class="btn xs pill {{ $buttonClass }}" startIcon="{{ $icon }}" :label="$label" />
</x-fgx::card-footer>
