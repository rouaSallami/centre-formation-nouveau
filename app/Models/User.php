<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'experience',
        'disponibilite',
        'specialite',
        'biographie',
        'niveau_etudes',
        'date_naissance',
        'telephone',
        'adresse',
        'statut',
        'photo',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'date_naissance' => 'date',
            'disponibilite' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    public function sessionsCommeFormateur()
    {
        return $this->hasMany(Session::class, 'formateur_id');
    }

    public function inscriptionsCommeApprenant()
    {
        return $this->hasMany(Inscription::class, 'apprenant_id');
    }
}