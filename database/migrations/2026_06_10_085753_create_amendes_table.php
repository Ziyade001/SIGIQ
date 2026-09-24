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
        Schema::create('amendes', function (Blueprint $table) {

    $table->id();

    $table->foreignId('inspection_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->string('etablissement');

    $table->string('reference_inspection');

    $table->decimal('montant_total', 12, 2)->default(0);

    $table->decimal('montant_paye', 12, 2)->default(0);

    $table->decimal('montant_impaye', 12, 2)->default(0);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amendes');
    }
};
