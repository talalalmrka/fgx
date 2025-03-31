<?php
use Fgx\Preview;
use Fgx\Previews;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\File;

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

if (!function_exists('media_icon')) {
    function media_icon(Media|TemporaryUploadedFile|UploadedFile $media)
    {
        return Preview::make($media)->icon;
    }
}

if (!function_exists('preview')) {
    function preview($media)
    {
        return Preview::make($media);
    }
}

if (!function_exists('previews')) {
    function previews(...$values)
    {
        return Previews::create($values);
    }
}

if(!function_exists('is_preview')){
    function is_preview($data){
        return $data instanceof Preview;
    }
}
if(!function_exists('is_previews')){
    function is_previews($data){
        return $data instanceof Previews;
    }
}

if (!function_exists('livewire_tmp_url')) {
    function livewire_tmp_url() {
        $disk = config('livewire.temporary_file_upload.disk');
        $directory = config('livewire.temporary_file_upload.directory') ?? 'livewire-tmp';
        $diskUrl = config("filesystems.disks.{$disk}.url");
        return "$diskUrl/$directory/";
    }
}

if (!function_exists('max_file_size')) {
    function max_file_size($size = null) {
        $limits = [
            $size,
            php_max_file_size(),
            media_library_max_file_size(),
            livewire_max_file_size()
        ];
        return min(array_filter($limits));
    }
}

if (!function_exists('php_max_file_size')) {
    function php_max_file_size() {
        $uploadMax = ini_get('upload_max_filesize');
        $postMax = ini_get('post_max_size');
        $uploadMaxBytes = convert_to_bytes($uploadMax);
        $postMaxBytes = convert_to_bytes($postMax);
        return min($uploadMaxBytes, $postMaxBytes);
    }
}

if (!function_exists('media_library_max_file_size')) {
    function media_library_max_file_size() {
        if (!class_exists(\Spatie\MediaLibrary\MediaLibraryServiceProvider::class)) {
            return null;
        }
        $maxSize = config('media-library.max_file_size');
        return $maxSize ? convert_to_bytes($maxSize) : null;
    }
}

if (!function_exists('livewire_max_file_size')) {
    function livewire_max_file_size() {
        if (!class_exists(\Livewire\LivewireServiceProvider::class)) {
            return null;
        }
        $rules = config('livewire.temporary_file_upload.rules');
        if (empty($rules)) {
            return null;
        }
        foreach ((array) $rules as $rule) {
            if (is_string($rule) && str_starts_with($rule, 'max:')) {
                $maxKB = (int) str_replace('max:', '', $rule);
                return $maxKB * 1024; // Convert KB to bytes
            }
        }
        return null;
    }
}

if (!function_exists('convert_to_bytes')) {
    function convert_to_bytes($value) {
        if (is_numeric($value)) {
            return (int) $value;
        }
        $unit = strtolower(substr($value, -1));
        $number = (float) substr($value, 0, -1);
    
        switch ($unit) {
            case 'g': return $number * 1024 * 1024 * 1024;
            case 'm': return $number * 1024 * 1024;
            case 'k': return $number * 1024;
            default: return $number;
        }
    }
}

if (!function_exists('file_accept_types')) {
    function file_accept_types()
    {
        $types = [
            get_default_validation_rules(),
            get_media_library_file_types(),
            get_livewire_file_types()
        ];

        // Merge all types and remove duplicates
        $all_types = array_unique(array_merge(...array_filter($types)));

        return empty($all_types) ? null : $all_types;
    }
}

if (!function_exists('get_default_validation_rules')) {
    function get_default_validation_rules()
    {
        // Check Laravel's default validation rules
        $rules = config('validation.rules.file_types', ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx']);

        return is_array($rules) ? $rules : [];
    }
}

if (!function_exists('get_media_library_file_types')) {
    function get_media_library_file_types()
    {
        if (!class_exists(\Spatie\MediaLibrary\MediaLibraryServiceProvider::class)) {
            return [];
        }

        // Check Media Library config
        $rules = config('media-library.allowed_file_types');

        if (empty($rules)) {
            return [];
        }

        return is_array($rules) ? $rules : explode(',', $rules);
    }
}

if (!function_exists('get_livewire_file_types')) {
    function get_livewire_file_types()
    {
        if (!class_exists(\Livewire\LivewireServiceProvider::class)) {
            return [];
        }

        $rules = config('livewire.temporary_file_upload.rules');

        if (empty($rules)) {
            return [];
        }

        $types = [];
        foreach ((array) $rules as $rule) {
            if (is_string($rule) && str_starts_with($rule, 'mimes:')) {
                $types = array_merge($types, explode(',', str_replace('mimes:', '', $rule)));
            }
            if (is_string($rule) && str_starts_with($rule, 'mimetypes:')) {
                $types = array_merge($types, explode(',', str_replace('mimetypes:', '', $rule)));
            }
        }

        return $types;
    }
}

if (!function_exists('file_accept_extensions')) {
    function file_accept_extensions()
    {
        $types = file_accept_types();
        
        if (empty($types)) {
            return null;
        }

        // Convert MIME types to extensions if needed
        $extensions = [];
        foreach ($types as $type) {
            if (str_contains($type, '/')) { // It's a MIME type
                $ext = File::mimeToExtension($type);
                if ($ext) {
                    $extensions[] = $ext;
                }
            } else {
                $extensions[] = $type;
            }
        }

        return array_unique($extensions);
    }
}

if (!function_exists('file_accept_attribute')) {
    function file_accept_attribute()
    {
        $extensions = file_accept_extensions();
        
        if (empty($extensions)) {
            return '';
        }

        return implode(',', array_map(function($ext) {
            return ".{$ext}";
        }, $extensions));
    }
}

if (!function_exists('file_accept_to_extensions')) {
    function file_accept_to_extensions($accept)
    {
        if (empty($accept)) {
            return [];
        }

        $extensions = [];
        $types = explode(',', $accept);

        foreach ($types as $type) {
            $type = trim($type);

            if (str_starts_with($type, '.')) { // It's a file extension
                $extensions[] = ltrim($type, '.');
            } elseif (str_contains($type, '/')) { // It's a MIME type
                $ext = File::mimeToExtension($type);
                if ($ext) {
                    $extensions[] = $ext;
                }
            }
        }

        return array_unique($extensions);
    }
}

if (!function_exists('file_accept_to_mime_types')) {
    function file_accept_to_mime_types($accept)
    {
        if (empty($accept)) {
            return [];
        }

        $mimeTypes = [];
        $types = explode(',', $accept);

        foreach ($types as $type) {
            $type = trim($type);

            if (str_starts_with($type, '.')) { // It's a file extension
                $mime = File::extensionToMime(ltrim($type, '.'));
                if ($mime) {
                    $mimeTypes[] = $mime;
                }
            } elseif (str_contains($type, '/')) { // It's a MIME type
                $mimeTypes[] = $type;
            }
        }

        return array_unique($mimeTypes);
    }
}