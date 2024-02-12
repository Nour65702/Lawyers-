<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyAdvice extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'provider_id',
        'reply'
    ];
    public function question()
    {
        return $this->belongsTo('App\Models\LegalAdvice', 'question_id', 'id');
    }
    public function provider()
    {
        return $this->belongsTo('App\Models\User', 'provider_id', 'id');
    }
}
