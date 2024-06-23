<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedStop extends Model
{
    use HasFactory;
    protected $fillable = [
        'StopID',
        'UserID',
    ];
    public function stop()
    {
        return $this->belongsTo(Stop::class, 'StopID', 'StopID');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }
}
