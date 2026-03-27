<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\Session;
use App\Models\User;

class FormateurController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        return view('formateur.dashboard', [
            'formations' => Formation::where('user_id', $user->id)->count(),
            'sessions' => Session::where('formateur_id', $user->id)->count(),
            'apprenants' => User::whereHas('role', function ($q) {
                $q->where('nom', 'apprenant');
            })->count(),
            'mesFormations' => Formation::where('user_id', $user->id)->latest()->take(5)->get(),
        ]);
    }
}