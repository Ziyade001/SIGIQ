<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionVolumeEssai extends Model
{
    protected $table = 'inspections_volume_essais';

    protected $fillable = [

    'inspection_volume_id',

    'numero_essai',

    'volume_nominal',

    'vdr',
    'vref',

    'edr',

    'emt',
    ];

    public function inspectionVolume()
    {
        return $this->belongsTo(
            InspectionVolume::class,
            'inspection_volume_id'
        );
    }
}