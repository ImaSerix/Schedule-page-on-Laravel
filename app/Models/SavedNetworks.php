<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedNetworks extends Model
{
    use HasFactory;
    protected $fillable = [
        'route_network_id',
        'user_id',
    ];
    public function route_network()
    {
        return $this->belongsTo(RouteNetwork::class, 'route_network_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
