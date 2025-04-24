@props([
    'error' => false,
    'editable' => true,
    'type' => 'text',
])

<div class="flex flex-col space-y-1">
    <label class="text-xs font-sm">{{ $slot }}</label>
    <input
        {{ $attributes->merge([
            'class' => 'px-2 py-1 text-xs border rounded text-gray-500',
            'type' => $type,
        ]) }}
        @if(!$editable) readonly @endif
    >
    <x-error :error="$error" />
</div>
