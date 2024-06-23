<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    use HasFactory;
    protected $primaryKey = 'RunID';
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $fillable = [
        'RunID',
        'RouteID',
        'IsWorkDay',
        'StartTime',
    ];
    public function route()
    {
        return $this->belongsTo(Route::class, 'RouteID', 'RouteID');
    }
}
