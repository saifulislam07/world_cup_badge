<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorldCupYear extends Model
{
    protected $fillable = ['year', 'is_default', 'status'];

    protected $casts = [
        'is_default' => 'boolean',
        'status' => 'boolean',
    ];

    public function placardRecords()
    {
        return $this->hasMany(PlacardRecord::class);
    }
}
