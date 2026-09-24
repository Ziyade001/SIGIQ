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
        Schema::table('missions', function (Blueprint $table) {

            $table->unsignedInteger('nb_preemballes_controles')
                  ->nullable()
                  ->after('nb_instruments_non_conformes');

            $table->unsignedInteger('nb_preemballes_non_conformes')
                  ->nullable()
                  ->after('nb_preemballes_controles');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('missions', function (Blueprint $table) {

            $table->dropColumn([
                'nb_preemballes_controles',
                'nb_preemballes_non_conformes'
            ]);

        });
    }
};