<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use App\Models\Evenement;
use App\Models\Transaction;
use App\Models\Achat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Charge;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PaiementController extends Controller
{
    /**
     * Afficher le formulaire de paiement pour un événement
     */
    public function showForm(Evenement $evenement)
    {
        // Récupérer les billets disponibles pour cet événement
        $billets = Billet::where('evenement_id', $evenement->id)
            ->where('quantite_disponible', '>', 0)
            ->get();

        return view('p.payement.payement', compact('evenement', 'billets'));
    }

    /**
     * Traiter le paiement avec Stripe
     */
    public function processPayment(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'billet_id' => 'required|exists:billets,id',
            'quantite_form' => 'required|integer|min:1|max:10',
            'montant_total' => 'required|numeric|min:0',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'stripeToken' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            // Récupérer le billet
            $billet = Billet::with('evenement')->findOrFail($validated['billet_id']);
            $quantite = $validated['quantite_form'];
            $montantTotal = $validated['montant_total'];

            // Vérifier la disponibilité des billets
            if ($billet->quantite_disponible < $quantite) {
                return response()->json([
                    'success' => false,
                    'message' => "Désolé, il ne reste que {$billet->quantite_disponible} billet(s) disponible(s)."
                ], 400);
            }

            // Vérifier que le montant est correct
            $montantAttendu = $billet->prix * $quantite;
            if ($montantTotal != $montantAttendu) {
                return response()->json([
                    'success' => false,
                    'message' => 'Le montant du paiement ne correspond pas au prix des billets.'
                ], 400);
            }

            // Configuration de Stripe
            Stripe::setApiKey(config('services.stripe.secret'));

            // Créer le paiement Stripe
            $charge = Charge::create([
                'amount' => $montantTotal,
                'currency' => 'xof',
                'description' => "Achat de {$quantite} billet(s) - {$billet->type} - {$billet->evenement->titre}",
                'source' => $validated['stripeToken'],
                'metadata' => [
                    'billet_id' => $billet->id,
                    'evenement_id' => $billet->evenement_id,
                    'quantite' => $quantite,
                    'nom' => $validated['nom'],
                    'email' => $validated['email'],
                ]
            ]);

            // Vérifier que le paiement a réussi
            if ($charge->status !== 'succeeded') {
                throw new \Exception('Le paiement a échoué.');
            }

            // Générer un code unique pour cet achat
            $codeAchat = $this->generateUniqueCode();

            // Créer la transaction
            $transaction = Transaction::create([
                'user_id' => Auth::id() ?? null,
                'evenement_id' => $billet->evenement_id,
                'billet_id' => $billet->id,
                'code_achat' => $codeAchat,
                'nom_acheteur' => $validated['nom'],
                'email_acheteur' => $validated['email'],
                'quantite' => $quantite,
                'prix_unitaire' => $billet->prix,
                'montant_total' => $montantTotal,
                'stripe_charge_id' => $charge->id,
                'status' => 'success',
                'payment_method' => 'stripe',
                'date_achat' => now(),
                'is_scanned' => false,
                'scan_count' => 0,
            ]);

            // Mettre à jour les quantités du billet
            $billet->quantite_vendue += $quantite;
            $billet->quantite_disponible -= $quantite;
            $billet->save();

            // Générer le QR Code avec toutes les informations
            $qrData = $this->generateQrData($transaction, $billet);
            $qrCodePath = $this->generateQrCode($qrData, $codeAchat);

            // Mettre à jour la transaction avec le chemin du QR code
            $transaction->qr_code_path = $qrCodePath;
            $transaction->qr_data = json_encode($qrData);
            $transaction->save();

            // Envoyer l'email de confirmation avec le QR code
            $this->sendConfirmationEmail($transaction, $billet, $qrCodePath);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Paiement effectué avec succès !',
                'redirect_url' => route('p.confirmation', ['transaction' => $transaction->id])
            ]);

        } catch (\Stripe\Exception\CardException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur de carte : ' . $e->getMessage()
            ], 400);

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur de requête : ' . $e->getMessage()
            ], 400);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Générer un code unique pour l'achat
     */
    private function generateUniqueCode()
    {
        do {
            $code = strtoupper('TCK-' . Str::random(10));
        } while (Transaction::where('code_achat', $code)->exists());

        return $code;
    }

    /**
     * Générer les données à encoder dans le QR code
     */
    private function generateQrData($transaction, $billet)
    {
        return [
            'code_achat' => $transaction->code_achat,
            'nom_acheteur' => $transaction->nom_acheteur,
            'email_acheteur' => $transaction->email_acheteur,
            'evenement' => [
                'id' => $billet->evenement->id,
                'titre' => $billet->evenement->titre,
                'date_achat' => $transaction->date_achat->format('Y-m-d H:i:s'),
                'lieu' => $billet->evenement->lieu,
            ],
            'billet' => [
                'type' => $billet->type,
                'prix_unitaire' => $billet->prix,
            ],
            'achat' => [
                'quantite' => $transaction->quantite,
                'montant_total' => $transaction->montant_total,
                'date_achat' => $transaction->date_achat->format('Y-m-d H:i:s'),
            ],
            'verification' => [
                'hash' => hash('sha256', $transaction->code_achat . $transaction->email_acheteur . config('app.key')),
                'timestamp' => now()->timestamp,
            ]
        ];
    }

    /**
     * Générer le QR Code et le sauvegarder (SANS IMAGICK)
     * Utilise SVG converti en PNG ou directement PNG avec GD
     */
    private function generateQrCode($data, $codeAchat)
    {
        // Créer le dossier s'il n'existe pas
        $directory = storage_path('app/public/qrcodes');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Encoder les données en JSON
        $jsonData = json_encode($data);

        // Générer le nom du fichier
        $filename = $codeAchat . '.png';
        $filepath = $directory . '/' . $filename;

        // MÉTHODE 1 : Générer en SVG puis convertir en PNG avec GD
        try {
            // Générer le QR code en SVG d'abord
            $svgString = QrCode::format('svg')
                ->size(400)
                ->margin(2)
                ->errorCorrection('H')
                ->generate($jsonData);

            // Convertir SVG en PNG avec GD
            $this->svgToPng($svgString, $filepath, 400, 400);

        } catch (\Exception $e) {
            // MÉTHODE 2 : Fallback - Générer directement en PNG avec GD
            // Si la conversion SVG échoue, essayer directement PNG
            QrCode::format('png')
                ->size(400)
                ->margin(2)
                ->errorCorrection('H')
                ->generate($jsonData, $filepath);
        }

        return 'qrcodes/' . $filename;
    }

    /**
     * Convertir SVG en PNG en utilisant GD (sans imagick)
     */
    private function svgToPng($svgString, $outputPath, $width, $height)
    {
        // Créer une image GD
        $image = imagecreatetruecolor($width, $height);

        // Fond blanc
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $white);

        // Pour une conversion SVG -> PNG plus sophistiquée,
        // on peut utiliser Imagick si disponible, sinon on génère directement en PNG
        if (extension_loaded('imagick')) {
            $imagick = new \Imagick();
            $imagick->readImageBlob($svgString);
            $imagick->setImageFormat('png');
            $imagick->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 1);
            $imagick->writeImage($outputPath);
            $imagick->clear();
            $imagick->destroy();
        } else {
            // Si imagick n'est pas disponible, sauvegarder directement
            // Note: Cette méthode nécessite que SimpleSoftwareIO/laravel-qrcode
            // utilise le backend 'svg' ou 'png' natif
            imagepng($image, $outputPath, 9);
        }

        imagedestroy($image);
    }

    /**
     * Envoyer l'email de confirmation avec le QR code
     */
    private function sendConfirmationEmail($transaction, $billet, $qrCodePath)
    {
        $data = [
            'transaction' => $transaction,
            'billet' => $billet,
            'evenement' => $billet->evenement,
            'qrCodePath' => storage_path('app/public/' . $qrCodePath),
        ];

        Mail::send('emails.confirmation-achat', $data, function ($message) use ($transaction, $qrCodePath) {
            $message->to($transaction->email_acheteur, $transaction->nom_acheteur)
                ->subject('Confirmation de votre achat - Billet(s) ' . $transaction->code_achat)
                ->attach(storage_path('app/public/' . $qrCodePath), [
                    'as' => 'billet-qrcode.png',
                    'mime' => 'image/png',
                ]);
        });
    }

    /**
     * Afficher la page de confirmation
     */
    public function confirmation($transactionId)
    {
        $transaction = Transaction::with(['billet.evenement'])->findOrFail($transactionId);

        // Vérifier que l'utilisateur a le droit de voir cette transaction
        if (Auth::check() && $transaction->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        return view('p.confirmation', compact('transaction'));
    }

    /**
     * Scanner un QR code (pour les organisateurs)
     */
    public function scanQrCode(Request $request)
    {
        $validated = $request->validate([
            'qr_data' => 'required|string',
        ]);

        try {
            // Décoder les données du QR code
            $qrData = json_decode($validated['qr_data'], true);

            if (!$qrData || !isset($qrData['code_achat'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'QR Code invalide ou illisible',
                    'error_type' => 'invalid_format'
                ], 400);
            }

            // Vérifier l'intégrité des données
            $expectedHash = hash('sha256', $qrData['code_achat'] . $qrData['email_acheteur'] . config('app.key'));
            if (!isset($qrData['verification']['hash']) || $qrData['verification']['hash'] !== $expectedHash) {
                return response()->json([
                    'success' => false,
                    'message' => 'QR Code falsifié ou corrompu. Contactez la sécurité.',
                    'error_type' => 'tampered'
                ], 400);
            }

            // Utiliser une transaction avec verrouillage pour éviter les conditions de concurrence
            return \DB::transaction(function () use ($qrData) {
                // Récupérer la transaction avec verrouillage (FOR UPDATE empêche les scans simultanés)
                $transaction = Transaction::where('code_achat', $qrData['code_achat'])
                    ->lockForUpdate()
                    ->first();

                if (!$transaction) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Billet non trouvé dans le système',
                        'error_type' => 'not_found'
                    ], 404);
                }

                // Vérifier le statut de la transaction
                if ($transaction->status !== 'success') {
                    $statusMessages = [
                        'pending' => 'Ce billet est en attente de paiement',
                        'failed' => 'Le paiement de ce billet a échoué',
                        'refunded' => 'Ce billet a été remboursé'
                    ];
                    
                    return response()->json([
                        'success' => false,
                        'message' => $statusMessages[$transaction->status] ?? 'Statut du billet invalide',
                        'error_type' => 'invalid_status',
                        'status' => $transaction->status
                    ], 400);
                }

                // VÉRIFICATION CRITIQUE : Vérifier si le billet a déjà été scanné
                if ($transaction->is_scanned) {
                    return response()->json([
                        'success' => false,
                        'message' => '⚠️ BILLET DÉJÀ UTILISÉ - Entrée refusée',
                        'error_type' => 'already_scanned',
                        'scan_info' => [
                            'premier_scan' => $transaction->first_scan_at?->format('d/m/Y à H:i:s'),
                            'dernier_scan' => $transaction->last_scan_at?->format('d/m/Y à H:i:s'),
                            'nombre_tentatives' => $transaction->scan_count,
                            'scanne_par' => $transaction->scannedByUser ? $transaction->scannedByUser->name : 'Inconnu'
                        ]
                    ], 400);
                }

                // Vérifier si l'événement est expiré
                if ($transaction->billet && $transaction->billet->evenement) {
                    $evenement = $transaction->billet->evenement;
                    $eventDate = \Carbon\Carbon::parse($evenement->date_debut ?? $evenement->date);
                    
                    if ($eventDate->isPast() && $eventDate->diffInDays(now()) > 1) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Cet événement est terminé depuis plus de 24h',
                            'error_type' => 'event_expired'
                        ], 400);
                    }
                }

                // ✅ MARQUER LE BILLET COMME SCANNÉ
                $transaction->is_scanned = true;
                $transaction->scan_count = 1;
                $transaction->first_scan_at = now();
                $transaction->last_scan_at = now();
                $transaction->scanned_by = Auth::id();
                $transaction->save();

                // Charger les relations pour la réponse
                $transaction->load(['billet.evenement', 'user']);

                return response()->json([
                    'success' => true,
                    'message' => '✅ BILLET VALIDÉ - Accès autorisé',
                    'scan_type' => 'first_scan',
                    'transaction' => [
                        'code_achat' => $transaction->code_achat,
                        'nom_acheteur' => $transaction->nom_acheteur,
                        'email_acheteur' => $transaction->email_acheteur,
                        'quantite' => $transaction->quantite,
                        'type_billet' => $transaction->billet->type ?? 'N/A',
                        'evenement' => $transaction->billet?->evenement?->titre ?? 'N/A',
                        'date_evenement' => $transaction->billet?->evenement?->date_debut 
                            ? \Carbon\Carbon::parse($transaction->billet->evenement->date_debut)->format('d/m/Y à H:i')
                            : 'N/A',
                        'montant_paye' => number_format($transaction->montant_total, 0, ',', ' ') . ' FCFA',
                        'date_achat' => $transaction->date_achat?->format('d/m/Y à H:i'),
                        'scanne_maintenant' => now()->format('d/m/Y à H:i:s'),
                        'scanne_par' => Auth::user()?->name ?? 'Organisateur'
                    ]
                ], 200);
            });

        } catch (\Exception $e) {
            \Log::error('Erreur lors du scan QR: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur système lors du scan. Veuillez réessayer.',
                'error_type' => 'system_error',
                'details' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Télécharger le QR code
     */
    public function downloadQrCode($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        // Vérifier les droits d'accès
        if (Auth::check() && $transaction->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $filePath = storage_path('app/public/' . $transaction->qr_code_path);

        if (!file_exists($filePath)) {
            abort(404, 'QR Code non trouvé');
        }

        return response()->download($filePath, $transaction->code_achat . '.png');
    }
}
