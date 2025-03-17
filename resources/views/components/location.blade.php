@props([
    'id' => 'location',
    'icon' => 'fas-map-marker-alt',
    'label' => null,
    'name' => 'location',
    'value' => [],
    'class' => null,
])
@if ($label)
    <x-form.label id="{{ $id }}" for="{{ $id }}" :label="$label" />
@endif
{{-- @dump($value) --}}
<div class="form-control bg-white dark:bg-gray-700">
    <div x-data="locationPicker(@js($value))" class="grid md:grid-cols-2 gap-3 {{ $class }}">

        <div class="col">
            <div class="col">
                <x-form.input id="{{ $id }}.address" name="{{ $id }}[address]" :label="__('Address')"
                    x-model="address" wire:model.live="{{ $id }}.address" />
            </div>
            <div class="col">
                <x-form.input id="{{ $id }}.latitude" name="{{ $id }}[latitude]" :label="__('Latitude')"
                    x-model="latitude" wire:model.live="{{ $id }}.address" />
            </div>
            <div class="col">
                <x-form.input id="{{ $id }}.longitude" name="{{ $id }}[longitude]"
                    :label="__('Longitude')" x-model="longitude" wire:model.live="{{ $id }}.address" />
            </div>
        </div>

        <div class="col">
            <div class="relative">
                <div x-bind="mapDiv" id="map" class="h-96 bg-gray-200 rounded relative"></div>
                <div class="absolute top-1 start-1 w-40">
                    <x-form.input type="search" x-model="searchQuery" @input.debounce.500ms="searchLocation"
                        placeholder="{{ __('Search for a location...') }}" class="sm" />
                    <ul x-collapse x-show="searchResults.length" @click.away="searchResults = []"
                        class="bg-white shadow-md rounded w-full z-10 max-h-56 overflow-y-auto">
                        <template x-for="result in searchResults" :key="result.id">
                            <li x-on:click="selectLocation(result.center[0], result.center[1], result.place_name)"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                <span x-text="result.place_name"></span>
                            </li>
                        </template>
                    </ul>
                </div>
                <div class="absolute start-1 bottom-1 z-full bg-white/50 text-xs p-1 font-semibold rounded w-40">
                    <div x-text="'lat:'+latitude"></div>
                    <div x-text="'lng:'+longitude"></div>
                    <div class="truncate" x-text="'addr:'+address"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-form.error :id="$id" class="mt-2" />
