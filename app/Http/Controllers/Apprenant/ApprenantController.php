<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;

class ApprenantController extends Controller
{
    public function dashboard()
    {
        return redirect()->route('index');
    }
}