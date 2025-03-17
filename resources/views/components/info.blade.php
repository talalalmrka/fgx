@props([
    'id' => null,
    'info' => null,
])
@if ($id && $info && !empty($info))
    <p id="{{ $id }}-help" class="form-info">
        {!! $info !!}
    </p>
@endif
