@props([
    'key',
    'id' => uniqid('file-input-'),
    'name' => null,
    'icon' => null,
    'label' => null,
    'media' => null,
    'previews' => null,
    'multiple' => false,
    'required' => false,
    'error' => null,
    'disabled' => false,
    'atts' => [],
    'info' => null,
    'accept' => null,
])
@php
    $multiple = $multiple || $attributes->has('multiple');
    if(!$multiple && !empty($previews)){
        $media = collect([$previews->last()]);
    }
    $hasPreviews = !empty($previews) && $previews->isNotEmpty();
@endphp
<x-fgx::label for="{{ $id }}" :icon="$icon" :required="$required" :error="$error" :label="$label" />
<div x-cloak x-data="fileDropZone" x-on:livewire-upload-start="uploadStart()" x-on:livewire-upload-finish="uploadFinish"
    x-on:livewire-upload-cancel="uploadCancel()" x-on:livewire-upload-error="uploadError()"
    x-on:livewire-upload-progress="uploadProgress($event)"
    class="media-drop-zone {{ $multiple ? 'multiple': '' }}">
    @if (!$hasPreviews)
        <label for="{{ $id }}" class="flex items-center justify-center w-full h-full cursor-pointer flex-coll">
            <div class="flex flex-col items-center justify-center p-4">
                @icon('bi-cloud-upload', 'w-8 h-8 mb-1 text-gray-500 dark:text-gray-400')
                <div class="mb-2 text-xs text-center text-gray-600 dark:text-gray-400">
                    {{ __('Click or darg here to upload') }}
                </div>
                @if ($info)
                    <p class="text-gray-500 hiddenn text-2xs dark:text-gray-400">{!! $info !!}</p>
                @endif
            </div>
        </label>
    @endif
    <!-- Previews -->
    @if ($hasPreviews)
        <div class="media-previews-container {{ $multiple ? 'multiple' : '' }}">
            @foreach ($previews as $index => $preview)
                <div class="media-previews-item">
                    <fgx:media-preview :preview="$preview"
                        wire:key="{{ $index }}" />
                    <button type="button" x-on:click="$dispatch('delete-media', {property: '{{ $id }}', index: {{ $index }}})" title="{{ __('Delete') }}"
                        class="media-item-delete">
                        @icon('bi-trash')
                    </button>
                </div>
            @endforeach
            @if (!$multiple)
                <button type="button" x-on:click="$refs.fileInput.click()"
                    class="media-item-edit">
                    @icon('bi-pencil-square', 'w-4 h-4')
                </button>
            @endif
            @if ($multiple && $hasPreviews)
                <label for="{{ $id }}"
                    class="relative flex flex-col items-center justify-center w-32 h-32 p-3 text-gray-400 bg-gray-100 border border-gray-200 rounded-lg shadow-xs cursor-pointer group hover:shadow-sm dark:text-gray-400 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900 dark:border-gray-700">
                    @icon('bi-plus', 'w-8 h-8 mb-1 text-gray-500 dark:text-gray-400')
                    <p class="mb-1 text-sm text-center text-gray-500 dark:text-gray-400">
                        <span class="text-xs">{{ __('Click or drop to upload') }}</span>
                    </p>
                </label>
            @endif
        </div>
    @endif
    <template x-if="uploading">
        <div class="absolute top-0 bottom-0 left-0 right-0 flex items-center justify-center">
            <div class="w-full px-3">
                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                        :style="'width: ' + progress + '%'" x-text="progress + '%'"></div>
                </div>
            </div>
        </div>
    </template>
    <input x-ref="fileInput" {!! $attributes->merge(
        array_merge($atts, [
            'class' => 'hidden',
            'id' => $id,
            'name' => $name,
            'type' => 'file',
            'accept' => $accept,
        ]),
    ) !!} {{ $multiple ? 'multiple' : '' }} />
</div>

<x-fgx::error :id="$id" />
<x-fgx::info :id="$id" :info="$info" />
@script
    <script>
        Alpine.data('fileDropZone', () => ({
            uploading: false,
            progress: 0,
            fileInput: {},
            model: null,
            uploadToggle(status) {
                this.uploading = status;
            },
            uploadStart() {
                this.uploadToggle(true);
            },
            uploadFinish() {
                this.uploadToggle(false);
            },
            uploadCancel() {
                this.uploadToggle(false);
            },
            uploadError() {
                this.uploadToggle(false);
            },
            uploadProgress(event) {
                this.progress = event.detail.progress;
            },
            deleteItem(id) {
                $wire.deleteMedia(id);
            },
            deletePreview(index) {
                $wire.deletePreview(this.model, index);
            },
            init() {
                $nextTick(() => {
                    this.fileInput = this.$refs.fileInput;
                    this.model = this.fileInput.id;
                    this.fileInput.addEventListener('change', (event) => {
                        //this.handleFiles(event);
                    });
                });
            }
        }));
    </script>
@endscript
