<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreemballeEchantillon extends Model
{
    protected $table = 'preemballes_echantillons';

    protected $fillable = [

        'inspection_preemballe_id',

        'numero',

        'poids_brut',

        'poids_net',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function inspectionPreemballe()
    {
        return $this->belongsTo(
            InspectionPreemballe::class,
            'inspection_preemballe_id'
        );
    }
}