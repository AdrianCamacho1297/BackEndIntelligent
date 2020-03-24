<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'answer_id',
        'question_id',
        'user_id'
    ];
    public function question()
    {
        return $this->belongsTo(Questions::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
