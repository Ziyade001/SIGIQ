<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Convocation extends Model
{
    protected $fillable = [

        'inspection_id',
        'reference',
        'date_convocation',
        'heure_convocation',
        'infraction',
        'remise',
    ];

    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }
}
