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
        Schema::create('inspections_volume_essais', function (Blueprint $table) {

    $table->id();

    $table->foreignId('inspection_volume_id')
        ->constrained('inspections_volumes')
        ->cascadeOnDelete();

    /*
    |--------------------------------------------------------------------------
    | Type d'essai
    |--------------------------------------------------------------------------
    */

    $table->integer('numero_essai');

    $table->decimal('volume_nominal', 8, 3);

    /*
    |--------------------------------------------------------------------------
    | Mesures relevées
    |--------------------------------------------------------------------------
    */

    $table->decimal('vdr', 10, 3)
        ->nullable();

    $table->decimal('vref', 10, 3)
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | Calculs
    |--------------------------------------------------------------------------
    */

    $table->decimal('edr', 10, 4)
        ->nullable();

    $table->decimal('emt', 10, 4)
        ->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections_volume_essais');
    }
};
