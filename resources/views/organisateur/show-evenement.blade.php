@extends('layouts.Obase')
@section('title', '| Détails de l\'événement')
@section('content')

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('organisateur.dashboard') }}" class="hover:text-indigo-600">Tableau de bord</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('organisateur.evenement-en-cours') }}" class="hover:text-indigo-600">Événements</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-medium">{{ $evenement->titre }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content - Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Event Header Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Event Image -->
                <div class="relative h-96">
                    @if($evenement->photo && Storage::exists('public/evenement/photo/' . $evenement->photo))
                        <img src="{{ Storage::url('evenement/photo/' . $evenement->photo) }}"
                             alt="{{ $evenement->titre }}"
                             class="w-full h-full object-cover"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    @endif
                    <!-- Fallback if image doesn't exist -->
                    <div class="w-full h-full bg-gradient-to-br from-indigo-100 to-purple-100 flex flex-col items-center justify-center text-gray-400" style="display: {{ $evenement->photo && Storage::exists('public/evenement/photo/' . $evenement->photo) ? 'none' : 'flex' }}">
                        <i class="fas fa-image text-6xl mb-4"></i>
                        <span>Image non disponible</span>
                    </div>

                    <!-- Status Badge -->
                    <div class="absolute top-4 right-4">
                        @if(\Carbon\Carbon::parse($evenement->date)->isFuture())
                            <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                <i class="fas fa-clock mr-1"></i> À venir
                            </span>
                        @else
                            <span class="bg-gray-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                <i class="fas fa-history mr-1"></i> Terminé
                            </span>
                        @endif
                    </div>

                    <!-- Category Badge -->
                    <div class="absolute top-4 left-4">
                        <span class="bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                            {{ $evenement->categorie }}
                        </span>
                    </div>
                </div>

                <!-- Event Info -->
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $evenement->titre }}</h1>

                    <!-- Quick Info -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-calendar-day text-indigo-600 mr-3 text-xl"></i>
                            <div>
                                <p class="text-xs text-gray-500">Date</p>
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($evenement->date)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-clock text-indigo-600 mr-3 text-xl"></i>
                            <div>
                                <p class="text-xs text-gray-500">Horaire</p>
                                <p class="font-semibold">{{ $evenement->start_heure }} - {{ $evenement->end_heure }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-map-marker-alt text-indigo-600 mr-3 text-xl"></i>
                            <div>
                                <p class="text-xs text-gray-500">Lieu</p>
                                <p class="font-semibold truncate">{{ $evenement->lieu }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Description</h3>
                        <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $evenement->description ?? 'Aucune description disponible.' }}</p>
                    </div>

                    <!-- Video if available -->
                    @if($evenement->video && Storage::exists('public/evenement/videos/' . $evenement->video))
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Vidéo de présentation</h3>
                        <video controls class="w-full rounded-lg shadow-md">
                            <source src="{{ Storage::url('evenement/videos/' . $evenement->video) }}" type="video/mp4">
                            Votre navigateur ne supporte pas la lecture de vidéos.
                        </video>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Billets Section -->
            @if($evenement->billets && $evenement->billets->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-ticket-alt text-indigo-600 mr-2"></i>
                        Billets disponibles
                    </h3>
                    <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $evenement->billets->count() }} type(s)
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($evenement->billets as $billet)
                    <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="font-bold text-lg text-gray-800">{{ $billet->nom }}</h4>
                                <p class="text-sm text-gray-600">{{ $billet->description ?? 'Aucune description' }}</p>
                            </div>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $billet->quantite_disponible ?? 0 }} restants
                            </span>
                        </div>
                        <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                            <span class="text-2xl font-bold text-indigo-600">
                                {{ number_format($billet->prix ?? 0, 0, ',', ' ') }} FCFA
                            </span>
                            <a href="{{ route('organisateur.edit-billet', ['id' => $billet->id]) }}" 
                               class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                <i class="fas fa-edit mr-1"></i> Modifier
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Sponsors Section -->
            @if($evenement->sponsors && $evenement->sponsors->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">
                    <i class="fas fa-handshake text-indigo-600 mr-2"></i>
                    Sponsors
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($evenement->sponsors as $sponsor)
                    <div class="text-center p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                        @if($sponsor->logo && Storage::exists('public/' . $sponsor->logo))
                        <img src="{{ Storage::url($sponsor->logo) }}"
                             alt="{{ $sponsor->nom }}"
                             class="h-16 w-auto mx-auto mb-2 object-contain">
                        @else
                        <div class="h-16 flex items-center justify-center mb-2">
                            <i class="fas fa-image text-gray-300 text-3xl"></i>
                        </div>
                        @endif
                        <p class="font-semibold text-sm text-gray-800">{{ $sponsor->nom }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar - Right Column -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Action Buttons -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('organisateur.update_form', ['id' => $evenement->id]) }}"
                       class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-3 rounded-lg transition-all duration-200 flex items-center justify-center font-medium">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier l'événement
                    </a>

                    <a href="{{ route('organisateur.event-detail-billets', ['id' => $evenement->id]) }}"
                       class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-3 rounded-lg transition-all duration-200 flex items-center justify-center font-medium">
                        <i class="fas fa-ticket-alt mr-2"></i>
                        Gérer les billets
                    </a>

                    <a href="{{ route('organisateur.scan-billet') }}"
                       class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg transition-all duration-200 flex items-center justify-center font-medium">
                        <i class="fas fa-qrcode mr-2"></i>
                        Scanner les billets
                    </a>

                    <form action="{{ route('organisateur.supprimer', ['id' => $evenement->id]) }}" 
                          method="POST" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg transition-all duration-200 flex items-center justify-center font-medium">
                            <i class="fas fa-trash mr-2"></i>
                            Supprimer l'événement
                        </button>
                    </form>
                </div>
            </div>

            <!-- Event Details Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Détails de l'événement</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Statut</p>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                            {{ $evenement->statut === 'publier' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $evenement->statut === 'publier' ? 'Publié' : 'En organisation' }}
                        </span>
                    </div>

                    @if($evenement->lien_google_map)
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Localisation</p>
                        <a href="{{ $evenement->lien_google_map }}" 
                           target="_blank" 
                           class="text-indigo-600 hover:text-indigo-800 text-sm flex items-center">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Voir sur Google Maps
                        </a>
                    </div>
                    @endif

                    <div>
                        <p class="text-xs text-gray-500 mb-1">Date de création</p>
                        <p class="text-sm font-medium text-gray-800">
                            {{ \Carbon\Carbon::parse($evenement->created_at)->translatedFormat('d F Y à H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Organizer Contact Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Informations organisateur</h3>
                <div class="space-y-3">
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-user text-indigo-600 mr-3"></i>
                        <span class="font-medium">{{ $evenement->nom_proprietaire }}</span>
                    </div>

                    @if($evenement->telephone)
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-phone text-indigo-600 mr-3"></i>
                        <a href="tel:{{ $evenement->telephone }}" class="hover:text-indigo-600">{{ $evenement->telephone }}</a>
                    </div>
                    @endif

                    @if($evenement->email)
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-envelope text-indigo-600 mr-3"></i>
                        <a href="mailto:{{ $evenement->email }}" class="hover:text-indigo-600 break-all">{{ $evenement->email }}</a>
                    </div>
                    @endif

                    <!-- Social Media -->
                    @if($evenement->facebook || $evenement->whatsapp || $evenement->twiter)
                    <div class="pt-3 border-t border-gray-200">
                        <p class="text-xs text-gray-500 mb-2">Réseaux sociaux</p>
                        <div class="flex space-x-2">
                            @if($evenement->facebook)
                            <a href="{{ $evenement->facebook }}" 
                               target="_blank" 
                               class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            @endif

                            @if($evenement->whatsapp)
                            <a href="https://wa.me/{{ $evenement->whatsapp }}" 
                               target="_blank" 
                               class="bg-green-600 text-white p-2 rounded-full hover:bg-green-700 transition-colors">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            @endif

                            @if($evenement->twiter)
                            <a href="{{ $evenement->twiter }}" 
                               target="_blank" 
                               class="bg-blue-400 text-white p-2 rounded-full hover:bg-blue-500 transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

@endsection
