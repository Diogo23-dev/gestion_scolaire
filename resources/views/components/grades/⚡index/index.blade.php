<div>

{{-- En-tête --}}
<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>
        <div class="mb-2 flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-slate-400">
            <span>Administration</span>
            <span>/</span>
            <span>Notes</span>
        </div>

        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl dark:text-white">
            Gestion des notes
        </h1>

        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            Saisissez et gérez les notes des élèves par matière.
        </p>
    </div>

</div>


{{-- Message de succès --}}
@if (session()->has('success'))
    <div
        class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/40 dark:text-emerald-300"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            class="mt-0.5 h-5 w-5 shrink-0"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
        </svg>

        <span class="text-sm font-medium">
            {{ session('success') }}
        </span>
    </div>
@endif


{{-- Sélection --}}
<div
    class="mb-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
>

    <div class="border-b border-slate-200 px-5 py-4 sm:px-6 dark:border-slate-800">

        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">
            Sélection
        </h2>

        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            Sélectionnez l'année, la classe et la matière à évaluer.
        </p>

    </div>


    <div class="grid gap-6 p-5 sm:p-6 md:grid-cols-3">

        {{-- Année scolaire --}}
        <div>

            <label
                for="school_year_id"
                class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300"
            >
                Année scolaire
            </label>

            <select
                id="school_year_id"
                wire:model.live="school_year_id"
                class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-slate-500 dark:focus:ring-slate-700"
            >

                <option value="">
                    Sélectionner une année
                </option>

                @foreach ($schoolYears as $schoolYear)
                    <option value="{{ $schoolYear->id }}">
                        {{ $schoolYear->name }}
                        @if ($schoolYear->is_active)
                            — Active
                        @endif
                    </option>
                @endforeach

            </select>

            @error('school_year_id')
                <span class="mt-1.5 block text-sm text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror

        </div>


        {{-- Classe --}}
        <div>

            <label
                for="class_id"
                class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300"
            >
                Classe
            </label>

            <select
                id="class_id"
                wire:model.live="class_id"
                @disabled(!$school_year_id)
                class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-400 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-slate-500 dark:focus:ring-slate-700 dark:disabled:bg-slate-800/50 dark:disabled:text-slate-500"
            >

                <option value="">
                    Sélectionner une classe
                </option>

                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">
                        {{ $class->name }}
                        @if ($class->level)
                            — {{ $class->level->name }}
                        @endif
                    </option>
                @endforeach

            </select>

            @error('class_id')
                <span class="mt-1.5 block text-sm text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror

        </div>


        {{-- Matière --}}
        <div>

            <label
                for="subject_id"
                class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300"
            >
                Matière
            </label>

            <select
                id="subject_id"
                wire:model.live="subject_id"
                @disabled(!$class_id)
                class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-400 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-slate-500 dark:focus:ring-slate-700 dark:disabled:bg-slate-800/50 dark:disabled:text-slate-500"
            >

                <option value="">
                    Sélectionner une matière
                </option>

                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">
                        {{ $subject->name }}
                        — Coef. {{ $subject->coefficient }}
                    </option>
                @endforeach

            </select>

            @error('subject_id')
                <span class="mt-1.5 block text-sm text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror

        </div>

    </div>

</div>


