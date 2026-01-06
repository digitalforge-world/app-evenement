@extends('layouts.base')
@section('title', '| ' . $detail_evenement->titre)
@section('content')

<div class="min-vh-100 bg-light">
    <!-- Hero Section avec Image -->
    <section class="position-relative hero-section">
        <div class="hero-image-wrapper">
            <img src="{{ $detail_evenement->photo_url }}"
                 alt="{{ $detail_evenement->titre }}"
                 class="hero-image">
        </div>
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-60"></div>

        <!-- Breadcrumb -->
        <div class="position-absolute top-0 start-0 w-100 mt-4">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-white">
                        <li class="breadcrumb-item">
                            <a href="{{ route('index') }}" class="text-white text-decoration-none">
                                <i class="bi bi-house-door-fill"></i> Accueil
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('p.evenement') }}" class="text-white text-decoration-none">
                                <i class="bi bi-calendar-event"></i> Événements
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-purple-300" aria-current="page">
                            {{ Str::limit($detail_evenement->titre, 30) }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Contenu Hero -->
        <div class="position-absolute bottom-0 start-0 w-100 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <span class="badge bg-purple mb-3 fs-6 px-3 py-2">
                            <i class="bi bi-tag-fill"></i> {{ $detail_evenement->categorie }}
                        </span>
                        <h1 class="text-white display-4 fw-bold mb-4">
                            {{ $detail_evenement->titre }}
                        </h1>
                        <div class="d-flex flex-wrap align-items-center gap-3 text-white">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar3 me-2"></i>
                                <span>{{ $detail_evenement->formatted_date_long }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill me-2"></i>
                                <span>{{ $detail_evenement->lieu }}</span>
                            </div>
                            @if($detail_evenement->is_upcoming)
                                <span class="badge bg-success px-3 py-2">
                                    <i class="bi bi-clock-fill me-1"></i>
                                    @if($detail_evenement->days_until > 0)
                                        Dans {{ abs($detail_evenement->days_until) }} jour(s)
                                    @else
                                        Aujourd'hui
                                    @endif
                                </span>
                            @else
                                <span class="badge bg-secondary px-3 py-2">
                                    <i class="bi bi-check-circle-fill me-1"></i> Terminé
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contenu Principal -->
    <div class="container py-5">
        <div class="row g-4">
            <!-- Colonne Principale -->
            <div class="col-lg-8">
                <!-- À propos de l'événement -->
                <section class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h2 class="h3 fw-bold text-dark mb-4 d-flex align-items-center">
                            <i class="bi bi-info-circle-fill text-purple me-3"></i>
                            À propos de l'événement
                        </h2>
                        <div class="text-muted lh-lg">
                            <p class="whitespace-pre-line mb-0">{{ $detail_evenement->description }}</p>
                        </div>
                    </div>
                </section>

                <!-- Informations Pratiques -->
                <section class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h2 class="h3 fw-bold text-dark mb-4 d-flex align-items-center">
                            <i class="bi bi-list-check text-purple me-3"></i>
                            Informations Pratiques
                        </h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start p-3 bg-purple bg-opacity-10 rounded-3">
                                    <div class="bg-purple text-white rounded-circle p-2 me-3 flex-shrink-0">
                                        <i class="bi bi-calendar-event-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted small mb-1">Date</p>
                                        <p class="fw-bold text-dark mb-0">{{ $detail_evenement->formatted_date_long }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-start p-3 bg-primary bg-opacity-10 rounded-3">
                                    <div class="bg-primary text-white rounded-circle p-2 me-3 flex-shrink-0">
                                        <i class="bi bi-clock-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted small mb-1">Horaires</p>
                                        <p class="fw-bold text-dark mb-0">
                                            {{ $detail_evenement->formatted_start_time }} - {{ $detail_evenement->formatted_end_time }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-start p-3 bg-success bg-opacity-10 rounded-3">
                                    <div class="bg-success text-white rounded-circle p-2 me-3 flex-shrink-0">
                                        <i class="bi bi-geo-alt-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted small mb-1">Lieu</p>
                                        <p class="fw-bold text-dark mb-0">{{ $detail_evenement->lieu }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-start p-3 bg-warning bg-opacity-10 rounded-3">
                                    <div class="bg-warning text-white rounded-circle p-2 me-3 flex-shrink-0">
                                        <i class="bi bi-person-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted small mb-1">Organisateur</p>
                                        <p class="fw-bold text-dark mb-0">{{ $detail_evenement->nom_proprietaire }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Sponsors -->
                @if($detail_evenement->sponsors && $detail_evenement->sponsors->count() > 0)
                <section class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h2 class="h3 fw-bold text-dark mb-4 d-flex align-items-center">
                            <i class="bi bi-award-fill text-purple me-3"></i>
                            Nos Partenaires
                        </h2>
                        <div class="row g-3">
                            @foreach($detail_evenement->sponsors as $sponsor)
                            <div class="col-6 col-md-3">
                                <div class="bg-light rounded-3 p-3 d-flex align-items-center justify-content-center h-100">
                                    @if($sponsor->logo)
                                        <img src="{{ asset('storage/' . $sponsor->logo) }}"
                                            alt="{{ $sponsor->nom }}" class="h-16 object-contain opacity-70 hover:opacity-100 transition-opacity" style="max-height: 60px;">
                                    @else
                                        <span class="text-muted fw-semibold small">{{ $sponsor->nom }}</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                @endif
            </div>

            <!-- Sidebar - Billets -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">
                    <!-- Carte Billetterie -->
                    <section class="card shadow-lg border-0 mb-4">
                        <div class="card-header bg-purple text-white py-3">
                            <h3 class="h4 fw-bold mb-1">
                                <i class="bi bi-ticket-perforated-fill"></i> Billetterie
                            </h3>
                            <p class="mb-0 opacity-75">Réservez vos places maintenant</p>
                        </div>
                        <div class="card-body p-4">
                            <!-- Statistiques Rapides -->
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="bg-success bg-opacity-10 rounded-3 p-3 text-center">
                                        <p class="text-success small mb-1">
                                            <i class="bi bi-check-circle-fill"></i> Disponibles
                                        </p>
                                        <p class="h4 fw-bold text-success mb-0">{{ number_format($stats_billets['billets_disponibles']) }}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-primary bg-opacity-10 rounded-3 p-3 text-center">
                                        <p class="text-primary small mb-1">
                                            <i class="bi bi-tag-fill"></i> Prix dès
                                        </p>
                                        <p class="h4 fw-bold text-primary mb-0">{{ number_format($stats_billets['prix_min']) }}</p>
                                        <p class="text-primary small mb-0">FCFA</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Liste des Billets -->
                            @if($billets_disponibles->count() > 0)
                                <div class="mb-4">
                                    @foreach($billets_disponibles as $billet)
                                    <div class="card border mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <div>
                                                    <h5 class="fw-bold text-dark mb-1">
                                                        <i class="bi bi-ticket-detailed-fill text-purple"></i> {{ $billet->type }}
                                                    </h5>
                                                    <p class="text-purple fw-bold h5 mb-0">{{ number_format($billet->prix) }} FCFA</p>
                                                </div>
                                                <span class="badge bg-success">
                                                    <i class="bi bi-people-fill"></i> {{ number_format($billet->quantite_disponible) }} places
                                                </span>
                                            </div>

                                            @if($detail_evenement->is_upcoming)
                                                <button class="btn btn-purple w-100 d-flex align-items-center justify-content-center btn-acheter"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#achatModal"
                                                        data-billet-id="{{ $billet->id }}"
                                                        data-billet-type="{{ $billet->type }}"
                                                        data-billet-prix="{{ $billet->prix }}"
                                                        data-billet-disponible="{{ $billet->quantite_disponible }}">
                                                    <i class="bi bi-cart-plus-fill me-2"></i>
                                                    Acheter
                                                </button>
                                            @else
                                                <button class="btn btn-secondary w-100" disabled>
                                                    <i class="bi bi-x-circle-fill me-2"></i>
                                                    Événement terminé
                                                </button>
                                            @endif

                                            @if($billet->quantite_disponible <= ($billet->quantite_totale * 0.2))
                                                <p class="text-warning small mt-2 mb-0 d-flex align-items-center">
                                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                                    Dernières places disponibles !
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-ticket-perforated text-muted display-6 mb-3"></i>
                                    <p class="text-muted fw-semibold">Aucun billet disponible</p>
                                    <p class="text-muted small">Les billets pour cet événement sont épuisés</p>
                                </div>
                            @endif

                            <!-- Informations complémentaires -->
                            <div class="border-top pt-3">
                                <div class="d-flex align-items-start mb-3">
                                    <i class="bi bi-shield-check text-success fs-5 me-3 flex-shrink-0"></i>
                                    <div>
                                        <p class="fw-semibold text-dark mb-1 small">Paiement sécurisé</p>
                                        <p class="text-muted small mb-0">Transactions cryptées et protégées</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-envelope-check-fill text-primary fs-5 me-3 flex-shrink-0"></i>
                                    <div>
                                        <p class="fw-semibold text-dark mb-1 small">E-billet instantané</p>
                                        <p class="text-muted small mb-0">Reçu par email immédiatement</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Partage Social -->
                    <section class="card shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <i class="bi bi-share-fill text-purple me-2"></i>
                                Partager cet événement
                            </h4>
                            <div class="row g-2">
                                <div class="col-3">
                                    <button class="btn btn-primary w-100" title="Facebook">
                                        <i class="bi bi-facebook"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-info w-100 text-white" title="Twitter">
                                        <i class="bi bi-twitter-x"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-danger w-100" title="Instagram">
                                        <i class="bi bi-instagram"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-success w-100" title="WhatsApp">
                                        <i class="bi bi-whatsapp"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <!-- Événements Similaires -->
        @if($evenements_similaires->count() > 0)
        <section class="mt-5">
            <h2 class="h3 fw-bold text-dark mb-4 d-flex align-items-center">
                <i class="bi bi-stars text-purple me-3"></i>
                Événements similaires
            </h2>
            <div class="row g-4">
                @foreach($evenements_similaires as $event)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('p.detail', $event->id) }}" class="text-decoration-none">
                        <div class="card shadow-sm h-100 border-0 hover-card">
                            <div class="similar-event-img-wrapper">
                                <img src="{{ $event->photo_url }}"
                                     alt="{{ $event->titre }}"
                                     class="similar-event-img">
                                <div class="position-absolute top-0 end-0 bg-purple text-white px-3 py-1 m-3 rounded-pill small fw-semibold">
                                    <i class="bi bi-tag-fill"></i> {{ $event->categorie }}
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-dark">{{ $event->titre }}</h5>
                                <p class="card-text text-muted small">{{ $event->truncated_description }}</p>
                                <div class="d-flex justify-content-between align-items-center small">
                                    <span class="text-muted d-flex align-items-center">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ $event->formatted_date }}
                                    </span>
                                    <span class="text-purple fw-bold">
                                        Dès {{ number_format($event->min_price) }} FCFA
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>

<!-- Modal d'achat de billet -->
<div class="modal fade" id="achatModal" tabindex="-1" aria-labelledby="achatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-purple text-white">
                <h5 class="modal-title" id="achatModalLabel">
                    <i class="bi bi-cart-plus-fill me-2"></i>
                    Acheter des billets
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Informations du billet sélectionné -->
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="fw-bold mb-2" id="modalBilletType">
                                    <i class="bi bi-ticket-detailed-fill text-purple"></i>
                                </h6>
                                <p class="text-muted mb-1" id="modalBilletPrix"></p>
                                <p class="text-success small mb-0" id="modalBilletDisponible">
                                    <i class="bi bi-check-circle-fill"></i>
                                </p>
                            </div>
                            <div class="col-md-4 text-end">
                                <p class="text-muted small mb-1">Total à payer</p>
                                <p class="h4 fw-bold text-purple mb-0" id="modalTotal">
                                    <i class="bi bi-cash-stack"></i> 0 FCFA
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de quantité -->
                <div class="mb-4">
                    <label for="quantite" class="form-label fw-semibold">
                        <i class="bi bi-123"></i> Quantité de billets
                    </label>
                    <div class="input-group input-group-lg" style="max-width: 250px;">
                        <button class="btn btn-outline-purple" type="button" id="decrementBtn">
                            <i class="bi bi-dash-lg"></i>
                        </button>
                        <input type="number"
                               class="form-control text-center fw-bold fs-4"
                               id="quantite"
                               name="quantite"
                               value="1"
                               min="1"
                               max="10"
                               readonly>
                        <button class="btn btn-outline-purple" type="button" id="incrementBtn">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                    <div class="form-text">
                        <i class="bi bi-info-circle-fill"></i> Maximum 10 billets par commande
                    </div>
                </div>

                <!-- Formulaire de paiement Stripe -->
                <form id="payment-form">
                    @csrf
                    <input type="hidden" name="billet_id" id="billet_id">
                    <input type="hidden" name="quantite_form" id="quantite_form">
                    <input type="hidden" name="montant_total" id="montant_total">

                    <!-- Informations personnelles -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="bi bi-person-fill text-purple"></i> Informations personnelles
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nom" class="form-label">
                                        <i class="bi bi-person-badge"></i> Nom complet
                                    </label>
                                    <input type="text" class="form-control" id="nom" name="nom" placeholder="John Doe" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope-fill"></i> Email
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carte de crédit -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="bi bi-credit-card-fill text-purple"></i> Informations de paiement
                            </h6>
                        </div>
                        <div class="card-body">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-credit-card-2-front"></i> Carte bancaire
                            </label>
                            <div id="card-element" class="stripe-card-element">
                                <!-- Stripe Elements s'affichera ici -->
                            </div>
                            <div id="card-errors" class="text-danger small mt-2"></div>

                            <div class="mt-3 text-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg"
                                     alt="Stripe"
                                     style="height: 20px; opacity: 0.5;">
                                <p class="text-muted small mb-0 mt-1">
                                    <i class="bi bi-shield-lock-fill"></i> Paiement sécurisé par Stripe
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Résumé de la commande -->
                    <div class="card bg-purple bg-opacity-10 border-purple mb-4">
                        <div class="card-header bg-purple text-white">
                            <h6 class="mb-0">
                                <i class="bi bi-receipt"></i> Résumé de la commande
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="bi bi-ticket-detailed"></i> <span id="resumeType"></span></span>
                                <span id="resumeQuantite"></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="bi bi-tag"></i> Prix unitaire</span>
                                <span id="resumePrixUnitaire"></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold h5 mb-0">
                                <span><i class="bi bi-cash-stack"></i> Total</span>
                                <span class="text-purple" id="resumeTotal"></span>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-purple btn-lg" id="submit-btn">
                            <i class="bi bi-lock-fill me-2"></i>
                            Payer <span id="montant-btn">0</span> FCFA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Styles personnalisés -->
<style>
.bg-purple {
    background-color: #6f42c1 !important;
}

.btn-purple {
    background-color: #6f42c1;
    border-color: #6f42c1;
    color: white;
}

.btn-purple:hover {
    background-color: #5a32a3;
    border-color: #5a32a3;
    color: white;
}

.btn-outline-purple {
    border-color: #6f42c1;
    color: #6f42c1;
}

.btn-outline-purple:hover {
    background-color: #6f42c1;
    border-color: #6f42c1;
    color: white;
}

.text-purple {
    color: #6f42c1 !important;
}

.border-purple {
    border-color: #6f42c1 !important;
}

/* Hero Section avec image optimisée */
.hero-section {
    position: relative;
    min-height: 500px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-image-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

/* Images des événements similaires */
.similar-event-img-wrapper {
    position: relative;
    width: 100%;
    height: 250px;
    overflow: hidden;
}

.similar-event-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.3s ease;
}

.hover-card:hover .similar-event-img {
    transform: scale(1.05);
}

.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

/* Stripe Elements */
.stripe-card-element {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px;
    background-color: white;
    transition: border-color 0.3s ease;
    min-height: 45px;
}

.stripe-card-element:focus-within {
    border-color: #6f42c1;
    box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
}

.StripeElement {
    width: 100%;
}

.StripeElement--focus {
    outline: none;
}

.StripeElement--invalid {
    border-color: #dc3545;
}

.StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
}

.progress {
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar {
    transition: width 0.6s ease;
}

/* Animation des boutons */
.btn {
    transition: all 0.3s ease;
}

.btn:active {
    transform: scale(0.95);
}

/* Spinner pour le chargement */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.spinner-border-sm {
    width: 1rem;
    height: 1rem;
    border-width: 0.2em;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section {
        min-height: 400px;
    }

    .hero-image-wrapper {
        height: 400px;
    }

    .similar-event-img-wrapper {
        height: 200px;
    }
}
</style>

<!-- Scripts -->
<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Script chargé');

    // Initialisation de Stripe
    const stripeKey = '{{ config("services.stripe.key") }}';
    console.log('Clé Stripe:', stripeKey ? 'Présente' : 'Manquante');

    const stripe = Stripe(stripeKey);
    const elements = stripe.elements();

    // Style personnalisé pour l'élément de carte
    const style = {
        base: {
            fontSize: '16px',
            color: '#32325d',
            fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif',
            fontSmoothing: 'antialiased',
            '::placeholder': {
                color: '#aab7c4',
            },
        },
        invalid: {
            color: '#dc3545',
            iconColor: '#dc3545',
        },
    };

    // Créer l'élément de carte avec style
    const cardElement = elements.create('card', {
        style: style,
        hidePostalCode: true
    });

    // Monter l'élément de carte
    const cardElementContainer = document.getElementById('card-element');
    if (cardElementContainer) {
        cardElement.mount('#card-element');
        console.log('Élément de carte monté');
    } else {
        console.error('Container card-element introuvable');
    }

    // Gestion des erreurs de carte en temps réel
    cardElement.on('change', function(event) {
        console.log('Changement carte:', event);
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-1"></i>' + event.error.message;
        } else {
            displayError.textContent = '';
        }

        // Afficher une icône de validation si la carte est complète
        if (event.complete) {
            displayError.innerHTML = '<span class="text-success"><i class="bi bi-check-circle-fill me-1"></i>Carte valide</span>';
        }
    });

    cardElement.on('ready', function() {
        console.log('Stripe Element prêt');
    });

    // Variables globales pour le modal
    let currentBillet = null;
    let currentPrix = 0;
    let maxQuantite = 10;
    let currentQuantite = 1;

    // Gestion de l'ouverture du modal d'achat
    const achatModal = document.getElementById('achatModal');
    if (achatModal) {
        achatModal.addEventListener('show.bs.modal', function (event) {
            console.log('Modal ouvert');
            const button = event.relatedTarget;

            // Récupérer les données du billet
            currentBillet = button.getAttribute('data-billet-id');
            const billetType = button.getAttribute('data-billet-type');
            currentPrix = parseInt(button.getAttribute('data-billet-prix'));
            const disponible = parseInt(button.getAttribute('data-billet-disponible'));

            console.log('Données billet:', { currentBillet, billetType, currentPrix, disponible });

            // Mettre à jour les informations du modal
            document.getElementById('modalBilletType').innerHTML =
                '<i class="bi bi-ticket-detailed-fill text-purple"></i> ' + billetType;
            document.getElementById('modalBilletPrix').textContent =
                currentPrix.toLocaleString('fr-FR') + ' FCFA par billet';
            document.getElementById('modalBilletDisponible').innerHTML =
                '<i class="bi bi-check-circle-fill"></i> ' + disponible.toLocaleString('fr-FR') + ' places disponibles';

            // Définir le maximum de quantité (minimum entre 10 et disponible)
            maxQuantite = Math.min(10, disponible);
            const quantiteInput = document.getElementById('quantite');
            quantiteInput.max = maxQuantite;
            quantiteInput.value = 1;

            console.log('Max quantité:', maxQuantite);

            // Mettre à jour le champ caché billet_id
            document.getElementById('billet_id').value = currentBillet;

            // Réinitialiser la quantité et mettre à jour l'affichage
            currentQuantite = 1;
            updateQuantiteDisplay(1);

            // Réinitialiser le formulaire
            document.getElementById('payment-form').reset();
            document.getElementById('billet_id').value = currentBillet;
            document.getElementById('card-errors').textContent = '';
        });
    }

    // Gestion du bouton d'incrémentation
    const incrementBtn = document.getElementById('incrementBtn');
    if (incrementBtn) {
        incrementBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Clic incrémentation');
            const quantiteInput = document.getElementById('quantite');
            let quantite = parseInt(quantiteInput.value) || 1;

            console.log('Quantité actuelle:', quantite, 'Max:', maxQuantite);

            if (quantite < maxQuantite) {
                quantite++;
                quantiteInput.value = quantite;
                currentQuantite = quantite;
                updateQuantiteDisplay(quantite);
                console.log('Nouvelle quantité:', quantite);
            } else {
                console.log('Maximum atteint');
                // Animation de feedback si on atteint le maximum
                this.classList.add('btn-secondary');
                setTimeout(() => {
                    this.classList.remove('btn-secondary');
                }, 200);
            }
        });
    }

    // Gestion du bouton de décrémentation
    const decrementBtn = document.getElementById('decrementBtn');
    if (decrementBtn) {
        decrementBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Clic décrémentation');
            const quantiteInput = document.getElementById('quantite');
            let quantite = parseInt(quantiteInput.value) || 1;

            console.log('Quantité actuelle:', quantite);

            if (quantite > 1) {
                quantite--;
                quantiteInput.value = quantite;
                currentQuantite = quantite;
                updateQuantiteDisplay(quantite);
                console.log('Nouvelle quantité:', quantite);
            } else {
                console.log('Minimum atteint');
                // Animation de feedback si on est au minimum
                this.classList.add('btn-secondary');
                setTimeout(() => {
                    this.classList.remove('btn-secondary');
                }, 200);
            }
        });
    }

    // Gestion du changement manuel de quantité
    const quantiteInput = document.getElementById('quantite');
    if (quantiteInput) {
        quantiteInput.addEventListener('change', function() {
            console.log('Changement manuel quantité');
            let quantite = parseInt(this.value);

            // Validation de la quantité
            if (isNaN(quantite) || quantite < 1) {
                quantite = 1;
            }
            if (quantite > maxQuantite) {
                quantite = maxQuantite;
            }

            this.value = quantite;
            currentQuantite = quantite;
            updateQuantiteDisplay(quantite);
            console.log('Quantité validée:', quantite);
        });
    }

    // Fonction pour mettre à jour l'affichage de la quantité et du total
    function updateQuantiteDisplay(quantite) {
        console.log('Mise à jour affichage:', quantite, 'x', currentPrix);
        const total = currentPrix * quantite;
        console.log('Total calculé:', total);

        // Mettre à jour le total principal
        const modalTotal = document.getElementById('modalTotal');
        if (modalTotal) {
            modalTotal.innerHTML = '<i class="bi bi-cash-stack"></i> ' + total.toLocaleString('fr-FR') + ' FCFA';
        }

        // Mettre à jour le bouton de paiement
        const montantBtn = document.getElementById('montant-btn');
        if (montantBtn) {
            montantBtn.textContent = total.toLocaleString('fr-FR');
        }

        // Mettre à jour le résumé de commande
        const modalBilletType = document.getElementById('modalBilletType');
        if (modalBilletType) {
            const billetType = modalBilletType.textContent.trim();
            const resumeType = document.getElementById('resumeType');
            if (resumeType) {
                resumeType.textContent = billetType.replace(/🎟️/g, '').replace(/[^\w\s]/gi, '').trim();
            }
        }

        const resumeQuantite = document.getElementById('resumeQuantite');
        if (resumeQuantite) {
            resumeQuantite.innerHTML = '<span class="badge bg-purple">x' + quantite + '</span>';
        }

        const resumePrixUnitaire = document.getElementById('resumePrixUnitaire');
        if (resumePrixUnitaire) {
            resumePrixUnitaire.textContent = currentPrix.toLocaleString('fr-FR') + ' FCFA';
        }

        const resumeTotal = document.getElementById('resumeTotal');
        if (resumeTotal) {
            resumeTotal.textContent = total.toLocaleString('fr-FR') + ' FCFA';
        }

        // Mettre à jour les champs cachés
        const quantiteForm = document.getElementById('quantite_form');
        if (quantiteForm) {
            quantiteForm.value = quantite;
        }

        const montantTotal = document.getElementById('montant_total');
        if (montantTotal) {
            montantTotal.value = total;
        }

        console.log('Affichage mis à jour - Total:', total, 'FCFA');
    }

    // Soumission du formulaire de paiement
    const paymentForm = document.getElementById('payment-form');
    if (paymentForm) {
        paymentForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            console.log('Soumission formulaire');

            // Validation du formulaire
            const nom = document.getElementById('nom').value.trim();
            const email = document.getElementById('email').value.trim();

            if (!nom || !email) {
                alert('Veuillez remplir tous les champs obligatoires.');
                return;
            }

            const submitBtn = document.getElementById('submit-btn');
            const originalBtnContent = submitBtn.innerHTML;

            // Désactiver le bouton et afficher un spinner
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Traitement en cours...
            `;

            try {
                // Créer le token de paiement Stripe
                console.log('Création token Stripe...');
                const {token, error} = await stripe.createToken(cardElement, {
                    name: nom,
                });

                if (error) {
                    console.error('Erreur Stripe:', error);
                    // Afficher l'erreur
                    const errorElement = document.getElementById('card-errors');
                    errorElement.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-1"></i>' + error.message;

                    // Réactiver le bouton
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnContent;
                    return;
                }

                console.log('Token créé:', token.id);

                // Préparer les données du formulaire
                const formData = new FormData(paymentForm);
                formData.append('stripeToken', token.id);

                console.log('Envoi au serveur...');
                // Envoyer la requête AJAX au serveur
                const response = await fetch('{{ route("p.paiement.process") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const result = await response.json();
                console.log('Réponse serveur:', result);

                if (result.success) {
                    // Afficher un message de succès
                    submitBtn.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i> Paiement réussi !';
                    submitBtn.classList.remove('btn-purple');
                    submitBtn.classList.add('btn-success');

                    // Redirection après un court délai
                    setTimeout(() => {
                        window.location.href = result.redirect_url;
                    }, 1500);
                } else {
                    // Afficher l'erreur
                    throw new Error(result.message || 'Erreur lors du paiement');
                }

            } catch (error) {
                console.error('Erreur:', error);

                // Afficher un message d'erreur
                const errorElement = document.getElementById('card-errors');
                if (errorElement) {
                    errorElement.innerHTML =
                        '<i class="bi bi-exclamation-triangle-fill me-1"></i>' +
                        (error.message || 'Une erreur est survenue lors du traitement du paiement.');
                }

                // Réactiver le bouton
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnContent;

                // Afficher une alerte
                alert('Erreur: ' + (error.message || 'Une erreur est survenue lors du paiement.'));
            }
        });
    }

    // Animation des barres de progression au chargement
    const progressBars = document.querySelectorAll('.progress-bar');
    progressBars.forEach(bar => {
        const targetWidth = bar.style.width;
        bar.style.width = '0%';
        bar.style.transition = 'width 1s ease-in-out';

        setTimeout(() => {
            bar.style.width = targetWidth;
        }, 300);
    });

    console.log('Initialisation terminée');
});
</script>

@endsection
