@props(['preview', 'class' => null, 'atts' => []])

<div {!! $attributes->merge(
    array_merge([
        'class' => css_classes(['media-item-preview', $class => $class]),
    ]),
    $atts,
) !!}>

    @if ($preview->type === 'image')
        <img alt="{{ $preview->name }}" src="{{ $preview->url }}" />
    @elseif ($preview->type === 'video')
        <video controls>
            <source src="{{ $url }}" type="{{ $mime_type }}">
            {{ __('Your browser does not support the video tag.') }}
        </video>
    @else
        <div class="flex items-center justify-center w-full h-full">
            <div class="text-center">
                <i class="icon {{ $preview->icon }} w-10 h-10"></i>
                <div class="text-xs mt-2">
                    <div class="font-semibold"> {{ $preview->name }}</div>
                    <div class="mt-1"> {{ $preview->mime_type }}</div>
                    <div class="mt-1"> {{ $preview->humanReadableSize }}</div>
                </div>
            </div>
        </div>
    @endif
</div>
