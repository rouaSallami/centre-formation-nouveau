<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;

    protected $table = 'formation_sessions';

    protected $fillable = [
        'date_debut',
        'date_fin',
        'lieu',
        'horaire',
        'capacite_max',
        'statut',
        'est_ouverte',
        'formation_id',
        'formateur_id',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function formateur()
    {
        return $this->belongsTo(User::class, 'formateur_id');
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
}