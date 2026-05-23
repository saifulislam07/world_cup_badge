<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlacardRecord extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'country_id',
        'world_cup_year_id',
        'download_count',
        'ip_address',
        'user_agent',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function year()
    {
        return $this->belongsTo(WorldCupYear::class, 'world_cup_year_id');
    }
}
