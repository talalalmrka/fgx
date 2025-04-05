@props([
    'id' => uniqid('file-input-'),
    'icon' => null,
    'label' => null,
    'info' => null,
    'class' => null,
    'atts' => [],
    'previews' => [],
    'maxSize' => max_file_size(),
    'accept' => file_accept_attribute(),
    'autoupload' => true,
])
@php
    $model = $attributes->whereStartsWith('wire:model')->first();
    if (is_previews($previews)) {
        $previews = $previews->toArray();
    }
    $hasPreviews = !empty($previews);
    $multiple = $attributes->has('multiple');
    $single = !$multiple;

@endphp
<fgx:label :for="$model" :icon="$icon" :label="$label" />
<div wire:cloak x-data="{
    uploading: false,
    progress: 0,
    files: [],
    multiple: @js($multiple),
    single: @js(!$multiple),
    model: @js($model),
    isDragging: false,
    init() {},
    addFiles(newFiles) {
        if (this.single) {
            this.files = [Preview.make(newFiles[0])];
        } else {
            this.files = newFiles.map(item => Preview.make(item));
            //this.files = [...this.files, ...newFiles.map(item => Preview.make(item))];
        }
        if (this.autoupload) {
            this.startUpload();
        }
    },
    triggerFileInput() {
        this.$refs.fileInput.click();
    },
    handleFileSelect(e) {
        if (Array.isArray(e.target.files) && e.target.files.length) {
            if (this.single) {
                this.files = [Preview.make(e.target.files[0])];
            } else {
                this.files = e.target.files.map(item => Preview.make(item));
            }
        }

    },
    handleDrop(event) {
        this.isDragging = false;
        const files = event.dataTransfer.files;
        console.log(files);
        this.addFiles(files);
    },
    deletePreview(file) {
        if (file.model_type === 'media') {
            $wire.$dispatch('delete-media', {
                property: this.model,
                id: file.id
            });
        } else if (file.model_type === 'temporary') {
            $wire.removeUpload(this.model, file.name, () => {
                //this.previews = this.previews.filter(item => item.name !== file.name);
                console.log('removed');
            });
        } else if (file.isLocal()) {
            this.cancelUpload(file);
        }
    },
    deleteFile(id) {
        this.files = this.files.filter(item => item.id !== id);
    }
}" x-on:livewire-upload-start="uploading = true"
    x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
    x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
    <div x-on:drop.prevent="handleDrop" x-on:dragover.prevent="isDragging = true"
        x-on:dragleave.prevent="isDragging = false" :class="isDragging && 'seek-drop-zone--dragging'"
        {{ $attributes->whereDoesntStartWith('wire:model')->merge(
            array_merge(
                [
                    'id' => $id,
                    'class' => css_classes(['form-drop-zone', 'single' => $single, 'multiple' => $multiple, $class => $class]),
                ],
                $atts,
            ),
        ) }}>

        <input {{ $attributes->whereStartsWith('wire:model') }} x-ref="fileInput" type="file" class="hidden"
            accept="{{ $accept }}" x-on:change="handleFileSelect" {{ $multiple ? 'multiple' : '' }}>

        <div
            :class="{
                'previews-grid': files.length > 0 || @js($hasPreviews),
                'cursor-pointer': files.length === 0 &&
                    @js(!$hasPreviews)
            }">
            @foreach ($previews as $preview)
                @php
                    $previewModel = data_get($preview, 'model_type');
                    $previewId = data_get($preview, 'id');
                    $previewName = data_get($preview, 'name');
                @endphp
                <div
                    class="previews-item {{ css_classes([
                        'border-primary' => data_get($preview, 'model_type') === 'media',
                        'border-green' => data_get($preview, 'model_type') === 'temporary',
                    ]) }}">
                    @if (data_get($preview, 'type') === 'image')
                        <img src="{{ data_get($preview, 'url') }}" class="previews-item__image">
                    @else
                        <div class="flex items-center justify-center w-full h-full">
                            <div class="text-center">
                                <i class="icon w-8 h-8 {{ data_get($preview, 'icon') }}"></i>
                                <div class="text-xs mt-2">
                                    <div class="font-semibold">{{ data_get($preview, 'name') }}</div>
                                    <div class="mt-1">{{ data_get($preview, 'mime_type') }}</div>
                                    <div class="mt-1">{{ data_get($preview, 'size') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <button type="button" class="previews-item-delete"
                        x-on:click="deletePreview({model_type: @js($previewModel), id: @js($previewId), name: @js($previewName)})">
                        <i class="icon bi-trash-fill"></i>
                    </button>
                </div>
            @endforeach
            <template x-for="(file, index) in files" :key="index">
                <div class="previews-item border-yellow">
                    <img x-show="file.isImage()" :src="file.url" class="previews-item__image">
                    <div x-show="!file.isImage()" class="flex items-center justify-center w-full h-full">
                        <div class="text-center">
                            <i class="icon w-8 h-8" :class="file.icon"></i>
                            <div class="text-xs mt-2">
                                <div x-text="file.name" class="font-semibold"></div>
                                <div x-text="file.mime_type" class="mt-1"></div>
                                <div x-text="file.size" class="mt-1"></div>
                            </div>
                        </div>
                    </div>
                    <span class="badge absolute top-1 end-1" x-text="file.model_type"></span>
                    <button type="button" class="previews-item-delete" x-on:click="deleteFile(file.id)">
                        <i class="icon bi-trash-fill"></i>
                    </button>
                </div>
            </template>

            <!-- Placeholder/Appender -->
            <div x-show="multiple || (files.length === 0 && @js(!$hasPreviews))"
                :class="{
                    'previews-placeholder': files.length === 0 && @js(!$hasPreviews),
                    'previews-appender': multiple &&
                        (files.length > 0 || @js($hasPreviews))
                }"
                x-on:click="triggerFileInput">
                <div class="text-center p-2"
                    :class="{ 'max-w-32 max-h-32': single || (multiple && (files.length > 0 || @js($hasPreviews))) }">
                    <i class="icon bi-cloud-upload w-10 h-10 mb-1 text-gray-500 dark:text-gray-400"></i>
                    <div class="text-xs text-center text-gray-600 dark:text-gray-400">
                        {{ __('Click or darg here to upload') }}
                    </div>
                    <div class="mt-1 text-xxs text-center text-gray-600 dark:text-gray-400 truncate">
                        {{ __('Max size: :max • Allowed: :accept', ['max' => size_formatted($maxSize), 'accept' => $accept]) }}
                    </div>
                </div>
            </div>
        </div>
        <button x-show="single && files.length > 0 && previews.length > 0" type="button"
            class="text-sm absolute z-3 w-8 h-8 flex items-center justify-center top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 rtl:translate-x-1/2 rounded-full text-white bg-primary/80 hover:bg-primary"
            x-on:click="triggerFileInput">
            <i class="icon bi-pencil-square"></i>
        </button>
    </div>
    <!-- Toolbar -->
    <div class="flex-space-2" x-show="uploading">
        <div class="progress grow" x-show="uploading">
            <div class="progress-bar" :style="'width: ' + progress + '%'" x-text="progress+'%'"></div>
        </div>
        <div class="flex-space-1">
            <button type="button" class="toolbar-button cancel"
                x-on:click="$wire.cancelUpload('{{ $model }}')">
                <i class="icon bi-x"></i>
            </button>
        </div>
    </div>
</div>
<fgx:info :id="$model" />
<fgx:error :id="$model" />
@pushOnce('scripts')
    @vite(['resources/js/preview.js'])
@endPushOnce
