<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        DB::table('roles')->insert([
            [
                'nom' => 'administrateur',
                'description' => 'Accès complet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'formateur',
                'description' => 'Gestion des formations et sessions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'apprenant',
                'description' => 'Inscription et suivi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};