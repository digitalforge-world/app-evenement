@extends('layouts.base')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App-Event - Découvrez les meilleurs événements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .event-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0;
        }

        .category-btn.active {
            background-color: #0d6efd !important;
            color: white !important;
        }

        .card-img-wrapper {
            width: 100%;
            height: 250px;
            overflow: hidden;
            position: relative;
            background-color: #f8f9fa;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .featured-event {
            background: linear-gradient(45deg, #0d6efd, #6f42c1);
        }

        .footer-bg {
            background-color: #212529;
        }

        .badge-past {
            background-color: #6c757d !important;
        }

        .badge-upcoming {
            background-color: #198754 !important;
        }

        .event-status {
            font-size: 0.75rem;
        }

        .featured-img-wrapper {
            width: 100%;
            height: 400px;
            overflow: hidden;
            border-radius: 0.5rem;
        }

        .featured-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="display-4 fw-bold mb-4">Découvrez les meilleurs événements près de chez vous</h1>
                    <p class="fs-5 mb-5">Trouvez et participez à des événements exceptionnels. Concerts, conférences, sports et bien plus encore.</p>

                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <form action="{{ route('p.evenement') }}" method="GET">
                                <div class="input-group input-group-lg bg-white rounded">
                                    <input type="text" name="search" class="form-control border-0" placeholder="Rechercher un événement..." value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Categories -->
        <section class="mb-5">
            <h2 class="h2 fw-bold mb-4 text-dark">Catégories populaires</h2>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('p.evenement', ['categorie' => 'concert et festivals de musique']) }}" class="btn btn-outline-secondary rounded-pill category-btn">
                    <i class="fas fa-music me-2"></i> Musique
                </a>
                <a href="{{ route('p.evenement', ['categorie' => 'fete']) }}" class="btn btn-outline-secondary rounded-pill category-btn">
                    <i class="fas fa-utensils me-2"></i> Gastronomie
                </a>
                <a href="{{ route('p.evenement', ['categorie' => 'evenement sportif']) }}" class="btn btn-outline-secondary rounded-pill category-btn">
                    <i class="fas fa-running me-2"></i> Sport
                </a>
                <a href="{{ route('p.evenement', ['categorie' => 'voyage']) }}" class="btn btn-outline-secondary rounded-pill category-btn">
                    <i class="fas fa-plane-departure me-2"></i> Voyages
                </a>
                <a href="{{ route('p.evenement', ['categorie' => 'santé']) }}" class="btn btn-outline-secondary rounded-pill category-btn">
                    <i class="fas fa-heartbeat me-2"></i> Santé
                </a>
                <a href="{{ route('p.evenement', ['categorie' => 'vie nocturne']) }}" class="btn btn-outline-secondary rounded-pill category-btn">
                    <i class="fas fa-cocktail me-2"></i> Vie nocturne
                </a>
                <a href="{{ route('p.evenement', ['categorie' => 'conferences et congres']) }}" class="btn btn-outline-secondary rounded-pill category-btn">
                    <i class="fas fa-microphone me-2"></i> Conférences
                </a>
            </div>
        </section>

        <!-- Statistiques -->
        @if(isset($stats))

        @endif

        <!-- Événements -->
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h2 fw-bold text-dark">
                    @if($events->where('is_upcoming', true)->count() > 0)
                        Événements à venir
                    @else
                        Événements récents
                    @endif
                </h2>
                <a href="{{ route('p.evenement') }}" class="text-primary text-decoration-none">Voir tout</a>
            </div>

            @if($events->count() > 0)
                <div class="row g-4">
                    @foreach($events as $event)
                        <div class="col-lg-4 col-md-6">
                            <div class="card event-card h-100 border-0 shadow-sm">
                                <div class="card-img-wrapper">
                                    <img src="{{ $event->photo_url }}"
                                         alt="{{ $event->titre }}"
                                         class="card-img-top"
                                         loading="lazy">
                                    <span class="position-absolute top-0 end-0 m-3 badge bg-primary">
                                        {{ $event->categorie ?? 'Événement' }}
                                    </span>
                                    @if($event->is_upcoming)
                                        <span class="position-absolute top-0 start-0 m-3 badge badge-upcoming event-status">
                                            <i class="fas fa-clock me-1"></i> À venir
                                        </span>
                                    @else
                                        <span class="position-absolute top-0 start-0 m-3 badge badge-past event-status">
                                            <i class="fas fa-history me-1"></i> Passé
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title fw-bold">{{ $event->titre }}</h5>
                                        <span class="badge bg-light text-dark">
                                            @if($event->min_price > 0)
                                                Payant
                                            @else
                                                Gratuit
                                            @endif
                                        </span>
                                    </div>
                                    <p class="card-text text-muted">{{ $event->truncated_description }}</p>

                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <i class="fas fa-calendar-day me-2"></i>
                                        <span>{{ $event->formatted_date }}</span>
                                    </div>

                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <i class="fas fa-clock me-2"></i>
                                        <span>{{ $event->formatted_start_time }} - {{ $event->formatted_end_time }}</span>
                                    </div>

                                    <div class="d-flex align-items-center text-muted mb-3">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <span>{{ $event->lieu }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        @if($event->min_price > 0)
                                            <span class="fw-bold fs-6">À partir de {{ number_format($event->min_price, 0, ',', ' ') }} FCFA</span>
                                        @else
                                            <span class="fw-bold fs-6 text-success">Gratuit</span>
                                        @endif
                                        <a href="{{ route('p.detail', $event->id) }}" class="btn btn-primary">
                                            @if($event->is_upcoming)
                                                Réserver
                                            @else
                                                Details
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                    <h3 class="text-muted">Aucun événement disponible</h3>
                    <p class="text-muted">Revenez bientôt pour découvrir de nouveaux événements passionnants !</p>
                </div>
            @endif
        </section>

        <!-- Événement en vedette -->
        @if(isset($featuredEvent) && $featuredEvent)
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h2 fw-bold text-dark">Événement en vedette</h2>
            </div>

            <div class="featured-event rounded p-4 p-lg-5 text-white">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h3 class="display-6 fw-bold mb-4">{{ $featuredEvent->titre }}</h3>
                        <p class="fs-5 mb-4">{{ $featuredEvent->truncated_description }}</p>

                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-calendar-day me-2"></i>
                            <span>{{ \Carbon\Carbon::parse($featuredEvent->date)->format('d M Y') }}</span>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-clock me-2"></i>
                            <span>{{ \Carbon\Carbon::parse($featuredEvent->start_heure)->format('H:i') }} - {{ \Carbon\Carbon::parse($featuredEvent->end_heure)->format('H:i') }}</span>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span>{{ $featuredEvent->lieu }}</span>
                        </div>

                        <a href="{{ route('p.detail', $featuredEvent->id) }}" class="btn btn-light btn-lg text-primary fw-bold">
                            En savoir plus
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="featured-img-wrapper shadow">
                            <img src="{{ $featuredEvent->photo_url }}"
                                 alt="{{ $featuredEvent->titre }}"
                                 loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- Newsletter -->
        <section class="bg-light rounded p-4 p-lg-5 text-center">
            <h2 class="h2 fw-bold mb-3 text-dark">Ne manquez aucun événement</h2>
            <p class="text-muted mb-4">Abonnez-vous à notre newsletter pour recevoir les derniers événements directement dans votre boîte mail.</p>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Votre email" required>
                            <button class="btn btn-primary" type="submit">S'abonner</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Active category selection
        const categoryBtns = document.querySelectorAll('.category-btn');
        categoryBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                categoryBtns.forEach(b => {
                    b.classList.remove('active');
                });
                btn.classList.add('active');
            });
        });
    </script>
</body>

@endsection
