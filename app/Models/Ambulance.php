<?php

namespace App\Models;

use App\Models\User;
use App\Models\Photo;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ambulance extends Model
{
    use HasFactory;

    protected $fillable = [
        'reg_no',
        'status',
        'driver_id',
        'incident_id',
        'photo_id'
    ];

    public function driver()
    {
        return $this->belongsTo(User::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function setRegNoAttribute($value)
    {
        $this->attributes['reg_no'] = substr(Str::upper($value), 0, 3) . " " . substr(Str::upper($value), 3);
    }

    public function dispatches()
    {
        return $this->hasMany(Dispatch::class);
    }
}
