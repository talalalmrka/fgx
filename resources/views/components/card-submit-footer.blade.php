@props([
    'icon' => 'bi-save',
    'label' => __('Save'),
    'buttonClass' => 'btn-primary',
    'target' => 'save',
])
<x-fgx::card-footer class="flex items-center justify-between">
    <div class="flex items-center">
        <x-fgx::loader wire:loading wire:target="{{ $target }}" size="4" />
        <x-fgx::status wire:loading.remove wire:target="{{ $target }}" id="{{ $id }}" class="mb-0 p-0" />
    </div>
    <x-fgx::button type="submit" class="btn sm pill {{ $buttonClass }}" startIcon="{{ $icon }}"
        label="{{ $label }}" />
</x-fgx::card-footer>
