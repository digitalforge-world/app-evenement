@extends('layouts.Obase')
@section('title', '| Gestion des Billets')
@section('content')

<div class="container mx-auto px-4 py-8 max-w-7xl">
    <!-- En-tête -->
    <div class="text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-bold text-purple-700 mb-4">Gestion des Billets</h1>
        <div class="flex items-center justify-center mb-4">
            <div class="flex-1 max-w-28 h-1 bg-purple-700 rounded-full"></div>
            <div class="mx-4 text-purple-700 text-3xl">
                <i class="bi bi-ticket-detailed"></i>
            </div>
            <div class="flex-1 max-w-28 h-1 bg-purple-700 rounded-full"></div>
        </div>
        <p class="text-lg text-gray-600">Visualisez et gérez tous vos billets par événement</p>
    </div>

    <!-- Statistiques globales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total événements -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Total Événements</p>
                    <h3 class="text-3xl font-bold">{{ $statsGlobales['total_evenements'] }}</h3>
                    <p class="text-blue-100 text-xs mt-2">
                        <i class="bi bi-calendar-event"></i> {{ $statsGlobales['evenements_futurs'] }} à venir
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <i class="bi bi-calendar-check text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Billets vendus -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Billets Vendus</p>
                    <h3 class="text-3xl font-bold">{{ number_format($statsGlobales['total_billets_vendus']) }}</h3>
                    <p class="text-green-100 text-xs mt-2">
                        <i class="bi bi-ticket-perforated"></i> {{ number_format($statsGlobales['total_billets_disponibles']) }} disponibles
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <i class="bi bi-graph-up-arrow text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Chiffre d'affaires -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-1">Chiffre d'Affaires</p>
                    <h3 class="text-3xl font-bold">{{ number_format($statsGlobales['chiffre_affaires_total']) }}</h3>
                    <p class="text-purple-100 text-xs mt-2">
                        <i class="bi bi-currency-exchange"></i> FCFA
                    </p>
                </div>
                <div class="bg-white/20 rounded-full p-4">
                    <i class="bi bi-cash-stack text-3xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Onglets -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="flex space-x-8" aria-label="Tabs">
                <button onclick="showTab('futurs')" id="tab-futurs" class="tab-button active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    <i class="bi bi-calendar-plus mr-2"></i>Événements à venir ({{ $evenementsFuturs->count() }})
                </button>
                <button onclick="showTab('passes')" id="tab-passes" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    <i class="bi bi-calendar-check mr-2"></i>Événements passés ({{ $evenementsPasses->count() }})
                </button>
            </nav>
        </div>
    </div>

    <!-- Événements à venir -->
    <div id="content-futurs" class="tab-content">
        @forelse($evenementsFuturs as $evenement)
            <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="grid lg:grid-cols-12 gap-0">
                    <!-- Image de l'événement -->
                    <div class="lg:col-span-4">
                        <div class="relative h-64 lg:h-full">
                            @if($evenement->photo)
                                <img src="{{ asset('storage/evenement/photo/' . $evenement->photo) }}"
                                     alt="{{ $evenement->titre }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                                    <i class="bi bi-calendar-event text-white text-6xl"></i>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                <i class="bi bi-clock"></i> À venir
                            </div>
                        </div>
                    </div>

                    <!-- Informations de l'événement -->
                    <div class="lg:col-span-8 p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $evenement->titre }}</h2>
                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-3">
                                    <span class="flex items-center">
                                        <i class="bi bi-calendar3 mr-1 text-purple-600"></i>
                                        {{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="bi bi-clock mr-1 text-purple-600"></i>
                                        {{ $evenement->start_heure }} - {{ $evenement->end_heure }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="bi bi-geo-alt mr-1 text-purple-600"></i>
                                        {{ $evenement->lieu }}
                                    </span>
                                </div>
                                <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                                    {{ $evenement->categorie }}
                                </span>
                            </div>
                        </div>

                        <!-- Statistiques des billets -->
                        @if($evenement->billets->count() > 0)
                            @php
                                $totalBillets = $evenement->billets->sum('quantite_totale');
                                $billetsVendus = $evenement->billets->sum('quantite_vendue');
                                $billetsDisponibles = $evenement->billets->sum('quantite_disponible');
                                $tauxVente = $totalBillets > 0 ? ($billetsVendus / $totalBillets) * 100 : 0;
                                $ca = $evenement->billets->sum(function($b) { return $b->quantite_vendue * $b->prix; });
                            @endphp

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                <div class="bg-blue-50 rounded-lg p-3">
                                    <p class="text-xs text-blue-600 mb-1">Total billets</p>
                                    <p class="text-xl font-bold text-blue-700">{{ number_format($totalBillets) }}</p>
                                </div>
                                <div class="bg-green-50 rounded-lg p-3">
                                    <p class="text-xs text-green-600 mb-1">Vendus</p>
                                    <p class="text-xl font-bold text-green-700">{{ number_format($billetsVendus) }}</p>
                                </div>
                                <div class="bg-orange-50 rounded-lg p-3">
                                    <p class="text-xs text-orange-600 mb-1">Disponibles</p>
                                    <p class="text-xl font-bold text-orange-700">{{ number_format($billetsDisponibles) }}</p>
                                </div>
                                <div class="bg-purple-50 rounded-lg p-3">
                                    <p class="text-xs text-purple-600 mb-1">CA</p>
                                    <p class="text-lg font-bold text-purple-700">{{ number_format($ca) }} F</p>
                                </div>
                            </div>

                            <!-- Barre de progression -->
                            <div class="mb-4">
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">Taux de vente</span>
                                    <span class="font-semibold text-gray-800">{{ number_format($tauxVente, 1) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2.5 rounded-full transition-all duration-500"
                                         style="width: {{ $tauxVente }}%"></div>
                                </div>
                            </div>

                            <!-- Liste des types de billets -->
                            <div class="border-t pt-4 mt-4">
                                <p class="text-sm font-semibold text-gray-700 mb-3">Types de billets ({{ $evenement->billets->count() }})</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($evenement->billets as $billet)
                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                            {{ $billet->type }} - {{ number_format($billet->prix) }} F
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <p class="text-yellow-800 text-sm">
                                    <i class="bi bi-exclamation-triangle mr-2"></i>
                                    Aucun billet n'a été créé pour cet événement
                                </p>
                            </div>
                        @endif

                        <!-- Bouton voir détails -->
                        <div class="mt-4">
                            <a href="{{ route('organisateur.event-detail-billets', $evenement->id) }}"
                               class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors duration-200">
                                <i class="bi bi-eye mr-2"></i>
                                Voir tous les billets
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-gray-50 rounded-xl p-12 text-center">
                <i class="bi bi-calendar-x text-6xl text-gray-400 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucun événement à venir</h3>
                <p class="text-gray-500">Créez un nouvel événement pour commencer</p>
            </div>
        @endforelse
    </div>

    <!-- Événements passés -->
    <div id="content-passes" class="tab-content hidden">
        @forelse($evenementsPasses as $evenement)
            <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden hover:shadow-xl transition-shadow duration-300 opacity-90">
                <div class="grid lg:grid-cols-12 gap-0">
                    <!-- Image de l'événement -->
                    <div class="lg:col-span-4">
                        <div class="relative h-64 lg:h-full">
                            @if($evenement->photo)
                                <img src="{{ asset('storage/evenement/photo/' . $evenement->photo) }}"
                                     alt="{{ $evenement->titre }}"
                                     class="w-full h-full object-cover grayscale-0 hover:grayscale transition-all">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center">
                                    <i class="bi bi-calendar-event text-white text-6xl"></i>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4 bg-gray-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                <i class="bi bi-check-circle"></i> Terminé
                            </div>
                        </div>
                    </div>

                    <!-- Informations de l'événement -->
                    <div class="lg:col-span-8 p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $evenement->titre }}</h2>
                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-3">
                                    <span class="flex items-center">
                                        <i class="bi bi-calendar3 mr-1 text-gray-600"></i>
                                        {{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="bi bi-geo-alt mr-1 text-gray-600"></i>
                                        {{ $evenement->lieu }}
                                    </span>
                                </div>
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">
                                    {{ $evenement->categorie }}
                                </span>
                            </div>
                        </div>

                        <!-- Statistiques des billets -->
                        @if($evenement->billets->count() > 0)
                            @php
                                $totalBillets = $evenement->billets->sum('quantite_totale');
                                $billetsVendus = $evenement->billets->sum('quantite_vendue');
                                $tauxVente = $totalBillets > 0 ? ($billetsVendus / $totalBillets) * 100 : 0;
                                $ca = $evenement->billets->sum(function($b) { return $b->quantite_vendue * $b->prix; });
                            @endphp

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-600 mb-1">Total billets</p>
                                    <p class="text-xl font-bold text-gray-700">{{ number_format($totalBillets) }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-600 mb-1">Vendus</p>
                                    <p class="text-xl font-bold text-gray-700">{{ number_format($billetsVendus) }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-600 mb-1">Taux de vente</p>
                                    <p class="text-xl font-bold text-gray-700">{{ number_format($tauxVente, 1) }}%</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-600 mb-1">CA total</p>
                                    <p class="text-lg font-bold text-gray-700">{{ number_format($ca) }} F</p>
                                </div>
                            </div>

                            <!-- Barre de progression -->
                            <div class="mb-4">
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-gradient-to-r from-gray-400 to-gray-600 h-2.5 rounded-full"
                                         style="width: {{ $tauxVente }}%"></div>
                                </div>
                            </div>
                        @endif

                        <!-- Bouton voir détails -->
                        <div class="mt-4">
                            <a href="{{ route('organisateur.event-detail-billets', $evenement->id) }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors duration-200">
                                <i class="bi bi-eye mr-2"></i>
                                Voir tous les billets
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-gray-50 rounded-xl p-12 text-center">
                <i class="bi bi-calendar-x text-6xl text-gray-400 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucun événement passé</h3>
            </div>
        @endforelse
    </div>
</div>

<script>
function showTab(tabName) {
    // Masquer tous les contenus
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });

    // Retirer la classe active de tous les boutons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-purple-600', 'text-purple-600');
        button.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
    });

    // Afficher le contenu sélectionné
    document.getElementById('content-' + tabName).classList.remove('hidden');

    // Activer le bouton correspondant
    const activeButton = document.getElementById('tab-' + tabName);
    activeButton.classList.add('active', 'border-purple-600', 'text-purple-600');
    activeButton.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
}

// Initialiser les styles des tabs
document.addEventListener('DOMContentLoaded', function() {
    showTab('futurs');
});
</script>

<style>
.tab-button {
    transition: all 0.3s ease;
}

.tab-button.active {
    border-color: rgb(126, 34, 206);
    color: rgb(126, 34, 206);
}

.tab-button:not(.active) {
    border-color: transparent;
    color: rgb(107, 114, 128);
}

.tab-button:not(.active):hover {
    color: rgb(55, 65, 81);
    border-color: rgb(209, 213, 219);
}
</style>

@endsection
