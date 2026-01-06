<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'evenement_id',
        'billet_id',
        'code_achat',
        'nom_acheteur',
        'email_acheteur',
        'quantite',
        'prix_unitaire',
        'montant_total',
        'stripe_charge_id',
        'status',
        'payment_method',
        'date_achat',
        'qr_code_path',
        'qr_data',
        'is_scanned',
        'scan_count',
        'first_scan_at',
        'last_scan_at',
        'scanned_by',
    ];

    protected $casts = [
        'date_achat' => 'datetime',
        'first_scan_at' => 'datetime',
        'last_scan_at' => 'datetime',
        'is_scanned' => 'boolean',
        'quantite' => 'integer',
        'scan_count' => 'integer',
        'prix_unitaire' => 'decimal:2',
        'montant_total' => 'decimal:2',
    ];

    /**
     * Relations
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }

    public function billet()
    {
        return $this->belongsTo(Billet::class);
    }

    public function scannedByUser()
    {
        return $this->belongsTo(User::class, 'scanned_by');
    }

    /**
     * Accesseurs
     */
   public function getFormattedMontantAttribute()
    {
        $montant = $this->montant_total ?? 0; // si null → 0
        return number_format((float)$montant, 0, ',', ' ') . ' FCFA';
    }

    public function getFormattedDateAchatAttribute()
    {
        return $this->date_achat ? $this->date_achat->format('d/m/Y à H:i') : 'N/A';
    }

    public function getQrCodeUrlAttribute()
    {
        return $this->qr_code_path ? asset('storage/' . $this->qr_code_path) : null;
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning">En attente</span>',
            'success' => '<span class="badge bg-success">Réussi</span>',
            'failed' => '<span class="badge bg-danger">Échoué</span>',
            'refunded' => '<span class="badge bg-secondary">Remboursé</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge bg-secondary">Inconnu</span>';
    }

    /**
     * Scopes
     */
    public function scopeSuccess($query)
    {
        return $query->where('status', 'success');
    }

    public function scopeScanned($query)
    {
        return $query->where('is_scanned', true);
    }

    public function scopeNotScanned($query)
    {
        return $query->where('is_scanned', false);
    }

    public function scopeForEvenement($query, $evenementId)
    {
        return $query->where('evenement_id', $evenementId);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('date_achat', '>=', Carbon::now()->subDays($days));
    }

    /**
     * Méthodes utilitaires
     */
    public function canBeScanned()
    {
        return $this->status === 'success' && !$this->is_scanned;
    }

    public function markAsScanned($userId = null)
    {
        $this->is_scanned = true;
        $this->scan_count = ($this->scan_count ?? 0) + 1;
        $this->first_scan_at = $this->first_scan_at ?? now();
        $this->last_scan_at = now();
        $this->scanned_by = $userId;
        $this->save();
    }

    public function isExpired()
    {
        if (!$this->billet || !$this->billet->evenement) {
            return true;
        }

        return Carbon::parse($this->billet->evenement->date)->isPast();
    }

    /**
     * Calculer le chiffre d'affaires total
     */
    public static function calculateRevenue($evenementId = null, $startDate = null, $endDate = null)
    {
        $query = self::where('status', 'success');

        if ($evenementId) {
            $query->where('evenement_id', $evenementId);
        }

        if ($startDate) {
            $query->where('date_achat', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('date_achat', '<=', $endDate);
        }

        return $query->sum('montant_total');
    }

    /**
     * Statistiques
     */
    public static function getStats($evenementId = null)
    {
        $query = self::query();

        if ($evenementId) {
            $query->where('evenement_id', $evenementId);
        }

        return [
            'total_transactions' => $query->count(),
            'total_success' => $query->where('status', 'success')->count(),
            'total_billets_vendus' => $query->where('status', 'success')->sum('quantite'),
            'chiffre_affaires' => $query->where('status', 'success')->sum('montant_total'),
            'billets_scannes' => $query->where('is_scanned', true)->count(),
            'taux_scan' => $query->where('status', 'success')->count() > 0
                ? round(($query->where('is_scanned', true)->count() / $query->where('status', 'success')->count()) * 100, 2)
                : 0,
        ];
    }
}
