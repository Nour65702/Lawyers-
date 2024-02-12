<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'notification',
        'reciver',
        'sender'
    ];
    public function sender_user()
    {
        return $this->belongsTo('App\Models\User', 'sender', 'id');
    }

    public function reciver_user()
    {
        return $this->belongsTo('App\Models\User', 'reciver', 'id');
    }
}
