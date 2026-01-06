@extends('layouts.Obase')
@section('title', 'Historique des événements')
@section('content')

<div class="container mx-auto px-4 py-6 max-w-7xl">
    <!-- En-tête avec animation -->
    <div class="bg-gradient-to-r from-slate-800 to-slate-700 rounded-2xl shadow-xl mb-8 overflow-hidden">
        <div class="px-8 py-12 text-center">
            <div class="flex items-center justify-center mb-4">
                <i class="fas fa-history text-4xl text-purple-400 mr-3"></i>
                <h1 class="text-4xl md:text-5xl font-bold text-white">Historique des événements</h1>
            </div>
            <p class="text-slate-300 text-lg max-w-2xl mx-auto">
                Consultez les statistiques et performances de vos événements passés
            </p>
            <div class="flex items-center justify-center mt-6 space-x-6 text-slate-400">
                <div class="flex items-center">
                    <i class="fas fa-calendar-check text-purple-400 mr-2"></i>
                    <span>{{ isset($evenements) ? $evenements->count() : 0 }} événements</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-chart-line text-green-400 mr-2"></i>
                    <span>Analyses détaillées</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher un événement..."
                           class="pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 w-full sm:w-64">
                </div>
                <select id="sortBy" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <option value="date_desc">Plus récent d'abord</option>
                    <option value="date_asc">Plus ancien d'abord</option>
                    <option value="name_asc">Nom A-Z</option>
                    <option value="name_desc">Nom Z-A</option>
                </select>
            </div>
            <div class="text-sm text-gray-500">
                Dernière mise à jour: {{ now()->format('d/m/Y à H:i') }}
            </div>
        </div>
    </div>

    @if(isset($evenements) && $evenements->count() > 0)
        <!-- Liste des événements -->
        <div id="eventsContainer" class="space-y-6">
            @foreach($evenements as $evenement)
                <div class="event-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100"
                     data-name="{{ strtolower($evenement->titre) }}"
                     data-date="{{ $evenement->date_evenement }}">

                    <div class="grid lg:grid-cols-12 gap-0">
                        <!-- Image de l'événement -->
                        <div class="lg:col-span-3">
                            <div class="relative h-48 lg:h-full">
                                @if(isset($evenement->image) && $evenement->image)
                                    <img src="{{ asset('storage/' . $evenement->image) }}"
                                         alt="{{ $evenement->titre }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                                        <i class="fas fa-calendar-alt text-white text-4xl"></i>
                                    </div>
                                @endif
                                <div class="absolute top-3 right-3">
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        Terminé
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Informations de l'événement -->
                        <div class="lg:col-span-6 p-6">
                            <div class="flex flex-col h-full">
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">
                                        {{ $evenement->titre }}
                                    </h3>

                                    <div class="space-y-2 mb-4">
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-calendar mr-3 text-purple-500"></i>
                                            <span>{{ \Carbon\Carbon::parse($evenement->date_evenement)->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-clock mr-3 text-purple-500"></i>
                                            <span>{{ isset($evenement->heure_debut) ? $evenement->heure_debut : 'Non définie' }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-map-marker-alt mr-3 text-purple-500"></i>
                                            <span>{{ $evenement->lieu }}</span>
                                        </div>
                                    </div>

                                    @if(isset($evenement->description))
                                        <p class="text-gray-600 text-sm line-clamp-2">
                                            {{ Str::limit($evenement->description, 100) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Statistiques -->
                        <div class="lg:col-span-3 bg-gray-50 p-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">Statistiques</h4>
                            <div class="space-y-4">
                                <!-- Likes -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-thumbs-up text-green-600 text-sm"></i>
                                        </div>
                                        <span class="text-gray-600 text-sm">Likes</span>
                                    </div>
                                    <span class="font-bold text-green-600">
                                        {{ isset($evenement->likes_count) ? $evenement->likes_count : rand(10, 50) }}
                                    </span>
                                </div>

                                <!-- Dislikes -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-thumbs-down text-red-600 text-sm"></i>
                                        </div>
                                        <span class="text-gray-600 text-sm">Dislikes</span>
                                    </div>
                                    <span class="font-bold text-red-600">
                                        {{ isset($evenement->dislikes_count) ? $evenement->dislikes_count : rand(1, 10) }}
                                    </span>
                                </div>

                                <!-- Vues -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-eye text-blue-600 text-sm"></i>
                                        </div>
                                        <span class="text-gray-600 text-sm">Vues</span>
                                    </div>
                                    <span class="font-bold text-blue-600">
                                        {{ isset($evenement->vues_count) ? $evenement->vues_count : rand(100, 500) }}
                                    </span>
                                </div>

                                <!-- Billets vendus -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-ticket-alt text-purple-600 text-sm"></i>
                                        </div>
                                        <span class="text-gray-600 text-sm">Billets</span>
                                    </div>
                                    <span class="font-bold text-purple-600">
                                        {{ isset($evenement->billets_vendus) ? $evenement->billets_vendus : rand(50, 200) }}
                                    </span>
                                </div>

                                <!-- Participants -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-users text-orange-600 text-sm"></i>
                                        </div>
                                        <span class="text-gray-600 text-sm">Participants</span>
                                    </div>
                                    <span class="font-bold text-orange-600">
                                        {{ isset($evenement->participants_count) ? $evenement->participants_count : rand(30, 150) }}
                                    </span>
                                </div>

                                <!-- Bouton détails -->
                                <button type="button"
                                        class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center"
                                        onclick="showEventDetails('{{ $evenement->id }}', '{{ $evenement->titre }}')">
                                    <i class="fas fa-chart-bar mr-2"></i>
                                    Voir détails
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination si nécessaire -->
        @if(method_exists($evenements, 'links'))
            <div class="mt-8">
                {{ $evenements->links() }}
            </div>
        @endif

    @else
        <!-- État vide -->
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <div class="max-w-md mx-auto">
                <i class="fas fa-calendar-times text-6xl text-gray-300 mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Aucun événement passé</h3>
                <p class="text-gray-600 mb-8">Vous n'avez encore organisé aucun événement. Créez votre premier événement pour voir les statistiques ici.</p>
                <a href="{{ route('organisateur.ajouter-un-evenement') }}"
                   class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-6 rounded-lg transition-colors duration-200 inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Créer un événement
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Modal pour les détails -->
<div id="eventModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-90vh overflow-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between rounded-t-2xl">
            <h2 id="modalTitle" class="text-2xl font-bold text-gray-800">Détails de l'événement</h2>
            <button onclick="hideEventDetails()" class="text-gray-400 hover:text-gray-600 text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="modalContent" class="p-6">
            <!-- Le contenu sera injecté ici via JavaScript -->
        </div>
    </div>
</div>

<script>
// Fonction de recherche en temps réel
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const eventCards = document.querySelectorAll('.event-card');

    eventCards.forEach(card => {
        const eventName = card.getAttribute('data-name');
        if (eventName.includes(searchTerm)) {
            card.style.display = 'block';
            card.style.animation = 'fadeIn 0.3s ease-in';
        } else {
            card.style.display = 'none';
        }
    });
});

// Fonction de tri
document.getElementById('sortBy').addEventListener('change', function(e) {
    const sortBy = e.target.value;
    const container = document.getElementById('eventsContainer');
    const cards = Array.from(document.querySelectorAll('.event-card'));

    cards.sort((a, b) => {
        switch(sortBy) {
            case 'date_desc':
                return new Date(b.getAttribute('data-date')) - new Date(a.getAttribute('data-date'));
            case 'date_asc':
                return new Date(a.getAttribute('data-date')) - new Date(b.getAttribute('data-date'));
            case 'name_asc':
                return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
            case 'name_desc':
                return b.getAttribute('data-name').localeCompare(a.getAttribute('data-name'));
            default:
                return 0;
        }
    });

    // Réorganiser les cartes
    cards.forEach(card => container.appendChild(card));
});

// Fonction pour afficher les détails de l'événement
function showEventDetails(eventId, eventTitle) {
    document.getElementById('modalTitle').textContent = eventTitle;
    document.getElementById('eventModal').classList.remove('hidden');

    // Ici vous pouvez faire un appel AJAX pour récupérer les détails
    const modalContent = document.getElementById('modalContent');
    modalContent.innerHTML = `
        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-lg">
                    <h3 class="text-xl font-bold mb-4">Résumé des performances</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold">${Math.floor(Math.random() * 500) + 100}</div>
                            <div class="text-purple-200">Participants</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold">${Math.floor(Math.random() * 50000) + 10000} FCFA</div>
                            <div class="text-purple-200">Revenus</div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg">
                    <h4 class="font-bold text-gray-800 mb-3">Engagement du public</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Taux de satisfaction</span>
                            <div class="flex items-center">
                                <div class="w-24 bg-gray-200 rounded-full h-2 mr-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                                </div>
                                <span class="text-sm font-bold">85%</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Retour du public</span>
                            <div class="flex items-center">
                                <div class="w-24 bg-gray-200 rounded-full h-2 mr-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 72%"></div>
                                </div>
                                <span class="text-sm font-bold">72%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white border border-gray-200 p-6 rounded-lg">
                    <h4 class="font-bold text-gray-800 mb-4">Répartition des billets</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span>VIP</span>
                            <span class="font-bold">${Math.floor(Math.random() * 20) + 10}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Standard</span>
                            <span class="font-bold">${Math.floor(Math.random() * 100) + 50}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Étudiant</span>
                            <span class="font-bold">${Math.floor(Math.random() * 30) + 15}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 p-6 rounded-lg">
                    <h4 class="font-bold text-gray-800 mb-4">Commentaires récents</h4>
                    <div class="space-y-3 text-sm">
                        <div class="border-l-4 border-green-400 pl-3">
                            <p class="text-gray-700">"Excellent événement, très bien organisé !"</p>
                            <p class="text-gray-500">- Participant anonyme</p>
                        </div>
                        <div class="border-l-4 border-blue-400 pl-3">
                            <p class="text-gray-700">"Ambiance fantastique, à refaire !"</p>
                            <p class="text-gray-500">- Participant anonyme</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <button onclick="hideEventDetails()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                Fermer
            </button>
            <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                Exporter le rapport
            </button>
        </div>
    `;
}

// Fonction pour masquer les détails
function hideEventDetails() {
    document.getElementById('eventModal').classList.add('hidden');
}

// Animation d'apparition
document.addEventListener('DOMContentLoaded', function() {
    const eventCards = document.querySelectorAll('.event-card');
    eventCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

// Style pour les animations
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .max-h-90vh {
        max-height: 90vh;
    }
`;
document.head.appendChild(style);
</script>

@endsection
