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
    $multiple = $attributes->has('multiple');
    $single = !$multiple;
@endphp
<fgx:label :for="$model" :icon="$icon" :label="$label" />
<div wire:cloak x-data="{
    model: '{{ $model }}',
    files: [],
    uploads: {},
    isDragging: false,
    currentUpload: null,
    multiple: @js($multiple),
    single: @js($single),
    autoupload: @js($autoupload),
    previews: @js($previews),
    progress: 0,
    uploading: false,
    status: 'pending',
    error: null,
    init() {
        /*if (this.previews.length) {
            this.files = this.previews.map(item => Preview.make(item));
        }*/
        if (Array.isArray($refs.fileInput.files) && $refs.fileInput.files.length) {
            setTimeout(function(){
                //this.addFiles(Array.from($refs.fileInput.files));
            }, 300);
            
        }
    },
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
        //console.log('File selected', e);
        this.addFiles(Array.from(e.target.files));
        e.target.value = ''; // Reset input
    },
    handleDrop(event) {
        this.isDragging = false;
        const files = event.dataTransfer.files;
        console.log(files);
        this.addFiles(files);
    },
    pauseUpload() {
        $wire.cancelUpload(this.model);
        this.status = 'paused';
    },
    resumeUpload(file) {
        this.startUpload();
    },
    cancelUpload() {
        $wire.cancelUpload(this.model);
    },
    removeFromQueue(file) {
        this.files = this.files.filter(f => f.id !== file.id);
        if (file.url) URL.revokeObjectURL(file.url);
    },
    removeMedia(file) {
        $wire.$dispatch('delete-media', {
            property: this.model,
            id: file.id
        });
    },
    removeUpload(file) {
        $wire.removeUpload(this.model, file.name, () => {
            this.previews = this.previews.filter(item => item.name !== file.name);
        });
    },
    deletePreview(file) {
        if (file.isMedia()) {
            this.removeMedia(file);
        } else if (file.isTemporary()) {
            this.removeUpload(file);
        } else if (file.isLocal()) {
            this.cancelUpload(file);
        }
    },
    filesToUpload() {
        try {
            const filesToUpload = this.files.filter(item => item.isLocal()).map(item => item.file);
            return this.multiple ? filesToUpload : filesToUpload[0];
        } catch (e) {
            return null;
        }
    },
    async startUpload() {
        if (this.uploading) {
            return;
        }
        const filesToUpload = this.filesToUpload();
        if (!filesToUpload || (this.multiple && !filesToUpload.length)) {
            console.log('No files to upload');
            return;
        }
        try {
            this.uploading = true;
            this.progress = 0;
            this.error = null;
            this.multiple ?
                await $wire.uploadMultiple(
                    this.model,
                    filesToUpload,
                    (uploadedFilenames) => {
                        //success
                        this.uploading = false;
                        this.progress = 0;
                        
                        //this.$refs.fileInput.files = [];
                        //filesToUpload.forEach(f => this.removeFromQueue(f));
                        setTimeout(function(){
                        this.$refs.fileInput.value = '';
                        this.files = [];
                        console.log('files', this.files);
                        console.log('inputFiles', this.$refs.fileInput.files);
                        }, 300);
                        
                        
                    },
                    () => {
                        //error
                        this.status = 'error';
                        this.uploading = false;
                        this.progress = 0;
                        this.error = 'Upload failed';
                    },
                    (event) => {
                        //progress
                        this.progress = event.detail.progress;
                    },
                    () => {
                        // Cancel callback
                        this.status = 'cancelled';
                        this.uploading = false;
                        this.progress = 0;
                    }) :
                await $wire.upload(
                    this.model,
                    filesToUpload,
                    (uploadedFilename) => {
                        this.uploading = false;
                        this.progress = 0;
                        this.removeFromQueue(filesToUpload);
                    },
                    (error) => {
                        this.status = 'error';
                        this.uploading = false;
                        this.progress = 0;
                        this.error = 'Upload failed';
                    },
                    (event) => {
                        this.progress = event.detail.progress;
                    },
                    () => {
                        // Cancel callback
                        this.status = 'cancelled';
                        this.uploading = false;
                        this.progress = 0;
                    }
                );
        } catch (error) {
            this.status = 'error';
            this.uploading = false;
            this.progress = 0;
            this.error = error.message;
        }
    }
}">
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

        <input x-ref="fileInput" type="file" class="hidden" :multiple="@js($multiple)"
            accept="{{ $accept }}" x-on:change="handleFileSelect">

        <div :class="{ 'previews-grid': files.length > 0 || previews.length > 0, 'cursor-pointer': files.length === 0 && previews.length === 0 }">
            @foreach ($previews as $preview)
            <div class="previews-item {{ css_classes([
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
            <button type="button" class="previews-item-delete" x-on:click="deletePreview(file)">
                <i class="icon bi-trash-fill"></i>
            </button>
        </div>
            @endforeach
            <template x-for="(file, index) in files" :key="index">
                <div class="previews-item"
                    :class="{
                        'border-primary': file.model_type === 'media',
                        'border-green': file
                            .model_type === 'temporary',
                        'border-yellow': file.model_type === 'local'
                    }">
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
                    <button type="button" class="previews-item-delete" x-on:click="deletePreview(file)">
                        <i class="icon bi-trash-fill"></i>
                    </button>
                </div>
            </template>

            <!-- Placeholder/Appender -->
            <div x-show="multiple || files.length === 0"
                :class="{ 'previews-placeholder': files.length === 0 && previews.length === 0, 'previews-appender': multiple && (files.length > 0 || previews.length > 0) }"
                x-on:click="triggerFileInput">
                <div class="text-center p-2"
                    :class="{ 'max-w-32 max-h-32': single || (multiple && (files.length > 0 || previews.length > 0)) }">
                    <i class="icon bi-cloud-upload w-10 h-10 mb-1 text-gray-500 dark:text-gray-400"></i>
                    <div class="text-xs text-center text-gray-600 dark:text-gray-400">
                        {{ __('Click or darg here to upload') }}
                    </div>
                    <div class="mt-1 text-xs text-center text-gray-600 dark:text-gray-400">
                        {{ __('Max size: :max MB • Allowed: :accept', ['max' => size_formatted($maxSize), 'accept' => $accept]) }}
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
    <div class="flex-space-2">
        <div class="progress grow" x-show="uploading">
            <div class="progress-bar" :style="'width: ' + progress + '%'" x-text="progress+'%'"></div>
        </div>
        <div class="flex-space-1">
            <template x-if="!uploading && !autoupload && filesToUpload().length">
                <button type="button" class="toolbar-button upload" x-on:click="startUpload()">
                    <i class="icon bi-cloud-upload-fill"></i>
                </button>
            </template>

            <template x-if="uploading">
                <button type="button" class="toolbar-button pause" x-on:click="pauseUpload()">
                    <i class="icon bi-pause-fill"></i>
                </button>
            </template>

            <template x-if="!uploading && status === 'pauesd'">
                <button type="button" class="toolbar-button resume" x-on:click="resumeUpload()">
                    <i class="icon play-fill"></i>
                </button>
            </template>
        </div>
    </div>
    <div x-show="error" class="form-error" x-text="error"></div>
</div>
<fgx:info :id="$model" />
<fgx:error :id="$model" />
@pre($previews)
@pushOnce('scripts')
    @vite(['resources/js/preview.js'])
@endPushOnce
