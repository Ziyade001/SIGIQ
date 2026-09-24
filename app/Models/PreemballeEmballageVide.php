<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreemballeEmballageVide extends Model
{
    protected $table = 'preemballes_emballages_vides';

    protected $fillable = [
        'inspection_preemballe_id',
        'poids',
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