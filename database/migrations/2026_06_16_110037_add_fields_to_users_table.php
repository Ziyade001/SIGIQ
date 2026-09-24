<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('matricule')
                  ->nullable()
                  ->after('id');

            $table->string('telephone')
                  ->nullable()
                  ->after('email');

            $table->string('fonction')
                  ->nullable();

            $table->enum('sexe', [
                'Homme',
                'Femme'
            ])->nullable();

            $table->date('date_naissance')
                  ->nullable();

            $table->text('adresse')
                  ->nullable();

            $table->string('photo')
                  ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['created_by']);

            $table->dropColumn([
                'matricule',
                'telephone',
                'fonction',
                'sexe',
                'date_naissance',
                'adresse',
                'photo',
            ]);
        });
    }
};