#!/usr/bin/env php
<?php

/**
 * Script de test rapide pour le système de scan QR
 * 
 * Usage:
 *   php test-qr-scan.php create    # Créer un billet de test
 *   php test-qr-scan.php scan      # Simuler un scan
 *   php test-qr-scan.php reset     # Réinitialiser un billet
 *   php test-qr-scan.php stats     # Afficher les statistiques
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Transaction;
use App\Models\Evenement;
use App\Models\Billet;
use Illuminate\Support\Facades\DB;

// Couleurs pour le terminal
$colors = [
    'green' => "\033[0;32m",
    'red' => "\033[0;31m",
    'yellow' => "\033[1;33m",
    'blue' => "\033[0;34m",
    'reset' => "\033[0m",
];

function printColor($text, $color, $colors) {
    echo $colors[$color] . $text . $colors['reset'] . PHP_EOL;
}

$command = $argv[1] ?? 'help';

switch ($command) {
    case 'create':
        printColor("🎫 Création d'un billet de test...", 'blue', $colors);
        
        // Récupérer un événement et un billet existants
        $evenement = Evenement::first();
        $billet = Billet::first();
        
        if (!$evenement || !$billet) {
            printColor("❌ Erreur: Aucun événement ou billet trouvé dans la base de données.", 'red', $colors);
            printColor("Veuillez d'abord créer un événement et un billet.", 'yellow', $colors);
            exit(1);
        }
        
        $codeAchat = 'TCK-TEST-' . strtoupper(substr(md5(time()), 0, 8));
        
        $transaction = Transaction::create([
            'user_id' => 1,
            'evenement_id' => $evenement->id,
            'billet_id' => $billet->id,
            'code_achat' => $codeAchat,
            'nom_acheteur' => 'Test User',
            'email_acheteur' => 'test@example.com',
            'quantite' => 1,
            'prix_unitaire' => $billet->prix,
            'montant_total' => $billet->prix,
            'status' => 'success',
            'payment_method' => 'test',
            'date_achat' => now(),
            'is_scanned' => false,
            'scan_count' => 0,
        ]);
        
        printColor("✅ Billet créé avec succès!", 'green', $colors);
        echo PHP_EOL;
        echo "📋 Détails du billet:" . PHP_EOL;
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . PHP_EOL;
        echo "Code d'achat: " . $colors['yellow'] . $codeAchat . $colors['reset'] . PHP_EOL;
        echo "Nom: {$transaction->nom_acheteur}" . PHP_EOL;
        echo "Email: {$transaction->email_acheteur}" . PHP_EOL;
        echo "Événement: {$evenement->titre}" . PHP_EOL;
        echo "Type billet: {$billet->type}" . PHP_EOL;
        echo "Montant: {$transaction->montant_total} FCFA" . PHP_EOL;
        echo "Statut: " . $colors['green'] . "Non scanné" . $colors['reset'] . PHP_EOL;
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . PHP_EOL;
        echo PHP_EOL;
        printColor("💡 Pour scanner ce billet, utilisez:", 'blue', $colors);
        echo "   php test-qr-scan.php scan {$codeAchat}" . PHP_EOL;
        break;
        
    case 'scan':
        $codeAchat = $argv[2] ?? null;
        
        if (!$codeAchat) {
            printColor("❌ Erreur: Veuillez fournir un code d'achat", 'red', $colors);
            echo "Usage: php test-qr-scan.php scan TCK-XXXXXXXX" . PHP_EOL;
            exit(1);
        }
        
        printColor("🔍 Scan du billet {$codeAchat}...", 'blue', $colors);
        echo PHP_EOL;
        
        DB::transaction(function () use ($codeAchat, $colors) {
            $transaction = Transaction::where('code_achat', $codeAchat)
                ->lockForUpdate()
                ->first();
            
            if (!$transaction) {
                printColor("❌ Billet non trouvé", 'red', $colors);
                exit(1);
            }
            
            if ($transaction->status !== 'success') {
                printColor("❌ Paiement non validé (statut: {$transaction->status})", 'red', $colors);
                exit(1);
            }
            
            if ($transaction->is_scanned) {
                printColor("⚠️  BILLET DÉJÀ UTILISÉ - ENTRÉE REFUSÉE", 'red', $colors);
                echo PHP_EOL;
                echo "📊 Informations du scan précédent:" . PHP_EOL;
                echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . PHP_EOL;
                echo "Premier scan: " . $transaction->first_scan_at->format('d/m/Y à H:i:s') . PHP_EOL;
                echo "Dernier scan: " . $transaction->last_scan_at->format('d/m/Y à H:i:s') . PHP_EOL;
                echo "Nombre de scans: {$transaction->scan_count}" . PHP_EOL;
                echo "Scanné par: User #{$transaction->scanned_by}" . PHP_EOL;
                echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . PHP_EOL;
                exit(1);
            }
            
            // Marquer comme scanné
            $transaction->is_scanned = true;
            $transaction->scan_count = 1;
            $transaction->first_scan_at = now();
            $transaction->last_scan_at = now();
            $transaction->scanned_by = 1; // Admin/Test user
            $transaction->save();
            
            printColor("✅ BILLET VALIDÉ - ACCÈS AUTORISÉ", 'green', $colors);
            echo PHP_EOL;
            echo "📋 Informations du participant:" . PHP_EOL;
            echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . PHP_EOL;
            echo "Code: {$transaction->code_achat}" . PHP_EOL;
            echo "Nom: {$transaction->nom_acheteur}" . PHP_EOL;
            echo "Email: {$transaction->email_acheteur}" . PHP_EOL;
            echo "Type: " . ($transaction->billet->type ?? 'N/A') . PHP_EOL;
            echo "Quantité: {$transaction->quantite}" . PHP_EOL;
            echo "Événement: " . ($transaction->billet->evenement->titre ?? 'N/A') . PHP_EOL;
            echo "Scanné à: " . now()->format('d/m/Y à H:i:s') . PHP_EOL;
            echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . PHP_EOL;
        });
        break;
        
    case 'reset':
        $codeAchat = $argv[2] ?? null;
        
        if (!$codeAchat) {
            printColor("❌ Erreur: Veuillez fournir un code d'achat", 'red', $colors);
            echo "Usage: php test-qr-scan.php reset TCK-XXXXXXXX" . PHP_EOL;
            exit(1);
        }
        
        $transaction = Transaction::where('code_achat', $codeAchat)->first();
        
        if (!$transaction) {
            printColor("❌ Billet non trouvé", 'red', $colors);
            exit(1);
        }
        
        $transaction->is_scanned = false;
        $transaction->scan_count = 0;
        $transaction->first_scan_at = null;
        $transaction->last_scan_at = null;
        $transaction->scanned_by = null;
        $transaction->save();
        
        printColor("✅ Billet réinitialisé avec succès!", 'green', $colors);
        echo "Le billet {$codeAchat} peut maintenant être scanné à nouveau." . PHP_EOL;
        break;
        
    case 'stats':
        printColor("📊 Statistiques de scan", 'blue', $colors);
        echo PHP_EOL;
        
        $total = Transaction::where('status', 'success')->count();
        $scanned = Transaction::where('is_scanned', true)->count();
        $notScanned = Transaction::where('status', 'success')->where('is_scanned', false)->count();
        $taux = $total > 0 ? round(($scanned / $total) * 100, 2) : 0;
        
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . PHP_EOL;
        echo "Total billets vendus: {$total}" . PHP_EOL;
        echo "Billets scannés: " . $colors['green'] . $scanned . $colors['reset'] . PHP_EOL;
        echo "Billets non scannés: " . $colors['yellow'] . $notScanned . $colors['reset'] . PHP_EOL;
        echo "Taux de scan: {$taux}%" . PHP_EOL;
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . PHP_EOL;
        
        if ($scanned > 0) {
            echo PHP_EOL;
            echo "📋 Derniers billets scannés:" . PHP_EOL;
            $recent = Transaction::where('is_scanned', true)
                ->orderBy('first_scan_at', 'desc')
                ->limit(5)
                ->get();
            
            foreach ($recent as $t) {
                echo "  • {$t->code_achat} - {$t->nom_acheteur} - " 
                    . $t->first_scan_at->format('d/m/Y H:i') . PHP_EOL;
            }
        }
        break;
        
    case 'help':
    default:
        printColor("🎫 Script de Test QR - Système de Scan Unique", 'blue', $colors);
        echo PHP_EOL;
        echo "Commandes disponibles:" . PHP_EOL;
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . PHP_EOL;
        echo "  " . $colors['green'] . "create" . $colors['reset'] . "                 Créer un billet de test" . PHP_EOL;
        echo "  " . $colors['green'] . "scan TCK-XXX" . $colors['reset'] . "          Scanner un billet" . PHP_EOL;
        echo "  " . $colors['green'] . "reset TCK-XXX" . $colors['reset'] . "         Réinitialiser un billet" . PHP_EOL;
        echo "  " . $colors['green'] . "stats" . $colors['reset'] . "                 Afficher les statistiques" . PHP_EOL;
        echo "  " . $colors['green'] . "help" . $colors['reset'] . "                  Afficher cette aide" . PHP_EOL;
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" . PHP_EOL;
        echo PHP_EOL;
        echo "Exemples:" . PHP_EOL;
        echo "  php test-qr-scan.php create" . PHP_EOL;
        echo "  php test-qr-scan.php scan TCK-TEST-12345678" . PHP_EOL;
        echo "  php test-qr-scan.php reset TCK-TEST-12345678" . PHP_EOL;
        break;
}

echo PHP_EOL;
