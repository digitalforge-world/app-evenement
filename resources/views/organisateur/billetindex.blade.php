@extends('layouts.Obase')

@section('title', '| Gestion des billets')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-100 py-6 sm:py-8 lg:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- En-tête de la page -->
            <div class="text-center mb-8 sm:mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl mb-4 sm:mb-6">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-3 sm:mb-4">
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Gestion des Billets
                    </span>
                </h1>
                <p class="text-gray-600 text-base sm:text-lg lg:text-xl max-w-2xl mx-auto px-4">
                    Créez et consultez vos billets facilement avec notre interface moderne et intuitive
                </p>
            </div>

            <!-- Cartes d'actions principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 mb-8 sm:mb-12">
                <!-- Carte Création de billet -->
                <div class="group">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl sm:rounded-3xl shadow-lg border border-white/20 p-6 sm:p-8 h-full transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 hover:bg-white/90">
                        <div class="text-center">
                            <!-- Icône -->
                            <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-blue-500/10 to-blue-600/20 rounded-2xl sm:rounded-3xl mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>

                            <!-- Titre -->
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">
                                Créer un billet
                            </h2>

                            <!-- Description -->
                            <p class="text-gray-600 mb-6 sm:mb-8 text-sm sm:text-base leading-relaxed">
                                Rédigez un nouveau billet et partagez vos idées avec votre communauté
                            </p>

                            <!-- Bouton -->
                            <a href="{{ route('organisateur.billet-form') }}"
                               class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl sm:rounded-2xl transition-all duration-300 hover:shadow-lg hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-500/30 w-full sm:w-auto">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Nouveau billet
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Carte Consultation des billets -->
                <div class="group">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl sm:rounded-3xl shadow-lg border border-white/20 p-6 sm:p-8 h-full transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 hover:bg-white/90">
                        <div class="text-center">
                            <!-- Icône -->
                            <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-emerald-500/10 to-emerald-600/20 rounded-2xl sm:rounded-3xl mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>

                            <!-- Titre -->
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">
                                Voir les billets
                            </h2>

                            <!-- Description -->
                            <p class="text-gray-600 mb-6 sm:mb-8 text-sm sm:text-base leading-relaxed">
                                Consultez tous vos billets existants et gérez votre contenu
                            </p>

                            <!-- Bouton -->
                            <a href="{{ route('organisateur.billet-all') }}"
                               class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-semibold rounded-xl sm:rounded-2xl transition-all duration-300 hover:shadow-lg hover:scale-105 focus:outline-none focus:ring-4 focus:ring-emerald-500/30 w-full sm:w-auto">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Consulter
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section d'actions rapides -->
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl sm:rounded-3xl border border-white/30 p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-0">
                        Actions rapides
                    </h3>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Accès rapide
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <a href="{{ route('organisateur.billet-form') }}"
                       class="inline-flex items-center justify-center sm:justify-start px-4 sm:px-6 py-3 bg-white/80 hover:bg-white border border-gray-200/50 hover:border-blue-300 text-gray-700 hover:text-blue-600 font-medium rounded-xl transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span>Créer un billet</span>
                    </a>

                    <a href="{{ route('organisateur.billet-all') }}"
                       class="inline-flex items-center justify-center sm:justify-start px-4 sm:px-6 py-3 bg-white/80 hover:bg-white border border-gray-200/50 hover:border-emerald-300 text-gray-700 hover:text-emerald-600 font-medium rounded-xl transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Parcourir les billets</span>
                    </a>

                    <!-- Action supplémentaire pour l'espace -->
                    <a href="#"
                       class="inline-flex items-center justify-center sm:justify-start px-4 sm:px-6 py-3 bg-white/80 hover:bg-white border border-gray-200/50 hover:border-purple-300 text-gray-700 hover:text-purple-600 font-medium rounded-xl transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-purple-500/20 sm:flex-1 sm:max-w-xs">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span>Statistiques</span>
                    </a>
                </div>
            </div>

            <!-- Section informative supplémentaire -->
            <div class="mt-8 sm:mt-12 grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                <div class="bg-white/40 backdrop-blur-sm rounded-xl border border-white/20 p-4 sm:p-6 text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Création rapide</h4>
                    <p class="text-sm text-gray-600">Créez vos billets en quelques clics</p>
                </div>

                <div class="bg-white/40 backdrop-blur-sm rounded-xl border border-white/20 p-4 sm:p-6 text-center">
                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Gestion simple</h4>
                    <p class="text-sm text-gray-600">Interface intuitive et moderne</p>
                </div>

                <div class="bg-white/40 backdrop-blur-sm rounded-xl border border-white/20 p-4 sm:p-6 text-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Accès rapide</h4>
                    <p class="text-sm text-gray-600">Trouvez vos billets instantanément</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
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
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .group:nth-child(1) {
        animation-delay: 0.1s;
    }

    .group:nth-child(2) {
        animation-delay: 0.2s;
    }
</style>
@endpush

@push('scripts')
<script>
    // Animation au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.group');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';

            setTimeout(() => {
                card.style.transition = 'all 0.6s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endpush
@endsection
