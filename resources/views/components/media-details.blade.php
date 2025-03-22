@props(['media'])
<div class="list-groupp text-xs">
    <div class="list-group-item">
        <div class="font-semibold">{{ __('Name:') }}</div>
        <div class="truncate">{{ $media->name }}</div>
    </div>
    <div class="list-group-item">
        <div class="font-semibold">{{ __('File name:') }}</div>
        <div class="truncate">{{ $media->file_name }}</div>
    </div>
    <div class="list-group-item">
        <div class="font-semibold">{{ __('File type:') }}</div>
        <div class="truncate">{{ $media->mime_type }}</div>
    </div>
    <div class="list-group-item">
        <div class="font-semibold">{{ __('Collection:') }}</div>
        <div class="truncate">{{ $media->collection_name }}</div>
    </div>
    <div class="list-group-item">
        <div class="font-semibold">{{ __('File size:') }}</div>
        <div class="truncate">{{ $media->humanReadableSize }}</div>
    </div>
</div>
