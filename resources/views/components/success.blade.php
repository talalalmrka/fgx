@props([
    'id' => null,
])
@if (session()->has($id))
    @if (is_array(session($id)))
        @foreach (session($id) as $msg)
            <div class="flex items-center space-x-2 rtl:space-x-reverse mt-2 text-xs text-green-600 dark:text-green-500">
                @icon('bi-check')
                {{ $msg }}
            </div>
        @endforeach
    @elseif (is_string(session($id)))
        <div class="flex items-center space-x-2 rtl:space-x-reverse mt-2 text-xs text-green-600 dark:text-green-500">
            @icon('bi-check')
            {{ session($id) }}
        </div>
    @endif
@endif

@error($id)
    <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
@enderror
@error("$id.*")
    <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
@enderror
