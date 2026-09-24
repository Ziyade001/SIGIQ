<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionVolume extends Model
{
    protected $table = 'inspections_volumes';

    protected $fillable = [

        'inspection_id',

        'nom_commercial',

        'identification_distributeur',
        'prix_unitaire_affiche',

        'lecture_totalisateur_fin',
        'lecture_totalisateur_debut',
        'retour_cuve',

        'produit',

        'marque_cabine',
        'numero_serie_cabine',

        'marque_mesureur',
        'numero_serie_mesureur',

        'verification_dispositifs_indicateurs',
        'mise_a_zero',
        'calcul_prix',
        'coupure_flexible_pistolet',
        'conformite',

        'numero_vignette',
        'numero_scelle',

        'representant_utilisateur',
        'technicien_reparateur',
    ];

    protected $casts = [

        'verification_dispositifs_indicateurs' => 'boolean',
        'mise_a_zero' => 'boolean',
        'calcul_prix' => 'boolean',
        'coupure_flexible_pistolet' => 'boolean',
        'conformite' => 'boolean',
    ];

    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }

    public function essais()
    {
        return $this->hasMany(
            InspectionVolumeEssai::class,
            'inspection_volume_id'
        );
    }
}