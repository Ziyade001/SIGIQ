<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('missions', function (Blueprint $table) {

    $table->id();

    $table->date('periode_debut');
    $table->date('periode_fin');

    $table->string('type_mission');

    $table->text('activites');
    $table->text('localites');

    $table->string('conducteur_cva');
    $table->string('vehicule');

    $table->string('fiche_signee_par')->nullable();
    $table->longText('compte_rendu')->nullable();

    $table->integer('nb_boutiques_controlees')->nullable();
    $table->integer('nb_boutiques_non_conformes')->nullable();

    $table->integer('nb_instruments_controles')->nullable();
    $table->integer('nb_instruments_non_conformes')->nullable();

    $table->integer('nb_amendes')->nullable();

    $table->decimal('montant_amendes', 15, 2)->nullable();
    $table->decimal('montant_frais_verification', 15, 2)->nullable();

    $table->integer('nb_instruments_mis_conformite')->nullable();

    $table->enum('statut', [
        'planifiee',
        'en_cours',
        'terminee',
        'validee'
    ])->default('planifiee');

    $table->foreignId('created_by')
          ->constrained('users')
          ->cascadeOnDelete();

    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
