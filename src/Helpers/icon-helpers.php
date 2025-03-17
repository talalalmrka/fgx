<?php
if (!function_exists('get_icon')) {
    function get_icon($class = null)
    {
        return !empty($class) ? '<i class="icon ' . $class . '"></i>' : '';
    }
}
if (!function_exists('icon')) {
    function icon($class = null)
    {
        echo get_icon($class);
    }
}
