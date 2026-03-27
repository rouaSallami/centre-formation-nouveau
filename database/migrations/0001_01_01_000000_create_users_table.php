<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password');

            $table->integer('experience')->nullable();
            $table->boolean('disponibilite')->default(true);
            $table->string('specialite')->nullable();
            $table->text('biographie')->nullable();
            $table->string('niveau_etudes')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->string('statut')->nullable();
            $table->string('photo')->nullable();

            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};