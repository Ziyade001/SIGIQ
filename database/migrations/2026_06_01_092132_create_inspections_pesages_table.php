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
        Schema::create('inspections_pesages', function (Blueprint $table) {

            $table->id();

            $table->foreignId('inspection_id')
                ->constrained('inspections')
                ->cascadeOnDelete();

            $table->string('instrument');

            $table->string('marque')
                ->nullable();

            $table->string('numero_serie')
                ->nullable();

            $table->decimal('portee_max', 12, 3)
                ->nullable();

            $table->decimal('portee_min', 12, 3)
                ->nullable();

            $table->string('echelon_verification')
                ->nullable();

            $table->string('echelon_affichage')
                ->nullable();

            $table->year('annee_fabrication')
                ->nullable();

            $table->string('numero_approbation_modele')
                ->nullable();

            $table->text('infractions_constatees')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections_pesages');
    }
};