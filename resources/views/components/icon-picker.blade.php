@props([
    'id' => uniqid('icon-picker-'),
    'name' => null,
    'icon' => null,
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'autofocus' => false,
    'autocomplete' => null,
    'required' => false,
    'disabled' => false,
    'class' => null,
    'atts' => [],
    'info' => null,
    'container_class' => null,
    'container_atts' => [],
    'group_class' => null,
    'group_atts' => [],
    'dropdown_class' => null,
    'dropdown_atts' => [],
])
@php
    $model = $attributes->whereStartsWith('wire:model')->first();
@endphp
<x-fgx::label :for="$id" :icon="$icon" :required="$required" :label="$label" />
<div x-cloak x-data="{
    open: false,
    selectedIcon: '{{ $value }}',
    searchTerm: '',
    model: @js($model),
    icons: fgi.icons,
    page: 1,
    perPage: 25,
    get filteredIcons() {
        return this.icons.filter(icon => icon.toLowerCase().includes(this.searchTerm.toLowerCase()));
    },
    get pageIcons() {
        return this.filteredIcons.slice((this.page - 1) * this.perPage, this.page * this.perPage);
    },
    get pages() {
        return Math.ceil(this.filteredIcons.length / this.perPage);
    },
    get selectedFullIcon() {
        return this.iconClass(this.selectedIcon);
    },
    selectIcon(icon) {
        this.selectedIcon = this.iconClass(icon);
        this.$refs.input.value = this.iconClass(icon);
        this.open = false;
        this.searchTerm = '';
        if (this.model) {
            if (typeof $wire !== 'undefined') {
                $wire.set(this.model, this.iconClass(icon));
            }
        }
    },
    inputChanged(evt) {
        this.selectedIcon = evt.target.value;
    },
    clearIcon() {
        this.selectedIcon = '';
        this.searchTerm = '';
    },
    clearSearch() {
        this.searchTerm = '';

    },
    iconClass(icon) {
        return `bi-${icon}`;
    },
    prevPage() {
        if (this.page > 1) {
            this.page--;
        }
    },
    nextPage() {
        if (this.page < this.pages) {
            this.page++;
        }
    },
    init() {
        //console.log('model', this.model);
        //console.log(Icons);
        $watch('searchTerm', (value, oldValue) => {
            if (value !== oldValue) {
                this.page = 1;
            }
        });
    }
}"
    {{ attributes($container_atts)->merge([
        'class' => css_classes([
            'dropdown inited overflow-visible',
            $container_class => $container_class,
            'x-on:click.away' => 'open = false',
        ]),
    ]) }}>
    <div class="input-group {{ $group_class }}">
        <button wire:ignore type="button" class="btn btn-primary" x-on:click="open = !open">
            <i class="icon" :class="selectedIcon" :title="selectedIcon"></i>
        </button>
        <input
            {{ $attributes->merge(
                array_merge(
                    [
                        'x-ref' => 'input',
                        'class' => css_classes(['form-control', $class => $class]),
                        'x-on:keyup' => 'inputChanged',
                    ],
                    $atts,
                ),
            ) }}>
    </div>

    <!-- Dropdown -->
    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-10 mt-2 w-auto bg-white dark:bg-gray-800 rounded-md shadow-sm border border-gray-200 dark:border-gray-600 {{ $dropdown_class }}">
        <div class="bg-gray-100 dark:bg-gray-700 p-1">
            <div class="form-control-container">
                <span class="start-icon">
                    <i class="icon bi-search"></i>
                </span>
                <input type="search" class="form-control xs pill has-start-icon" x-model="searchTerm"
                    placeholder="{{ __('Search') }}" x-on:input="" />
            </div>
        </div>
        <div class="grid grid-cols-5 gap-3 p-2">
            <template x-for="icon in pageIcons" :key="icon">
                <button type="button" x-on:click="selectIcon(icon)"
                    class="flex flex-col items-center justify-center w-7 h-7 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
                    :class="{ 'bg-primary text-bg-primary': selectedIcon === icon }" :title="icon">
                    <i class="icon" :class="iconClass(icon)" class="text-xl"></i>
                </button>
            </template>
            <div x-show="pageIcons.length === 0" class="col-span-5 text-center py-4 text-gray-500">
                {{ __('No icons found') }}
            </div>
        </div>
        <div x-show="pages" class="flex-space-2 items-center justify-between text-xs bg-gray-100 dark:bg-gray-700 p-1">
            <button type="button"
                class="flex items-center justify-center rounded-full p-1 hover:bg-gray-200 dark:hover:bg-primary-600 transition-colors"
                x-on:click.prevent="prevPage">
                <i class="icon bi-chevron-left rtl:rotate-270"></i>
            </button>
            <span x-text="page+'/'+pages"></span>
            <button x-show="page < pages" type="button"
                class="flex items-center justify-center rounded-full p-1 hover:bg-gray-200 dark:hover:bg-primary-600 transition-colors"
                x-on:click.prevent="nextPage">
                <i class="icon bi-chevron-right rtl:rotate-270"></i>
            </button>
        </div>
    </div>
</div>
@pushOnce('scripts')
    <script src="{{ asset('assets/fgi/dist/js/fgi.js') }}"></script>
@endPushOnce

@pushOnce('styles')
    <link rel="stylesheet" href="{{ asset('assets/fgi/dist/css/fgi.css') }}" />
@endPushOnce
