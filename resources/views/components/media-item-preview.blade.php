@props([
    'id' => null,
    'name' => '',
    'type' => '',
    'mime_type' => '',
    'url' => '',
    'extension' => '',
    'size' => 0,
    'iconSize' => 8,
    'iconClass' => 'w-8 h-8',
    'icon' => 'bi-file',
    'class' => '',
    'atts' => [],
    'onClickDelete' => null,
])

<div {!! $attributes->merge(
    array_merge([
        'class' => css_classes(['media-item-preview', $class => $class]),
    ]),
    $atts,
) !!}>

    @if ($type == 'image')
        <img alt="{{ $name }}" src="{{ $url }}" />
    @elseif ($type == 'video')
        <video controls>
            <source src="{{ $url }}" type="{{ $mime_type }}">
            {{ __('Your browser does not support the video tag.') }}
        </video>
    @else
        <div class="flex items-center justify-center w-full h-full">
            <div class="text-center">
                @icon($icon, 'w-10 h-10 inline-block')
                <div class="text-xs mt-2">
                    <div class="font-semibold"> {{ $name }}</div>
                    <div class="mt-1"> {{ $size }}</div>
                </div>
            </div>
        </div>
    @endif

    <button type="button" x-on:click="{{ $onClickDelete }}" title="{{ __('Delete') }}" class="media-item-delete">
        @icon('bi-trash')
    </button>
</div>
