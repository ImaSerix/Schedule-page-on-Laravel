<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $primaryKey = 'RouteID';
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $fillable = [
        'RouteID',
        'RouteNetworkID',
        'Direction',
        'Description',
    ];
    public function routeNetwork()
    {
        return $this->belongsTo(RouteNetwork::class, 'RouteNetworkID', 'RouteNetworkID');
    }
}
