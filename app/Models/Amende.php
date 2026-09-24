<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amende extends Model
{
    protected $fillable = [

        'inspection_id',
        'etablissement',
        'ifu',
        'reference_inspection',
        'montant_total',
        'montant_paye',
        'montant_impaye',
    ];

    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }
}
