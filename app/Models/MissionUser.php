<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MissionUser extends Model
{
    use HasFactory;

    protected $table = 'mission_user';

    protected $fillable = [
        'mission_id',
        'user_id',
        'chef_equipe',
    ];

    protected $casts = [
        'chef_equipe' => 'boolean',
    ];

    /**
     * Mission associée.
     */
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    /**
     * Utilisateur associé.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}