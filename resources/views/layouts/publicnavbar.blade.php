<nav class="navbar navbar-expand-lg bg-body-tertiary fixed fixed-top inset-x-0 top-0 z-50 navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand px-3 font-bold text-lg" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas"
            aria-controls="navbarOffcanvas" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon "></span>
        </button>
        <div class="offcanvas offcanvas-start" tabindex="1" id="navbarOffcanvas"
            aria-labelledby="navbarOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="navbarOffcanvasLabel"><a href="{{url('/')}}"
                        class="nav-link">EvenAf</a></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto mb-lg-0">
                    <li class="nav-item p-0 font-bold text-lg">
                        <a class="nav-link active" href="{{ route('p.evenement') }}" aria-expanded="false">
                            Trouver les événements
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCategories" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Catégories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownCategories">
                            <li><a class="dropdown-item" href="{{ route('p.evenement', ['categorie' => 'concert et festivals de musique']) }}">Concerts</a></li>
                            <li><a class="dropdown-item" href="{{ route('p.evenement', ['categorie' => 'conferences et congres']) }}">Conférences</a></li>
                            <li><a class="dropdown-item" href="{{ route('p.evenement', ['categorie' => 'evenement sportif']) }}">Sports</a></li>
                            <li><a class="dropdown-item" href="{{ route('p.evenement', ['categorie' => 'santé']) }}">Santés</a></li>
                            <li><a class="dropdown-item" href="{{ route('p.evenement', ['categorie' => 'vie nocturne']) }}">Vie nocturnes</a></li>
                            <li><a class="dropdown-item" href="{{ route('p.evenement', ['categorie' => 'voyage']) }}">Voyages</a></li>
                            <li><a class="dropdown-item" href="{{ route('p.evenement', ['categorie' => 'fete']) }}">Fêtes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item font-bold text-lg">
                        <a class="nav-link" aria-current="page" href="{{ route('p.a-propos') }}">À propos</a>
                    </li>
                    <li class="nav-item font-bold text-lg">
                        <a class="nav-link" aria-current="page" href="{{ route('p.faq') }}">FAQ</a>
                    </li>
                    
                    @guest
                        <li class="nav-item ms-2">
                            <a href="{{ route('login') }}" class="btn btn-primary">{{ __('Connexion') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" 
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('asset/svgs/solid/user.svg') }}" alt="User" class="rounded-circle me-2" width="32" height="32">
                                <span>{{ Auth::user()->nom }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-user me-2"></i>Mon profil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-calendar me-2"></i>Mes réservations
                                    </a>
                                </li>
                                @if(Auth::user()->role == 'organisateur')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('organisateur.dashboard') }}">
                                            <i class="fa fa-dashboard me-2"></i>Tableau de bord
                                        </a>
                                    </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out me-2"></i>{{ __('Déconnexion') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>