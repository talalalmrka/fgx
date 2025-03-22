@props([
    'media' => null,
])
@if ($media)
    @php
        $model_type = data_get($media, 'model_type', false);
    @endphp
    @if ($model_type)
        @php
            $model = $model_type::find($media->model_id);
        @endphp
        @if ($model instanceof App\Models\User)
            <a href="{{ route('dashboard.users.edit', $model) }}" title="{{ $model->name }}" class="text-xs">
                User: {{ $model->name }}
            </a>
        @elseif($model instanceof App\Models\Post)
            <a href="{{ route('dashboard.posts.edit', $model) }}" title="{{ $model->name }}" class="text-xs">
                Post: {{ $model->name }}
            </a>
        @else
            @dump($media->model)
        @endif
    @endif
@endif
