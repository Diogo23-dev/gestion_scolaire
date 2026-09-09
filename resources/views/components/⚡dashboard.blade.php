<?php

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\SchoolYear;
use Livewire\Component;

new class extends Component
{
    public function with(): array
    {
        $activeYear = SchoolYear::where('is_active', true)->first();

        return [
            'studentsCount' => Student::count(),

            'classesCount' => SchoolClass::count(),

            'subjectsCount' => Subject::count(),

            'enrollmentsCount' => $activeYear
                ? Enrollment::where('school_year_id', $activeYear->id)->count()
                : 0,

            'gradesCount' => $activeYear
                ? Grade::whereHas('enrollment', function ($query) use ($activeYear) {
                    $query->where('school_year_id', $activeYear->id);
                })->count()
                : 0,

            'activeYear' => $activeYear,

            'recentEnrollments' => $activeYear
                ? Enrollment::with(['student', 'schoolClass'])
                    ->where('school_year_id', $activeYear->id)
                    ->latest()
                    ->take(5)
                    ->get()
                : collect(),
        ];
    }
};
?>

<div>

    <div class="flex w-full flex-1 flex-col gap-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                    <span>Administration</span>
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.21 14.77a.75.75 0 0 1 .02-1.06L10.94 10 7.23 6.29a.75.75 0 1 1 1.06-1.06l4.24 4.24a.75.75 0 0 1 0 1.06l-4.24 4.24a.75.75 0 0 1-1.06-.02Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Tableau de bord</span>
                </div>

                <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-white sm:text-3xl">
                    Tableau de bord
                </h1>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Vue d'ensemble de votre établissement scolaire.
                </p>
            </div>

            {{-- Année scolaire active --}}
            <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex size-10 items-center justify-center rounded-lg bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M5.25 5.25h13.5a1.5 1.5 0 011.5 1.5v12a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-12a1.5 1.5 0 011.5-1.5z" />
                    </svg>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        Année active
                    </p>

                    <p class="font-semibold text-slate-900 dark:text-white">
                        {{ $activeYear?->name ?? 'Aucune année active' }}
                    </p>
                </div>
            </div>
        </div>


        {{-- Statistiques principales --}}
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Élèves --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            Élèves
                        </p>

                        <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white">
                            {{ number_format($studentsCount) }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                            Élèves enregistrés
                        </p>
                    </div>

                    <div class="flex size-11 items-center justify-center rounded-xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.5a6 6 0 00-12 0M9 13.5a4.5 4.5 0 100-9 4.5 4.5 0 000 9zM21 19.5a6 6 0 00-4.5-5.66M15.75 4.72a4.5 4.5 0 010 8.56" />
                        </svg>
                    </div>
                </div>
            </div>


            {{-- Classes --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            Classes
                        </p>

                        <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white">
                            {{ number_format($classesCount) }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                            Classes disponibles
                        </p>
                    </div>

                    <div class="flex size-11 items-center justify-center rounded-xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 21h16.5M5.25 21V5.25A1.5 1.5 0 016.75 3.75h10.5a1.5 1.5 0 011.5 1.5V21M8.25 7.5h1.5M14.25 7.5h1.5M8.25 11.25h1.5M14.25 11.25h1.5M8.25 15h1.5M14.25 15h1.5" />
                        </svg>
                    </div>
                </div>
            </div>


            {{-- Matières --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            Matières
                        </p>

                        <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white">
                            {{ number_format($subjectsCount) }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                            Matières enregistrées
                        </p>
                    </div>

                    <div class="flex size-11 items-center justify-center rounded-xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 5.25A2.25 2.25 0 016.75 3h10.5a2.25 2.25 0 012.25 2.25v13.5a2.25 2.25 0 01-2.25 2.25H6.75a2.25 2.25 0 01-2.25-2.25V5.25z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 7.5h7.5M8.25 11.25h7.5M8.25 15h4.5" />
                        </svg>
                    </div>
                </div>
            </div>


            {{-- Inscriptions --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            Inscriptions
                        </p>

                        <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white">
                            {{ number_format($enrollmentsCount) }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                            Pour l'année active
                        </p>
                    </div>

                    <div class="flex size-11 items-center justify-center rounded-xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75l2 2 4-4M4.5 19.5h15M6.75 4.5h10.5A1.5 1.5 0 0118.75 6v12a1.5 1.5 0 01-1.5 1.5H6.75a1.5 1.5 0 01-1.5-1.5V6a1.5 1.5 0 011.5-1.5z" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>


        {{-- Informations complémentaires --}}
        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Année scolaire --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center gap-3">
                    <div class="flex size-10 items-center justify-center rounded-xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M5.25 5.25h13.5a1.5 1.5 0 011.5 1.5v12a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-12a1.5 1.5 0 011.5-1.5z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="font-semibold text-slate-900 dark:text-white">
                            Année scolaire
                        </h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Période actuellement active
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">
                        {{ $activeYear?->name ?? 'Non définie' }}
                    </p>

                    @if ($activeYear)
                        <div class="mt-3 flex flex-wrap gap-2 text-sm text-slate-500 dark:text-slate-400">
                            <span>
                                Du {{ $activeYear->starts_at?->format('d/m/Y') }}
                            </span>
                            <span>•</span>
                            <span>
                                Au {{ $activeYear->ends_at?->format('d/m/Y') }}
                            </span>
                        </div>
                    @else
                        <p class="mt-3 text-sm text-amber-600 dark:text-amber-400">
                            Aucune année scolaire active.
                        </p>
                    @endif
                </div>
            </div>


            {{-- Notes --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center gap-3">
                    <div class="flex size-10 items-center justify-center rounded-xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 5.25A2.25 2.25 0 016.75 3h10.5a2.25 2.25 0 012.25 2.25v13.5a2.25 2.25 0 01-2.25 2.25H6.75a2.25 2.25 0 01-2.25-2.25V5.25z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 8.25h7.5M8.25 12h7.5M8.25 15.75h4.5" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="font-semibold text-slate-900 dark:text-white">
                            Notes enregistrées
                        </h2>

                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Pour l'année scolaire active
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex items-end gap-2">
                    <span class="text-3xl font-bold text-slate-900 dark:text-white">
                        {{ number_format($gradesCount) }}
                    </span>

                    <span class="mb-1 text-sm text-slate-500 dark:text-slate-400">
                        notes
                    </span>
                </div>
            </div>


            {{-- État du système --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center gap-3">
                    <div class="flex size-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="font-semibold text-slate-900 dark:text-white">
                            État du système
                        </h2>

                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Fonctionnement général
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-sm font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                        <span class="size-2 rounded-full bg-emerald-500"></span>
                        Système opérationnel
                    </span>
                </div>
            </div>

        </div>


        {{-- Dernières inscriptions --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

            <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">
                <div>
                    <h2 class="font-semibold text-slate-900 dark:text-white">
                        Dernières inscriptions
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Les dernières inscriptions de l'année scolaire active.
                    </p>
                </div>
            </div>

            @if ($recentEnrollments->isNotEmpty())

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 dark:bg-slate-800/60 dark:text-slate-400">
                            <tr>
                                <th class="px-6 py-4 font-semibold">
                                    Élève
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Matricule
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Classe
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Date
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                            @foreach ($recentEnrollments as $enrollment)
                                <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/40">

                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex size-9 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                                {{ strtoupper(substr($enrollment->student->first_name, 0, 1)) }}
                                            </div>

                                            <div>
                                                <p class="font-medium text-slate-900 dark:text-white">
                                                    {{ $enrollment->student->first_name }}
                                                    {{ $enrollment->student->last_name }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-slate-500 dark:text-slate-400">
                                        {{ $enrollment->student->matricule }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                            {{ $enrollment->schoolClass->name }}
                                        </span>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-slate-500 dark:text-slate-400">
                                        {{ $enrollment->created_at->format('d/m/Y') }}
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            @else

                <div class="flex flex-col items-center justify-center px-6 py-12 text-center">

                    <div class="flex size-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400">
                        <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.5a6 6 0 00-12 0M9 13.5a4.5 4.5 0 100-9 4.5 4.5 0 000 9zM21 19.5a6 6 0 00-4.5-5.66M15.75 4.72a4.5 4.5 0 010 8.56" />
                        </svg>
                    </div>

                    <h3 class="mt-4 font-semibold text-slate-900 dark:text-white">
                        Aucune inscription
                    </h3>

                    <p class="mt-1 max-w-md text-sm text-slate-500 dark:text-slate-400">
                        Aucune inscription n'a encore été enregistrée pour l'année scolaire active.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>