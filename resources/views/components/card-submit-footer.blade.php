@props([
    'id' => '',
    'icon' => 'fas-save',
    'label' => __('Save'),
    'buttonClass' => 'primary sm pill',
    'target' => 'save',
])
<x-card-footer class="flex items-center justify-between">
    <div class="flex items-center">
        <x-loader wire:loading wire:target="{{ $target }}" size="4" />
        <x-status wire:loading.remove wire:target="{{ $target }}" id="{{ $id }}" class="mb-0 p-0" />
    </div>
    <x-button type="submit" class="flex items-center {{ $buttonClass }}" startIcon="{{ $icon }}"
        label="{{ $label }}" />
</x-card-footer>
