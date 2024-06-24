<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'stop_id',
        'longitude',
        'latitude',
    ];

    public function stop()
    {
        return $this->belongsTo(Stop::class, 'stop_id', 'id');
    }
}
