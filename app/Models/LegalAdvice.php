<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalAdvice extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'category_id',
        'user_id',
        'image',
        'status'
    ];
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function count_reply()
    {
        return $this->hasMany('App\Models\ReplyAdvice', 'question_id', 'id')->count();
    }
    public function replies()
    {
        return $this->hasMany('App\Models\ReplyAdvice', 'question_id', 'id');
    }
}
