<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $primaryKey = ['RouteID', 'StopID'];
    public $incrementing = false;
    protected $keyType = 'composite';
    protected $fillable = [
        'RouteID',
        'StopID',
        'IsWorkDay',
        'Order',
        'TimeDelta',
    ];
    use HasFactory;
    public function stop()
    {
        return $this->belongsTo(Stop::class, 'StopID', 'StopID');
    }
    public function route()
    {
        return $this->belongsTo(Stop::class, 'RouteID', 'RouteID');
    }
}
