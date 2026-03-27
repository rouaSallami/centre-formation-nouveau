<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Formation;
use App\Models\Session;
use App\Models\Inscription;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Roles déjà créés dans la migration
        $adminRole = Role::where('nom', 'administrateur')->first();
        $formateurRole = Role::where('nom', 'formateur')->first();
        $apprenantRole = Role::where('nom', 'apprenant')->first();

        // 🔹 Users
        $admin = User::create([
            'nom' => 'Admin',
            'prenom' => 'Principal',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678'),
            'role_id' => $adminRole->id,
        ]);

        $formateur = User::create([
            'nom' => 'Ali',
            'prenom' => 'Formateur',
            'email' => 'formateur@test.com',
            'password' => Hash::make('12345678'),
            'role_id' => $formateurRole->id,
        ]);

        $apprenant = User::create([
            'nom' => 'Sara',
            'prenom' => 'Apprenant',
            'email' => 'apprenant@test.com',
            'password' => Hash::make('12345678'),
            'role_id' => $apprenantRole->id,
        ]);

        // 🔹 Formation
        $formation = Formation::create([
            'titre' => 'Laravel Débutant',
            'description' => 'Apprendre Laravel بسهولة',
            'duree_totale' => 40,
            'niveau' => 'débutant',
            'tarif' => 300,
            'user_id' => $formateur->id,
        ]);

        // 🔹 Session
        $session = Session::create([
            'date_debut' => '2026-01-10',
            'date_fin' => '2026-02-10',
            'lieu' => 'Tunis',
            'horaire' => '09:00 - 12:00',
            'capacite_max' => 20,
            'statut' => 'ouverte',
            'formation_id' => $formation->id,
            'formateur_id' => $formateur->id,
        ]);

        // 🔹 Inscription
        Inscription::create([
            'date_inscription' => now(),
            'statut' => 'en attente',
            'mode_paiement' => 'cash',
            'apprenant_id' => $apprenant->id,
            'session_id' => $session->id,
        ]);
    }
}