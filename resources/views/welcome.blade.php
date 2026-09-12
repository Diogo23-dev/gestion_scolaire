<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ config('app.name', 'Gestion Scolaire') }}</title>

<meta name="description" content="Application moderne de gestion scolaire pour centraliser les élèves, classes, matières, inscriptions et notes.">

@vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased dark:bg-slate-950 dark:text-white">

{{-- Header --}}
<header class="border-b border-slate-200 bg-white/90 backdrop-blur dark:border-slate-800 dark:bg-slate-950/90">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="flex size-10 items-center justify-center rounded-xl bg-slate-900 text-white shadow-sm dark:bg-white dark:text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4 7v5c0 5 3.5 8 8 9 4.5-1 8-4 8-9V7l-8-4Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M12 9v6"/>
                </svg>
            </div>

            <div>
                <span class="block text-sm font-bold tracking-tight text-slate-900 dark:text-white">
                    Gestion Scolaire
                </span>
                <span class="block text-xs text-slate-500 dark:text-slate-400">
                    Administration scolaire
                </span>
            </div>
        </a>

        {{-- Navigation --}}
        <nav class="hidden items-center gap-8 md:flex">
            <a href="#fonctionnalites"
               class="text-sm font-medium text-slate-600 transition hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">
                Fonctionnalités
            </a>

            <a href="#avantages"
               class="text-sm font-medium text-slate-600 transition hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">
                Avantages
            </a>

            @auth
                <a href="{{ route('dashboard') }}"
                   class="rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100">
                    Tableau de bord
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100">
                    Se connecter
                </a>
            @endauth
        </nav>

        {{-- Mobile action --}}
        <div class="md:hidden">
            @auth
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center rounded-xl bg-slate-900 px-3.5 py-2 text-sm font-semibold text-white dark:bg-white dark:text-slate-900">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="inline-flex items-center rounded-xl bg-slate-900 px-3.5 py-2 text-sm font-semibold text-white dark:bg-white dark:text-slate-900">
                    Connexion
                </a>
            @endauth
        </div>

    </div>
</header>


