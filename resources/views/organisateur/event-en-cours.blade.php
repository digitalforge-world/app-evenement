@extends('layouts.Obase')
@section('title', ' | Gestion des événements en attente')
@section('content')

<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --success-color: #4cc9f0;
        --warning-color: #f72585;
        --light-bg: #f8f9fa;
        --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --card-hover-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    body {
        background-color: #f5f7fb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--card-shadow);
    }

    .event-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: var(--card-shadow);
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-hover-shadow);
    }

    .card-img-container {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .card-img-top {
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .event-card:hover .card-img-top {
        transform: scale(1.05);
    }

    .status-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 10;
    }

    .card-body {
        padding: 1.5rem;
    }

    .event-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .event-category {
        display: inline-block;
        background-color: #e9ecef;
        color: #6c757d;
        padding: 0.25rem 0.5rem;
        border-radius: 20px;
        font-size: 0.8rem;
        margin-bottom: 1rem;
    }

    .event-details {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .event-details i {
        width: 20px;
        text-align: center;
        margin-right: 5px;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        gap: 0.5rem;
    }

    .btn-action {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem;
        border-radius: 8px;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }

    .btn-details {
        background-color: var(--success-color);
        color: white;
        border: none;
    }

    .btn-details:hover {
        background-color: #3aa8d0;
        color: white;
        transform: translateY(-2px);
    }

    .btn-edit {
        background-color: #ffc107;
        color: #212529;
        border: none;
    }

    .btn-edit:hover {
        background-color: #e0a800;
        color: #212529;
        transform: translateY(-2px);
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-delete:hover {
        background-color: #c82333;
        color: white;
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        background-color: white;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
    }

    .empty-state i {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 1rem;
    }

    .alert-custom {
        border-radius: 10px;
        border: none;
        box-shadow: var(--card-shadow);
    }

    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    .alert-info {
        background-color: #dbeafe;
        color: #1e40af;
        border-left: 4px solid #3b82f6;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .page-link {
        color: var(--primary-color);
        border-radius: 8px;
        margin: 0 3px;
        border: none;
    }

    .page-link:hover {
        color: var(--secondary-color);
        background-color: #e9ecef;
    }

    @media (max-width: 768px) {
        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            margin-bottom: 0.5rem;
        }
    }
</style>

<div class="container py-4">
    <!-- En-tête de page -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h2 mb-2"><i class="fas fa-clock me-2"></i>Événements en Attente</h1>
                <p class="mb-0">Gérez vos événements en cours de validation</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('organisateur.ajouter-un-evenement') }}" class="btn btn-light">
                    <i class="fas fa-plus me-2"></i>Nouvel événement
                </a>
            </div>
        </div>
    </div>

    <!-- Alertes de succès -->
    @if (session('evenement_ajouter'))
        <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <div>{{ session('evenement_ajouter') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Compteur d'événements -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info alert-custom">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>
                        <strong>{{ count($evenements) }}</strong> événement(s) en attente de validation
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des événements -->
    @if(count($evenements) > 0)
        <div class="row">
            @foreach ($evenements as $evenement)
                <div class="col-lg-4 col-md-6">
                    <div class="card event-card">
                        <div class="card-img-container">
                            @if($evenement->photo)
                                <img src="{{ asset('storage/evenement/photo/' . $evenement->photo) }}"
                                     class="card-img-top"
                                     alt="{{ $evenement->titre }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center h-100">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="status-badge">
                                <span class="badge bg-warning">
                                    <i class="fas fa-clock me-1"></i> En attente
                                </span>
                            </div>
                        </div>

                        <div class="card-body">
                            <h5 class="event-title">{{ $evenement->titre }}</h5>
                            <div class="event-category">{{ $evenement->categorie }}</div>

                            <div class="event-details">
                                <div class="mb-1">
                                    <i class="fas fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}
                                </div>
                                <div class="mb-1">
                                    <i class="fas fa-clock"></i>
                                    {{ $evenement->start_heure }} - {{ $evenement->end_heure }}
                                </div>
                                <div class="mb-1">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $evenement->lieu }}
                                </div>
                            </div>

                            <div class="action-buttons">
                                <a href="{{ route('organisateur.detail', $evenement->id) }}"
                                   class="btn btn-action btn-details"
                                   title="Voir les détails">
                                    <i class="fas fa-eye me-1"></i> Détails
                                </a>

                                <a href="{{ route('organisateur.update_form', $evenement->id) }}"
                                   class="btn btn-action btn-edit"
                                   title="Modifier l'événement">
                                    <i class="fas fa-edit me-1"></i> Modifier
                                </a>

                                <form action="{{ route('organisateur.supprimer', $evenement->id) }}"
                                      method="POST"
                                      class="d-inline delete-form"
                                      data-event-name="{{ $evenement->titre }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-action btn-delete"
                                            title="Supprimer l'événement">
                                        <i class="fas fa-trash me-1"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if(isset($evenements) && method_exists($evenements, 'hasPages') && $evenements->hasPages())
            <div class="pagination-container">
                {{ $evenements->links() }}
            </div>
        @endif

    @else
        <!-- État vide -->
        <div class="empty-state">
            <i class="fas fa-calendar-times"></i>
            <h3 class="h4 mb-3">Aucun événement en attente</h3>
            <p class="text-muted mb-4">
                Vous n'avez actuellement aucun événement en attente de validation.
            </p>
            <a href="{{ route('organisateur.ajouter-un-evenement') }}"
               class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Créer un nouvel événement
            </a>
        </div>
    @endif
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirmation de suppression
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const eventName = this.getAttribute('data-event-name');
                if (!confirm(`Êtes-vous sûr de vouloir supprimer l'événement "${eventName}" ? Cette action est irréversible.`)) {
                    e.preventDefault();
                }
            });
        });

        // Auto-dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert.classList.contains('show')) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        });

        // Animation d'apparition des cartes
        const eventCards = document.querySelectorAll('.event-card');
        eventCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>

@endsection
