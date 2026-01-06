<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BilletController extends Controller
{
    /**
     * Afficher la liste des billets avec filtrage
     */
    public function index(Request $request)
    {
        // Récupération des paramètres de recherche
        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');
        $typeBillet = $request->input('type_billet');
        $evenementId = $request->input('evenement_id');

        // Construction de la requête pour récupérer les billets avec leurs événements
        $query = Billet::with(['evenement' => function($q) {
            $q->select('id', 'titre', 'date', 'lieu');
        }]);

        // Filtrage par type de billet
        if (!empty($typeBillet)) {
            $query->where('type', $typeBillet);
        }

        // Filtrage par événement spécifique
        if (!empty($evenementId)) {
            $query->where('evenement_id', $evenementId);
        }

        // Filtrage par date via la relation avec l'événement
        if (!empty($dateDebut) || !empty($dateFin)) {
            $query->whereHas('evenement', function($q) use ($dateDebut, $dateFin) {
                if (!empty($dateDebut)) {
                    $q->where('date', '>=', Carbon::parse($dateDebut)->startOfDay());
                }
                if (!empty($dateFin)) {
                    $q->where('date', '<=', Carbon::parse($dateFin)->endOfDay());
                }
            });
        }

        // Tri par date d'événement (plus récent en premier)
        $query->join('evenements', 'billets.evenement_id', '=', 'evenements.id')
              ->orderBy('evenements.date', 'desc')
              ->orderBy('billets.type', 'asc')
              ->select('billets.*'); // Pour éviter les conflits de colonnes

        $billets = $query->paginate(15);

        // Pour le formulaire de filtrage
        $evenements = Evenement::select('id', 'titre', 'date')
                               ->orderBy('date', 'desc')
                               ->get();

        $typesBillets = Billet::distinct()->pluck('type')->filter();

        return view('organisateur.billetindex', compact('billets', 'evenements', 'typesBillets'));
    }

    /**
     * Afficher tous les billets (vue alternative)
     */
    public function allBillets(Request $request)
    {
        $query = Billet::with(['evenement' => function($q) {
            $q->select('id', 'titre', 'date', 'lieu');
        }]);

        // Tri par défaut
        $query->join('evenements', 'billets.evenement_id', '=', 'evenements.id')
              ->orderBy('evenements.date', 'desc')
              ->select('billets.*');

        $billets = $query->paginate(20);

        return view('organisateur.allbillet', compact('billets'));
    }

    /**
     * Afficher les billets d'un événement spécifique
     */
    public function billetsByEvenement(Request $request, $evenementId)
    {
        $evenement = Evenement::findOrFail($evenementId);

        $billets = Billet::where('evenement_id', $evenementId)
                         ->orderBy('type', 'asc')
                         ->paginate(15);

        return view('organisateur.evenement-billets', compact('billets', 'evenement'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $evenementid = Evenement::select('id', 'titre', 'date', 'lieu')
                               ->orderBy('date', 'desc')
                               ->get();

        return view('organisateur.billet', compact('evenementid'));
    }

    /**
     * Enregistrer un nouveau billet
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'nullable|string|max:50',
            'prix' => 'nullable|numeric|min:0',
            'quantite' => 'nullable|integer|min:0',
            'evenement_id' => 'required|exists:evenements,id',
        ], [
            'prix.min' => 'Le prix minimum est 0 FCFA',
            'prix.numeric' => 'Le prix doit être un nombre',
            'quantite.min' => 'La quantité minimum est 0',
            'quantite.integer' => 'La quantité doit être un nombre entier',
            'evenement_id.required' => 'Vous devez sélectionner un événement',
            'evenement_id.exists' => 'L\'événement sélectionné n\'existe pas',
        ]);

        // Vérifier si un billet du même type existe déjà pour cet événement
        $billetExistant = Billet::where('evenement_id', $validatedData['evenement_id'])
                                ->where('type', $validatedData['type'] ?? 'STANDARD')
                                ->first();

        if ($billetExistant) {
            return back()->withErrors(['type' => 'Un billet de ce type existe déjà pour cet événement'])
                        ->withInput();
        }

        // Créer le billet avec des valeurs par défaut
        $quantite = $validatedData['quantite'] ?? 0;

        $billet = Billet::create([
            'type' => $validatedData['type'] ?? 'STANDARD',
            'prix' => $validatedData['prix'] ?? 0,
            'quantite' => $quantite,
            'quantite_totale' => $quantite,
            'quantite_disponible' => $quantite,
            'quantite_vendue' => 0,
            'evenement_id' => $validatedData['evenement_id'],
        ]);

        return redirect()->route('organisateur.billet-form')
                        ->with('success', 'Le billet a été ajouté avec succès');
    }

    /**
     * Afficher tous les événements avec leurs billets
     */
    public function showBilletsByEvent()
    {
        // Récupérer les événements futurs avec leurs billets
        $evenementsFuturs = Evenement::with(['billets'])
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->get();

        // Récupérer les événements passés avec leurs billets
        $evenementsPasses = Evenement::with(['billets'])
            ->where('date', '<', now())
            ->orderBy('date', 'desc')
            ->get();

        // Statistiques globales
        $statsGlobales = [
            'total_evenements' => Evenement::count(),
            'evenements_futurs' => $evenementsFuturs->count(),
            'evenements_passes' => $evenementsPasses->count(),
            'total_billets_disponibles' => Billet::sum('quantite_disponible'),
            'total_billets_vendus' => Billet::sum('quantite_vendue'),
            'chiffre_affaires_total' => Billet::all()->sum(function($billet) {
                return $billet->quantite_vendue * $billet->prix;
            })
        ];

        return view('organisateur.show-billet', compact(
            'evenementsFuturs',
            'evenementsPasses',
            'statsGlobales'
        ));
    }

    /**
     * Afficher les détails d'un événement spécifique avec ses billets
     */
    public function showEventDetails($id)
    {
        $evenement = Evenement::with(['billets', 'user'])->findOrFail($id);

        // Statistiques pour cet événement
        $statsEvenement = [
            'total_billets' => $evenement->billets->sum('quantite_totale'),
            'billets_vendus' => $evenement->billets->sum('quantite_vendue'),
            'billets_disponibles' => $evenement->billets->sum('quantite_disponible'),
            'chiffre_affaires' => $evenement->billets->sum(function($billet) {
                return $billet->quantite_vendue * $billet->prix;
            }),
            'taux_vente' => $evenement->billets->sum('quantite_totale') > 0
                ? round(($evenement->billets->sum('quantite_vendue') / $evenement->billets->sum('quantite_totale')) * 100, 2)
                : 0
        ];

        return view('organisateur.event-detail-billets', compact('evenement', 'statsEvenement'));
    }

    /**
     * Afficher le formulaire d'édition d'un billet
     */
    public function edit($id)
    {
        $billet = Billet::findOrFail($id);

        $evenements = Evenement::select('id', 'titre', 'date', 'lieu')
                               ->orderBy('date', 'desc')
                               ->get();

        return view('organisateur.edit-billet', compact('billet', 'evenements'));
    }

    /**
     * Mettre à jour un billet existant
     */
    public function update(Request $request, $id)
    {
        $billet = Billet::findOrFail($id);

        $validatedData = $request->validate([
            'type' => 'required|string|max:50',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:' . $billet->quantite_vendue,
            'evenement_id' => 'required|exists:evenements,id',
        ], [
            'type.required' => 'Le type de billet est obligatoire',
            'prix.required' => 'Le prix est obligatoire',
            'prix.min' => 'Le prix minimum est 0 FCFA',
            'prix.numeric' => 'Le prix doit être un nombre',
            'quantite.required' => 'La quantité est obligatoire',
            'quantite.min' => 'La quantité ne peut pas être inférieure au nombre de billets déjà vendus (' . $billet->quantite_vendue . ')',
            'quantite.integer' => 'La quantité doit être un nombre entier',
            'evenement_id.required' => 'Vous devez sélectionner un événement',
            'evenement_id.exists' => 'L\'événement sélectionné n\'existe pas',
        ]);

        // Vérifier si un autre billet du même type existe pour cet événement
        $billetExistant = Billet::where('evenement_id', $validatedData['evenement_id'])
                                ->where('type', $validatedData['type'])
                                ->where('id', '!=', $billet->id)
                                ->first();

        if ($billetExistant) {
            return back()->withErrors(['type' => 'Un autre billet de ce type existe déjà pour cet événement'])
                        ->withInput();
        }

        // Calculer la nouvelle quantité disponible
        $nouvelleQuantite = $validatedData['quantite'];
        $quantiteDisponible = max(0, $nouvelleQuantite - $billet->quantite_vendue);

        // Mettre à jour le billet
        $billet->update([
            'type' => $validatedData['type'],
            'prix' => $validatedData['prix'],
            'quantite' => $nouvelleQuantite,
            'quantite_totale' => $nouvelleQuantite,
            'quantite_disponible' => $quantiteDisponible,
            'evenement_id' => $validatedData['evenement_id'],
        ]);

        return redirect()->route('organisateur.event-detail-billets', $billet->evenement_id)
                        ->with('success', 'Le billet a été modifié avec succès');
    }

    /**
     * Supprimer un billet
     */
    public function destroy($id)
    {
        try {
            $billet = Billet::findOrFail($id);
            $evenementId = $billet->evenement_id;

            // Vérifier si des billets ont été vendus
            if ($billet->quantite_vendue > 0) {
                return redirect()->back()
                               ->with('error', 'Impossible de supprimer ce billet car ' . $billet->quantite_vendue . ' exemplaire(s) ont déjà été vendus');
            }

            $billet->delete();

            return redirect()->route('organisateur.event-detail-billets', $evenementId)
                            ->with('success', 'Le billet "' . $billet->type . '" a été supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Erreur lors de la suppression du billet : ' . $e->getMessage());
        }
    }

    /**
     * Obtenir des statistiques sur les billets
     */
    public function statistiques(Request $request)
    {
        $dateDebut = $request->input('date_debut', Carbon::now()->startOfMonth());
        $dateFin = $request->input('date_fin', Carbon::now()->endOfMonth());

        // Statistiques générales
        $totalBillets = Billet::whereHas('evenement', function($q) use ($dateDebut, $dateFin) {
            $q->whereBetween('date', [$dateDebut, $dateFin]);
        })->sum('quantite_totale');

        $billetsVendus = Billet::whereHas('evenement', function($q) use ($dateDebut, $dateFin) {
            $q->whereBetween('date', [$dateDebut, $dateFin]);
        })->sum('quantite_vendue');

        $chiffresAffaires = Billet::whereHas('evenement', function($q) use ($dateDebut, $dateFin) {
            $q->whereBetween('date', [$dateDebut, $dateFin]);
        })->get()->sum(function($billet) {
            return $billet->quantite_vendue * $billet->prix;
        });

        // Statistiques par type
        $billetsParType = Billet::whereHas('evenement', function($q) use ($dateDebut, $dateFin) {
            $q->whereBetween('date', [$dateDebut, $dateFin]);
        })->selectRaw('
            type,
            COUNT(*) as nombre_types,
            SUM(quantite_totale) as total_quantite,
            SUM(quantite_vendue) as total_vendues,
            SUM(quantite_disponible) as total_disponibles,
            AVG(prix) as prix_moyen
        ')->groupBy('type')->get();

        // Statistiques par événement
        $billetsParEvenement = Billet::with('evenement')
            ->whereHas('evenement', function($q) use ($dateDebut, $dateFin) {
                $q->whereBetween('date', [$dateDebut, $dateFin]);
            })
            ->selectRaw('
                evenement_id,
                COUNT(*) as nombre_types_billets,
                SUM(quantite_totale) as total_quantite,
                SUM(quantite_vendue) as total_vendues
            ')
            ->groupBy('evenement_id')
            ->get();

        $stats = [
            'totaux' => [
                'total_billets' => $totalBillets,
                'billets_vendus' => $billetsVendus,
                'billets_disponibles' => $totalBillets - $billetsVendus,
                'taux_vente' => $totalBillets > 0 ? round(($billetsVendus / $totalBillets) * 100, 2) : 0,
                'chiffre_affaires' => $chiffresAffaires
            ],
            'par_type' => $billetsParType,
            'par_evenement' => $billetsParEvenement,
            'periode' => [
                'debut' => Carbon::parse($dateDebut)->format('d/m/Y'),
                'fin' => Carbon::parse($dateFin)->format('d/m/Y')
            ]
        ];

        if ($request->ajax()) {
            return response()->json($stats);
        }

        return view('organisateur.statistiques-billets', compact('stats'));
    }

    /**
     * Recherche AJAX pour l'autocomplétion
     */
    public function recherche(Request $request)
    {
        $terme = $request->input('q');

        $billets = Billet::with('evenement')
            ->whereHas('evenement', function($q) use ($terme) {
                $q->where('titre', 'LIKE', "%{$terme}%");
            })
            ->orWhere('type', 'LIKE', "%{$terme}%")
            ->limit(10)
            ->get();

        return response()->json($billets);
    }
}
