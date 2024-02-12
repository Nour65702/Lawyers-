<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribeUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'package_id',
        'price',
        'balance',
        'status'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id', 'id');
    }
}
