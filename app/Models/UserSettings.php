<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'settings',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getSettings(){
        return $this->settings;
    }
    public function setSetting($settings){
        $this->settings()->update([
            'user_id' => $this->user()->id(),
            'settings' => $settings,
        ]);
    }
}
