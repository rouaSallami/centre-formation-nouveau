<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;

class FormateurController extends Controller
{
    public function dashboard()
    {
        return view('formateur.dashboard');
    }
}