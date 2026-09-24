<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $fillable = [

        'mission_id',
        'reference',
        'type_inspection',
        'type_essai',
        'etablissement',
        'ifu',
        'adresse',
        'telephone',

        'date',
        'heure',
        'nom_proprietaire',
        'activite',
        'anomalies',
        'photos',
        'amendes',
        'commentaires',

        'inspecteur_id',
    ];

    /**
     * Mission liée.
     */
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    /**
     * Inspecteur ayant réalisé l'inspection.
     */
    public function inspecteur()
    {
        return $this->belongsTo(User::class, 'inspecteur_id');
    }

    public function pesage()
    {
        return $this->hasOne(InspectionPesage::class);
    }

    public function preemballe()
    {
        return $this->hasOne(InspectionPreemballe::class);
    }

    public function volume()
    {
        return $this->hasOne(InspectionVolume::class);
    }

    public function amende()
    {
        return $this->hasOne(Amende::class);
    }

    public function convocation()
    {
        return $this->hasOne(Convocation::class);
    }

}