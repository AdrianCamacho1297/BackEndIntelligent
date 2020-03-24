<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Questions;

class Test extends Model
{
    ## Define los atributos del Modelo Test
    protected $fillable = [
        'nombreTest',
        'descripcionTest',
        'duracionTest',
    ];

    ## Test tiene muchas preguntas
    public function questions()
    {
        return $this->hasMany(
            Questions::class
        );
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
