<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    use HasFactory;
    protected $fillable = [
        'RouteID',
        'IsWorkDay',
        'StartTime',
    ];
    public function route()
    {
        return $this->belongsTo(Route::class, 'RouteID', 'RouteID');
    }
}
