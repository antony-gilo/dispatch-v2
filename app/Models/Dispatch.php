<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'caller_phone',
        'victim_name',
        'victim_gender',
        'kin_name',
        'kin_phone',
        'location_id',
        'ambulance_id',
        'emergency_details',
    ];

    public function hospitals()
    {
        return $this->hasMany(Location::class);
    }
}
