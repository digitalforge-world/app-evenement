<?php

namespace App\Http\Controllers;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Faq;
use Carbon\Carbon;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer d'abord les événements futurs
        $upcomingEvents = Evenement::with(['user', 'billets', 'sponsors'])
                                  ->where('statut', 'publier')
                                  ->where('date', '>=', now()->toDateString())
                                  ->orderBy('date', 'asc')
                                  ->limit(6)
                                  ->get();

        // Si pas assez d'événements futurs, compléter avec les événements passés récents
        $eventsToShow = $upcomingEvents;
        if ($upcomingEvents->count() < 6) {
            $remainingSlots = 6 - $upcomingEvents->count();

            $pastEvents = Evenement::with(['user', 'billets', 'sponsors'])
                                  ->where('statut', 'publier')
                                  ->where('date', '<', now()->toDateString())
                                  ->orderBy('date', 'desc')
                                  ->limit($remainingSlots)
                                  ->get();

            $eventsToShow = $upcomingEvents->merge($pastEvents);
        }

        // Transformation des données pour l'affichage
        $events = $eventsToShow->transform(function ($event) {
            $event->truncated_description = Str::limit($event->description, 150);
            $event->formatted_date = Carbon::parse($event->date)->format('d M Y');
            $event->formatted_start_time = Carbon::parse($event->start_heure)->format('H:i');
            $event->formatted_end_time = Carbon::parse($event->end_heure)->format('H:i');
            $event->photo_url = $event->photo ? asset('storage/evenement/photo/' . $event->photo) : asset('images/default-event.jpg');
            $event->is_upcoming = Carbon::parse($event->date)->isFuture();

            // Prix minimum des billets pour cet événement
            $event->min_price = $event->billets->min('prix') ?? 0;

            return $event;
        });

        // Récupérer les catégories pour la section catégories
        $categories = [
            [
                'name' => 'Concerts & Musique',
                'description' => 'Découvrez les meilleurs concerts et festivals',
                'image' => 'https://th.bing.com/th/id/OIP.UqehV_VtqVVYuN8GJvYaqQHaEK?w=295&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7',
                'slug' => 'concert'
            ],
            [
                'name' => 'Sports & Fitness',
                'description' => 'Événements sportifs et activités fitness',
                'image' => 'https://th.bing.com/th/id/OIP.g3L8Cs_9cEGghmtmZqAA7gHaE8?w=277&h=184&c=7&r=0&o=5&dpr=1.3&pid=1.7',
                'slug' => 'sport'
            ],
            [
                'name' => 'Ateliers & Formations',
                'description' => 'Développez vos compétences et passions',
                'image' => 'https://via.placeholder.com/300x200/6366f1/ffffff?text=Formation',
                'slug' => 'formation'
            ],
            [
                'name' => 'Arts & Culture',
                'description' => 'Expositions, théâtre et performances',
                'image' => 'https://th.bing.com/th/id/OIP.Th_AX048TT1Qnf8gvOJPDgHaE8?w=248&h=181&c=7&r=0&o=5&dpr=1.3&pid=1.7',
                'slug' => 'art'
            ]
        ];

        // Statistiques pour la page d'accueil
        $stats = [
            'total_events' => Evenement::where('statut', 'publier')->count(),
            'upcoming_events' => Evenement::where('statut', 'publier')
                                        ->where('date', '>=', now())
                                        ->count(),
            'total_categories' => Evenement::where('statut', 'publier')
                                         ->distinct('categorie')
                                         ->count('categorie')
        ];

        // Événement en vedette (priorité aux événements futurs, sinon le plus récent)
        $featuredEvent = Evenement::where('statut', 'publier')
                                 ->where('date', '>=', now()->toDateString())
                                 ->orderBy('date', 'asc')
                                 ->first();

        if (!$featuredEvent) {
            $featuredEvent = Evenement::where('statut', 'publier')
                                    ->orderBy('date', 'desc')
                                    ->first();
        }

        if ($featuredEvent) {
            $featuredEvent->truncated_description = Str::limit($featuredEvent->description, 300);
            $featuredEvent->photo_url = $featuredEvent->photo ? asset('storage/evenement/photo/' . $featuredEvent->photo) : asset('images/default-event.jpg');
            $featuredEvent->is_upcoming = Carbon::parse($featuredEvent->date)->isFuture();
        }

        return view('index', compact('events', 'categories', 'stats', 'featuredEvent'));
    }

    // ... autres méthodes restent inchangées
    public function show(string $id)
    {
        // Récupérer l'événement avec ses relations
        $detail_evenement = Evenement::with(['user', 'billets', 'sponsors'])
            ->where('statut', 'publier') // Uniquement les événements publiés
            ->findOrFail($id);

        // Formater les données de l'événement
        $detail_evenement->formatted_date = Carbon::parse($detail_evenement->date)->format('d/m/Y');
        $detail_evenement->formatted_date_long = Carbon::parse($detail_evenement->date)->locale('fr')->isoFormat('dddd D MMMM YYYY');
        $detail_evenement->formatted_start_time = Carbon::parse($detail_evenement->start_heure)->format('H:i');
        $detail_evenement->formatted_end_time = Carbon::parse($detail_evenement->end_heure)->format('H:i');
        // photo_url est déjà géré par l'accesseur du modèle Evenement
        $detail_evenement->is_upcoming = Carbon::parse($detail_evenement->date)->isFuture();
        $detail_evenement->days_until = Carbon::parse($detail_evenement->date)->diffInDays(now(), false);

        // Récupérer uniquement les billets disponibles (quantité > 0)
        $billets_disponibles = $detail_evenement->billets()
            ->where('quantite_disponible', '>', 0)
            ->orderBy('prix', 'asc')
            ->get();

        // Statistiques des billets pour cet événement
        $stats_billets = [
            'total_types' => $detail_evenement->billets->count(),
            'billets_disponibles' => $detail_evenement->billets->sum('quantite_disponible'),
            'billets_vendus' => $detail_evenement->billets->sum('quantite_vendue'),
            'prix_min' => $detail_evenement->billets->min('prix') ?? 0,
            'prix_max' => $detail_evenement->billets->max('prix') ?? 0,
            'taux_vente' => $detail_evenement->billets->sum('quantite_totale') > 0
                ? round(($detail_evenement->billets->sum('quantite_vendue') / $detail_evenement->billets->sum('quantite_totale')) * 100, 1)
                : 0
        ];

        // Événements similaires (même catégorie, futurs, différents de l'actuel)
        $evenements_similaires = Evenement::with(['billets'])
            ->where('statut', 'publier')
            ->where('categorie', $detail_evenement->categorie)
            ->where('id', '!=', $id)
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->limit(3)
            ->get()
            ->transform(function ($event) {
                $event->truncated_description = Str::limit($event->description, 120);
                $event->formatted_date = Carbon::parse($event->date)->format('d/m/Y');
                $event->photo_url = $event->photo
                    ? asset('storage/evenement/photo/' . $event->photo)
                    : asset('images/default-event.jpg');
                $event->min_price = $event->billets->min('prix') ?? 0;
                return $event;
            });

        return view('p.detail', compact('detail_evenement', 'billets_disponibles', 'stats_billets', 'evenements_similaires'));
    }

    public function a_propos()
    {
        return view('p.a-propos');
    }

    public function contact()
    {
        return view('p.contact');
    }

    public function concert_et_festival_de_musique()
    {
        return view('p.concerts-et-festival-de-musique');
    }

    public function conference_et_congres()
    {
        return view('p.conferences-et-congres');
    }

    public function evenement_sportif()
    {
        return view('p.evenement-sportif');
    }

    /**
     * Afficher tous les événements pour le public
     */
    public function evenement(Request $request)
    {
        $query = Evenement::with(['user', 'billets', 'sponsors'])
                          ->where('statut', 'publier'); // Seulement les événements publiés

        // Recherche par titre ou description
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('titre', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('lieu', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filtre par catégorie
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        // Filtre par lieu
        if ($request->filled('lieu')) {
            $query->where('lieu', 'LIKE', "%{$request->lieu}%");
        }

        // Filtre par date
        if ($request->filled('date_debut')) {
            $query->where('date', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->where('date', '<=', $request->date_fin);
        }

        // Tri - priorité aux événements futurs
        $sortBy = $request->get('sort', 'priority');
        switch ($sortBy) {
            case 'date_desc':
                $query->orderBy('date', 'desc');
                break;
            case 'titre_asc':
                $query->orderBy('titre', 'asc');
                break;
            case 'titre_desc':
                $query->orderBy('titre', 'desc');
                break;
            case 'recent':
                $query->orderBy('created_at', 'desc');
                break;
            case 'priority':
            default:
                // Événements futurs en premier, puis les passés
                $query->orderByRaw('CASE WHEN date >= CURDATE() THEN 0 ELSE 1 END')
                      ->orderBy('date', 'asc');
        }

        // Pagination avec conservation des paramètres de recherche
        $events = $query->paginate(12)->appends($request->query());

        // Transformation des données pour l'affichage
        $events->getCollection()->transform(function ($event) {
            $event->truncated_description = Str::limit($event->description, 200);
            $event->formatted_date = Carbon::parse($event->date)->format('d/m/Y');
            $event->formatted_start_time = Carbon::parse($event->start_heure)->format('H:i');
            $event->formatted_end_time = Carbon::parse($event->end_heure)->format('H:i');
            $event->photo_url = $event->photo ? asset('storage/evenement/photo/' . $event->photo) : asset('images/default-event.jpg');
            $event->is_upcoming = Carbon::parse($event->date)->isFuture();
            $event->min_price = $event->billets->min('prix') ?? 0;
            return $event;
        });

        // Récupérer les catégories et lieux pour les filtres
        $categories = Evenement::select('categorie')
                               ->distinct()
                               ->whereNotNull('categorie')
                               ->where('statut', 'publier')
                               ->pluck('categorie');

        $lieux = Evenement::select('lieu')
                          ->distinct()
                          ->whereNotNull('lieu')
                          ->where('statut', 'publier')
                          ->pluck('lieu');

        // Événement en vedette (le plus récent publié)
        $featuredEvent = Evenement::where('statut', 'publier')
                                  ->where('date', '>=', now()->toDateString())
                                  ->orderBy('date', 'asc')
                                  ->first();

        if (!$featuredEvent) {
            $featuredEvent = Evenement::where('statut', 'publier')
                                    ->orderBy('date', 'desc')
                                    ->first();
        }

        if ($featuredEvent) {
            $featuredEvent->truncated_description = Str::limit($featuredEvent->description, 300);
            $featuredEvent->photo_url = $featuredEvent->photo ? asset('storage/evenement/photo/' . $featuredEvent->photo) : asset('images/default-event.jpg');
            $featuredEvent->is_upcoming = Carbon::parse($featuredEvent->date)->isFuture();
        }

        return view('p.evenement', compact('events', 'categories', 'lieux', 'featuredEvent'));
    }

    public function faq($parameter = null)
    {
        $faqs = Faq::all();
        return view('P.faq', compact('faqs'));
    }

    public function fete()
    {
        return view('p.fete');
    }

    public function sante()
    {
        return view('p.santé');
    }

    public function vie_nocturne()
    {
        return view('p.vie-nocturne');
    }

    public function voyage()
    {
        return view('p.voyage');
    }
}
