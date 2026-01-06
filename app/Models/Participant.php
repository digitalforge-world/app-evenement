<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $fillable = ['nom','prenom','email','numero'];

    public function evenement(){
        return $this->belongsToany(Evenement::class,'reservation')
                    ->withPivote('place_reserver','status')
                    ->withTemestamps();
    }
    public function participer(){
        return $this->belongsToany(Evenement::class,'partciper')
                    ->withPivote()
                    ->withTemestamps();
    }
    public function commentaire()
    {
        return $this->hasMany(Commentaire::class);
    }


}
