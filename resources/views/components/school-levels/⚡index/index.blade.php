<div>
   {{-- En-tête --}}
    <div class="mb-8">

        <div class="mb-2 flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-slate-400">
            <span>Administration</span>
            <span>/</span>
            <span>Niveaux scolaires</span>
        </div>

        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl dark:text-white">
            Niveaux scolaires
        </h1>

        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            Gérez les différents niveaux de votre établissement.
        </p>

    </div>


    {{-- Messages --}}
    @if (session()->has('success'))

        <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/40 dark:text-emerald-300">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="mt-0.5 h-5 w-5 shrink-0"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m4.5 12.75 6 6 9-13.5"
                />
            </svg>

            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>

        </div>

    @endif


    @if (session()->has('error'))

        <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-300">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="mt-0.5 h-5 w-5 shrink-0"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v3.75m0 3h.008v.008H12v-.008ZM10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                />
            </svg>

            <span class="text-sm font-medium">
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- Formulaire --}}
    <div class="mb-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

        {{-- En-tête du formulaire --}}
        <div class="border-b border-slate-200 px-5 py-4 sm:px-6 dark:border-slate-800">

            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">
                {{ $editingId ? 'Modifier le niveau scolaire' : 'Nouveau niveau scolaire' }}
            </h2>

            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                {{ $editingId
                    ? 'Modifiez les informations du niveau scolaire.'
                    : 'Renseignez le nom du nouveau niveau scolaire.'
                }}
            </p>

        </div>


        {{-- Formulaire --}}
        <form
            wire:submit="save"
            class="space-y-6 p-5 sm:p-6"
        >

            <div>

                <label
                    for="name"
                    class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300"
                >
                    Nom du niveau
                </label>

                <input
                    id="name"
                    type="text"
                    wire:model="name"
                    placeholder="Exemple : Collège"
                    class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-slate-500 dark:focus:ring-slate-700"
                >

                @error('name')

                    <span class="mt-1.5 block text-sm text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                @if ($editingId)

                    <button
                        type="button"
                        wire:click="cancelEdit"
                        class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                    >
                        Annuler
                    </button>

                @endif


                <button
                    type="submit"
                    class="rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-400 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200"
                >
                    {{ $editingId ? 'Mettre à jour' : 'Enregistrer' }}
                </button>

            </div>

        </form>

    </div>


    {{-- Liste des niveaux --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

        {{-- En-tête de la liste --}}
        <div class="flex flex-col gap-2 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6 dark:border-slate-800">

            <div>

                <h2 class="font-semibold text-slate-900 dark:text-white">
                    Liste des niveaux scolaires
                </h2>

                <p class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">
                    {{ $levels->count() }} niveau(x) enregistré(s)
                </p>

            </div>

        </div>


        {{-- Tableau --}}
        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 dark:bg-slate-800/60 dark:text-slate-400">

                    <tr>

                        <th class="px-5 py-3.5 font-semibold sm:px-6">
                            Niveau
                        </th>

                        <th class="px-5 py-3.5 font-semibold">
                            Classes
                        </th>

                        <th class="px-5 py-3.5 text-right font-semibold sm:px-6">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">

                    @forelse ($levels as $level)

                        <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/40">

                            {{-- Niveau --}}
                            <td class="px-5 py-4 sm:px-6">

                                <div class="font-semibold text-slate-900 dark:text-white">
                                    {{ $level->name }}
                                </div>

                            </td>


                            {{-- Classes --}}
                            <td class="px-5 py-4">

                                <span class="inline-flex min-w-8 items-center justify-center rounded-lg bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                    {{ $level->classes_count }}
                                </span>

                            </td>


                            {{-- Actions --}}
                            <td class="px-5 py-4 sm:px-6">

                                <div class="flex flex-wrap justify-end gap-2">

                                    {{-- Modifier --}}
                                    <button
                                        type="button"
                                        wire:click="edit({{ $level->id }})"
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            class="h-4 w-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"
                                            />
                                        </svg>

                                        <span class="hidden lg:inline">
                                            Modifier
                                        </span>

                                    </button>


                                    {{-- Supprimer --}}
                                    @if ($level->classes_count === 0)

                                        <button
                                            type="button"
                                            wire:click="delete({{ $level->id }})"
                                            wire:confirm="Voulez-vous vraiment supprimer ce niveau ?"
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-50 dark:border-red-900/60 dark:text-red-400 dark:hover:bg-red-950/40"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="2"
                                                stroke="currentColor"
                                                class="h-4 w-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.114-.455m-8.142 0a48.108 48.108 0 0 1 3.114-.455m0 0V4.9c0-.85.69-1.54 1.54-1.54h2.748c.85 0 1.54.69 1.54 1.54v.435m-6.09 0a48.11 48.11 0 0 1 6.09 0"
                                                />
                                            </svg>

                                            <span class="hidden lg:inline">
                                                Supprimer
                                            </span>

                                        </button>

                                    @else

                                        <span class="inline-flex items-center rounded-lg px-2 py-1.5 text-xs text-slate-400 dark:text-slate-500">
                                            Utilisé
                                        </span>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="3"
                                class="px-6 py-12 text-center"
                            >

                                <div class="mx-auto flex max-w-sm flex-col items-center">

                                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500">

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
                                                d="M3.75 6.75h16.5M6.75 6.75v12.5a2 2 0 0 0 2 2h6.5a2 2 0 0 0 2-2V6.75M8.25 6.75V4.5A1.5 1.5 0 0 1 9.75 3h4.5a1.5 1.5 0 0 1 1.5 1.5v2.25"
                                            />
                                        </svg>

                                    </div>

                                    <h3 class="font-semibold text-slate-900 dark:text-white">
                                        Aucun niveau scolaire
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Commencez par ajouter un niveau scolaire.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>