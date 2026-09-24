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
        Schema::create('inspections', function (Blueprint $table) {

            $table->id();

            $table->foreignId('mission_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('type_inspection');
            // preemballe, pesage, volume

            $table->enum('type_essai', ['verification_primitive', 'verification_periodique']);

            $table->string('etablissement');

            $table->string('adresse');

            $table->string('telephone')
                ->nullable();

            $table->date('date');

            $table->time('heure');
            
            $table->string('nom_proprietaire');

            $table->text('activite');

            $table->text('anomalies')->nullable();

            $table->string('amendes')->nullable();

            $table->text('commentaires')->nullable();

            $table->foreignId('inspecteur_id')
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
        Schema::dropIfExists('inspections');
    }
};