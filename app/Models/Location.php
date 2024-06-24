<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $primaryKey = 'StopID';
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $fillable = [
        'StopID',
        'Longitude',
        'Latitude',
    ];

    public function stop()
    {
        return $this->belongsTo(Stop::class, 'StopID', 'StopID');
    }
}
