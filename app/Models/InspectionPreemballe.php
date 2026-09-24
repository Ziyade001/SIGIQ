<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionPreemballe extends Model
{
    protected $table = 'inspections_preemballes';

    protected $fillable = [

        'inspection_id',

        'produit',
        'quantite_nominale',
        'effectif_lot',
        'effectif_echantillon',
        'marque',

        'moyenne_emballage_vide',
        'ecart_type_emballage_vide',
        'emt',
        'emt_sur_5',
        'conclusion_controle',

        'eave',
        'ecart_type',
        'fce',
        'quantite_corrigee',
        'resultat_moyenne',

        't1',
        'contenu_nominal_tolere',
        'nombre_defectueux_t1',
        'resultat_t1',

        't2',
        'quantite_nominale_moins_t2',
        'nombre_defectueux_t2',
        'resultat_t2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }

    public function emballagesVides()
    {
        return $this->hasMany(PreemballeEmballageVide::class);
    }

    public function echantillons()
    {
        return $this->hasMany(PreemballeEchantillon::class);
    }
}