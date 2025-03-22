<?php

use Fgx\MediaPreview;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
if (!function_exists('size_formatted')) {
    function size_formatted($bytes, $decimals = 0)
    {
        $size = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
}
if (!function_exists('media')) {
    function media($id)
    {
        return Media::find($id);
    }
}
if (!function_exists('is_user_model')) {
    function is_user_model($model)
    {
        return $model instanceof User;
    }
}
if (!function_exists('is_setting_model')) {
    function is_setting_model($model)
    {
        return $model instanceof Setting;
    }
}
if (!function_exists('is_model')) {
    function is_model($model)
    {
        return $model instanceof Model;
    }
}
if (!function_exists('is_media')) {
    function is_media($data)
    {
        return $data instanceof Media;
    }
}

if (!function_exists('is_media_collection')) {
    function is_media_collection($data)
    {
        return $data instanceof MediaCollection;
    }
}
if (!function_exists('is_temporary_file')) {
    function is_temporary_file($data)
    {
        return $data instanceof TemporaryUploadedFile;
    }
}
if (!function_exists('is_temporary_files')) {
    function is_temporary_files($data)
    {
        return is_array($data) && collect($data)->every(fn($item) => $item instanceof TemporaryUploadedFile);
    }
}
if (!function_exists('mime_to_type')) {
    function mime_to_type(string $mime)
    {
        $mimeGroups = [
            'image' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml', 'image/bmp', 'image/tiff'],
            'video' => ['video/mp4', 'video/mpeg', 'video/quicktime', 'video/x-msvideo', 'video/x-ms-wmv', 'video/webm'],
        ];

        foreach ($mimeGroups as $type => $mimes) {
            if (in_array($mime, $mimes)) {
                return $type;
            }
        }
        return $mime;
    }
}
if (!function_exists('media_preview')) {
    function media_preview($media, $data = [])
    {
        return MediaPreview::make($media, $data);
    }
}

if (!function_exists('media_previews')) {
    function media_previews($media)
    {
        return MediaPreview::collection($media);
    }
}

if (!function_exists('media_icon')) {
    function media_icon(Media|TemporaryUploadedFile|UploadedFile $media)
    {
        return MediaPreview::make($media)->icon;
    }
}