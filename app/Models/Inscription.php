<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_inscription',
        'statut',
        'mode_paiement',
        'apprenant_id',
        'session_id',
    ];

    public function apprenant()
    {
        return $this->belongsTo(User::class, 'apprenant_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}