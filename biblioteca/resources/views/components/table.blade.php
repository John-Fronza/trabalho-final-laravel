<div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">

    <div class="overflow-x-auto">

        <table class="w-full text-left text-sm">

            <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-600">
                {{ $head }}
            </thead>

            <tbody class="divide-y divide-slate-200">
                {{ $slot }}
            </tbody>

        </table>

    </div>

</div>