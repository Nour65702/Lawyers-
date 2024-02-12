<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderLicence extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'category_id',
        'active'
    ];
    public function provider()
    {
        return $this->belongsTo('App\Models\User', 'provider_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
}
