<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function provider()
    {
        return $this->hasMany('App\Models\ProviderLicence', 'provider_id', 'id');
    }
}
