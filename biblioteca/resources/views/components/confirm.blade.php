@props([
    'id',
    'title',
    'message',
    'form',
    'confirmText' => 'Confirmar',
])

<button
    type="button"
    onclick="document.getElementById('confirm-dialog-{{ $id }}').showModal()"
    class="font-medium text-red-600 hover:text-red-800 hover:underline"
>
    Excluir
</button>

<dialog
    id="confirm-dialog-{{ $id }}"
    class="m-auto w-full max-w-md rounded-xl p-0 shadow-2xl backdrop:bg-slate-900/50"
>
    <div class="p-6">

        <div class="mb-5 flex items-start gap-4">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">
                ⚠
            </div>

            <div>
                <h2 class="text-lg font-semibold text-slate-900">
                    {{ $title }}
                </h2>

                <p class="mt-1 text-sm text-slate-600">
                    {{ $message }}
                </p>
            </div>

        </div>

        <p class="mb-6 text-sm text-slate-500">
            Essa ação não poderá ser desfeita.
        </p>

        <div class="flex justify-end gap-3">

            <button
                type="button"
                onclick="document.getElementById('confirm-dialog-{{ $id }}').close()"
                class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300"
            >
                Cancelar
            </button>

            <button
                type="submit"
                form="{{ $form }}"
                class="rounded-lg bg-red-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2"
            >
                {{ $confirmText }}
            </button>

        </div>

    </div>
</dialog>