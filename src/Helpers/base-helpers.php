<?php
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;


if (!function_exists('css_classes')) {
    function css_classes(array $array)
    {
        return Arr::toCssClasses($array);
    }
}

if (!function_exists('css_styles')) {
    function css_styles(array $array)
    {
        return Arr::toCssStyles($array);
    }
}

if (!function_exists('attributes')) {
    function attributes($attributes = [])
    {
        return new ComponentAttributeBag($attributes);
    }
}

if (!function_exists('is_json')) {
    function is_json($value)
    {
        if (!is_string($value)) {
            return false;
        }
        try {
            json_decode($value);
            return json_last_error() === JSON_ERROR_NONE;
        } catch (Exception $e) {
            return false;
        }
    }
}

if (!function_exists('pre')) {
    function pre($data, $class = "")
    {
        echo "<pre class=\"$class\">";
        if (is_array($data) || is_object($data)) {
            print_r($data);
        } else {
            echo $data;
        }
        echo "</pre>";
    }
}

if (!function_exists('is_livewire')) {
    function is_livewire()
    {
        return request()->header('X-Livewire') ? true : false;
    }
}

if (!function_exists('content')) {
    function content($content = null)
    {
        if (!empty($content)) {
            if (is_string($content)) {
                echo $content;
            } elseif (is_array($content)) {
                dump($content);
            } else {
                echo gettype($content);
            }
        }
    }
}