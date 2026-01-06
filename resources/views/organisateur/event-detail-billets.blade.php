@extends('layouts.Obase')
@section('title', '| Détails des Billets')
@section('content')

<div class="container mx-auto px-4 py-8 max-w-7xl">
    <!-- Bouton retour -->
    <div class="mb-6">
        <a href="{{ route('organisateur.billet-all') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium">
            <i class="bi bi-arrow-left mr-2"></i> Retour à la liste
        </a>
    </div>

    <!-- En-tête de l'événement -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
        <div class="grid lg:grid-cols-12 gap-0">
            <!-- Image -->
            <div class="lg:col-span-5">
                <div class="relative h-96">
                    @if($evenement->photo)
                        <img src="{{ asset('storage/evenement/photo/' . $evenement->photo) }}"
                             alt="{{ $evenement->titre }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                            <i class="bi bi-calendar-event text-white text-8xl"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>

                    <!-- Badges de statut -->
                    <div class="absolute top-4 right-4 flex gap-2">
                        @if(\Carbon\Carbon::parse($evenement->date)->isFuture())
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                <i class="bi bi-clock"></i> À venir
                            </span>
                        @else
                            <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                <i class="bi bi-check-circle"></i> Terminé
                            </span>
                        @endif
                        <span class="bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            {{ $evenement->statut }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Informations -->
            <div class="lg:col-span-7 p-8">
                <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold mb-3">
                    {{ $evenement->categorie }}
                </span>
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $evenement->titre }}</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="flex items-start">
                        <i class="bi bi-calendar3 text-purple-600 text-xl mr-3 mt-1"></i>
                        <div>
                            <p class="text-sm text-gray-600">Date</p>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-clock text-purple-600 text-xl mr-3 mt-1"></i>
                        <div>
                            <p class="text-sm text-gray-600">Horaire</p>
                            <p class="font-semibold">{{ $evenement->start_heure }} - {{ $evenement->end_heure }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-geo-alt text-purple-600 text-xl mr-3 mt-1"></i>
                        <div>
                            <p class="text-sm text-gray-600">Lieu</p>
                            <p class="font-semibold">{{ $evenement->lieu }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-person text-purple-600 text-xl mr-3 mt-1"></i>
                        <div>
                            <p class="text-sm text-gray-600">Organisateur</p>
                            <p class="font-semibold">{{ $evenement->nom_proprietaire }}</p>
                        </div>
                    </div>
                </div>

                @if($evenement->description)
                    <div class="mt-4">
                        <p class="text-gray-700 leading-relaxed">{{ Str::limit($evenement->description, 200) }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Statistiques de l'événement -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm mb-1">Total Billets</p>
                    <h3 class="text-3xl font-bold">{{ number_format($statsEvenement['total_billets']) }}</h3>
                </div>
                <div class="bg-white/20 rounded-full p-3">
                    <i class="bi bi-ticket-perforated text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm mb-1">Billets Vendus</p>
                    <h3 class="text-3xl font-bold">{{ number_format($statsEvenement['billets_vendus']) }}</h3>
                </div>
                <div class="bg-white/20 rounded-full p-3">
                    <i class="bi bi-check2-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm mb-1">Disponibles</p>
                    <h3 class="text-3xl font-bold">{{ number_format($statsEvenement['billets_disponibles']) }}</h3>
                </div>
                <div class="bg-white/20 rounded-full p-3">
                    <i class="bi bi-box-seam text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm mb-1">Chiffre d'Affaires</p>
                    <h3 class="text-2xl font-bold">{{ number_format($statsEvenement['chiffre_affaires']) }}</h3>
                    <p class="text-purple-100 text-xs">FCFA</p>
                </div>
                <div class="bg-white/20 rounded-full p-3">
                    <i class="bi bi-cash-stack text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Taux de vente -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-800">Taux de Vente Global</h3>
            <span class="text-3xl font-bold text-purple-600">{{ $statsEvenement['taux_vente'] }}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-4 rounded-full transition-all duration-1000 flex items-center justify-end pr-2"
                 style="width: {{ $statsEvenement['taux_vente'] }}%">
                @if($statsEvenement['taux_vente'] > 10)
                    <span class="text-white text-xs font-bold">{{ $statsEvenement['taux_vente'] }}%</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Liste détaillée des billets -->
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">
            <i class="bi bi-ticket-detailed text-purple-600 mr-2"></i>
            Détails des Billets ({{ $evenement->billets->count() }})
        </h2>
        <a href="{{ route('organisateur.billet-form') }}"
           class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors">
            <i class="bi bi-plus-circle mr-2"></i> Ajouter un billet
        </a>
    </div>

    @if($evenement->billets->count() > 0)
        <div class="grid gap-6">
            @foreach($evenement->billets as $billet)
                @php
                    $pourcentageVendu = $billet->quantite_totale > 0
                        ? ($billet->quantite_vendue / $billet->quantite_totale) * 100
                        : 0;
                    $caType = $billet->quantite_vendue * $billet->prix;
                    $canDelete = $billet->quantite_vendue == 0; // Peut supprimer seulement si aucun billet vendu
                @endphp

                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-4">
                            <div class="flex items-center mb-4 lg:mb-0">
                                <div class="bg-purple-100 rounded-full p-4 mr-4">
                                    <i class="bi bi-ticket-perforated text-purple-600 text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $billet->type }}</h3>
                                    <p class="text-purple-600 font-semibold text-lg">{{ number_format($billet->prix) }} FCFA</p>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <!-- BOUTON MODIFIER - MAINTENANT FONCTIONNEL -->
                                <a href="{{ route('organisateur.edit-billet', $billet->id) }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                                    <i class="bi bi-pencil mr-2"></i> Modifier
                                </a>

                                <!-- BOUTON SUPPRIMER - MAINTENANT FONCTIONNEL -->
                                <form action="{{ route('organisateur.delete-billet', $billet->id) }}"
                                      method="POST"
                                      onsubmit="return confirmDeleteBillet(event, '{{ $billet->type }}', {{ $billet->quantite_vendue }});"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 {{ $canDelete ? 'bg-red-600 hover:bg-red-700' : 'bg-gray-400 cursor-not-allowed' }} text-white rounded-lg transition-colors"
                                            {{ !$canDelete ? 'disabled' : '' }}
                                            @if(!$canDelete) title="Impossible de supprimer un billet déjà vendu" @endif>
                                        <i class="bi bi-trash mr-2"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Statistiques du billet -->
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <p class="text-xs text-gray-600 mb-1">Total</p>
                                <p class="text-2xl font-bold text-gray-800">{{ number_format($billet->quantite_totale) }}</p>
                            </div>
                            <div class="bg-green-50 rounded-lg p-4 text-center">
                                <p class="text-xs text-green-600 mb-1">Vendus</p>
                                <p class="text-2xl font-bold text-green-700">{{ number_format($billet->quantite_vendue) }}</p>
                            </div>
                            <div class="bg-orange-50 rounded-lg p-4 text-center">
                                <p class="text-xs text-orange-600 mb-1">Disponibles</p>
                                <p class="text-2xl font-bold text-orange-700">{{ number_format($billet->quantite_disponible) }}</p>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-4 text-center">
                                <p class="text-xs text-purple-600 mb-1">CA généré</p>
                                <p class="text-xl font-bold text-purple-700">{{ number_format($caType) }}</p>
                                <p class="text-xs text-purple-600">FCFA</p>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-4 text-center">
                                <p class="text-xs text-blue-600 mb-1">Taux vente</p>
                                <p class="text-2xl font-bold text-blue-700">{{ number_format($pourcentageVendu, 1) }}%</p>
                            </div>
                        </div>

                        <!-- Barre de progression -->
                        <div>
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600">Progression des ventes</span>
                                <span class="font-semibold">{{ number_format($billet->quantite_vendue) }} / {{ number_format($billet->quantite_totale) }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="h-3 rounded-full transition-all duration-500 flex items-center justify-end pr-2
                                    @if($pourcentageVendu >= 80) bg-gradient-to-r from-green-500 to-green-600
                                    @elseif($pourcentageVendu >= 50) bg-gradient-to-r from-blue-500 to-blue-600
                                    @elseif($pourcentageVendu >= 20) bg-gradient-to-r from-orange-500 to-orange-600
                                    @else bg-gradient-to-r from-red-500 to-red-600
                                    @endif"
                                     style="width: {{ $pourcentageVendu }}%">
                                </div>
                            </div>
                        </div>

                        <!-- Alerte si stock faible -->
                        @if($billet->quantite_disponible > 0 && $billet->quantite_disponible <= ($billet->quantite_totale * 0.1))
                            <div class="mt-4 bg-orange-50 border border-orange-200 rounded-lg p-3">
                                <p class="text-orange-800 text-sm flex items-center">
                                    <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                                    <strong>Stock faible :</strong>&nbsp;Il ne reste que {{ $billet->quantite_disponible }} billets disponibles
                                </p>
                            </div>
                        @elseif($billet->quantite_disponible == 0)
                            <div class="mt-4 bg-red-50 border border-red-200 rounded-lg p-3">
                                <p class="text-red-800 text-sm flex items-center">
                                    <i class="bi bi-x-circle-fill mr-2"></i>
                                    <strong>Épuisé :</strong>&nbsp;Tous les billets de ce type ont été vendus
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-12 text-center">
            <i class="bi bi-ticket-perforated text-6xl text-yellow-600 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Aucun billet créé</h3>
            <p class="text-gray-600 mb-6">Commencez par créer des billets pour cet événement</p>
            <a href="{{ route('organisateur.billet-form') }}"
               class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold transition-colors">
                <i class="bi bi-plus-circle mr-2"></i> Créer un billet
            </a>
        </div>
    @endif
</div>

<!-- JavaScript pour améliorer l'UX -->
<script>
function confirmDeleteBillet(event, billetType, quantiteVendue) {
    if (quantiteVendue > 0) {
        event.preventDefault();
        alert(`Impossible de supprimer le billet "${billetType}" car ${quantiteVendue} exemplaire(s) ont déjà été vendus.`);
        return false;
    }

    return confirm(`Êtes-vous sûr de vouloir supprimer le billet "${billetType}" ?\n\nCette action est irréversible.`);
}

document.addEventListener('DOMContentLoaded', function() {
    // Animation des barres de progression
    const progressBars = document.querySelectorAll('.h-3.rounded-full');
    progressBars.forEach(bar => {
        const originalWidth = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = originalWidth;
        }, 100);
    });

    // Gestion des messages flash
    @if(session('success'))
        showToast('{{ session('success') }}', 'success');
    @endif

    @if(session('error'))
        showToast('{{ session('error') }}', 'error');
    @endif
});

// Fonction pour afficher les toasts
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    const bgColors = {
        'success': 'bg-green-500',
        'error': 'bg-red-500',
        'warning': 'bg-yellow-500',
        'info': 'bg-blue-500'
    };

    toast.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl text-white ${bgColors[type]} transform translate-x-full transition-transform duration-300 shadow-lg`;
    toast.innerHTML = `
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i class="bi ${type === 'success' ? 'bi-check-circle' : type === 'error' ? 'bi-exclamation-circle' : type === 'warning' ? 'bi-exclamation-triangle' : 'bi-info-circle'} mr-2"></i>
                <span>${message}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200 transition-colors">
                <i class="bi bi-x"></i>
            </button>
        </div>
    `;

    document.body.appendChild(toast);

    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);

    // Auto remove after 5 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 300);
    }, 5000);
}
</script>

@endsection
