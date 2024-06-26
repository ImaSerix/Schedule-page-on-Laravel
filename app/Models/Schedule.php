<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'route_id',
        'stop_id',
        'is_work_day',
        'order',
        'time_delta',
    ];
    use HasFactory;
    public function stop()
    {
        return $this->belongsTo(Stop::class, 'stop_id', 'id');
    }
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
    }
}
