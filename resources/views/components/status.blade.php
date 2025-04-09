@props([
    'id' => 'status',
    'class' => '',
    'soft' => false,
    'outline' => false,
    'size' => null,
    'atts' => [],
])
@php
    $soft = $soft ?? $attributes->has('soft');
    $outline = $outline ?? $attributes->has('outline');
    $atts = array_merge($attributes->getAttributes(), $atts);
    $successMessage = session()->has($id) ? session($id) : null;
@endphp
@if ($successMessage)
    @if (is_array($successMessage))
        @foreach ($successMessage as $msg)
            @component('fgx::components.alert', [
                'type' => 'success',
                'class' => $class,
                'soft' => $soft,
                'outline' => $outline,
                'size' => $size,
                'atts' => $atts,
                'content' => $msg,
            ])
            @endcomponent
        @endforeach
    @elseif (is_string($successMessage))
        @component('fgx::components.alert', [
            'type' => 'success',
            'class' => $class,
            'soft' => $soft,
            'outline' => $outline,
            'size' => $size,
            'atts' => $atts,
            'content' => $successMessage,
        ])
        @endcomponent
    @endif
@endif

@error($id)
    @if (is_array($message))
        @foreach ($message as $emsg)
            @component('fgx::components.alert', [
                'type' => 'error',
                'class' => $class,
                'soft' => $soft,
                'outline' => $outline,
                'size' => $size,
                'atts' => $atts,
                'content' => $emsg,
            ])
            @endcomponent
        @endforeach
    @elseif(is_string($message))
        @component('fgx::components.alert', [
            'type' => 'error',
            'class' => $class,
            'soft' => $soft,
            'outline' => $outline,
            'size' => $size,
            'atts' => $atts,
            'content' => $message,
        ])
        @endcomponent
    @endif
@enderror

@error("$id.*")
    @if (is_array($message))
        @foreach ($message as $emsg)
            @component('fgx::components.alert', [
                'type' => 'error',
                'class' => $class,
                'soft' => $soft,
                'outline' => $outline,
                'size' => $size,
                'atts' => $atts,
                'content' => $emsg,
            ])
            @endcomponent
        @endforeach
    @elseif(is_string($message))
        @component('fgx::components.alert', [
            'type' => 'error',
            'class' => $class,
            'soft' => $soft,
            'outline' => $outline,
            'size' => $size,
            'atts' => $atts,
            'content' => $message,
        ])
        @endcomponent
    @endif
@enderror