{{-- Saisie des notes --}}
@if ($school_year_id && $class_id && $subject_id)

    <div
        class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
    >

        {{-- En-tête --}}
        <div
            class="flex flex-col gap-2 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6 dark:border-slate-800"
        >

            <div>

                <h2 class="font-semibold text-slate-900 dark:text-white">
                    Saisie des notes
                </h2>

                <p class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">
                    {{ $students->count() }} élève(s) à évaluer
                </p>

            </div>

            <div class="text-sm text-slate-500 dark:text-slate-400">
                Note sur <span class="font-semibold text-slate-700 dark:text-slate-200">20</span>
            </div>

        </div>


        @if ($students->count())

            <form wire:submit="save">

                <div class="overflow-x-auto">

                    <table class="w-full text-left text-sm">

                        <thead
                            class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 dark:bg-slate-800/60 dark:text-slate-400"
                        >

                            <tr>

                                <th class="px-5 py-3.5 font-semibold sm:px-6">
                                    Élève
                                </th>

                                <th class="hidden px-5 py-3.5 font-semibold sm:table-cell sm:px-6">
                                    Matricule
                                </th>

                                <th class="hidden px-5 py-3.5 font-semibold sm:table-cell sm:px-6">
                                    Classe
                                </th>

                                <th class="px-5 py-3.5 font-semibold">
                                    Note
                                </th>

                                <th class="px-5 py-3.5 text-right font-semibold sm:px-6">
                                    Statut
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-200 dark:divide-slate-800">

                            @foreach ($students as $student)

                                <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/40">

                                    {{-- Élève --}}
                                    <td class="whitespace-nowrap px-5 py-4 sm:px-6">

                                        <div class="font-semibold text-slate-900 dark:text-white">
                                            {{ $student->last_name }}
                                            {{ $student->first_name }}
                                        </div>

                                        <div class="mt-1 text-xs text-slate-500 sm:hidden dark:text-slate-400">
                                            {{ $student->matricule }}
                                        </div>

                                    </td>


                                    {{-- Matricule --}}
                                    <td class="hidden whitespace-nowrap px-5 py-4 text-slate-600 sm:table-cell sm:px-6 dark:text-slate-300">

                                        {{ $student->matricule }}

                                    </td>
                                    
                                    {{-- Classe --}}
                                    <td class="hidden whitespace-nowrap px-5 py-4 text-slate-600 sm:table-cell sm:px-6 dark:text-slate-300">

                                        {{ $classes->firstWhere('id', $class_id)?->name }}

                                    </td>

                                    {{-- Note --}}
                                    <td class="px-5 py-4">

                                        <input
                                            type="number"
                                            min="0"
                                            max="20"
                                            step="0.01"
                                            wire:model="grades.{{ $student->id }}"
                                            placeholder="—"
                                            class="w-28 rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-slate-500 dark:focus:ring-slate-700"
                                        >

                                        @error('grades.' . $student->id)
                                            <span class="mt-1 block text-xs text-red-600 dark:text-red-400">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </td>


                                    {{-- Statut --}}
                                    <td class="px-5 py-4 text-right sm:px-6">

                                        @if (($grades[$student->id] ?? '') !== '')

                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400"
                                            >
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                Saisie
                                            </span>

                                        @else

                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-400"
                                            >
                                                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                                Non saisie
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Actions --}}
                <div
                    class="flex flex-col gap-3 border-t border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-end sm:px-6 dark:border-slate-800"
                >

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200 dark:focus:ring-slate-600 dark:focus:ring-offset-slate-950"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 12.75 10.5 18.75 19.5 5.25"
                            />
                        </svg>

                        Enregistrer les notes

                    </button>

                </div>

            </form>

        @else

            {{-- Aucun élève --}}
            <div class="px-6 py-12 text-center">

                <div class="mx-auto flex max-w-sm flex-col items-center">

                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 3.5.672A9.375 9.375 0 0 0 21.75 18c0-1.035-.126-2.04-.36-3m-6.39 4.128A9.38 9.38 0 0 1 12 20.25a9.38 9.38 0 0 1-3-.522m6.39-.6a9.38 9.38 0 0 0 0-14.256m0 14.256A9.38 9.38 0 0 1 12 20.25a9.38 9.38 0 0 1-3-.522m3-14.978a9.38 9.38 0 0 1 3 .522m-3-.522a9.38 9.38 0 0 0-3 .522m3-.522V3.75m0 1.522A9.38 9.38 0 0 0 8.25 9m7.5-3.728A9.38 9.38 0 0 1 15.75 9"
                            />
                        </svg>

                    </div>

                    <h3 class="font-semibold text-slate-900 dark:text-white">
                        Aucun élève inscrit
                    </h3>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Aucun élève n'est inscrit dans cette classe pour l'année sélectionnée.
                    </p>

                </div>

            </div>

        @endif

    </div>

@else

    {{-- État initial --}}
    <div
        class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-12 text-center dark:border-slate-700 dark:bg-slate-900/50"
    >

        <div class="mx-auto flex max-w-sm flex-col items-center">

            <div
                class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white text-slate-400 shadow-sm dark:bg-slate-800 dark:text-slate-500"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-6 w-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6v12m6-6H6"
                    />
                </svg>

            </div>

            <h3 class="font-semibold text-slate-900 dark:text-white">
                Prêt pour la saisie
            </h3>

            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Sélectionnez une année scolaire, une classe et une matière pour commencer.
            </p>

        </div>

    </div>

@endif

</div>
