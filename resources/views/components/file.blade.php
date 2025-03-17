@props([
    'key',
    'id' => uniqid('file-input-'),
    'name' => null,
    'icon' => null,
    'label' => null,
    'media' => null,
    'previews' => [],
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
    $hasPreviews = is_array($previews) && sizeof($previews) > 0;
@endphp
<x-form.label for="{{ $id }}" :icon="$icon" :required="$required" :error="$error">
    {!! $label ?? $slot !!}
</x-form.label>
<!-- Drop Zone -->
<div x-cloak x-data="fileDropZone" x-on:livewire-upload-start="uploadStart()" x-on:livewire-upload-finish="uploadFinish"
    x-on:livewire-upload-cancel="uploadCancel()" x-on:livewire-upload-error="uploadError()"
    x-on:livewire-upload-progress="uploadProgress($event)"
    class="relative overflow-hidden border-2 border-gray-300 border-dashed rounded-lg cursor-pointerr bg-gray-50 dark:bg-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-700"
    :class="{ 'w-36 h-36': @js(!$multiple) }">
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
        <div :class="{ 'flex flex-wrap p-4 gap-4': @js($multiple), 'w-full h-full': @js(!$multiple) }"
            class="relative group/items">
            <!-- Saved Previews -->
            @php
                $i = 0;
            @endphp
            @foreach ($previews as $preview)
                @php
                    $itemId = data_get($preview, 'id');
                @endphp
                @include(
                    'components.media-item-preview',
                    array_merge($preview, [
                        'onClickDelete' => !empty($itemId) ? "deleteItem($itemId)" : "deletePreview($i)",
                        'class' => css_classes(['w-full h-full' => !$multiple, 'w-32 h-32' => $multiple]),
                    ]))
                @php
                    $i++;
                @endphp
            @endforeach
            <!-- Change For Single -->
            @if (!$multiple)
                <label for="{{ $id }}"
                    class="absolute inset-0 items-center justify-center hidden w-8 h-8 m-auto text-white transition-opacity bg-blue-500 rounded-full shadow cursor-pointer group-hover/items:flex bg-opacity-85 hover:bg-opacity-95">
                    @icon('fas-edit', 'w-4 h-4')
                </label>
            @endif
            <!-- Appender For Multiple -->
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
    <!-- Progress -->
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
    <!-- Input -->
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

<x-form.error :id="$id" />
<x-form.info :id="$id" :info="$info" />
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
