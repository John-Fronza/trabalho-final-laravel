@props([
'title',
'description' => null,
])

<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

<div>

    <h1 class="text-3xl font-bold tracking-tight text-slate-900">
        {{ $title }}
    </h1>

    @if ($description)

        <p class="mt-2 text-slate-600">
            {{ $description }}
        </p>

    @endif

</div>

@if (isset($actions))

    <div>
        {{ $actions }}
    </div>

@endif

</div>
