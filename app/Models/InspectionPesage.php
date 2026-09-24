<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionPesage extends Model
{
    protected $table = 'inspections_pesages';

    protected $fillable = [

        'inspection_id',

        'instrument',
        'marque',
        'numero_serie',

        'portee_max',
        'portee_min',

        'echelon_verification',
        'echelon_affichage',

        'annee_fabrication',

        'numero_approbation_modele',

        'infractions_constatees',
    ];

    /**
     * Inspection parente.
     */
    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }
}