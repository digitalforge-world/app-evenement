<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'lieu',
        'date_debut',
        'date_fin',
        'nombre_place',
        'prix',
        'image',
        'featured',
        'status',
        'category_id',
        'user_id'
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'featured' => 'boolean',
        'prix' => 'decimal:2'
    ];

    // Relation avec l'utilisateur (organisateur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec la catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation avec les réservations
    public function reservations()
    {
        return $this->belongsToMany(User::class, 'reservations')
                    ->withPivot('place_reserver', 'status')
                    ->withTimestamps();
    }

    // Relation avec les participants
    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants')
                    ->withTimestamps();
    }

    // Relation avec les commentaires
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    // Méthodes utiles
    public function placesRestantes()
    {
        return $this->nombre_place - $this->reservations()->sum('place_reserver');
    }

    public function estComplet()
    {
        return $this->placesRestantes() <= 0;
    }

    public function estTermine()
    {
        return $this->status === 'termine' || now()->isAfter($this->date_fin);
    }

    public function estAVenir()
    {
        return now()->isBefore($this->date_debut);
    }

    public function estEnCours()
    {
        return now()->between($this->date_debut, $this->date_fin);
    }

    // Scope pour les événements en vedette
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    // Scope pour les événements actifs
    public function scopeActif($query)
    {
        return $query->where('status', 'active');
    }

    // Scope pour les événements à venir
    public function scopeAVenir($query)
    {
        return $query->where('date_debut', '>', now());
    }

    // Formater le prix
    public function getPrixFormateAttribute()
    {
        return number_format($this->prix, 0, ',', ' ') . ' FCFA';
    }
}