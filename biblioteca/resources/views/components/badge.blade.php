@props([
    'text',
    'color' => 'slate',
])

@php
    $colors = [
        'slate' => 'bg-slate-100 text-slate-600',
        'green' => 'bg-green-100 text-green-700',
        'red' => 'bg-red-100 text-red-700',
        'yellow' => 'bg-yellow-100 text-yellow-700',
        'blue' => 'bg-blue-100 text-blue-700',
    ];

    $colorClasses = $colors[$color] ?? $colors['slate'];
@endphp

<span
    {{ $attributes->merge([
        'class' => 'inline-flex rounded-full px-2.5 py-1 text-xs font-medium ' . $colorClasses
    ]) }}
>
    {{ $text }}
</span>