<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'user_id',
        'date',
        'time',
        'status'
    ];
    public function user()
    {
        return $this->belongsto('App\Models\User','user_id','id');
    }
    public function provider()
    {
        return $this->belongsTo('App\Models\User', 'provider_id', 'id');
    }
}