<main>

    {{-- Hero --}}
    <section class="relative overflow-hidden">
        <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-28">

            <div class="grid items-center gap-14 lg:grid-cols-2">

                {{-- Hero content --}}
                <div class="max-w-2xl">

                    <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3.5 py-2 text-sm font-medium text-slate-600 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300">
                        <span class="size-2 rounded-full bg-emerald-500"></span>
                        Gestion scolaire simplifiée
                    </div>

                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl dark:text-white">
                        Gérez votre établissement
                        <span class="text-slate-500 dark:text-slate-400">
                            simplement.
                        </span>
                    </h1>

                    <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600 dark:text-slate-300">
                        Une application centralisée pour gérer les élèves, les classes,
                        les matières, les inscriptions et les notes depuis un seul espace.
                    </p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                        @auth
                            <a href="{{ route('dashboard') }}"
                               class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100">
                                Accéder au tableau de bord

                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100">
                                Commencer

                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        @endauth

                        <a href="#fonctionnalites"
                           class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                            Découvrir les fonctionnalités
                        </a>

                    </div>

                    <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-slate-500 dark:text-slate-400">
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/>
                            </svg>
                            Données centralisées
                        </span>

                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/>
                            </svg>
                            Interface responsive
                        </span>

                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/>
                            </svg>
                            Simple à utiliser
                        </span>
                    </div>
                </div>


                {{-- Dashboard preview --}}
                <div class="relative">

                    <div class="absolute -inset-4 rounded-[2rem] bg-slate-200/60 blur-2xl dark:bg-slate-800/30"></div>

                    <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900">

                        {{-- Fake browser header --}}
                        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4 dark:border-slate-800">
                            <div class="flex gap-1.5">
                                <span class="size-2.5 rounded-full bg-slate-300 dark:bg-slate-700"></span>
                                <span class="size-2.5 rounded-full bg-slate-300 dark:bg-slate-700"></span>
                                <span class="size-2.5 rounded-full bg-slate-300 dark:bg-slate-700"></span>
                            </div>

                            <div class="rounded-lg bg-slate-100 px-3 py-1.5 text-[10px] font-medium text-slate-400 dark:bg-slate-800">
                                gestion-scolaire
                            </div>

                            <div class="size-5"></div>
                        </div>

                        {{-- Fake dashboard --}}
                        <div class="p-5 sm:p-6">

                            <div class="mb-6">
                                <div class="h-3 w-32 rounded bg-slate-200 dark:bg-slate-700"></div>
                                <div class="mt-2 h-2.5 w-48 rounded bg-slate-100 dark:bg-slate-800"></div>
                            </div>

                            <div class="grid grid-cols-2 gap-3">

                                <div class="rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                                    <div class="mb-3 flex items-center justify-between">
                                        <div class="flex size-9 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-500 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19a6 6 0 0 0-12 0M9 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm9 6a6 6 0 0 0-4-5.65M15 5a4 4 0 0 1 0 7.75"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="h-5 w-12 rounded bg-slate-800 dark:bg-slate-200"></div>
                                    <div class="mt-2 h-2 w-16 rounded bg-slate-100 dark:bg-slate-700"></div>
                                </div>

                                <div class="rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                                    <div class="mb-3 flex items-center justify-between">
                                        <div class="flex size-9 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-500 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="h-5 w-10 rounded bg-slate-800 dark:bg-slate-200"></div>
                                    <div class="mt-2 h-2 w-14 rounded bg-slate-100 dark:bg-slate-700"></div>
                                </div>

                                <div class="rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                                    <div class="mb-3 flex size-9 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-500 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12M6 12h12"/>
                                        </svg>
                                    </div>
                                    <div class="h-5 w-10 rounded bg-slate-800 dark:bg-slate-200"></div>
                                    <div class="mt-2 h-2 w-16 rounded bg-slate-100 dark:bg-slate-700"></div>
                                </div>

                                <div class="rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                                    <div class="mb-3 flex size-9 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-500 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 21h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1Z"/>
                                        </svg>
                                    </div>
                                    <div class="h-5 w-10 rounded bg-slate-800 dark:bg-slate-200"></div>
                                    <div class="mt-2 h-2 w-20 rounded bg-slate-100 dark:bg-slate-700"></div>
                                </div>

                            </div>

                            <div class="mt-4 rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                                <div class="mb-4 flex items-center justify-between">
                                    <div class="h-3 w-28 rounded bg-slate-200 dark:bg-slate-700"></div>
                                    <div class="h-3 w-12 rounded bg-slate-100 dark:bg-slate-800"></div>
                                </div>

                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="size-7 rounded-full bg-slate-100 dark:bg-slate-800"></div>
                                        <div class="h-2 flex-1 rounded bg-slate-100 dark:bg-slate-800"></div>
                                        <div class="h-2 w-14 rounded bg-slate-100 dark:bg-slate-800"></div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <div class="size-7 rounded-full bg-slate-100 dark:bg-slate-800"></div>
                                        <div class="h-2 flex-1 rounded bg-slate-100 dark:bg-slate-800"></div>
                                        <div class="h-2 w-14 rounded bg-slate-100 dark:bg-slate-800"></div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <div class="size-7 rounded-full bg-slate-100 dark:bg-slate-800"></div>
                                        <div class="h-2 flex-1 rounded bg-slate-100 dark:bg-slate-800"></div>
                                        <div class="h-2 w-14 rounded bg-slate-100 dark:bg-slate-800"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- Features --}}
    <section id="fonctionnalites" class="border-y border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900/40">
        <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">

            <div class="max-w-2xl">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                    Fonctionnalités
                </p>

                <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                    Tout ce dont vous avez besoin
                </h2>

                <p class="mt-4 text-base leading-7 text-slate-600 dark:text-slate-300">
                    Les principales opérations scolaires sont regroupées dans une
                    interface unique et simple à utiliser.
                </p>
            </div>

            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                {{-- Élèves --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex size-11 items-center justify-center rounded-xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19a6 6 0 0 0-12 0M9 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm9 6a6 6 0 0 0-4-5.65M15 5a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>

                    <h3 class="mt-5 text-base font-semibold text-slate-900 dark:text-white">
                        Gestion des élèves
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Centralisez les informations des élèves et suivez leur parcours scolaire.
                    </p>
                </div>

                {{-- Classes --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex size-11 items-center justify-center rounded-xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4"/>
                        </svg>
                    </div>

                    <h3 class="mt-5 text-base font-semibold text-slate-900 dark:text-white">
                        Classes et niveaux
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Organisez facilement les classes et leurs niveaux scolaires.
                    </p>
                </div>

                {{-- Matières --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex size-11 items-center justify-center rounded-xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5Zm4 3h8M8 12h8M8 16h5"/>
                        </svg>
                    </div>

                    <h3 class="mt-5 text-base font-semibold text-slate-900 dark:text-white">
                        Matières
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Gérez les matières, leurs codes et leurs coefficients.
                    </p>
                </div>

                {{-- Inscriptions --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex size-11 items-center justify-center rounded-xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 21h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1Z"/>
                        </svg>
                    </div>

                    <h3 class="mt-5 text-base font-semibold text-slate-900 dark:text-white">
                        Inscriptions
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Associez chaque élève à sa classe et à son année scolaire.
                    </p>
                </div>

                {{-- Notes --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex size-11 items-center justify-center rounded-xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 19V5m0 14h14M9 15l3-3 2 2 4-5"/>
                        </svg>
                    </div>

                    <h3 class="mt-5 text-base font-semibold text-slate-900 dark:text-white">
                        Gestion des notes
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Enregistrez les résultats des élèves par matière et par inscription.
                    </p>
                </div>

                {{-- Dashboard --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex size-11 items-center justify-center rounded-xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5m0 14h16M8 16v-5m4 5V8m4 8v-9"/>
                        </svg>
                    </div>

                    <h3 class="mt-5 text-base font-semibold text-slate-900 dark:text-white">
                        Tableau de bord
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Visualisez rapidement les principales informations de votre établissement.
                    </p>
                </div>

            </div>
        </div>
    </section>


    {{-- Advantages --}}
    <section id="avantages">
        <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">

            <div class="grid gap-12 lg:grid-cols-2 lg:items-center">

                <div>
                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                        Pourquoi cette application ?
                    </p>

                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                        Une gestion plus simple et plus organisée
                    </h2>

                    <p class="mt-5 max-w-xl text-base leading-7 text-slate-600 dark:text-slate-300">
                        L'objectif est de réduire la dépendance aux documents papier
                        et de centraliser les informations importantes de l'établissement
                        dans une seule application.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">

                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="flex items-center gap-3">
                            <div class="flex size-9 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-600 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3"/>
                                </svg>
                            </div>

                            <span class="text-sm font-semibold text-slate-900 dark:text-white">
                                Centralisé
                            </span>
                        </div>

                        <p class="mt-3 text-sm leading-6 text-slate-500 dark:text-slate-400">
                            Toutes les informations importantes regroupées au même endroit.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="flex items-center gap-3">
                            <div class="flex size-9 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-600 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </div>

                            <span class="text-sm font-semibold text-slate-900 dark:text-white">
                                Rapide
                            </span>
                        </div>

                        <p class="mt-3 text-sm leading-6 text-slate-500 dark:text-slate-400">
                            Retrouvez rapidement les informations dont vous avez besoin.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="flex items-center gap-3">
                            <div class="flex size-9 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-600 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4 7v5c0 5 3.5 8 8 9 4.5-1 8-4 8-9V7l-8-4Z"/>
                                </svg>
                            </div>

                            <span class="text-sm font-semibold text-slate-900 dark:text-white">
                                Structuré
                            </span>
                        </div>

                        <p class="mt-3 text-sm leading-6 text-slate-500 dark:text-slate-400">
                            Une organisation claire des élèves, classes et années scolaires.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="flex items-center gap-3">
                            <div class="flex size-9 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-600 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"/>
                                </svg>
                            </div>

                            <span class="text-sm font-semibold text-slate-900 dark:text-white">
                                Évolutif
                            </span>
                        </div>

                        <p class="mt-3 text-sm leading-6 text-slate-500 dark:text-slate-400">
                            Une base conçue pour accueillir progressivement de nouvelles fonctionnalités.
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </section>


    {{-- CTA --}}
    <section class="border-t border-slate-200 dark:border-slate-800">
        <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">

            <div class="overflow-hidden rounded-3xl bg-slate-900 px-6 py-12 text-center shadow-sm dark:bg-white sm:px-12">

                <h2 class="text-3xl font-bold tracking-tight text-white dark:text-slate-900 sm:text-4xl">
                    Prêt à simplifier votre gestion scolaire ?
                </h2>

                <p class="mx-auto mt-4 max-w-2xl text-base leading-7 text-slate-300 dark:text-slate-600">
                    Accédez à votre espace de gestion et commencez à centraliser
                    les informations de votre établissement.
                </p>

                <div class="mt-8">

                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-100 dark:bg-slate-900 dark:text-white dark:hover:bg-slate-800">
                            Ouvrir le tableau de bord

                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-100 dark:bg-slate-900 dark:text-white dark:hover:bg-slate-800">
                            Se connecter

                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>
                    @endif

                </div>

            </div>
        </div>
    </section>

</main>


{{-- Footer --}}
<footer class="border-t border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-950">
    <div class="mx-auto flex max-w-7xl flex-col gap-4 px-6 py-8 sm:flex-row sm:items-center sm:justify-between lg:px-8">

        <div>
            <p class="text-sm font-semibold text-slate-900 dark:text-white">
                Gestion Scolaire
            </p>

            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                Une gestion scolaire plus simple et plus organisée.
            </p>
        </div>

        <p class="text-xs text-slate-500 dark:text-slate-400">
            © {{ date('Y') }} Gestion Scolaire. Tous droits réservés.
        </p>

    </div>
</footer>

</body>
</html>
