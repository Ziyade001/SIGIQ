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
        Schema::create('inspections_volumes', function (Blueprint $table) {

    $table->id();

    $table->foreignId('inspection_id')
        ->constrained('inspections')
        ->cascadeOnDelete();

    /*
    |--------------------------------------------------------------------------
    | Informations générales
    |--------------------------------------------------------------------------
    */

    $table->string('nom_commercial')->nullable();

    /*
    |--------------------------------------------------------------------------
    | Identification du distributeur
    |--------------------------------------------------------------------------
    */

    $table->string('identification_distributeur');

    $table->decimal('prix_unitaire_affiche', 10, 2)
        ->nullable();

    $table->decimal('lecture_totalisateur_fin', 12, 3)
        ->nullable();

    $table->decimal('lecture_totalisateur_debut', 12, 3)
        ->nullable();

    $table->decimal('retour_cuve', 12, 3)
        ->nullable();

    $table->string('produit');

    $table->string('marque_cabine')
        ->nullable();

    $table->string('numero_serie_cabine')
        ->nullable();

    $table->string('marque_mesureur')
        ->nullable();

    $table->string('numero_serie_mesureur')
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | Vérifications fonctionnelles
    |--------------------------------------------------------------------------
    */

    $table->boolean('verification_dispositifs_indicateurs')
        ->nullable();

    $table->boolean('mise_a_zero')
        ->nullable();

    $table->boolean('calcul_prix')
        ->nullable();

    $table->boolean('coupure_flexible_pistolet')
        ->nullable();

    $table->boolean('conformite')
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | Identification métrologique
    |--------------------------------------------------------------------------
    */

    $table->string('numero_vignette')
        ->nullable();

    $table->string('numero_scelle')
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | Signatures
    |--------------------------------------------------------------------------
    */

    $table->string('representant_utilisateur')
        ->nullable();

    $table->string('technicien_reparateur')
        ->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections_volumes');
    }
};
