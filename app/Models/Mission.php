<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'statut',
        'periode_debut',
        'periode_fin',
        'categorie',
        'type_mission',
        'activites',
        'localites',
        'conducteur_cva',
        'vehicule',
        'created_by',

        // Remplis à la clôture
        'fiche_signee_par',
        'compte_rendu',

        // Indicateurs
        'nb_boutiques_controlees',
        'nb_boutiques_non_conformes',
        'nb_instruments_controles',
        'nb_instruments_non_conformes',
        'nb_preemballes_controles',
        'nb_preemballes_non_conformes',
        'nb_amendes',
        'montant_amendes',
        'montant_frais_verification',
        'nb_instruments_mis_conformite',
    ];

    protected $casts = [
        'periode_debut' => 'date',
        'periode_fin' => 'date',

        'montant_amendes' => 'decimal:2',
        'montant_frais_verification' => 'decimal:2',
    ];

    /**
     * Participants à la mission.
     */
    public function participants()
    {
        return $this->belongsToMany(User::class, 'mission_user')
                    ->withPivot('chef_equipe')
                    ->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    
}