@props([
    'text',
    'href' => null,
    'color' => 'slate',
    'type' => 'button',
])

@php
    $colors = [
        'slate' => 'bg-slate-800 hover:bg-slate-700 focus:ring-slate-400',
        'red' => 'bg-red-600 hover:bg-red-700 focus:ring-red-400',
        'green' => 'bg-green-600 hover:bg-green-700 focus:ring-green-400',
    ];

    $colorClasses = $colors[$color] ?? $colors['slate'];
@endphp

@if ($href)

    <a
        href="{{ $href }}"
        {{ $attributes->merge([
            'class' => 'inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-medium text-white shadow-sm transition focus:outline-none focus:ring-2 focus:ring-offset-2 ' . $colorClasses
        ]) }}
    >
        {{ $text }}
    </a>

@else

    <button
        type="{{ $type }}"
        {{ $attributes->merge([
            'class' => 'inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-medium text-white shadow-sm transition focus:outline-none focus:ring-2 focus:ring-offset-2 ' . $colorClasses
        ]) }}
    >
        {{ $text }}
    </button>

@endif