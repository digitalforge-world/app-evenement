@extends('layouts.base')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $evenement->titre }} - App-Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .event-header-img {
            height: 400px;
            object-fit: cover;
            width: 100%;
        }
        .info-card {
            border-left: 4px solid #0d6efd;
        }
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s;
        }
        .social-link:hover {
            transform: translateY(-3px);
        }
        .badge-custom {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('p.evenement') }}">Événements</a></li>
                <li class="breadcrumb-item active">{{ $evenement->titre }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Contenu principal -->
            <div class="col-lg-8">
                <!-- Image principale -->
                <div class="card border-0 shadow-sm mb-4">
                    <img src="{{ $evenement->photo_url }}"
                         alt="{{ $evenement->titre }}"
                         class="event-header-img rounded-top">
                    <div class="card-body">
                        <!-- Titre et catégorie -->
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h1 class="h2 fw-bold mb-0">{{ $evenement->titre }}</h1>
                            <span class="badge bg-primary badge-custom">{{ $evenement->categorie }}</span>
                        </div>

                        <!-- Statut -->
                        @if($evenement->is_upcoming)
                            <span class="badge bg-success mb-3">
                                <i class="fas fa-clock me-1"></i> À venir
                            </span>
                        @else
                            <span class="badge bg-secondary mb-3">
                                <i class="fas fa-history me-1"></i> Événement passé
                            </span>
                        @endif

                        <!-- Description -->
                        <div class="mt-4">
                            <h3 class="h5 fw-bold mb-3">Description</h3>
                            <p class="text-muted" style="white-space: pre-line;">{{ $evenement->description ?? 'Aucune description disponible.' }}</p>
                        </div>

                        <!-- Vidéo si disponible -->
                        @if($evenement->video)
                        <div class="mt-4">
                            <h3 class="h5 fw-bold mb-3">Vidéo de présentation</h3>
                            <video controls class="w-100 rounded">
                                <source src="{{ asset('storage/evenement/videos/' . $evenement->video) }}" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </video>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Billets disponibles -->
                @if($evenement->billets && $evenement->billets->count() > 0)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 fw-bold mb-4">Billets disponibles</h3>
                        <div class="row g-3">
                            @foreach($evenement->billets as $billet)
                            <div class="col-md-6">
                                <div class="card h-100 border">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title mb-0">{{ $billet->nom }}</h5>
                                            <span class="badge bg-light text-dark">{{ $billet->quantite_disponible }} restants</span>
                                        </div>
                                        <p class="text-muted small mb-3">{{ $billet->description }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold fs-5 text-primary">
                                                {{ number_format($billet->prix, 0, ',', ' ') }} FCFA
                                            </span>
                                            @if($evenement->is_upcoming && $billet->quantite_disponible > 0)
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-ticket-alt me-1"></i> Réserver
                                            </button>
                                            @else
                                            <button class="btn btn-sm btn-secondary" disabled>
                                                Indisponible
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Sponsors -->
                @if($evenement->sponsors && $evenement->sponsors->count() > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="h5 fw-bold mb-4">Sponsors</h3>
                        <div class="row g-3">
                            @foreach($evenement->sponsors as $sponsor)
                            <div class="col-md-4 text-center">
                                @if($sponsor->logo)
                                <img src="{{ asset('storage/' . $sponsor->logo) }}"
                                     alt="{{ $sponsor->nom }}"
                                     class="img-fluid mb-2"
                                     style="max-height: 80px;">
                                @endif
                                <p class="mb-0 fw-bold">{{ $sponsor->nom }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Informations principales -->
                <div class="card border-0 shadow-sm mb-4 info-card">
                    <div class="card-body">
                        <h3 class="h5 fw-bold mb-4">Informations</h3>

                        <!-- Date -->
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-calendar-day text-primary me-3 mt-1"></i>
                            <div>
                                <strong class="d-block">Date</strong>
                                <span class="text-muted">{{ $evenement->formatted_date }}</span>
                            </div>
                        </div>

                        <!-- Horaire -->
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-clock text-primary me-3 mt-1"></i>
                            <div>
                                <strong class="d-block">Horaire</strong>
                                <span class="text-muted">{{ $evenement->formatted_start_time }} - {{ $evenement->formatted_end_time }}</span>
                            </div>
                        </div>

                        <!-- Lieu -->
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-3 mt-1"></i>
                            <div>
                                <strong class="d-block">Lieu</strong>
                                <span class="text-muted">{{ $evenement->lieu }}</span>
                                @if($evenement->lien_google_map)
                                <a href="{{ $evenement->lien_google_map }}"
                                   target="_blank"
                                   class="d-block text-primary mt-1">
                                    <i class="fas fa-external-link-alt me-1"></i> Voir sur Google Maps
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Prix -->
                        @if($evenement->min_price > 0)
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-tag text-primary me-3 mt-1"></i>
                            <div>
                                <strong class="d-block">Prix</strong>
                                <span class="text-muted">À partir de {{ number_format($evenement->min_price, 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>
                        @else
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-tag text-primary me-3 mt-1"></i>
                            <div>
                                <strong class="d-block text-success">Entrée gratuite</strong>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Contact organisateur -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 fw-bold mb-4">Organisateur</h3>

                        <p class="mb-3">
                            <i class="fas fa-user text-primary me-2"></i>
                            <strong>{{ $evenement->nom_proprietaire }}</strong>
                        </p>

                        @if($evenement->telephone)
                        <p class="mb-3">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <a href="tel:{{ $evenement->telephone }}">{{ $evenement->telephone }}</a>
                        </p>
                        @endif

                        @if($evenement->email)
                        <p class="mb-3">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:{{ $evenement->email }}">{{ $evenement->email }}</a>
                        </p>
                        @endif

                        <!-- Réseaux sociaux -->
                        @if($evenement->facebook || $evenement->whatsapp || $evenement->twiter)
                        <div class="mt-4">
                            <strong class="d-block mb-3">Suivez-nous</strong>
                            <div>
                                @if($evenement->facebook)
                                <a href="{{ $evenement->facebook }}" target="_blank" class="social-link bg-primary text-white">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                @endif

                                @if($evenement->whatsapp)
                                <a href="https://wa.me/{{ $evenement->whatsapp }}" target="_blank" class="social-link bg-success text-white">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                @endif

                                @if($evenement->twiter)
                                <a href="{{ $evenement->twiter }}" target="_blank" class="social-link bg-info text-white">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Bouton de partage -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="h6 fw-bold mb-3">Partager cet événement</h3>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               target="_blank"
                               class="btn btn-primary btn-sm">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($evenement->titre) }}"
                               target="_blank"
                               class="btn btn-info btn-sm text-white">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($evenement->titre . ' - ' . url()->current()) }}"
                               target="_blank"
                               class="btn btn-success btn-sm">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection
