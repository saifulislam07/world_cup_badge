<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'flag', 'code', 'status', 'sort_order'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function placardRecords()
    {
        return $this->hasMany(PlacardRecord::class);
    }
}
