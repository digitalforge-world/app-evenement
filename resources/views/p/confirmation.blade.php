@extends('layouts.base')
@section('title', '| Confirmation d\'achat')
@section('content')

<div class="min-vh-100 bg-light py-5">
    <div class="container">
        <!-- Message de succès -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="alert alert-success text-center shadow-lg border-0">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h2 class="alert-heading fw-bold mb-3">Paiement réussi !</h2>
                    <p class="mb-0 fs-5">Votre commande a été confirmée et vos billets ont été générés.</p>
                    <p class="mb-0 text-muted">Un email de confirmation a été envoyé à <strong>{{ $transaction->email_acheteur }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Carte principale -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <!-- En-tête -->
                    <div class="card-header bg-purple text-white py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-1">
                                    <i class="bi bi-ticket-perforated-fill me-2"></i>
                                    Vos Billets
                                </h3>
                                <p class="mb-0 opacity-75">Code de commande : <strong>{{ $transaction->code_achat }}</strong></p>
                            </div>
                            <div class="text-end">
                                <p class="mb-0 small opacity-75">Date d'achat</p>
                                <p class="mb-0 fw-bold">{{ \Carbon\Carbon::parse($transaction->date_achat)->format('d/m/Y à H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Informations sur l'événement -->
                        <section class="mb-4 pb-4 border-bottom">
                            <h4 class="fw-bold mb-3 d-flex align-items-center">
                                <i class="bi bi-calendar-event-fill text-purple me-2"></i>
                                Événement
                            </h4>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-start">
                                        @if($transaction->billet->evenement->photo_url)
                                            <img src="{{ $transaction->billet->evenement->photo_url }}"
                                                 alt="{{ $transaction->billet->evenement->titre }}"
                                                 class="rounded me-3"
                                                 style="width: 100px; height: 100px; object-fit: cover;">
                                        @endif
                                        <div class="flex-grow-1">
                                            <h5 class="fw-bold mb-2">{{ $transaction->billet->evenement->titre }}</h5>
                                            <p class="text-muted mb-1">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ \Carbon\Carbon::parse($transaction->billet->evenement->date_debut)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                                            </p>
                                            <p class="text-muted mb-1">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ \Carbon\Carbon::parse($transaction->billet->evenement->heure_debut)->format('H:i') }}
                                                -
                                                {{ \Carbon\Carbon::parse($transaction->billet->evenement->heure_fin)->format('H:i') }}
                                            </p>
                                            <p class="text-muted mb-0">
                                                <i class="bi bi-geo-alt-fill me-1"></i>
                                                {{ $transaction->billet->evenement->lieu }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Détails de l'achat -->
                        <section class="mb-4 pb-4 border-bottom">
                            <h4 class="fw-bold mb-3 d-flex align-items-center">
                                <i class="bi bi-receipt text-purple me-2"></i>
                                Détails de votre commande
                            </h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="bg-light rounded p-3">
                                        <p class="text-muted small mb-1">Nom</p>
                                        <p class="fw-bold mb-0">{{ $transaction->nom_acheteur }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light rounded p-3">
                                        <p class="text-muted small mb-1">Email</p>
                                        <p class="fw-bold mb-0">{{ $transaction->email_acheteur }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light rounded p-3">
                                        <p class="text-muted small mb-1">Type de billet</p>
                                        <p class="fw-bold mb-0">
                                            <i class="bi bi-ticket-detailed text-purple"></i>
                                            {{ $transaction->billet->type }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light rounded p-3">
                                        <p class="text-muted small mb-1">Quantité</p>
                                        <p class="fw-bold mb-0">{{ $transaction->quantite }} billet(s)</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light rounded p-3">
                                        <p class="text-muted small mb-1">Prix unitaire</p>
                                        <p class="fw-bold mb-0">{{ number_format($transaction->prix_unitaire, 0, ',', ' ') }} FCFA</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-purple bg-opacity-10 rounded p-3 border border-purple">
                                        <p class="text-purple small mb-1">Montant total</p>
                                        <p class="fw-bold text-with h4 mb-0">{{ number_format($transaction->montant_total, 0, ',', ' ') }} FCFA</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- QR Code -->
                        <section class="mb-4">
                            <h4 class="fw-bold mb-3 d-flex align-items-center">
                                <i class="bi bi-qr-code text-purple me-2"></i>
                                Votre QR Code d'accès
                            </h4>
                            <div class="text-center">
                                <div class="bg-light rounded p-4 d-inline-block">
                                    @if($transaction->qr_code_url)
                                        <img src="{{ $transaction->qr_code_url }}"
                                             alt="QR Code"
                                             class="img-fluid"
                                             style="max-width: 300px;">
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="bi bi-exclamation-triangle me-2"></i>
                                            QR Code en cours de génération...
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Présentez ce QR code à l'entrée de l'événement
                                    </p>
                                    <p class="text-danger small fw-semibold mb-3">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                        Ce QR code ne peut être scanné qu'une seule fois
                                    </p>
                                </div>
                            </div>
                        </section>

                        <!-- Boutons d'action -->
                        <div class="d-flex flex-wrap gap-3 justify-content-center">
                            <a href="{{ route('p.transaction.download-qr', $transaction->id) }}"
                               class="btn btn-purple btn-lg">
                                <i class="bi bi-download me-2"></i>
                                Télécharger le QR Code
                            </a>
                            <button onclick="window.print()" class="btn btn-outline-purple btn-lg">
                                <i class="bi bi-printer me-2"></i>
                                Imprimer
                            </button>
                            <a href="{{ route('index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-house-door me-2"></i>
                                Retour à l'accueil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-purple {
    background-color: #6f42c1 !important;
}

.text-purple {
    color: #6f42c1 !important;
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

.border-purple {
    border-color: #6f42c1 !important;
}

@media print {
    .btn, nav, footer {
        display: none !important;
    }

    .card {
        box-shadow: none !important;
        border: 1px solid #dee2e6 !important;
    }
}
</style>

@endsection
