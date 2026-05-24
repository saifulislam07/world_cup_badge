<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorldCupMatch extends Model
{
    protected $fillable = [
        'match_number',
        'stage',
        'group',
        'home_team',
        'away_team',
        'kickoff_at',
        'venue',
        'status',
    ];

    protected $casts = [
        'kickoff_at' => 'datetime',
    ];
}
