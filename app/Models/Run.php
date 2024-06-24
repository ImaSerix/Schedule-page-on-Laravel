<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    use HasFactory;
    protected $fillable = [
        'route_id',
        'is_work_day',
        'start_time',
    ];
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
    }
}
