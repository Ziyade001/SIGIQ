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
        Schema::create('preemballes_echantillons', function (Blueprint $table) {

    $table->id();

    $table->foreignId('inspection_preemballe_id')
        ->constrained('inspections_preemballes')
        ->cascadeOnDelete();

    $table->integer('numero');

    $table->decimal('poids_brut', 10, 3);

    $table->decimal('poids_net', 10, 3);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preemballes_echantillons');
    }
};
