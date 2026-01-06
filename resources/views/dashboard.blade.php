<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@php
                                                $pourcentage = $billet->quantite_totale > 0
                                                    ? ($billet->quantite_vendue / $billet->quantite_totale) * 100
                                                    : 0;
                                            @endphp
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between small text-muted mb-1">
                                                    <span><i class="bi bi-graph-up"></i> {{ number_format($billet->quantite_vendue) }} vendus</span>
                                                    <span>{{ number_format($pourcentage, 0) }}%</span>
                                                </div>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-purple"
                                                         role="progressbar"
                                                         style="width: {{ $pourcentage }}%"
                                                         aria-valuenow="{{ $pourcentage }}"
                                                         aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
