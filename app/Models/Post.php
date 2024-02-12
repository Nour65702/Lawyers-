<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'image',
        'provider_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Models\User','provider_id','id');
    }
}
