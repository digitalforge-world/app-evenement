@extends('layouts.Obase')
@section('title', 'Tous les Billets')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Tous les Billets</h5>
                            <p class="text-sm mb-0">
                                Vue d'ensemble de tous vos billets d'événements
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="{{ route('organisateur.billet-form') }}" class="btn bg-gradient-primary btn-sm mb-0">
                                    <i class="fas fa-plus"></i> Nouveau Billet
                                </a>
                                <a href="#" class="btn btn-outline-secondary btn-sm mb-0 ms-2">
                                    <i class="fas fa-filter"></i> Vue avec Filtres
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Messages de succès/erreur -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
                        <span class="alert-icon"><i class="fas fa-check"></i></span>
                        <span class="alert-text">{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
                        <span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
                        <span class="alert-text">{{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Tableau des billets -->
                <div class="table-responsive">
                    <table class="table table-flush" id="all-billets-table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Événement
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Type & Prix
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Stock
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Ventes
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Performance
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Statut
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($billets)
                                @foreach($billets as $billet)
                                    <tr>
                                        <!-- Événement -->
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm font-weight-bold">{{ $billet->evenement->titre }}</h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fas fa-calendar me-1"></i>
                                                        {{ \Carbon\Carbon::parse($billet->evenement->date)->format('d/m/Y à H:i') }}
                                                    </p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fas fa-map-marker-alt me-1"></i>
                                                        {{ Str::limit($billet->evenement->lieu, 30) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Type & Prix -->
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="badge badge-sm mb-1
                                                    @switch($billet->type)
                                                        @case('VIP')
                                                            bg-gradient-warning
                                                            @break
                                                        @case('PREMIUM')
                                                            bg-gradient-info
                                                            @break
                                                        @case('STANDARD')
                                                            bg-gradient-secondary
                                                            @break
                                                        @default
                                                            bg-gradient-primary
                                                    @endswitch
                                                ">{{ $billet->type }}</span>
                                                <span class="text-xs font-weight-bold text-success">
                                                    {{ number_format($billet->prix, 0, ',', ' ') }} FCFA
                                                </span>
                                            </div>
                                        </td>

                                        <!-- Stock -->
                                        <td class="align-middle text-center">
                                            <div class="d-flex flex-column align-items-center">
                                                <span class="text-sm font-weight-bold mb-1">
                                                    {{ $billet->quantite_disponible }}/{{ $billet->quantite_totale }}
                                                </span>
                                                @php
                                                    $stockPourcentage = $billet->quantite_totale > 0
                                                        ? ($billet->quantite_disponible / $billet->quantite_totale) * 100
                                                        : 0;
                                                @endphp
                                                <div class="progress" style="width: 60px; height: 4px;">
                                                    <div class="progress-bar
                                                        @if($stockPourcentage > 50) bg-success
                                                        @elseif($stockPourcentage > 20) bg-warning
                                                        @else bg-danger
                                                        @endif"
                                                        style="width: {{ $stockPourcentage }}%">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Ventes -->
                                        <td class="align-middle text-center">
                                            <div class="d-flex flex-column align-items-center">
                                                <span class="text-sm font-weight-bold text-info mb-1">
                                                    {{ $billet->quantite_vendue }}
                                                </span>
                                                <span class="text-xs text-secondary">
                                                    {{ number_format($billet->quantite_vendue * $billet->prix, 0, ',', ' ') }} FCFA
                                                </span>
                                            </div>
                                        </td>

                                        <!-- Performance -->
                                        <td class="align-middle text-center">
                                            @php
                                                $tauxVente = $billet->quantite_totale > 0
                                                    ? ($billet->quantite_vendue / $billet->quantite_totale) * 100
                                                    : 0;
                                            @endphp
                                            <div class="d-flex flex-column align-items-center">
                                                <span class="text-sm font-weight-bold
                                                    @if($tauxVente >= 80) text-success
                                                    @elseif($tauxVente >= 50) text-warning
                                                    @else text-secondary
                                                    @endif">
                                                    {{ number_format($tauxVente, 1) }}%
                                                </span>
                                                <div class="progress mt-1" style="width: 50px; height: 3px;">
                                                    <div class="progress-bar
                                                        @if($tauxVente >= 80) bg-success
                                                        @elseif($tauxVente >= 50) bg-warning
                                                        @else bg-info
                                                        @endif"
                                                        style="width: {{ $tauxVente }}%">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Statut -->
                                        <td class="align-middle text-center text-sm">
                                            @if($billet->quantite_disponible <= 0)
                                                <span class="badge badge-sm bg-gradient-danger">
                                                    <i class="fas fa-times me-1"></i>Épuisé
                                                </span>
                                            @elseif($tauxVente >= 80)
                                                <span class="badge badge-sm bg-gradient-warning">
                                                    <i class="fas fa-exclamation-triangle me-1"></i>Stock faible
                                                </span>
                                            @elseif($tauxVente >= 50)
                                                <span class="badge badge-sm bg-gradient-info">
                                                    <i class="fas fa-trending-up me-1"></i>En cours
                                                </span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-success">
                                                    <i class="fas fa-check me-1"></i>Disponible
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Actions -->
                                        <td class="align-middle text-center">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-link text-secondary" data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v text-xs"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="{{-- route('organisateur.show-billet', $billet) --}}">
                                                            <i class="fas fa-eye me-2 text-info"></i> Voir détails
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{-- route('organisateur.edit-billet', $billet) --}}">
                                                            <i class="fas fa-edit me-2 text-warning"></i> Modifier
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{-- route('organisateur.evenement-billets', $billet->evenement_id) --}}">
                                                            <i class="fas fa-list me-2 text-primary"></i> Billets événement
                                                        </a>
                                                    </li>
                                                    @if($billet->quantite_vendue == 0)
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="{{-- route('organisateur.destroy-billet', $billet) --}}"
                                                                method="POST"
                                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce billet ?')"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="fas fa-trash me-2"></i> Supprimer
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-ticket-alt fa-4x text-secondary mb-4 opacity-6"></i>
                                            <h5 class="text-secondary mb-2">Aucun billet trouvé</h5>
                                            <p class="text-sm text-secondary mb-4 mx-auto" style="max-width: 400px;">
                                                Vous n'avez pas encore créé de billets pour vos événements.
                                                Commencez par créer votre premier billet.
                                            </p>
                                            <a href="{{ route('organisateur.billet-form') }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-2"></i> Créer mon premier billet
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($billets->hasPages())
                    <div class="card-footer px-3">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <p class="text-xs text-secondary mb-0">
                                    Affichage de {{ $billets->firstItem() }} à {{ $billets->lastItem() }}
                                    sur {{ $billets->total() }} billets au total
                                </p>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                {{ $billets->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Cartes statistiques globales -->
    @if($billets->count() > 0)
        <div class="row mt-4">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Billets</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ number_format($billets->sum('quantite_totale')) }}
                                    </h5>
                                    <p class="mb-0 text-xs">
                                        <span class="text-success font-weight-bolder">{{ $billets->count() }}</span>
                                        types différents
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fas fa-ticket-alt text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Billets Vendus</p>
                                    <h5 class="font-weight-bolder mb-0 text-success">
                                        {{ number_format($billets->sum('quantite_vendue')) }}
                                    </h5>
                                    @php
                                        $totalStock = $billets->sum('quantite_totale');
                                        $totalVendu = $billets->sum('quantite_vendue');
                                        $tauxGlobal = $totalStock > 0 ? ($totalVendu / $totalStock) * 100 : 0;
                                    @endphp
                                    <p class="mb-0 text-xs">
                                        <span class="text-success font-weight-bolder">{{ number_format($tauxGlobal, 1) }}%</span>
                                        du stock total
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="fas fa-chart-line text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Disponibles</p>
                                    <h5 class="font-weight-bolder mb-0 text-info">
                                        {{ number_format($billets->sum('quantite_disponible')) }}
                                    </h5>
                                    @php
                                        $billetsEpuises = $billets->where('quantite_disponible', 0)->count();
                                    @endphp
                                    <p class="mb-0 text-xs">
                                        @if($billetsEpuises > 0)
                                            <span class="text-danger font-weight-bolder">{{ $billetsEpuises }}</span>
                                            type(s) épuisé(s)
                                        @else
                                            <span class="text-success font-weight-bolder">Tous</span>
                                            en stock
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                    <i class="fas fa-warehouse text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">CA Réalisé</p>
                                    <h5 class="font-weight-bolder mb-0 text-warning">
                                        {{ number_format($billets->sum(function($billet) {
                                            return $billet->quantite_vendue * $billet->prix;
                                        }), 0, ',', ' ') }}
                                    </h5>
                                    <p class="mb-0 text-xs">
                                        <span class="text-warning font-weight-bolder">FCFA</span>
                                        générés
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="fas fa-coins text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    // DataTable initialization (optional)
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-refresh every 5 minutes for real-time updates
        setInterval(function() {
            if (document.visibilityState === 'visible') {
                location.reload();
            }
        }, 300000); // 5 minutes
    });
</script>
@endpush
@endsection
