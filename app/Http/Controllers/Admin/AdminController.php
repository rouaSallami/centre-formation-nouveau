<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Formation;
use App\Models\Session;
use App\Models\Inscription;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'users' => User::count(),
            'formations' => Formation::count(),
            'sessions' => Session::count(),
            'inscriptions' => Inscription::count(),
        ]);
    }
}