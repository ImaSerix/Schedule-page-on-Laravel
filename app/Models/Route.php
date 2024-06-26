<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $fillable = [
        'route_network_id',
        'direction',
        'description',
    ];
    public function routeNetwork()
    {
        return $this->belongsTo(RouteNetwork::class, 'route_network_id', 'id');
    }
    public function schedules(){
        return $this->hasMany(Schedule::class, 'route_id', 'id');
    }
    public function runs(){
        return $this->hasMany(Run::class, 'route_id', 'id');
    }
}
