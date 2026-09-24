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
        Schema::create('inspections_preemballes', function (Blueprint $table) {

    $table->id();

    $table->foreignId('inspection_id')
        ->constrained('inspections')
        ->cascadeOnDelete();

    /*
    |--------------------------------------------------------------------------
    | Informations générales
    |--------------------------------------------------------------------------
    */

    $table->string('produit');

    $table->decimal('quantite_nominale', 10, 3);

    $table->integer('effectif_lot');

    $table->integer('effectif_echantillon');

    $table->string('marque')->nullable();

    /*
    |--------------------------------------------------------------------------
    | Détermination de la nature du contrôle
    |--------------------------------------------------------------------------
    */

    $table->decimal('moyenne_emballage_vide', 10, 3)
        ->nullable();

    $table->decimal('ecart_type_emballage_vide', 10, 3)
        ->nullable();

    $table->decimal('emt', 10, 3)
        ->nullable();

    $table->decimal('emt_sur_5', 10, 3)
        ->nullable();

    $table->string('conclusion_controle')
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | Critère de la moyenne de l'échantillon
    |--------------------------------------------------------------------------
    */

    $table->decimal('eave', 10, 3)
        ->nullable();

    $table->decimal('ecart_type', 10, 3)
        ->nullable();

    $table->decimal('fce', 10, 3)
        ->nullable();

    $table->decimal('quantite_corrigee', 10, 3)
        ->nullable();

    $table->string('resultat_moyenne')
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | Critère du nombre de défectueux
    |--------------------------------------------------------------------------
    */

    $table->decimal('t1', 10, 3)
        ->nullable();

    $table->decimal('contenu_nominal_tolere', 10, 3)
        ->nullable();

    $table->integer('nombre_defectueux_t1')
        ->nullable();

    $table->string('resultat_t1')
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | Critère des produits ayant une erreur > T2
    |--------------------------------------------------------------------------
    */

    $table->decimal('t2', 10, 3)
        ->nullable();

    $table->decimal('quantite_nominale_moins_t2', 10, 3)
        ->nullable();

    $table->integer('nombre_defectueux_t2')
        ->nullable();

    $table->string('resultat_t2')
        ->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections_preemballes');
    }
};
