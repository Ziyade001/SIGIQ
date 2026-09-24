<?php

namespace App\Models;

use App\Models\Mission;
use App\Models\Inspection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Champs autorisés en remplissage massif.
     */
    protected $fillable = [

    'matricule',
    'name',
    'email',
    'telephone',
    'fonction',
    'sexe',
    'date_naissance',
    'adresse',
    'photo',
    'role',
    'password',
    'must_change_password',
    'created_by',
    ];

    /**
     * Champs cachés.
     */
    protected $hidden = [

        'password',

        'remember_token',
    ];

    /**
     * Casts.
     */
    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'date_naissance' => 'date',

            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RÔLES
    |--------------------------------------------------------------------------
    */

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDG()
    {
        return $this->role === 'dg';
    }

    public function isDT()
    {
        return $this->role === 'dt';
    }

    public function isInspecteur()
    {
        return $this->role === 'inspecteur';
    }

    /*
    |--------------------------------------------------------------------------
    | MISSIONS
    |--------------------------------------------------------------------------
    */

    public function missions()
    {
        return $this->belongsToMany(
                Mission::class,
                'mission_user'
            )
            ->withPivot('chef_equipe')
            ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | INSPECTIONS
    |--------------------------------------------------------------------------
    */

    public function inspections()
    {
        return $this->hasMany(
            Inspection::class,
            'inspecteur_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | AUDIT DE CRÉATION
    |--------------------------------------------------------------------------
    */

    public function createdBy()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }

    public function createdUsers()
    {
        return $this->hasMany(
            User::class,
            'created_by'
        );
    }
}