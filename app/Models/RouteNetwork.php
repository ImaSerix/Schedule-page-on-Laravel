<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteNetwork extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'transport_type',
    ];
}
