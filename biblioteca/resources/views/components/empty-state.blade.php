@props([
    'title',
    'message',
])

<div class="rounded-xl border border-slate-200 bg-white p-8 text-center shadow-sm">

    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-2xl">
        📭
    </div>

    <h2 class="text-lg font-semibold text-slate-900">
        {{ $title }}
    </h2>

    <p class="mt-2 text-sm text-slate-600">
        {{ $message }}
    </p>

</div>