<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteNetwork extends Model
{
    use HasFactory;
    protected $primaryKey = 'RouteNetworkID';
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $fillable = [
        'RouteNetworkID',
        'Name',
        'TransportType',
    ];
}
