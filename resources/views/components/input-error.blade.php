@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'space-y-1 mt-2']) }}>
        @foreach ((array) $messages as $message)
            <li class="text-sm text-red-400">{{ $message }}</li>
        @endforeach
    </ul>
@endif
