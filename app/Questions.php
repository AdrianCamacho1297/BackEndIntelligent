<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'pregunta',
        'test_id',
    ];

    ##Solo pertece a un test
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function answers()
    {
        return $this->hasMany(
            Answer::class,'question_id'
        );
    }
}
