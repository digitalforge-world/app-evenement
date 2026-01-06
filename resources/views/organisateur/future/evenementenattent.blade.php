@extends('layouts.Obase')
@section('title', "| Les événements organisés qui ne sont pas encore publiés")
@section('content')

@if ($countfuture > 0)
<div class="container mx-auto px-4 py-8">
    <!-- En-tête de la page -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">
            <i class="fas fa-clock text-yellow-500 mr-3"></i>
            Événements à Venir
        </h1>
        <p class="text-lg text-gray-600 mb-6">Événements organisés en attente de publication</p>
        <div class="inline-block bg-yellow-100 text-yellow-800 px-6 py-3 rounded-full font-semibold">
            {{ $countfuture }} événement(s) à venir
        </div>
    </div>

    <!-- Liste des événements -->
    <div class="space-y-8">
        @foreach ($evenementdateavenir as $evavenir)
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200">
            <div class="flex flex-col lg:flex-row">
                <!-- Image de l'événement -->
                <div class="lg:w-1/3">
                    <div class="relative h-64 lg:h-full">
                        <img src="{{ Storage::url('evenement/photo/' . $evavenir->photo) }}"
                                alt="{{ $evavenir->titre }}"
                                class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold flex items-center shadow-lg">
                                <i class="fas fa-clock mr-1 text-xs"></i>
                                À venir
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Contenu de l'événement -->
                <div class="lg:w-2/3 p-6 lg:p-8">
                    <div class="flex flex-col h-full">
                        <!-- En-tête -->
                        <div class="mb-4">
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-3">{{ $evavenir->titre }}</h3>
                            @if($evavenir->description)
                            <p class="text-gray-600 leading-relaxed line-clamp-3">
                                {{ Str::limit($evavenir->description, 150) }}
                            </p>
                            @endif
                        </div>

                        <!-- Informations détaillées -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-calendar-day text-blue-500 text-lg mr-3"></i>
                                <div>
                                    <p class="font-semibold">{{ \Carbon\Carbon::parse($evavenir->date)->translatedFormat('d F Y') }}</p>
                                    <p class="text-sm text-gray-500">{{ $evavenir->start_heure }} - {{ $evavenir->end_heure }}</p>
                                </div>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-map-marker-alt text-red-500 text-lg mr-3"></i>
                                <span>{{ $evavenir->lieu }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-tag text-purple-500 text-lg mr-3"></i>
                                <span class="capitalize">{{ $evavenir->categorie }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-user text-green-500 text-lg mr-3"></i>
                                <span>{{ $evavenir->nom_proprietaire }}</span>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-200 mt-auto">
                            <a href="{{ route('organisateur.detail', ['id' => $evavenir->id]) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center">
                                <i class="fas fa-eye mr-2"></i>
                                Voir les détails
                            </a>
                            <a href="{{ route('organisateur.update_form', ['id' => $evavenir->id]) }}"
                               class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center">
                                <i class="fas fa-edit mr-2"></i>
                                Modifier
                            </a>
                            <a href="{{ route('organisateur.supprimer', ['id' => $evavenir->id]) }}"
                               class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">
                                <i class="fas fa-trash mr-2"></i>
                                Supprimer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if(isset($evenementdateavenir) && method_exists($evenementdateavenir, 'hasPages') && $evenementdateavenir->hasPages())
    <div class="mt-12 flex justify-center">
        <div class="flex items-center space-x-2">
            <!-- Previous Page -->
            @if($evenementdateavenir->onFirstPage())
            <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
            @else
            <a href="{{ $evenementdateavenir->previousPageUrl() }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-chevron-left"></i>
            </a>
            @endif

            <!-- Page Numbers -->
            @foreach(range(1, $evenementdateavenir->lastPage()) as $page)
                @if($page == $evenementdateavenir->currentPage())
                <span class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold">{{ $page }}</span>
                @else
                <a href="{{ $evenementdateavenir->url($page) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">{{ $page }}</a>
                @endif
            @endforeach

            <!-- Next Page -->
            @if($evenementdateavenir->hasMorePages())
            <a href="{{ $evenementdateavenir->nextPageUrl() }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-chevron-right"></i>
            </a>
            @else
            <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-right"></i>
            </span>
            @endif
        </div>
    </div>
    @endif
</div>
@else
<!-- État vide -->
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4">
    <div class="max-w-md w-full text-center">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="mb-6">
                <div class="bg-yellow-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-plus text-yellow-600 text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Aucun événement à venir</h1>
                <p class="text-gray-600 mb-6">
                    Vous n'avez pas encore d'événements programmés pour le futur.
                    Créez votre premier événement pour commencer à planifier.
                </p>
            </div>
            <div class="space-y-4">
                <a href="{{ route('organisateur.ajouter-un-evenement') }}"
                   class="block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 transform hover:-translate-y-0.5 inline-flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i>
                    Créer un nouvel événement
                </a>
                <a href="{{ route('organisateur.dashboard') }}"
                   class="block bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 transform hover:-translate-y-0.5 inline-flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour au tableau de bord
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Styles personnalisés -->
<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease forwards;
}

/* Responsive */
@media (max-width: 768px) {
    .flex-col {
        flex-direction: column;
    }

    .lg\:w-1\/3 {
        width: 100%;
    }

    .lg\:w-2\/3 {
        width: 100%;
    }

    .h-64 {
        height: 200px;
    }
}

/* Effets de hover améliorés */
.hover\:-translate-y-0\.5:hover {
    transform: translateY(-2px);
}

/* Transition pour les cartes */
.transition-all {
    transition: all 0.3s ease;
}

/* Ombre portée améliorée */
.shadow-lg {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.shadow-xl {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
</style>

<!-- JavaScript pour les interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'apparition des cartes
    const eventCards = document.querySelectorAll('.bg-white.rounded-2xl');
    eventCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';

        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Gestion des erreurs d'images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('error', function() {
            console.log('Image failed to load:', this.src);
            // Remplacer par une image de placeholder
            this.src = '{{ asset("asset/image/placeholder-event.jpg") }}';
            this.alt = 'Image non disponible';
            this.classList.add('bg-gray-200');
        });

        // Préchargement avec effet de fondu
        img.addEventListener('load', function() {
            this.classList.add('opacity-100');
            this.classList.remove('opacity-0');
        });

        // État initial
        img.classList.add('transition-opacity', 'duration-300');
    });

    // Confirmation améliorée pour la suppression
    const deleteButtons = document.querySelectorAll('a[href*="supprimer"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const eventTitle = this.closest('.bg-white').querySelector('h3').textContent;
            if (!confirm(`Êtes-vous sûr de vouloir supprimer l'événement "${eventTitle.trim()}" ?\n\nCette action est irréversible.`)) {
                e.preventDefault();
                return false;
            }
        });
    });
});

// Fonction utilitaire pour formater les dates
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('fr-FR', options);
}

// Toast notifications
function showToast(message, type = 'info') {
    // Implémentation simple des toasts
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl text-white ${
        type === 'success' ? 'bg-green-500' :
        type === 'error' ? 'bg-red-500' :
        type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500'
    } transform translate-x-full transition-transform duration-300 shadow-lg`;
    toast.textContent = message;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);

    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => toast.remove(), 300);
    }, 5000);
}
</script>

@endsection
