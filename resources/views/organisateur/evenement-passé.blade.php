@extends('layouts.Obase')
@section('title', '| Les événements passés')
@section('content')

@if ($countpasser > 0)
<div class="container mx-auto px-4 py-8">
    <div class="mb-8 text-center">
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-2">
            <i class="fas fa-history mr-3 text-gray-500"></i>
            Événements Passés
        </h1>
        <p class="text-gray-600 text-lg">Retrouvez vos événements terminés</p>
        <div class="mt-4">
            <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-semibold">
                {{ $countpasser }} événement(s) passé(s)
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @foreach ($evenementdatepasser as $evpasser)
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200">
            <div class="flex flex-col md:flex-row">
                <!-- Image Section - CORRIGÉE -->
                <div class="md:w-2/5">
                    <div class="h-64 md:h-full">
                        @if($evpasser->photo && Storage::exists('public/evenement/photo/' . $evpasser->photo))
                            <img src="{{ Storage::url('evenement/photo/' . $evpasser->photo) }}"
                                 alt="{{ $evpasser->titre }}"
                                 class="w-full h-full object-cover transition-opacity duration-300"
                                 loading="lazy"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        @else
                            <!-- Fallback si l'image n'existe pas -->
                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex flex-col items-center justify-center text-gray-400">
                                <i class="fas fa-image text-4xl mb-2"></i>
                                <span class="text-sm">Image non disponible</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Content Section -->
                <div class="md:w-3/5 p-6">
                    <div class="flex flex-col h-full">
                        <!-- Header -->
                        <div class="mb-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $evpasser->titre }}</h3>
                                    <span class="inline-block bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class="fas fa-clock mr-1"></i>
                                        Événement terminé
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4 flex-grow">
                            <p class="text-gray-600 leading-relaxed line-clamp-3">
                                {{ Str::limit($evpasser->description, 200) }}
                            </p>
                        </div>

                        <!-- Event Details -->
                        <div class="mb-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-calendar-day mr-3 text-blue-500"></i>
                                    <div>
                                        <p class="font-semibold">{{ \Carbon\Carbon::parse($evpasser->date)->translatedFormat('d F Y') }}</p>
                                        <p class="text-sm">{{ $evpasser->start_heure }} - {{ $evpasser->end_heure }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-map-marker-alt mr-3 text-red-500"></i>
                                    <span>{{ $evpasser->lieu }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-200">
                            <a href="{{ route('organisateur.detail', ['id' => $evpasser->id]) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center">
                                <i class="fas fa-eye mr-2"></i>
                                Voir les détails
                            </a>

                            @if(Route::has('organisateur.statistique'))
                            <a href="{{ route('organisateur.statistique', ['id' => $evpasser->id]) }}"
                               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center">
                                <i class="fas fa-chart-bar mr-2"></i>
                                Statistiques
                            </a>
                            @endif

                            <a href="{{ route('organisateur.update_form', ['id' => $evpasser->id]) }}"
                               class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center">
                                <i class="fas fa-edit mr-2"></i>
                                Réutiliser
                            </a>

                            <a href="{{ route('organisateur.event-detail-billets', ['id' => $evpasser->id]) }}"
                               class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center">
                                <i class="fas fa-ticket-alt mr-2"></i>
                                Voir les billets
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if(isset($evenementdatepasser) && method_exists($evenementdatepasser, 'hasPages') && $evenementdatepasser->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $evenementdatepasser->links() }}
    </div>
    @endif
</div>
@else
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4">
    <div class="max-w-md w-full text-center">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="mb-6">
                <div class="bg-gray-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-history text-gray-400 text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Aucun événement passé</h1>
                <p class="text-gray-600 mb-6">
                    Vous n'avez pas encore d'événements terminés. Les événements passés apparaîtront ici automatiquement.
                </p>
            </div>
            <div class="space-y-4">
                <a href="{{ route('organisateur.ajouter-un-evenement') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 transform hover:-translate-y-0.5 inline-flex items-center justify-center w-full">
                    <i class="fas fa-plus mr-2"></i>
                    Créer un nouvel événement
                </a>
                <a href="{{ route('organisateur.dashboard') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 transform hover:-translate-y-0.5 inline-flex items-center justify-center w-full">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour au tableau de bord
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<!-- JavaScript amélioré pour le débogage -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vérifier le statut des images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        // Vérifier si l'image est déjà chargée
        if (img.complete) {
            if (img.naturalHeight === 0) {
                console.log('Image failed to load:', img.src);
                showImageFallback(img);
            }
        } else {
            img.addEventListener('load', function() {
                console.log('Image loaded successfully:', this.src);
            });

            img.addEventListener('error', function() {
                console.log('Image error:', this.src);
                showImageFallback(this);
            });
        }
    });

    function showImageFallback(imgElement) {
        imgElement.style.display = 'none';

        // Créer un fallback si il n'existe pas
        let fallback = imgElement.nextElementSibling;
        if (!fallback || !fallback.classList.contains('bg-gradient-to-br')) {
            fallback = document.createElement('div');
            fallback.className = 'w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex flex-col items-center justify-center text-gray-400';
            fallback.innerHTML = `
                <i class="fas fa-image text-4xl mb-2"></i>
                <span class="text-sm">Image non disponible</span>
            `;
            imgElement.parentNode.appendChild(fallback);
        }
        fallback.style.display = 'flex';
    }

    // Reste de votre code JavaScript...
    const buttons = document.querySelectorAll('a[class*="bg-"]');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!this.href.includes('#') && !this.onclick) {
                this.classList.add('btn-loading');
                this.style.pointerEvents = 'none';
                setTimeout(() => {
                    this.classList.remove('btn-loading');
                    this.style.pointerEvents = 'auto';
                }, 3000);
            }
        });
    });
});

// Fonction pour tester manuellement les images
function testImageUrl(url) {
    return new Promise((resolve) => {
        const img = new Image();
        img.onload = () => resolve(true);
        img.onerror = () => resolve(false);
        img.src = url;
    });
}
</script>

<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Styles existants... */
</style>
@endsection
