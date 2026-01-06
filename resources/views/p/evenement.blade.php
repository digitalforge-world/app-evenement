@extends('layouts.base')

@section('title', 'Événements')

@section('content')
<div class="container-fluid my-5 mt-4">
    <div class="row g-4 mt-2">
        <!-- Sidebar - Formulaire de recherche et filtres -->
        <div class="col-lg-4 col-xl-3">
            <div class="sticky-top" style="top: 10px;">
                <div class="card shadow border-0 h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-filter me-2"></i>Filtrer les événements
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="GET" action="{{ route('dashboard') }}">
                            <!-- Recherche -->
                            <div class="mb-4">
                                <label for="search" class="form-label fw-semibold">
                                    <i class="fas fa-search me-1 text-primary"></i>Rechercher
                                </label>
                                <input type="text"
                                       name="search"
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="Titre, description, lieu..."
                                       class="form-control border-2">
                            </div>

                            <!-- Filtre par catégorie -->
                            <div class="mb-4">
                                <label for="categorie" class="form-label fw-semibold">
                                    <i class="fas fa-tags me-1 text-primary"></i>Catégorie
                                </label>
                                <select name="categorie" id="categorie" class="form-select border-2">
                                    <option value="">Toutes les catégories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ request('categorie') == $cat ? 'selected' : '' }}>
                                            {{ ucfirst($cat) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filtre par lieu -->
                            <div class="mb-4">
                                <label for="lieu" class="form-label fw-semibold">
                                    <i class="fas fa-map-marker-alt me-1 text-primary"></i>Lieu
                                </label>
                                <input type="text"
                                       name="lieu"
                                       id="lieu"
                                       value="{{ request('lieu') }}"
                                       placeholder="Ville, lieu..."
                                       class="form-control border-2">
                            </div>

                            <!-- Tri -->
                            <div class="mb-4">
                                <label for="sort" class="form-label fw-semibold">
                                    <i class="fas fa-sort me-1 text-primary"></i>Trier par
                                </label>
                                <select name="sort" id="sort" class="form-select border-2">
                                    <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Date (croissant)</option>
                                    <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Date (décroissant)</option>
                                    <option value="titre_asc" {{ request('sort') == 'titre_asc' ? 'selected' : '' }}>Titre (A-Z)</option>
                                    <option value="titre_desc" {{ request('sort') == 'titre_desc' ? 'selected' : '' }}>Titre (Z-A)</option>
                                    <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Plus récents</option>
                                </select>
                            </div>

                            <!-- Filtres par date -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-calendar-alt me-1 text-primary"></i>Période
                                </label>
                                <div class="row g-2">
                                    <div class="col-12">
                                        <label for="date_debut" class="form-label small text-muted">Date de début</label>
                                        <input type="date"
                                               name="date_debut"
                                               id="date_debut"
                                               value="{{ request('date_debut') }}"
                                               class="form-control border-2">
                                    </div>
                                    <div class="col-12">
                                        <label for="date_fin" class="form-label small text-muted">Date de fin</label>
                                        <input type="date"
                                               name="date_fin"
                                               id="date_fin"
                                               value="{{ request('date_fin') }}"
                                               class="form-control border-2">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-search me-2"></i>Rechercher
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Réinitialiser
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal - Événements -->
        <div class="col-lg-8 col-xl-9">
            <!-- Événement en vedette -->
            @if($featuredEvent)
            <div class="mb-5">
                <h2 class="h4 fw-bold text-dark mb-4">
                    <i class="fas fa-star text-warning me-2"></i>Événement en vedette
                </h2>
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body p-4 bg-gradient text-white position-relative" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 300px;">
                                <span class="badge bg-light bg-opacity-25 text-white mb-3">
                                    {{ ucfirst($featuredEvent->categorie) }}
                                </span>
                                <h3 class="card-title h4 fw-bold mb-3">{{ $featuredEvent->titre }}</h3>
                                <p class="card-text mb-3 opacity-90">{{ $featuredEvent->truncated_description }}</p>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-calendar-alt me-2"></i>
                                        <span class="small">{{ \Carbon\Carbon::parse($featuredEvent->date)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-clock me-2"></i>
                                        <span class="small">{{ \Carbon\Carbon::parse($featuredEvent->start_heure)->format('H:i') }} - {{ \Carbon\Carbon::parse($featuredEvent->end_heure)->format('H:i') }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <span class="small">{{ $featuredEvent->lieu }}</span>
                                    </div>
                                </div>

                                @if($featuredEvent->is_upcoming)
                                    <a href="{{ route('p.detail', $featuredEvent->id) }}" class="btn btn-light text-primary fw-semibold">
                                        <i class="fas fa-ticket-alt me-2"></i>Participer
                                        <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                @else
                                    <a href="{{ route('p.detail', $featuredEvent->id) }}" class="btn btn-light text-primary fw-semibold">
                                        <i class="fas fa-info-circle me-2"></i>Détails de l'événement
                                        <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                                <img src="{{ $featuredEvent->photo_url }}"
                                     alt="{{ $featuredEvent->titre }}"
                                     class="img-fluid h-100 w-100 object-fit-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Liste des événements -->
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 fw-bold text-dark mb-0">
                        Tous les événements
                        <span class="badge bg-primary ms-2">{{ $events->total() }} résultat{{ $events->total() > 1 ? 's' : '' }}</span>
                    </h2>
                </div>

                @if($events->count() > 0)
                    <div class="row g-3">
                        @foreach($events as $event)
                            @php
                                $isNew = \Carbon\Carbon::parse($event->created_at)->diffInDays(now()) <= 7;
                            @endphp
                            <div class="col-md-6 col-xl-4">
                                <div class="card h-100 border-0 shadow-sm hover-shadow-lg transition-all {{ $isNew ? 'border-warning border-2' : '' }}">
                                    <!-- Image de l'événement -->
                                    <div class="position-relative bg-light" style="height: 180px;">
                                        <img src="{{ $event->photo_url }}"
                                             alt="{{ $event->titre }}"
                                             class="card-img-top h-100 object-fit-cover">

                                        <!-- Badge nouveau -->
                                        @if($isNew)
                                            <span class="position-absolute top-0 start-0 m-2 badge bg-warning text-dark">
                                                <i class="fas fa-star me-1"></i>Nouveau
                                            </span>
                                        @endif

                                        <!-- Badge statut -->
                                        @if($event->is_upcoming)
                                            <span class="position-absolute top-0 end-0 m-2 badge bg-success">
                                                À venir
                                            </span>
                                        @else
                                            <span class="position-absolute top-0 end-0 m-2 badge bg-secondary">
                                                Passé
                                            </span>
                                        @endif

                                        <!-- Catégorie -->
                                        <span class="position-absolute bottom-0 start-0 m-2 badge bg-primary">
                                            {{ ucfirst($event->categorie) }}
                                        </span>
                                    </div>

                                    <!-- Contenu -->
                                    <div class="card-body p-3 d-flex flex-column">
                                        <h5 class="card-title fw-bold text-dark mb-2 line-clamp-2 h6">{{ $event->titre }}</h5>
                                        <p class="card-text text-muted small mb-3 line-clamp-2">{{ $event->truncated_description }}</p>

                                        <!-- Informations pratiques -->
                                        <div class="mb-3 flex-grow-1">
                                            <div class="d-flex align-items-center text-muted small mb-1">
                                                <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                                <span>{{ $event->formatted_date }}</span>
                                            </div>
                                            <div class="d-flex align-items-center text-muted small mb-1">
                                                <i class="fas fa-clock me-2 text-primary"></i>
                                                <span>{{ $event->formatted_start_time }} - {{ $event->formatted_end_time }}</span>
                                            </div>
                                            <div class="d-flex align-items-center text-muted small">
                                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                                <span class="text-truncate">{{ $event->lieu }}</span>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="d-flex justify-content-between align-items-center mt-auto">
                                            <small class="text-muted">
                                                Par {{ $event->user->name ?? $event->nom_proprietaire }}
                                            </small>
                                            @if($event->is_upcoming)
                                                <a href="{{ route('p.detail', $event->id) }}"
                                                   class="btn btn-success btn-sm">
                                                    <i class="fas fa-ticket-alt me-1"></i>Participer
                                                </a>
                                            @else
                                                <a href="{{ route('p.detail', $event->id) }}"
                                                   class="btn btn-info btn-sm text-white">
                                                    <i class="fas fa-info-circle me-1"></i>Détails
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $events->links() }}
                    </div>
                @else
                    <!-- Message si aucun événement trouvé -->
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-calendar-times display-1 text-muted opacity-50"></i>
                        </div>
                        <h3 class="h5 fw-semibold text-muted mb-3">Aucun événement trouvé</h3>
                        <p class="text-muted mb-4">Essayez de modifier vos critères de recherche.</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            <i class="fas fa-calendar me-2"></i>Voir tous les événements
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.object-fit-cover {
    object-fit: contain !important; /* Affiche l'image complète sans la couper */
    background-color: #f8f9fa; /* Fond gris clair pour les espaces vides */
}

.hover-shadow-lg {
    transition: all 0.3s ease;
}

.hover-shadow-lg:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.transition-all {
    transition: all 0.3s ease;
}

.card {
    border-radius: 12px;
}

/* Effet spécial pour les nouveaux événements */
.border-warning.border-2 {
    border: 2px solid #ffc107 !important;
    box-shadow: 0 0 15px rgba(255, 193, 7, 0.3);
}

.border-warning.border-2:hover {
    box-shadow: 0 0 25px rgba(255, 193, 7, 0.5);
}

.btn {
    border-radius: 8px;
}

.form-control, .form-select {
    border-radius: 8px;
}

.bg-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

/* Amélioration des badges */
.badge {
    border-radius: 15px;
    padding: 0.4em 0.8em;
    font-weight: 600;
}

/* Animation pour le badge "Nouveau" */
@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.badge.bg-warning {
    animation: pulse 2s infinite;
}

/* Animation pour les cartes */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.5s ease forwards;
}

/* Sidebar sticky */
.sticky-top {
    z-index: 1020;
}

/* Responsive adjustments */
@media (max-width: 991px) {
    .sticky-top {
        position: relative !important;
        top: auto !important;
    }

    .display-4 {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }

    .card-body {
        padding: 1rem !important;
    }
}

/* Améliorations visuelles */
.card-header {
    border-radius: 12px 12px 0 0 !important;
}

.form-label {
    color: #495057;
    font-size: 0.875rem;
}

.form-control:focus,
.form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Loading state */
.loading {
    opacity: 0.7;
    pointer-events: none;
}

/* Boutons d'action personnalisés */
.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(135deg, #218838 0%, #1ba87d 100%);
    transform: translateY(-2px);
}

.btn-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    border: none;
}

.btn-info:hover {
    background: linear-gradient(135deg, #138496 0%, #0f6674 100%);
    transform: translateY(-2px);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit du formulaire lors du changement des filtres
    const form = document.querySelector('form');
    const selects = form.querySelectorAll('select');

    selects.forEach(select => {
        select.addEventListener('change', function() {
            // Ajouter un effet de loading
            const btn = form.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Recherche...';
            btn.disabled = true;

            // Ajouter classe loading au conteneur principal
            document.querySelector('.col-lg-8.col-xl-9').classList.add('loading');

            form.submit();
        });
    });

    // Animation au scroll pour les cartes
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -30px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = Math.random() * 0.2 + 's';
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observer toutes les cartes
    document.querySelectorAll('.card').forEach(card => {
        observer.observe(card);
    });

    // Smooth scroll pour les ancres
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Ajouter un effet de "shimmer" aux nouveaux événements
    const newEventCards = document.querySelectorAll('.border-warning.border-2');
    newEventCards.forEach(card => {
        card.style.position = 'relative';
        card.style.overflow = 'hidden';
    });
});
</script>
@endpush
@endsection
