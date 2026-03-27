<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\FrontController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Formateur\FormateurController;
use App\Http\Controllers\Apprenant\ApprenantController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\InscriptionController;

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/course', [FrontController::class, 'course'])->name('course');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/team', [FrontController::class, 'team'])->name('team');
Route::get('/testimonial', [FrontController::class, 'testimonial'])->name('testimonial');

/*
|--------------------------------------------------------------------------
| Dashboard حسب role
|--------------------------------------------------------------------------
*/

// admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'role:administrateur'])
    ->name('admin.dashboard');

// formateur
Route::get('/formateur/dashboard', [FormateurController::class, 'dashboard'])
    ->middleware(['auth', 'role:formateur'])
    ->name('formateur.dashboard');

// apprenant
Route::get('/apprenant/dashboard', [ApprenantController::class, 'dashboard'])
    ->middleware(['auth', 'role:apprenant'])
    ->name('apprenant.dashboard');

/*
|--------------------------------------------------------------------------
| Redirection حسب role
|--------------------------------------------------------------------------
*/

Route::get('/redirect-role', function () {
    $role = auth()->user()->role->nom;

    if ($role === 'administrateur') {
        return redirect()->route('admin.dashboard');
    }

    if ($role === 'formateur') {
        return redirect()->route('formateur.dashboard');
    }

    if ($role === 'apprenant') {
        return redirect()->route('index');
    }

    return redirect()->route('index');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Profile (Auth)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api')->middleware('auth')->group(function () {

    // admin فقط
    Route::apiResource('users', UserController::class)
        ->middleware('role:administrateur');

    // admin + formateur
    Route::apiResource('formations', FormationController::class)
        ->middleware('role:administrateur,formateur');

    Route::apiResource('sessions', SessionController::class)
        ->middleware('role:administrateur,formateur');

    // apprenant + admin
    Route::apiResource('inscriptions', InscriptionController::class)
        ->middleware('role:administrateur,apprenant');
});